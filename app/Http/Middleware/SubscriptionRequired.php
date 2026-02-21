<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionRequired
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Only enforce for employers
        if ($user && $user->isEmployer()) {
            if (!$user->hasActiveSubscription()) {
                // Check if they have a pending subscription
                $pendingSub = $user->subscriptions()->where('status', 'pending')->exists();
                
                if ($pendingSub) {
                    return redirect()->route('subscriptions.index')->with('warning', 'Your subscription is pending admin verification. You will get access once it is approved.');
                }

                return redirect()->route('subscriptions.index')->with('error', 'Please subscribe to a plan to access the employer dashboard.');
            }
        }

        return $next($request);
    }
}
