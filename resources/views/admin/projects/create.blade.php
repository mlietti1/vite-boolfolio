@extends('layouts.app')

@section('title')
    | New project
@endsection

@section('content')


<div class="container py-3">

    <h1 class="my-3">New project
    </h1>

    @if ($errors->any())

        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>


    @endif

    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}" placeholder="Name">
            @error('name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="client_name" class="form-label">Client name</label>
            <input

             type="text" class="form-control @error('client_name') is-invalid @enderror"  id="client_name" name="client_name" value="{{old('client_name')}}">
            @error('client_name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror

        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Types</label>
            <select class="form-select" name="type_id" aria-label="Default select example">
                <option value="">Select a type</option>
                @foreach ($types as $type)
                    <option
                    @if($type->id == old('type_id')) selected @endif
                     value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>

        </div>

        <div class="mb-3">
            <p for="date" class="form-label">Technologies:</p>
            @foreach ($technologies as $technology )
                <input class="me-1" type="checkbox"
                id="technology{{$loop->iteration}}"
                name="technologies[]"
                value="{{$technology->id}}"
                @if (in_array($technology->id, old('technologies',[])))
                    checked
                @endif
                >
                <label class="me-3" for="tag{{$loop->iteration}}">{{$technology->name}}</label>
            @endforeach

        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover image</label>
            <input
            onchange="showImage(event)"
             type="file" class="form-control @error('cover_image') is-invalid @enderror"  id="cover_image" name="cover_image" value="{{old('cover_image')}}" placeholder="Image URL">
            @error('cover_image')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
            <div class="image mt-2" >
                <img id='output-image' width="150" src="" alt="">
            </div>
        </div>
          <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea name="summary"  id="summary" rows="10">{{old('summary')}}</textarea>
            @error('summary')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
          </div>
          <button type="submit" class="btn btn-success">Submit</button>
    </form>




</div>

<script>
ClassicEditor
        .create( document.querySelector( '#summary' ),{
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
        })
        .catch( error => {
            console.error( error );
        } );
function showImage(event){
    const tagImage = document.getElementById('output-image');
    tagImage.src = URL.createObjectURL(event.target.files[0]);
}
</script>


@endsection
