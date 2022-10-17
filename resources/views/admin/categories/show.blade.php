@extends('layouts.app')

@section('page-title', 'Categoria: '. $category->title )

@section('content')
    <div class="container my-5">
        <div class="row py-5">
            <div class="col-8 m-auto bg-light p-5 ">
                <h3 class="py-3"><strong>Titolo Categoria: </strong> {{$category->title}}</h3>
                <p><strong>Slug: </strong></p>
                <p><em>{{$category->slug}}</em></p>
                <a class="btn btn-dark mt-4" href="{{route('admin.categories.index', compact('category'))}}">Torna indietro</a>
            </div>
        </div>
    </div>
@endsection
