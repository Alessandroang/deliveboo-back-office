@extends('layouts.app')

@section('content')
    <div class="food_container">
        <div class="container">
            <div class=" mt-3 row g-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Menù :</h1>
                    <div class="btn btn-primary ms-2">
                        <a class="text-white text-decoration-none " href="{{ route('admin.plates.create') }}">➕ Aggiungi
                            piatto
                        </a>
                    </div>
                </div>

                {{ $plates->links('pagination::bootstrap-5') }}
                @foreach ($plates as $plate)
                    <figure class="food col-sm-12 col-md-6">
                        {{-- <div class="food__hero">
                            <img src={{ $plate->image }} alt="food" class="food__img">
                        </div> --}}

                        <div class="food__content">
                            <div class="food__title">
                                <h1 class="food__heading">{{ $plate->name }} 🍽️</h1>
                                <div class="fw-bold">visibile</div>
                                <form action="{{ route('admin.plates.visibility', $plate) }}" method="POST"
                                    id="form-visibility-{{ $plate->id }}">
                                    @method('PATCH')
                                    @csrf

                                    <label class="switch">
                                        <input type="checkbox" name="visibility"
                                            @if ($plate->visibility) checked @endif>
                                        <span class="slider round checkbox-visibility" data-id="{{ $plate->id }}"></span>
                                    </label>
                                </form>
                                {{-- <div class="food__tag food__tag--1">#vegetarian</div>
                                <div class="food__tag food__tag--2">#italian</div> --}}
                            </div>
                            <p class="food__description">
                                {!! $plate->getAbstract() !!}
                            </p>
                            <div>
                                <p class="food__detail"><span class="emoji">👨‍🍳</span>{{ $plate->ingredients }}</p>
                                <p class="food__detail"><span class="emoji">💶</span>{{ $plate->price }} €
                                </p>
                                {{-- <p class="food__detail"><span class="emoji">⭐️</span>4.7 / 5</p> --}}
                            </div>
                        </div>
                        <div class="food__price">
                            <a class="my2 text-decoration-none" href="{{ route('admin.plates.show', $plate) }}">🔎</a>
                            <a class="my2 text-decoration-none" href="{{ route('admin.plates.edit', $plate) }}">🖊️</a>
                            <button class="btn my2" data-bs-toggle="modal"
                                data-bs-target="#delete-modal-{{ $plate->id }}">
                                🗑️
                            </button>
                        </div>
                    </figure>
                @endforeach
                <div class="legenda_content">
                    <h5 class="text-center mb-3">Legenda : "🔎-🖊️-🗑️"</h5>
                    <div class="d-flex justify-content-around fw-bold">
                        <span>🔎 = mostra i dettagli del piatto</span>
                        <span>🖊️ = modifica i dettagli del piatto selezionato</span>
                        <span>🗑️ = elimina il piatto selezionato</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')
    @foreach ($plates as $plate)
        <div class="modal fade " id="delete-modal-{{ $plate->id }}" tabindex="-1"
            aria-labelledby="delete-modal-{{ $plate->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content food_modal">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-modal-{{ $plate->id }}-label">
                            Conferma eliminazione
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Sei sicuro di voler eliminare <i>" {{ $plate->name }} "</i> con ID
                        {{ $plate->id }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Annulla
                        </button>

                        <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
                            @method('DELETE') @csrf

                            <button type="submit" class="btn btn-danger">
                                Elimina
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
    <script>
        const checkboxesVisibility = document.getElementsByClassName('checkbox-visibility');
        console.log(checkboxesVisibility);


        for (checkbox of checkboxesVisibility) {
            checkbox.addEventListener('click', function() {
                const idPlate = this.getAttribute('data-id');
                const form = document.getElementById('form-visibility-' + idPlate);
                form.submit();
            })
        }
    </script>
@endsection
