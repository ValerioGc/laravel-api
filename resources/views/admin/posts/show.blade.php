@extends('layouts.app')

@section('page-title', 'Post: ' . $post->title )

@section('content')
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col-8 m-auto bg-light p-5 ">
                <p>Cover:</p>
                @if ($post->cover)
                    <img src="{{asset('storage/' . $post->cover)}}" class="img-fluid"/>
                @else
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg"
                         class="img-thumbnail"
                         style="width:75px;"/>
                @endif
                <p><strong>Categoria:</strong></p>
                <p class="font-italic">{{$post->category ? $post->category->title : 'Nessuna categoria associata'}}</p>
                <h3 class="py-3"><strong>Titolo: </strong> {{$post->title}}</h3>
                <p><strong>Slug: </strong><em>{{$post->slug}}</em></p>
                <p><strong>Contenuto:</strong></p>
                <p>{{$post->content}}</p>
                <p><strong>Tags:</strong></p>
                <ul style="height: 5vh; display: flex; justify-content: space-around; flex-direction: column; align-items: center; flex-wrap: wrap;">
                    @foreach ($post->tags as $tag)
                        <li>{{$tag->name}},</li>
                    @endforeach
                </ul>
                <a class="btn btn-dark mt-4" href="{{route('admin.posts.index')}}">Torna indietro</a>
            </div>
        </div>
    </div>
@endsection
