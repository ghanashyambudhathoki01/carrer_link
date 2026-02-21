<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Resume</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- html2pdf library --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; margin: 0; }
            .print-shadow { shadow: none; }
        }
    </style>
</head>
<body class="bg-gray-100 p-4 md:p-12 print:bg-white print:p-0">
    
    {{-- Controls --}}
    <div class="max-w-[21cm] mx-auto mb-6 no-print flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
        <a href="{{ route('seeker.resume.builder') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Builder
        </a>
        <div class="flex gap-3">
            <button onclick="window.print()" class="px-6 py-2 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Print
            </button>
            <button onclick="downloadPDF()" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                Download PDF
            </button>
        </div>
    </div>

    {{-- Resume Paper --}}
    <div id="resume-content" class="max-w-[21cm] min-h-[29.7cm] mx-auto bg-white shadow-2xl print:shadow-none overflow-hidden flex flex-col md:flex-row">
        
        {{-- Sidebar --}}
        <div class="w-full md:w-72 bg-slate-900 text-white p-10 flex flex-col">
            <div class="mb-10 text-center md:text-left">
                <div class="w-32 h-32 rounded-3xl bg-blue-600 mx-auto md:mx-0 mb-6 flex items-center justify-center text-5xl font-black shadow-2xl">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h1 class="text-2xl font-black leading-tight mb-2">{{ $user->name }}</h1>
                <p class="text-blue-400 font-bold text-xs uppercase tracking-widest">{{ $user->seekerProfile->headline ?? 'Professional' }}</p>
            </div>

            <div class="space-y-10">
                <div>
                    <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Contact</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-sm font-medium text-slate-300">
                            <span class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400">📧</span>
                            {{ $user->email }}
                        </li>
                        @if($user->seekerProfile->current_location)
                        <li class="flex items-center gap-3 text-sm font-medium text-slate-300">
                            <span class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-slate-400">📍</span>
                            {{ $user->seekerProfile->current_location }}
                        </li>
                        @endif
                    </ul>
                </div>

                @if($user->socialLinks->count())
                <div>
                    <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Social Presence</h3>
                    <ul class="space-y-3">
                        @foreach($user->socialLinks as $link)
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-400">
                            <span class="w-6 h-6 rounded bg-slate-800 flex items-center justify-center">🔗</span>
                            <span class="text-slate-300">{{ $link->platform }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($user->languages->count())
                <div>
                    <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Languages</h3>
                    <div class="space-y-3">
                        @foreach($user->languages as $lang)
                        <div>
                            <div class="flex justify-between text-xs font-bold mb-1">
                                <span class="text-slate-300">{{ $lang->name }}</span>
                                <span class="text-slate-500 text-[10px]">{{ $lang->proficiency }}</span>
                            </div>
                            <div class="h-1 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600 rounded-full" style="width: {{ $lang->proficiency == 'Native' ? '100%' : ($lang->proficiency == 'Fluent' ? '75%' : ($lang->proficiency == 'Intermediate' ? '50%' : '25%')) }}"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($user->seekerProfile->skills && is_array($user->seekerProfile->skills))
                <div>
                    <h3 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->seekerProfile->skills as $skill)
                            <span class="px-3 py-1 bg-slate-800 text-slate-300 rounded-lg text-[10px] font-bold">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="mt-auto pt-10 text-slate-600 text-[10px] font-bold uppercase tracking-widest text-center">
                CareerLink Certified
            </div>
        </div>

        {{-- Main Content --}}
        <div class="flex-1 p-12 bg-white">
            <div class="space-y-12">
                
                {{-- Summary --}}
                @if($user->seekerProfile->bio)
                <div>
                    <h2 class="text-sm font-black text-blue-600 uppercase tracking-[0.2em] mb-4 border-b border-gray-100 pb-2">Professional Summary</h2>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $user->seekerProfile->bio }}
                    </p>
                </div>
                @endif

                {{-- Experience --}}
                @if($user->workExperiences->count())
                <div>
                    <h2 class="text-sm font-black text-blue-600 uppercase tracking-[0.2em] mb-6 border-b border-gray-100 pb-2">Work Experience</h2>
                    <div class="space-y-8">
                        @foreach($user->workExperiences as $exp)
                            <div class="relative pl-8 border-l-2 border-gray-100">
                                <div class="absolute -left-[9px] top-0 w-4 h-4 bg-white border-2 border-blue-600 rounded-full"></div>
                                <div class="flex justify-between items-start mb-1">
                                    <h3 class="font-bold text-gray-900">{{ $exp->position }}</h3>
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        {{ $exp->start_date->format('M Y') }} – {{ $exp->is_current ? 'Present' : $exp->end_date->format('M Y') }}
                                    </span>
                                </div>
                                <div class="text-sm font-bold text-blue-600 mb-3">{{ $exp->company }}</div>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ $exp->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Education --}}
                @if($user->educations->count())
                <div>
                    <h2 class="text-sm font-black text-blue-600 uppercase tracking-[0.2em] mb-6 border-b border-gray-100 pb-2">Education</h2>
                    <div class="space-y-8">
                        @foreach($user->educations as $edu)
                            <div class="relative pl-8 border-l-2 border-gray-100">
                                <div class="absolute -left-[9px] top-0 w-4 h-4 bg-white border-2 border-purple-600 rounded-full"></div>
                                <div class="flex justify-between items-start mb-1">
                                    <h3 class="font-bold text-gray-900">{{ $edu->degree }} in {{ $edu->field_of_study }}</h3>
                                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                        {{ $edu->start_date->format('Y') }} – {{ $edu->is_current ? 'Present' : $edu->end_date->format('Y') }}
                                    </span>
                                </div>
                                <div class="text-sm font-bold text-purple-600">{{ $edu->school }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Certifications --}}
                @if($user->certifications->count())
                <div>
                    <h2 class="text-sm font-black text-blue-600 uppercase tracking-[0.2em] mb-6 border-b border-gray-100 pb-2">Certifications</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @foreach($user->certifications as $cert)
                            <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                <div class="text-sm font-bold text-gray-900 mb-1">{{ $cert->name }}</div>
                                <div class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-2">{{ $cert->issuer }}</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                    {{ $cert->issue_date->format('M Y') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>

    <div class="max-w-[21cm] mx-auto mt-8 text-center no-print">
        <p class="text-sm text-gray-400">Tip: If the download button is not available, you can still save as PDF using the Print button.</p>
    </div>

    <script>
        function downloadPDF() {
            const element = document.getElementById('resume-content');
            const opt = {
                margin: 0,
                filename: '{{ $user->name }}_Resume.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
            
            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>
