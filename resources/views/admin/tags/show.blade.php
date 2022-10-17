@extends('layouts.app')

@section('page-title', 'Tag: '. $tag->name )

@section('content')
    <div class="container my-5">
        <div class="row py-5">
            <div class="col-8 m-auto bg-light p-5 ">
                <p class="pt-3"><strong>Titolo Tag: </strong></p>
                <p class="pb-2">{{$tag->name}}</p>
                <p><strong>Slug: </strong></p>
                <p><em>{{$tag->slug}}</em></p>
                <a class="btn btn-dark mt-4" href="{{route('admin.categories.index', compact('tag'))}}">Torna indietro</a>
            </div>
        </div>
    </div>
@endsection
