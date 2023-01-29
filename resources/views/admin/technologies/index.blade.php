@extends('layouts.app')

@section('title')
    | Admin
@endsection

@section('content')
<div class="container py-3">

    <h1 class="my-3">Technologies manager</h1>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
    @endif

    <div class="w-50">
        <form  action="{{route('admin.technologies.store')}}" method="POST">
            @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="New technology">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                            <i class="fa-solid fa-circle-plus"></i>
                            Add</button>
                    </div>
        </form>
    </div>
    <table class="table w-50">
        <tr>
            <th scope="col">Technology</th>
            <th scope="col">Project Count</th>
        </tr>
        <tbody>
            @foreach ($technologies as $technology)
                <tr>
                    <td class="d-flex">
                        <form action="{{route('admin.technologies.update', $technology)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input class="border-0" type="text" name="name" value="{{$technology->name}}">
                            <button type="submit" class="btn btn-warning me-3">Update</button>
                        </form>
                        @include('admin.partials.form-delete',[
                            'route' => 'technologies',
                            'message' => "Are you sure you want to delete the technology: $technology->name ?",
                            'entity' => $technology])
                    </td>
                    <td>{{count($technology->projects)}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
