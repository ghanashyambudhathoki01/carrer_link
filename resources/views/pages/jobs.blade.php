@extends('layouts.app')
@section('title', 'Jobs — JobPortal')

@section('content')

<!-- Page Header -->
<section class="gradient-hero relative overflow-hidden py-20">
    <div class="orb w-80 h-80 bg-secondary top-[-20%] left-[10%]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto">
            <div class="badge bg-secondary/10 text-secondary border border-secondary/20 mb-4">
                💼 10,000+ Active Jobs
            </div>
            
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
                Browse <span class="gradient-text">Jobs</span>
            </h1>
            
            <p class="text-slate-400 text-lg mb-6">
                Discover opportunities from top companies across Nepal and beyond.
            </p>

            <!-- Typing animation – two lines -->
            <div class="typing-wrapper text-2xl sm:text-3xl font-bold text-white min-h-[5rem] flex flex-col items-center justify-center leading-tight">
                <div class="line-wrapper">
                    <span id="typed-line1"></span>
                    <span class="cursor animate-blink" id="cursor1">|</span>
                </div>
                <div class="line-wrapper mt-1">
                    <span id="typed-line2"></span>
                    <span class="cursor animate-blink hidden" id="cursor2">|</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Job Listings section remains unchanged -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search & Filter -->
        <div class="glass-card p-4 mb-10 flex flex-col md:flex-row gap-4">
            <div class="flex-1 flex items-center gap-2 px-3">
                <svg class="w-5 h-5 text-slate-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" placeholder="Job title, company" class="w-full py-2 bg-transparent text-white placeholder-slate-500 outline-none text-sm">
            </div>
            <select class="form-input !py-2 !w-auto min-w-[150px]">
                <option>All Locations</option>
                <option>Kathmandu</option>
                <option>Lalitpur</option>
                <option>Pokhara</option>
                <option>Remote</option>
            </select>
            <select class="form-input !py-2 !w-auto min-w-[150px]">
                <option>Job Type</option>
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Contract</option>
                <option>Freelance</option>
            </select>
            <button class="btn-primary !py-2">Search</button>
        </div>

        <!-- Job List -->
        <div class="space-y-4">
            @php
                $jobs = [
                    ['title' => 'Senior Frontend Developer', 'company' => 'CloudTech Pvt. Ltd.', 'location' => 'Kathmandu', 'type' => 'Full-time', 'salary' => 'Rs. 80K - 120K/mo', 'tags' => ['React', 'TypeScript', 'Node.js'], 'posted' => '2 days ago', 'urgent' => true],
                    ['title' => 'Product Manager', 'company' => 'InnovateLab', 'location' => 'Remote', 'type' => 'Full-time', 'salary' => 'Rs. 100K - 150K/mo', 'tags' => ['Agile', 'Roadmap', 'Analytics'], 'posted' => '1 day ago', 'urgent' => false],
                    ['title' => 'Graphic Designer', 'company' => 'CreativeMinds', 'location' => 'Lalitpur', 'type' => 'Full-time', 'salary' => 'Rs. 45K - 65K/mo', 'tags' => ['Photoshop', 'Illustrator', 'Figma'], 'posted' => '3 days ago', 'urgent' => false],
                    ['title' => 'Backend Developer (Laravel)', 'company' => 'SoftNep Solutions', 'location' => 'Kathmandu', 'type' => 'Full-time', 'salary' => 'Rs. 70K - 100K/mo', 'tags' => ['Laravel', 'PHP', 'MySQL'], 'posted' => '5 hours ago', 'urgent' => true],
                    ['title' => 'DevOps Engineer', 'company' => 'ServerMax', 'location' => 'Remote', 'type' => 'Contract', 'salary' => 'Rs. 90K - 130K/mo', 'tags' => ['AWS', 'Docker', 'CI/CD'], 'posted' => '1 week ago', 'urgent' => false],
                    ['title' => 'Digital Marketing Specialist', 'company' => 'BrandGrowth Nepal', 'location' => 'Pokhara', 'type' => 'Part-time', 'salary' => 'Rs. 30K - 50K/mo', 'tags' => ['SEO', 'Google Ads', 'Social Media'], 'posted' => '4 days ago', 'urgent' => false],
                ];
            @endphp

            @foreach($jobs as $job)
            <div class="glass-card p-6 flex flex-col md:flex-row md:items-center gap-4">
                <!-- Company Icon -->
                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                    <span class="text-primary-light font-bold text-lg">{{ substr($job['company'], 0, 1) }}</span>
                </div>

                <!-- Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 flex-wrap mb-1">
                        <h3 class="text-white font-semibold text-lg">{{ $job['title'] }}</h3>
                        @if($job['urgent'])
                        <span class="badge bg-red-500/10 text-red-400 border border-red-500/20 !text-[10px]">🔥 Urgent</span>
                        @endif
                    </div>
                    <p class="text-slate-400 text-sm mb-2">{{ $job['company'] }}</p>
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-slate-500 text-sm">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $job['location'] }}
                        </span>
                        <span>{{ $job['type'] }}</span>
                        <span>{{ $job['salary'] }}</span>
                        <span>{{ $job['posted'] }}</span>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach($job['tags'] as $tag)
                        <span class="tag !text-xs">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Action -->
                <div class="shrink-0 flex items-center gap-3">
                    <button class="btn-outline !py-2 !px-4 text-sm">Save</button>
                    <button class="btn-primary !py-2 !px-5 text-sm">Apply</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
    .cursor {
        display: inline-block;
        width: 2px;
        margin-left: 2px;
        vertical-align: middle;
    }

    .animate-blink {
        animation: blink 1.1s step-end infinite;
    }

    @keyframes blink {
        from, to { opacity: 1; }
        50%      { opacity: 0; }
    }

    .typing-wrapper {
        min-height: 5.5rem; /* enough space for two lines */
    }

    .line-wrapper {
        display: inline-flex;
        align-items: center;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const line1Element = document.getElementById('typed-line1');
    const line2Element = document.getElementById('typed-line2');
    const cursor1       = document.getElementById('cursor1');
    const cursor2       = document.getElementById('cursor2');

    if (!line1Element || !line2Element) {
        console.warn('Typing elements not found');
        return;
    }

    const line1 = "Unlock Your";
    const line2 = "Professional Future";

    let i = 0;
    let currentLine = 1;
    let isDeleting = false;

    function type() {
        // Typing phase
        if (!isDeleting) {
            if (currentLine === 1 && i < line1.length) {
                line1Element.textContent += line1.charAt(i);
                i++;
                setTimeout(type, 60 + Math.random() * 50);
                return;
            }
            if (currentLine === 2 && i < line2.length) {
                line2Element.textContent += line2.charAt(i);
                i++;
                setTimeout(type, 60 + Math.random() * 50);
                return;
            }
        }

        // Finished line 1 → pause → switch to line 2
        if (currentLine === 1 && i === line1.length && !isDeleting) {
            setTimeout(() => {
                cursor1.classList.add('hidden');
                cursor2.classList.remove('hidden');
                currentLine = 2;
                i = 0;
                type();
            }, 1200); // pause after first line
            return;
        }

        // Finished line 2 → pause → start deleting (or stop / loop)
        if (currentLine === 2 && i === line2.length && !isDeleting) {
            setTimeout(() => {
                isDeleting = true;
                type();
            }, 2200); // longer pause when both lines are complete
            return;
        }

        // Deleting phase (backspace both lines – optional)
        if (isDeleting) {
            if (currentLine === 2 && i > 0) {
                line2Element.textContent = line2.substring(0, i - 1);
                i--;
                setTimeout(type, 40);
                return;
            }
            if (currentLine === 2 && i === 0) {
                currentLine = 1;
                setTimeout(() => {
                    type();
                }, 600);
                return;
            }
            if (currentLine === 1 && i > 0) {
                line1Element.textContent = line1.substring(0, i - 1);
                i--;
                setTimeout(type, 40);
                return;
            }
            if (currentLine === 1 && i === 0) {
                isDeleting = false;
                setTimeout(type, 800); // restart after full clear
            }
        }
    }

    // Initial start
    setTimeout(() => {
        line1Element.textContent = '';
        line2Element.textContent = '';
        type();
    }, 800);
});
</script>
@endsection