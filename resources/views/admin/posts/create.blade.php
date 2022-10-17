
@extends('layouts.app')

@section('page-title', 'Crea Post')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 m-auto bg-light border-dark p-4">
                <h1 class="text-center py-3">Crea un nuovo post</h1>
                <form class="form text-center container" action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row d-block p-2">
                        <label for="cover" class="d-block">Seleziona l'immagine di copertina</label>
                        <input type="file" name="image" id="cover" class="w-50 m-auto text-center" @error('image') is-invalid @enderror />
                        @error('image')
                            <div class="alert-danger col-3 mx-auto my-3">
                                {{ $message}}
                            </div>
                        @enderror
                    </div>
                    <div class="row d-block p-2">
                        <label for="category_id" class="d-block">Seleziona Categoria</label>
                        <select name="category_id" class="custom-select w-50 m-auto text-center" @error('category_id') is-invalid @enderror id="category_id">
                            <option {{(old('category_id')=="")?'selected':''}} value="">Senza Categoria</option>
                            @foreach ($categories as $category)
                                <option {{(old('category_id')==$category->id)?'selected':''}} value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert-danger col-3 mx-auto my-3">
                                {{ $message}}
                            </div>
                        @enderror
                    </div>
                    <div class="p-2 row d-block">
                        <label  class="d-block" for="title">Inserisci il titolo del post</label>
                        <input type="text" name="title" id="title" required value="{{old('title')}}" class="w-50 py-2" @error('title') is-invalid @enderror />
                        @error('title')
                            <div class="alert-danger col-3 mx-auto my-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="row p-2 d-block">
                        <label class="d-block" for="content">Inserisci il contenuto del post</label>
                        <textarea name="content" id="content" class="w-50 py-5" required @error('content') is-invalid @enderror>{{old('content')}}</textarea>
                        @error('content')
                            <div class="alert-danger col-3 mx-auto my-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="row p-2 d-block w-100 h-25">
                        <h4>Tags:</h4>
                        @foreach($tags as $tag)
                                <input type="checkbox" name="tags[]" class="checkbox"
                                       {{(in_array($tag->id, old('tags', [])))?'checked':''}}
                                       id="tag_{{$tag->id}}" value="{{$tag->id}}">
                                <label for="tag_{{$tag->id}}">{{$tag->name}}</label>
                        @endforeach
                        @error('tags')
                            <div class="alert-danger col-3 mx-auto my-3">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="m-2 btn-dark btn">Invia</button>
                </form>
            </div>
        </div>
    </div>
@endsection
