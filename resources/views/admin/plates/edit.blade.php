@extends('layouts.app')

@section('content')
    <div class="food_container">
        <div class="container mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Modifica piatto :</h1>
                <div class="btn btn-primary ms-auto">
                    <a class="text-white text-decoration-none " href="{{ route('admin.plates.index') }}">⬅️ Torna al menù
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.plates.update', $plate) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-6 my-2">
                                <label for="name" class="form-label fw-bold">Nome piatto</label>
                                <input type="text" id="name" name="name"
                                    class="form-control  @error('name') is-invalid @enderror" placeholder="Plate name"
                                    value="{{ old('name') ?? $plate->name }}">
                                {{-- @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>

                            <div class="row">
                                <div class="col-3">
                                    <label for="image">URL dell'immagine:</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        value="{{ old('image') }}">
                                    @error('image')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-4 mt-2">
                                    <img src="{{ asset('/storage/' . $plate->image) }}" class="img-fluid"
                                        id="image_preview">
                                </div>
                            </div>

                            <div class="col-6 my-2">
                                <label for="price" class="form-label fw-bold">Prezzo</label>
                                <input type="text" id="price" name="price"
                                    class="form-control @error('price') is-invalid @enderror" placeholder="Plate price"
                                    value="{{ old('price') ?? $plate->price }}">
                                {{-- @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>

                            {{-- <div class="col-6 my-2">
                            <label for="type_id" class="form-label"><strong>Tipo</strong></label>
                            <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                                <option value="">Seleziona il tipo</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>
                                        {{ $type->label }}
                                    </option>
                                @endforeach
                            </select> --}}
                            {{-- @error('type_id')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror --}}
                            {{-- </div> --}}

                            <div class="col-6">
                                <label for="ingredients" class="form-label fw-bold">Ingredienti</label>
                                <input type="textarea" id="ingredients" name="ingredients"
                                    class="form-control @error('ingredients') is-invalid @enderror"
                                    placeholder="Plate ingredients" value="{{ old('ingredients') ?? $plate->ingredients }}">
                                {{-- @error('ingredients')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label fw-bold">Descrizione</label>
                                <textarea class="form-control" id="description" name="description" rows="2">
                                    {{ old('description') ?? $plate->description }}
                                </textarea>
                                {{-- @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success w-25 my-5 fw-bold">Salva</button>
                </div>
            </form>
        </div>
    </div>
@endsection
