@extends('layouts.app')

@section('page-title', 'Post')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-9 m-auto text-center">
                <h1 class="my-4">Gestione Post:</h1>
                <table class="table table-striped primary table-primary rounded">
                    <thead class="bg-primary">
                        <tr>
                            <th>Image</th>
                            <th>Titolo</th>
                            <th>Slug</th>
                            <th>Categoria</th>
                            <th>Tags</th>
                            <th class="w-25">Data Creazione</th>
                            <th class="w-25">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    @if ($post->cover)
                                        <img src="{{asset('storage/' . $post->cover)}}" class="img-thumbnail" style="width:75px;"/>
                                    @else
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg"
                                             class="img-thumbnail"
                                             style="width:75px;"/>
                                    @endif
                                </td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->slug}}</td>
                                <td>
                                    {{($post->category) ? $post->category->title : '-'}}
                                </td>
                                <td>
                                    @foreach ($post->tags as $tag)
                                        {{$tag->name}},
                                    @endforeach
                                </td>

                                <td>{{date('d-m-Y', strtotime($post->created_at))}}</td>
                                <td>
                                    <a class="btn btn-success shadow d-inline-block" href="{{route('admin.posts.show', ['post' => $post->id])}}">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <a class="btn btn-primary shadow mx-3 d-inline-block" href="{{route('admin.posts.edit', ['post' => $post->id])}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="POST" class="d-inline-block" onsubmit="return confirm('Sei sicuro di voler cancellare il post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger shadow" type="submit">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
