@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('sidebar-nav')
@endsection

@section('content')
    <div class="card rounded-xl p-6">
        <p class="text-slate-300">{{ __("You're logged in!") }}</p>
    </div>
@endsection
