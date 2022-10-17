@extends('layouts.app')

@section('ext-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css')

@section('page-title', 'Categories')

@section('content')
    <div class="container-fluid overflow-auto">
        <div class="row not d-block">
            <div class="col-9 m-auto">
                <h1 class="my-4 text-center py-3">Gestione Categorie:</h1>
            </div>
            <div class="col-9 m-auto bg-light border-dark p-4 text-center">
                <h3 class="pr-3 d-inline-block">Crea una nuova categoria</h3>
                <form class="form container d-inline-block w-50" action="{{route('admin.categories.store')}}" method="POST">
                    @csrf
                    <div class="p-2 row d-block">
                        <input type="text" name="title" id="title"
                               required value="{{old('title')}}" class="w-50 py-2 d-inline-block"
                               placeholder="Inserisci il titolo della Categoria" @error('title') is-invalid @enderror />
                        @error('title')
                        <div class="alert-danger col-3 mx-auto my-3">
                            {{$message}}
                        </div>
                        @enderror
                        <button type="submit" class="m-2 btn-dark btn d-inline-block">Crea</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-9 mx-auto">
                <h1 class="my-4">Categorie:</h1>
                <table class="table table-striped primary table-primary rounded">
                    <thead class="bg-primary">
                    <tr class="text-light">
                        <th>Titolo</th>
                        <th>Slug</th>
                        <th>Data Creazione</th>
                        <th>Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->title}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{date('d-m-Y', strtotime($category->created_at))}}</td>
                                <td>
                                    <a href="{{route('admin.categories.show', ['category' => $category->id])}}" class="btn btn-primary shadow">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-success shadow">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{route('admin.categories.destroy', compact('category'))}}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger shadow">
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
