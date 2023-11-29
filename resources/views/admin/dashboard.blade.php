@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col">
                <div class="card text-center my-3 border-black border-1">
                    <div class="card-header bg-success-subtle">
                        <h1>{{ __('Benvenuto!') }}</h1>
                    </div>

                    <div class="card-body ">
                        @if (session('status'))
                            <div>
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (!auth()->user()->restaurant)
                            <h4>{{ __('Sei riuscito a iscriverti! Congratulazioni!') }}</h4>

                            <div class="my-4">
                                <button type="button" class="btn btn-warning btn-lg">
                                    <a class="nav-link"
                                        href="{{ route('admin.restaurants.create') }}">{{ __('Registra il tuo Ristorante') }}
                                    </a>
                                </button>
                            </div>
                        @endif
                        @if (auth()->user()->restaurant)
                            <h4>{{ __('E\' un piacere rivederti!') }}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
