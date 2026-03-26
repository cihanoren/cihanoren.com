@extends('layouts.admin')
@section('title', 'Add Project')
@section('page-title', 'Add Project')
@section('content')
<form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.projects.form')
</form>
@endsection