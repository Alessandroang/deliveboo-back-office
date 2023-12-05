@extends('layouts.guest')


@section('content')
    <section class="container mt-5">
        <h1>{{ $title }}</h1>
        <h2>Lista dei Ristoranti</h2>
        <ul>
            @foreach ($restaurants as $restaurant)
                <li>
                    <h2>{{ $restaurant->name }}</h2>
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
