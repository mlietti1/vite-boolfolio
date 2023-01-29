@extends('layouts.app')

@section('title')

| Admin

@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-3">{{ Auth::user()->name }}'s dashboard</h2>
    <div><strong>Email: </strong>{{ Auth::user()->email }}</div>
    <h4 class="py-3 text-secondary">There are {{$projects_count}} projects</h4>
    <a class="btn btn-info" href="{{route('admin.projects.create')}}">Add a new project</a>
</div>
@endsection
