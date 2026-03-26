@extends('layouts.admin')
@section('title', 'Edit Project')
@section('page-title', 'Edit: ' . $project->title)
@section('content')
<form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.projects.form')
</form>
@endsection