@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="card-custom text-center p-5 shadow-lg rounded-lg" style="background-color: #f0f4ff;">
            <h1 class="mb-3" style="color: #1d4ed8; font-weight: 700;">Welcome Back, {{ Auth::user()->name ?? 'Guest' }}!
            </h1>
            <p class="text-gray-700 mb-4" style="font-size: 1.1rem;">
                Here's a snapshot of your projects and any pending issues. Stay on top and keep things moving!
            </p>
            <a href="{{ route('projects.index') }}" class="btn btn-blue px-4 py-2 rounded-full"
                style="background-color: #1d4ed8; color: #fff; font-weight: 500;">
                View Projects
            </a>
        </div>
    </div>
@endsection