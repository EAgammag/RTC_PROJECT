@extends('layouts.app')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('sidebar-nav')
    <div class="sidebar-link active">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        My Profile
    </div>
@endsection

@section('content')
<div class="max-w-2xl space-y-6">

    <div class="card rounded-xl p-6">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="card rounded-xl p-6">
        @include('profile.partials.update-password-form')
    </div>

    <div class="card rounded-xl p-6">
        @include('profile.partials.delete-user-form')
    </div>

</div>
@endsection
