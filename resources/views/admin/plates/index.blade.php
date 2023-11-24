@extends('layouts.app')

@section('content')
    <div class="food_container">
        <div class="container">
            <div class=" mt-3 row g-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Menù :</h1>
                    <div class="btn btn-primary ms-auto">
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
                            <a class="my2" href="{{ route('admin.plates.show', $plate) }}">🔎</a>
                            <a class="my2" href="{{ route('admin.plates.edit', $plate) }}">🖊️</a>
                        </div>
                    </figure>
                @endforeach
            </div>
        </div>
    </div>
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
