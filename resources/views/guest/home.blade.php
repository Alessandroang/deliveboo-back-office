@extends('layouts.guest')


@section('content')
    <section class="container mt-5">
        <h2 class="mb-4">Benvenuto! ad oggi ci ha scelti :</h2>
        <ul>
            @foreach ($restaurants as $restaurant)
                <li class="home_li">
                    <h3>{{ $restaurant->name }}</h3>
                    {{-- 
                     <p>{{ $restaurant->description }}</p>
                    <!-- Aggiungi un link per visualizzare il menu o fare un ordine -->
                    <a href="{{ route('admin.plates.index', ['id' => $restaurant->id]) }}">Visualizza Menu</a>
                    --}}
                </li>
            @endforeach
        </ul>
    </section>
@endsection
