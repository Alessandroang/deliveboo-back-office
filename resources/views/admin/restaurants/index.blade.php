@extends('layouts.app')

@section('content')
    <div class="restaurant_container">
        <div class="container">
            <div class=" mt-3 row justify-content-center g-2">
                @if ($restaurant)
                    <h1>Dettaglio Ristorante</h1>
                    <div class="food__hero col-6 col-lg-4">
                        <img src={{ asset('/storage/' . $restaurant->image) }} alt="restaurant-image" class="food__image">
                    </div>
                    <figure class="food col-6">
                        <div class="restaurant__content">
                            <div class="food__title">
                                <h1 class="food__heading">{{ $restaurant->name }} 🏡</h1>

                                <div>
                                    @if ($restaurant->types && count($restaurant->types) > 0)
                                        @foreach ($restaurant->types as $type)
                                            <span class="tag restaurant__tag">{{ $type->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="tag restaurant__tag">Nessuna tipologia disponibile</span>
                                    @endif
                                </div>

                                {{-- <div class="tag food__tag--2">#italian</div> --}}
                            </div>
                            <p class="food__description">
                                {{ $restaurant->description }}
                            </p>
                        </div>
                        <div class="restaurant__route"><a class="text_route" href="{{ route('admin.plates.index') }}">Vedi
                                Menù</a></div>
                    </figure>
                @else
                    <div class="col-md-12">
                        <p>Errore: il ristorante non è stato trovato.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
