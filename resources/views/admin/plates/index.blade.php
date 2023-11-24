@extends('layouts.app')

@section('content')
    <div class="food_container">
        <div class="container">
            <div class=" mt-3 row g-2">
                <h1>Menù :</h1>
                {{ $plates->links('pagination::bootstrap-5') }}
                @foreach ($plates as $plate)
                    <figure class="food col-md-12 col-lg-6">
                        {{-- <div class="food__hero">
                            <img src={{ $plate->image }} alt="food" class="food__img">
                        </div> --}}

                        <div class="food__content">
                            <div class="food__title">
                                <h1 class="food__heading">{{ $plate->name }} 🍽️</h1>
                                {{-- <div class="food__tag food__tag--1">#vegetarian</div>
                                <div class="food__tag food__tag--2">#italian</div> --}}
                            </div>
                            <p class="food__description">
                                {!! $plate->getAbstract() !!}
                            </p>
                            <div>
                                <p class="food__detail"><span class="emoji">👨‍🍳</span>{{ $plate->ingredients }}</p>
                                <p class="food__detail"><span class="emoji">💶</span>{{ $plate->price }} €</p>
                                {{-- <p class="food__detail"><span class="emoji">⭐️</span>4.7 / 5</p> --}}
                            </div>
                        </div>
                        <div class="food__price"><a href="{{ route('admin.plates.show', $plate) }}">🔎</a></div>
                    </figure>
                @endforeach
            </div>
        </div>

    </div>
@endsection
