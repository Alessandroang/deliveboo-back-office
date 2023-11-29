@extends('layouts.app')

@section('content')
    <div class="food_container">
        <div class="container mt-3 d-flex justify-content-end">
            {{ $menu->links('pagination::bootstrap-5') }}
        </div>
        <div class="container">
            <div class="mt-3 row g-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Menù :</h1>
                    <div class="btn btn-primary ms-2">
                        <a class="text-white text-decoration-none" href="{{ route('admin.plates.create') }}">➕ Aggiungi
                            piatto</a>
                    </div>
                </div>

                @foreach ($menu as $plate)
                    <figure class="food col-sm-12 col-md-6">
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
                            </div>
                            <p class="food__description">
                                {!! $plate->getAbstract() !!}
                            </p>
                            <div>
                                <p class="food__detail"><span class="emoji">👨‍🍳</span>{{ $plate->ingredients }}</p>
                                <p class="food__detail"><span class="emoji">💶</span>{{ $plate->price }} €</p>
                            </div>
                        </div>
                        <div class="food__routes">
                            <a class="my2 text-decoration-none" href="{{ route('admin.plates.show', $plate) }}">🔎</a>
                            <a class="my2 text-decoration-none" href="{{ route('admin.plates.edit', $plate) }}">🖊️</a>
                            <button class="btn my2" data-bs-toggle="modal"
                                data-bs-target="#delete-modal-{{ $plate->id }}">
                                🗑️
                            </button>
                            {{-- <button class="btn" data-bs-toggle="modal"
                                data-bs-target="#deletePlateModal{{ $plate->id }}">🗑️</button> --}}
                        </div>
                    </figure>

                    <!-- Modal Bootstrap-->
                    {{-- <div class="modal fade" id="deletePlateModal{{ $plate->id }}" tabindex="-1"
                        aria-labelledby="deletePlateModalLabel{{ $plate->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletePlateModalLabel{{ $plate->id }}">Conferma
                                        eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di voler eliminare definitivamente il piatto "{{ $plate->name }}"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
    @foreach ($menu as $plate)
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
