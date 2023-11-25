@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.restaurants.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome del ristorante</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">URL dell'immagine</label>
                <input type="url" class="form-control" id="image" name="image" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione del ristorante</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Numero di telefono</label>
                <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]+" required>
                <div class="text-danger">Inserisci solo numeri nel campo del numero di cellulare.</div>
            </div>

            <!-- Altri campi del modulo -->

            <button type="submit" class="btn btn-primary">Registra Ristorante</button>
        </form>
    </div>
@endsection
