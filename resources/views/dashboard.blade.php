<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
        <!-- Subscription Plans Section -->
        <div class="mt-8">
            <h3 class="text-lg font-bold mb-4">Choose Your Subscription Plan</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(App\Models\SubscriptionPlan::orderBy('sort_order')->get() as $plan)
                    <div class="border rounded-lg p-6 bg-white dark:bg-gray-700 shadow">
                        <h4 class="text-xl font-semibold mb-2">{{ $plan->name }}</h4>
                        <p class="mb-2 text-gray-600 dark:text-gray-300">{{ $plan->description }}</p>
                        <div class="mb-2">
                            <span class="text-2xl font-bold">
                                @if($plan->isFree())
                                    Free
                                @else
                                    ₹{{ number_format($plan->price / 100, 2) }}
                                @endif
                            </span>
                            <span class="ml-2 text-sm">for {{ $plan->duration_days }} days</span>
                        </div>
                        <ul class="mb-4 list-disc pl-5">
                            @foreach($plan->features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                        <form method="POST" action="{{ route('subscription.select', $plan->id) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Select</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
