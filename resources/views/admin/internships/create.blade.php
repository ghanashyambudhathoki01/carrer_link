@extends('layouts.app')
@section('title', 'Post New Internship')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 font-display">Post New Internship</h1>
        <p class="text-sm font-medium text-gray-500 mt-1">Create a new internship listing as a System Admin.</p>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <form action="{{ auth()->user()->isSuperAdmin() ? route('super-admin.internships.store') : route('admin.internships.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                {{-- Title --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Internship Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="e.g. Frontend Development Intern">
                </div>

                {{-- Category --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Category</label>
                    <select name="category_id" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Location --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Location</label>
                    <input type="text" name="location" value="{{ old('location') }}" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="e.g. Kathmandu or Remote">
                </div>

                {{-- Vacancies --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">No. of Vacancies</label>
                    <input type="number" name="vacancies" value="{{ old('vacancies', 1) }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                </div>

                {{-- Deadline --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Application Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                </div>

                {{-- Salary --}}
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Stipend Min (Monthly)</label>
                    <input type="number" name="salary_min" value="{{ old('salary_min') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Stipend Max (Monthly)</label>
                    <input type="number" name="salary_max" value="{{ old('salary_max') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium">
                </div>

                {{-- Skills --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Skills Needed (Comma separated)</label>
                    <input type="text" name="skills" value="{{ old('skills') }}" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="Laravel, PHP, CSS">
                </div>

                {{-- Description --}}
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Internship Description</label>
                    <textarea name="description" rows="8" required class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-sm font-medium" placeholder="Describe the internship role and learning opportunities...">{{ old('description') }}</textarea>
                </div>

                {{-- Lists --}}
                <div class="md:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold mb-1 uppercase tracking-wider">Requirements (One per line)</p>
                            <textarea name="requirements" rows="4" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-xs font-medium">{{ old('requirements') }}</textarea>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold mb-1 uppercase tracking-wider">Learning Benefits (One per line)</p>
                            <textarea name="benefits" rows="4" class="w-full border border-gray-100 bg-gray-50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 text-xs font-medium">{{ old('benefits') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_featured" value="1" id="is_featured" class="w-5 h-5 text-blue-600 rounded-lg border-gray-100 bg-gray-50 focus:ring-blue-500">
                    <label for="is_featured" class="text-sm font-bold text-gray-700 cursor-pointer">⭐ Mark as Featured Internship</label>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ auth()->user()->isSuperAdmin() ? route('super-admin.dashboard') : route('admin.dashboard') }}" class="px-8 py-3 border border-gray-100 text-gray-500 font-bold rounded-xl hover:bg-gray-50 transition-all text-sm">Cancel</a>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all text-sm">
                        Publish Internship
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
