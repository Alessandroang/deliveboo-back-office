@extends('layouts.app')

@section('content')
    <div class="restaurant_container">
        <div class="container">
            <div class="row gap-3">
                <div class="title_container">
                    <h2 class="restaurant_title">Dettaglio Ristorante :</h2>
                    <span class="specifications">Qui potrai visualizzare i dati del tuo ristorante.</span>
                </div>

                <div class="restaurant_image">
                    <img src={{ asset('/storage/' . $restaurant->image) }} alt="restaurant-image">
                    <span class="specifications">(immagine)</span>
                </div>

                <div class="name_container">
                    <h1 class="restaurant_name">{{ $restaurant->name }}</h1>
                    <span class="specifications">(Nome attività)</span>
                </div>

                <div class="type_container">
                    @if ($restaurant->types && count($restaurant->types) > 0)
                        @foreach ($restaurant->types as $type)
                            <span class="restaurant_type">{{ $type->name }}</span>
                        @endforeach
                    @else
                        <span class="restaurant_type">Nessuna tipologia disponibile</span>
                    @endif
                    <span class="specifications">(tipologia/e alimentare)</span>
                </div>

                <div class="description_container">
                    <p class="restaurant_description">
                        {{ $restaurant->description }}
                    </p>
                    <span class="specifications">(descrizione)</span>
                </div>

                <div class="restaurant_route_container">
                    <a class="restaurant_route" href="{{ route('admin.plates.index') }}">Vedi/Crea Menù</a>
                </div>
            </div>
        </div>
    </div>
@endsection
