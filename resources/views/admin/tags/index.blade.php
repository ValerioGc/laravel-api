@extends('layouts.app')

@section('page-title', 'Tags')

@section('content')
    <div class="container-fluid overflow-auto">
        <div class="row not d-block">
            <div class="col-9 m-auto">
                <h1 class="my-4 text-center py-3">Gestione Tags:</h1>
            </div>
            <div class="col-9 m-auto bg-light border-dark p-4 text-center">
                <h3 class="pr-3 d-inline-block">Crea uno nuovo tag:</h3>
                <form class="form container d-inline-block w-50" action="{{route('admin.tags.store')}}" method="POST">
                    @csrf
                    <div class="p-2 row d-block">
                        <input type="text" name="name" id="name"
                               required value="{{old('name')}}" class="w-50 py-2 d-inline-block"
                               placeholder="Inserisci il titolo del tag" @error('name') is-invalid @enderror />
                        @error('name')
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
                <h1 class="my-4">Tags:</h1>
                <table class="table table-striped primary table-primary rounded">
                    <thead class="bg-primary">
                    <tr class="text-light">
                        <th>Tag</th>
                        <th>Slug</th>
                        <th>ID</th>
                        <th>Data Creazione</th>
                        <th>Azioni</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->slug}}</td>
                            <td>{{$tag->id}}</td>
                            <td>{{date('d-m-Y', strtotime($tag->created_at))}}</td>
                            <td>
                                <a href="{{route('admin.tags.show', ['tag' => $tag->id])}}" class="btn btn-primary shadow">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                                <a href="{{route('admin.tags.edit', ['tag' => $tag->id])}}" class="btn btn-success shadow">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{route('admin.tags.destroy', compact('tag'))}}" method="POST" class="d-inline-block">
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
