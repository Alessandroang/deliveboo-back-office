@extends('layouts.guest')


@section('content')
    <section class="container mt-5">
        <h2 class="mb-4">Benvenuto! ad oggi ci ha scelti :</h2>
        <ul>
            @foreach ($restaurants as $restaurant)
                <li class="home_li">
                    <h3>{{ $restaurant->name }}</h3>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
