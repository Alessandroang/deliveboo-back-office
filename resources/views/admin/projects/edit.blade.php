@extends('layouts.app')

@section('content')
    <section class="container mt-5">
        <a class="btn btn-dark" href="{{ route('admin.projects.index') }}">
            Torna ai projects
        </a>
        <a class="btn btn-warning" href="{{ route('admin.projects.show', $project) }}">
            Torna al dettaglio
        </a>

        <h1 class="my-3">Modifica il progetto</h1>

        <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="row g-3">
            @csrf
            @method('PUT')
            <div class="col-4">

                <div class="col-12">
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" id="title" name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value=" {{ old('title') ?? $project->title }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="text" id="image" name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        value=" {{ old('image') ?? $project->image }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <div class="col-6">
                <label for="description">Descrizione</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $project->description }}</textarea>
            </div>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror


            <button class="btn btn-success">Salva</button>
            </div>



        </form>
    </section>
@endsection
