@extends('layouts.app')

@section('content')
@section('content')
    <div class="container mt-4">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.restaurants.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome del ristorante:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo:</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipologia del ristorante:</label>
                <div>
                    @foreach ($types as $type)
                        <input type="checkbox" id="type{{ $type->id }}" name="types[]" value="{{ $type->id }}"
                            @if (in_array($type->id, old('types', []))) checked @endif>
                        <label for="types{{ $type->id }}">{{ $type->name }}</label>
                    @endforeach
                </div>
            </div>

            {{-- <div class="mb-3">
                <label for="image" class="form-label">URL dell'immagine:</label>
                <input type="url" class="form-control" id="image" name="image" value="{{ old('image') }}"
                    required>
            </div> --}}

            <div class="row">
                <div class="col-3">
                    <label for="image">URL dell'immagine:</label>
                    <input type="file" name="image" id="image"
                        class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4 mt-2">
                    <img src="" class="img-fluid" id="image_preview">

                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione del ristorante:</label>
                <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Numero di telefono:</label>
                <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+"
                    value="{{ old('phone') }}" required>
            </div>



            <!-- Altri campi del modulo -->

            <button type="submit" class="btn btn-primary">Registra Ristorante</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const inputFileElement = document.getElementById('image');
        const imagePreview = document.getElementById('image_preview');

        if (!imagePreview.getAttribute('src')) {
            imagePreview.src = "https://placehold.co/400";
        }

        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            imagePreview.src = URL.createObjectURL(file)
        })
    </script>
@endsection
