@extends('layouts.app')
@section('content')

<div class="container">
    <div class="container">
        <div class="row">
          <div class="col">
            <div class="jumbotron">
                <h1 class="display-4">All Posts</h1>
                <a class="btn btn-success" href="{{route('post.create')}}" >Create Post</a>
                <a class="btn btn-danger" href="{{route('posts.trashed')}}" >Trashed</a>
              </div>
              
          </div>
         
        </div>
        <div class="row">
            @if ($post->count()>0)
            <div class="col">
                <table class="table">
                    <thead class="thead-dark">
                      @php
                          $i = 1;
                      @endphp
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">User</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$item->title}}</td>
                            <td>{{$item->user->name}}</td>
                            <td>
                                <img src="{{URL::asset($item->photo)}}" alt="" class="img-tumbnail" width="100" height="100">
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{route('post.edit',['id'=> $item->id])}}"><i class="fas fa-edit"></i> Edit </a> &nbsp; &nbsp;
                                <a class="btn btn-danger" href="{{route('post.destroy',['id'=> $item->id])}}"><i class="fas fa-trash-alt"></i> Delete </a> &nbsp; &nbsp;
                                <a  class="btn btn-danger" href="{{route('post.show',['slug'=> $item->slug])}}"><i class="fas fa-trash-alt"></i> Show </a> &nbsp; &nbsp;
                            </td>
                          </tr>
                        @endforeach
                  </table>
              </div>
            @else
            <div class="col">
            <div class="alert alert-primary" role="alert">
                 No Posts
              </div>
            </div>
            @endif
       
          
        </div>
      </div>
</div>



@endsection