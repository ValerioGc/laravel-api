@extends('layouts.app')

@section('page-title', 'Modifica Tag: '. $tag->title )

@section('content')
    <div class="container my-5">
        <div class="row py-5">
            <div class="col-9 m-auto bg-light border-dark p-4 text-center">
                <h3 class="pr-3 d-inline-block">Modifica nome Tag</h3>
                <form class="form container d-inline-block w-50" action="{{route('admin.tags.update', compact('tag'))}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="p-2 row d-block">
                        <input type="text" name="name" id="name"
                               required value="{{old('name', $tag->name)}}" class="w-50 py-2 d-inline-block"
                               placeholder="Inserisci il titolo del Tag" @error('name') is-invalid @enderror />
                        @error('name')
                        <div class="position-absolute alert-danger col-3 mx-auto my-3">
                            {{$message}}
                        </div>
                        @enderror
                        <button type="submit" class="m-2 btn-dark btn d-inline-block">Crea</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
