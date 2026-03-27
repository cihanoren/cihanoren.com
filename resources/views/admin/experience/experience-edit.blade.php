@extends('layouts.admin')
@section('title', 'Edit Experience')
@section('page-title', 'Edit: ' . $experience->position)
@section('content')
<div class="mb-8">
    <a href="{{ route('admin.experience.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
        </svg>
        Back to experience
    </a>
</div>
<form method="POST" action="{{ route('admin.experience.update', $experience) }}">
    @csrf
    @method('PUT')
    @include('admin.experience.experience-form')
</form>
@endsection