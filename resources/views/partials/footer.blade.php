<footer class="bg-gray-950 text-gray-400 mt-16 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <span class="text-xl font-bold text-white">Career<span class="text-emerald-400">Link</span></span>
            </div>
            <p class="text-sm text-gray-400 leading-relaxed">Nepal's premier job portal connecting talented professionals with great companies.</p>
        </div>
        <div>
            <h4 class="font-semibold text-white mb-3">For Job Seekers</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('jobs.index') }}" class="hover:text-blue-400 transition-colors">Browse Jobs</a></li>
                <li><a href="{{ route('internships') }}" class="hover:text-blue-400 transition-colors">Internships</a></li>
                <li><a href="{{ route('events.index') }}" class="hover:text-blue-400 transition-colors">Career Events</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold text-white mb-3">For Employers</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('subscriptions.index') }}" class="hover:text-blue-400 transition-colors">Post a Job</a></li>
                <li><a href="{{ route('subscriptions.index') }}" class="hover:text-blue-400 transition-colors">View Pricing</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold text-white mb-3">Legal</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('privacy') }}" class="hover:text-blue-400 transition-colors">Privacy Policy</a></li>
                <li><a href="{{ route('terms') }}" class="hover:text-blue-400 transition-colors">Terms of Use</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-semibold text-white mb-3">Contact</h4>
            <ul class="space-y-2 text-sm text-gray-400">
                <li>📧 info@careerlink.com.np</li>
                <li>📞 +977-01-5000000</li>
                <li>📍 Kathmandu, Nepal</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-800 text-center py-4 text-xs text-gray-500">
        &copy; {{ date('Y') }} CareerLink Nepal. All rights reserved.
    </div>
</footer>
