<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::where('is_active', true)->orderBy('sort_order')->get();
        $user = auth()->user();
        
        $currentSub = $user ? $user->subscriptions()->where('status', 'active')->where('expires_at', '>', now())->with('plan')->latest()->first() : null;
        $latestAttempt = $user ? $user->subscriptions()->whereIn('status', ['pending', 'cancelled'])->with('plan')->latest()->first() : null;

        return view('subscriptions.index', compact('plans', 'currentSub', 'latestAttempt'));
    }

    // Handle subscription plan selection
    public function select(Request $request, SubscriptionPlan $plan)
    {
        $user = $request->user();
        // If free plan, activate immediately
        if ($plan->isFree()) {
            Subscription::create([
                'user_id'        => $user->id,
                'plan_id'        => $plan->id,
                'starts_at'      => now(),
                'expires_at'     => now()->addDays($plan->duration_days),
                'status'         => 'active',
                'payment_method' => 'free',
                'is_verified'    => true,
                'verified_at'    => now(),
            ]);
            return redirect()->route('dashboard')->with('success', 'Free plan activated!');
        }
        // For paid plans, redirect to checkout
        return redirect()->route('subscriptions.checkout', $plan->id);
    }

    public function checkout(int $planId)
    {

        $plan = SubscriptionPlan::findOrFail($planId);

        if ($plan->isFree()) {
            Subscription::create([
                'user_id'        => auth()->id(),
                'plan_id'        => $plan->id,
                'starts_at'      => now(),
                'expires_at'     => now()->addDays($plan->duration_days),
                'status'         => 'active',
                'payment_method' => 'free',
                'is_verified'    => true,
                'verified_at'    => now(),
            ]);
            return redirect()->route('subscriptions.index')->with('success', 'Free plan activated!');
        }

        return view('subscriptions.checkout', compact('plan'));
    }

    public function submit(Request $request, int $planId)
    {

        $plan = SubscriptionPlan::findOrFail($planId);

        $request->validate([
            'payment_reference' => 'required|string|max:100',
            'payment_screenshot'=> 'required|file|image|max:5120',
        ]);

        $screenshotPath = $request->file('payment_screenshot')->store('payment-proofs', 'public');

        Subscription::create([
            'user_id'            => auth()->id(),
            'plan_id'            => $plan->id,
            'starts_at'          => null,
            'expires_at'         => null,
            'status'             => 'pending',
            'payment_method'     => 'kumari_bank_qr',
            'payment_reference'  => $request->payment_reference,
            'payment_screenshot' => $screenshotPath,
            'is_verified'        => false,
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Payment submitted! Your subscription will be activated after admin verification (usually within 24 hours).');
    }
}
