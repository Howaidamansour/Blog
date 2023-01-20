@extends('layouts.app')
@section('content')

<div class="container">

    @if (count($errors)>0)
  @foreach ($errors->all() as $item)
  <div class="alert alert-primary" role="alert">
    {{$item}}
  </div>
  @endforeach
      
  @endif

    <div class="row">
      <div class="col">
        <div class="jumbotron">
            <h1 class="display-4">Creata Post</h1>
            <a class="btn btn-success" href="{{route('posts')}}" >All Posts</a>
          </div>
         
      </div>
      
    </div>
    <div class="row">
      <div class="col">
        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleFormControlInput1">Title</label>
              <input type="text" class="form-control" name="title">
            </div>
       
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Content</label>
              <textarea class="form-control" name="content"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Image</label>
                <input type="file" class="form-control" name="photo">
              </div>


            <div class="form-group">
                <button class="btn btn-danger" type="submit">Save</button>
              </div>
          </form>
      </div>
    </div>
  </div>

  @endsection