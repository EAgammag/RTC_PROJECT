@extends('layouts.app')

@section('title', 'Create Account')
@section('page-title', 'Create New Account')

@section('sidebar-nav')
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Dashboard
    </a>
    <a href="{{ route('admin.users.create') }}" class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
        Create Account
    </a>
@endsection

@section('content')
<div class="max-w-xl">
    <div class="card rounded-xl p-6">
        <p class="text-xs text-slate-500 mb-6">
            New accounts are only created by administrators. Passwords must be at least 12 characters
            and include uppercase, lowercase, numbers, and a special character.
        </p>

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2.5 rounded-lg text-sm text-slate-900"
                           style="background: #f8fafc; border: 1px solid rgba(4,9,15,0.14);"
                           placeholder="e.g. Juan dela Cruz">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Student / Service ID</label>
                    <input type="text" name="student_id" value="{{ old('student_id') }}" required maxlength="50"
                           class="w-full px-4 py-2.5 rounded-lg text-sm text-slate-900 font-mono"
                           style="background: #f8fafc; border: 1px solid rgba(4,9,15,0.14);"
                           placeholder="e.g. 2024-00001">
                    @error('student_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required maxlength="255"
                           class="w-full px-4 py-2.5 rounded-lg text-sm text-slate-900"
                           style="background: #f8fafc; border: 1px solid rgba(4,9,15,0.14);"
                           placeholder="user@csu.edu.ph">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Role</label>
                    <select name="role" required
                            class="w-full px-4 py-2.5 rounded-lg text-sm text-slate-900"
                            style="background: #f8fafc; border: 1px solid rgba(4,9,15,0.14);">
                        <option value="">— Select Role —</option>
                        <option value="admin"   {{ old('role') === 'admin'   ? 'selected' : '' }}>Administrator</option>
                        <option value="officer" {{ old('role') === 'officer' ? 'selected' : '' }}>Officer / Instructor</option>
                        <option value="cadet"   {{ old('role') === 'cadet'   ? 'selected' : '' }}>Cadet</option>
                    </select>
                    @error('role') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <input type="password" name="password" required minlength="12"
                           class="w-full px-4 py-2.5 rounded-lg text-sm text-slate-900"
                           style="background: #f8fafc; border: 1px solid rgba(4,9,15,0.14);"
                           placeholder="Minimum 12 characters">
                    <p class="mt-1 text-xs text-slate-500">Must include uppercase, lowercase, number, and special character.</p>
                    @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-2.5 rounded-lg text-sm text-slate-900"
                           style="background: #f8fafc; border: 1px solid rgba(4,9,15,0.14);"
                           placeholder="Re-enter password">
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit"
                        class="px-6 py-2.5 rounded-lg text-sm font-semibold"
                        style="background: linear-gradient(135deg, #FFD700, #C7A600); color: #200608;">
                    Create Account
                </button>
                <a href="{{ route('admin.dashboard') }}"
                   class="px-6 py-2.5 rounded-lg text-sm font-medium text-slate-600 transition-colors"
                   style="background: #f1f5f9; border: 1px solid rgba(15,4,4,0.1);">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
