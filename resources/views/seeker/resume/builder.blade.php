@extends('layouts.app')
@section('title', 'Resume Builder')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        
        @include('seeker.partials.sidebar')

        <div class="flex-1">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 dark:text-white leading-tight">Resume <span class="text-blue-600">Builder</span></h1>
                    <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium">Create a professional resume in minutes.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('seeker.resume.preview') }}" target="_blank" class="px-6 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-200 font-bold rounded-2xl hover:shadow-lg transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Full Preview
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                {{-- Form Sections --}}
                <div class="space-y-8">
                    {{-- Personal Information --}}
                    <section class="glass dark:glass-dark rounded-[2rem] p-8 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <h2 class="text-xl font-black text-gray-800 dark:text-gray-200 uppercase tracking-tight">Personal Info</h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Name</label>
                                <input type="text" readonly value="{{ auth()->user()->name }}" class="w-full border-none bg-gray-50 dark:bg-gray-900 rounded-xl px-4 py-3 text-sm text-gray-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Email</label>
                                <input type="text" readonly value="{{ auth()->user()->email }}" class="w-full border-none bg-gray-50 dark:bg-gray-900 rounded-xl px-4 py-3 text-sm text-gray-500 cursor-not-allowed">
                            </div>
                            <div class="sm:col-span-2">
                                <p class="text-xs text-gray-400 mt-2">Manage these in your <a href="{{ route('seeker.profile') }}" class="text-blue-600 hover:underline">main profile</a>.</p>
                            </div>
                        </div>
                    </section>

                    {{-- Work Experience --}}
                    <section class="glass dark:glass-dark rounded-[2rem] p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <h2 class="text-xl font-black text-gray-800 dark:text-gray-200 uppercase tracking-tight">Work Experience</h2>
                            </div>
                            <button onclick="toggleModal('exp-modal')" class="p-2 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            @forelse($user->workExperiences as $exp)
                                <div class="p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800 flex justify-between items-start group">
                                    <div>
                                        <h3 class="font-bold text-gray-800 dark:text-gray-200">{{ $exp->position }}</h3>
                                        <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">{{ $exp->company }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">
                                            {{ $exp->start_date->format('M Y') }} – {{ $exp->is_current ? 'Present' : $exp->end_date->format('M Y') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('seeker.resume.experience.delete', $exp->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-center py-6 border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-2xl">
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">No experience added yet</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- Education --}}
                    <section class="glass dark:glass-dark rounded-[2rem] p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 text-purple-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                                </div>
                                <h2 class="text-xl font-black text-gray-800 dark:text-gray-200 uppercase tracking-tight">Education</h2>
                            </div>
                            <button onclick="toggleModal('edu-modal')" class="p-2 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            @forelse($user->educations as $edu)
                                <div class="p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800 flex justify-between items-start group">
                                    <div>
                                        <h3 class="font-bold text-gray-800 dark:text-gray-200">{{ $edu->degree }} - {{ $edu->field_of_study }}</h3>
                                        <p class="text-sm text-purple-600 dark:text-purple-400 font-medium">{{ $edu->school }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">
                                            {{ $edu->start_date->format('Y') }} – {{ $edu->is_current ? 'Present' : $edu->end_date->format('Y') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('seeker.resume.education.delete', $edu->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-center py-6 border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-2xl">
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">No education added yet</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- Certifications --}}
                    <section class="glass dark:glass-dark rounded-[2rem] p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 text-orange-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                                </div>
                                <h2 class="text-xl font-black text-gray-800 dark:text-gray-200 uppercase tracking-tight">Certifications</h2>
                            </div>
                            <button onclick="toggleModal('cert-modal')" class="p-2 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            @forelse($user->certifications as $cert)
                                <div class="p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800 flex justify-between items-start group">
                                    <div>
                                        <h3 class="font-bold text-gray-800 dark:text-gray-200">{{ $cert->name }}</h3>
                                        <p class="text-sm text-orange-600 dark:text-orange-400 font-medium">{{ $cert->issuer }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">
                                            Issued: {{ $cert->issue_date->format('M Y') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('seeker.resume.certification.delete', $cert->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-center py-6 border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-2xl">
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">No certifications added yet</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- Languages --}}
                    <section class="glass dark:glass-dark rounded-[2rem] p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
                                </div>
                                <h2 class="text-xl font-black text-gray-800 dark:text-gray-200 uppercase tracking-tight">Languages</h2>
                            </div>
                            <button onclick="toggleModal('lang-modal')" class="p-2 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            @forelse($user->languages as $lang)
                                <div class="px-4 py-2 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-100 dark:border-gray-800 flex items-center gap-3">
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $lang->name }}</p>
                                        <p class="text-[10px] text-blue-600 dark:text-blue-400 font-bold uppercase">{{ $lang->proficiency }}</p>
                                    </div>
                                    <form action="{{ route('seeker.resume.language.delete', $lang->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="w-full text-center py-6 border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-2xl">
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">No languages added yet</p>
                                </div>
                            @endforelse
                        </div>
                    </section>

                    {{-- Social Links --}}
                    <section class="glass dark:glass-dark rounded-[2rem] p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-pink-100 dark:bg-pink-900/30 text-pink-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.102 1.101"></path></svg>
                                </div>
                                <h2 class="text-xl font-black text-gray-800 dark:text-gray-200 uppercase tracking-tight">Social Links</h2>
                            </div>
                            <button onclick="toggleModal('social-modal')" class="p-2 bg-blue-600 text-white rounded-xl shadow-lg hover:bg-blue-700 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>

                        <div class="space-y-4">
                            @forelse($user->socialLinks as $link)
                                <div class="p-5 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-gray-100 dark:border-gray-800 flex justify-between items-start group">
                                    <div>
                                        <h3 class="font-bold text-gray-800 dark:text-gray-200">{{ $link->platform }}</h3>
                                        <a href="{{ $link->url }}" target="_blank" class="text-sm text-pink-600 dark:text-pink-400 font-medium hover:underline">{{ $link->url }}</a>
                                    </div>
                                    <form action="{{ route('seeker.resume.social.delete', $link->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-center py-6 border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-2xl">
                                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">No social links added yet</p>
                                </div>
                            @endforelse
                        </div>
                    </section>
                </div>

                {{-- Preview Panel --}}
                <div class="hidden xl:block">
                    <div class="sticky top-24">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Live Preview</h2>
                            <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-bold uppercase">Modern Theme</span>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 aspect-[1/1.4] overflow-hidden transform scale-90 origin-top transition-transform hover:scale-95">
                            {{-- Minified template preview --}}
                            <div class="p-8 h-full flex flex-col pointer-events-none">
                                <div class="flex items-center gap-4 border-b border-gray-100 dark:border-gray-700 pb-6 mb-6">
                                    <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-2xl font-black">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-black text-gray-900 dark:text-white leading-tight">{{ auth()->user()->name }}</h3>
                                        <p class="text-xs text-blue-600 dark:text-blue-400 font-bold uppercase tracking-tighter">{{ $user->seekerProfile->headline ?? 'Your Headline Here' }}</p>
                                    </div>
                                </div>
                                <div class="flex-1 space-y-6 overflow-hidden">
                                    <div>
                                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Experience</h4>
                                        <div class="space-y-3">
                                            @foreach($user->workExperiences->take(2) as $exp)
                                                <div class="border-l-2 border-gray-100 dark:border-gray-700 pl-4 py-1">
                                                    <div class="text-xs font-bold text-gray-800 dark:text-gray-200">{{ $exp->position }}</div>
                                                    <div class="text-[10px] text-gray-500">{{ $exp->company }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Education</h4>
                                            <div class="space-y-2">
                                                @foreach($user->educations->take(1) as $edu)
                                                    <div class="text-[10px] font-bold text-gray-800 dark:text-gray-200">{{ $edu->degree }}</div>
                                                    <div class="text-[8px] text-gray-500">{{ $edu->school }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Certifications</h4>
                                            <div class="space-y-2">
                                                @foreach($user->certifications->take(1) as $cert)
                                                    <div class="text-[10px] font-bold text-gray-800 dark:text-gray-200">{{ $cert->name }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-auto pt-6 border-t border-gray-100 dark:border-gray-700 text-center">
                                    <p class="text-[10px] text-gray-400">Generated by CareerLink Premium Resume Builder</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modals --}}
<div id="exp-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden animate-fade-in-up">
        <div class="p-8 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-800 dark:text-white">Add <span class="text-emerald-600">Work Experience</span></h3>
            <button onclick="toggleModal('exp-modal')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('seeker.resume.experience.store') }}" method="POST" class="p-8 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Company Name</label>
                    <input type="text" name="company" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Position</label>
                    <input type="text" name="position" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Start Date</label>
                    <input type="date" name="start_date" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">End Date</label>
                    <input type="date" name="end_date" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_current" value="1" class="rounded border-gray-300 text-blue-600">
                        <span class="text-xs font-bold text-gray-500">I am currently working here</span>
                    </label>
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Description / Achievements</label>
                    <textarea name="description" rows="3" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
            </div>
            <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black rounded-2xl shadow-xl shadow-emerald-100 dark:shadow-none transition-all mt-4">Save Experience</button>
        </form>
    </div>
</div>

<div id="edu-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden animate-fade-in-up">
        <div class="p-8 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-800 dark:text-white">Add <span class="text-purple-600">Education</span></h3>
            <button onclick="toggleModal('edu-modal')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('seeker.resume.education.store') }}" method="POST" class="p-8 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">School / University</label>
                    <input type="text" name="school" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Degree</label>
                    <input type="text" name="degree" required placeholder="e.g. Bachelor's" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Field of Study</label>
                    <input type="text" name="field_of_study" required placeholder="e.g. CS" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Start Date</label>
                    <input type="date" name="start_date" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">End Date</label>
                    <input type="date" name="end_date" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_current" value="1" class="rounded border-gray-300 text-blue-600">
                        <span class="text-xs font-bold text-gray-500">I am currently studying here</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="w-full py-4 bg-purple-600 hover:bg-purple-700 text-white font-black rounded-2xl shadow-xl shadow-purple-100 dark:shadow-none transition-all mt-4">Save Education</button>
        </form>
    </div>
</div>

<div id="cert-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden animate-fade-in-up">
        <div class="p-8 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-800 dark:text-white">Add <span class="text-orange-600">Certification</span></h3>
            <button onclick="toggleModal('cert-modal')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('seeker.resume.certification.store') }}" method="POST" class="p-8 space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Certification Name</label>
                    <input type="text" name="name" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Issuing Organization</label>
                    <input type="text" name="issuer" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Issue Date</label>
                    <input type="date" name="issue_date" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Expiry Date (Optional)</label>
                    <input type="date" name="expiry_date" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Credential ID (Optional)</label>
                    <input type="text" name="credential_id" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Credential URL (Optional)</label>
                    <input type="url" name="credential_url" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <button type="submit" class="w-full py-4 bg-orange-600 hover:bg-orange-700 text-white font-black rounded-2xl shadow-xl shadow-orange-100 dark:shadow-none transition-all mt-4">Save Certification</button>
        </form>
    </div>
</div>

<div id="lang-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden animate-fade-in-up">
        <div class="p-8 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-800 dark:text-white">Add <span class="text-indigo-600">Language</span></h3>
            <button onclick="toggleModal('lang-modal')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('seeker.resume.language.store') }}" method="POST" class="p-8 space-y-4">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Language</label>
                    <input type="text" name="name" required placeholder="e.g. English" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Proficiency</label>
                    <select name="proficiency" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="Native">Native / Bilingual</option>
                        <option value="Fluent">Fluent / Professional</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Basic">Basic</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black rounded-2xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all mt-4">Save Language</button>
        </form>
    </div>
</div>

<div id="social-modal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-[100] hidden items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden animate-fade-in-up">
        <div class="p-8 border-b border-gray-50 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-800 dark:text-white">Add <span class="text-pink-600">Social Link</span></h3>
            <button onclick="toggleModal('social-modal')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('seeker.resume.social.store') }}" method="POST" class="p-8 space-y-4">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Platform</label>
                    <select name="platform" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                        <option value="LinkedIn">LinkedIn</option>
                        <option value="GitHub">GitHub</option>
                        <option value="Portfolio">Portfolio / Website</option>
                        <option value="Twitter">Twitter / X</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Instagram">Instagram</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">Profile URL</label>
                    <input type="url" name="url" required placeholder="https://..." class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <button type="submit" class="w-full py-4 bg-pink-600 hover:bg-pink-700 text-white font-black rounded-2xl shadow-xl shadow-pink-100 dark:shadow-none transition-all mt-4">Save Social Link</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
        modal.classList.toggle('flex');
    }
</script>
@endpush
@endsection
