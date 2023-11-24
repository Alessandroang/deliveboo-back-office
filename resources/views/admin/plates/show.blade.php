@extends('layouts.app')

@section('content')
    <div class="food_container ">
        <div class="container">
            <div class=" mt-3 row justify-content-center g-2">
                <h1>Dettaglio piatto :</h1>
                <div class="food__hero col-6 col-lg-4">
                    <img src={{ $plate->image }} alt="food" class="food__img">
                </div>
                <figure class="food col-6">
                    <div class="food__content">
                        <div class="food__title">
                            <h1 class="food__heading">{{ $plate->name }} 🍽️</h1>
                            {{-- <div class="food__tag food__tag--1">#vegetarian</div>
                                <div class="food__tag food__tag--2">#italian</div> --}}
                        </div>
                        <p class="food__description">
                            {{ $plate->description }}
                        </p>
                        <div>
                            <p class="food__detail"><span class="emoji">👨‍🍳</span>{{ $plate->ingredients }}</p>
                            <p class="food__detail"><span class="emoji">💶</span>{{ $plate->price }} €</p>
                            {{-- <p class="food__detail"><span class="emoji">⭐️</span>4.7 / 5</p> --}}
                        </div>
                    </div>
                    <div class="food__price"><a href="{{ route('admin.plates.index', $plate) }}">⬇️</a></div>
                </figure>
            </div>
        </div>

    </div>
@endsection
