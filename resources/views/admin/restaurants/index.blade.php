@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if ($restaurant)
                        <div class="col-md-4">
                            {{-- <img src="{{ $restaurant->image }}" alt="Immagine del ristorante" class="img-fluid"> --}}
                        </div>



                        <div class="col-md-8">
                            <h2 class="card-title">{{ $restaurant->name }}</h2>

                            <h4>Tipologia: @if ($restaurant->types && count($restaurant->types) > 0)
                                    @foreach ($restaurant->types as $type)
                                        <span class="badge bg-secondary">{{ $type->name }}</span>
                                    @endforeach
                                @else
                                    <span class="badge bg-secondary">Nessuna tipologia disponibile</span>
                                @endif
                            </h4>


                            <p class="card-text">{{ $restaurant->description }}</p>
                            <!-- Pulsante Dettagli -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#menuModal">
                                Visualizza Menu
                            </button>
                        </div>
                    @else
                        <div class="col-md-12">
                            <p>Errore: il ristorante non è stato trovato.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Modale del menu -->
    <div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($restaurant)
                        <h5 class="modal-title" id="menuModalLabel">Menu - {{ $restaurant->name }}</h5>
                    @else
                        <h5 class="modal-title" id="menuModalLabel">Menu - Nome del ristorante non disponibile</h5>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contenuto del menu -->
                    @if ($restaurant)
                        <h4>Antipasti</h4>
                        <ul>
                            <li>Antipasto 1</li>
                            <li>Antipasto 2</li>
                            <!-- Aggiungi altri elementi del menu -->
                        </ul>

                        <h4>Primi Piatti</h4>
                        <ul>
                            <li>Primo Piatto 1</li>
                            <li>Primo Piatto 2</li>
                            <!-- Aggiungi altri elementi del menu -->
                        </ul>
                    @else
                        <p>Il ristorante non è stato trovato.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
