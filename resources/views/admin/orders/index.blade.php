@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Elenco degli Ordini</h1>

        @foreach ($orders as $order)
            <!-- Check se l'ordine appartiene al ristorante desiderato -->
            @foreach ($order->plates as $plate)
                @if ($order->plate->restaurant_id)
                    <div class="card mb-3">
                        <div class="card-header">
                            Informazioni Cliente
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->name }} {{ $order->lastname }}</h5>
                            <p class="card-text">
                                <strong>Address:</strong> {{ $order->address }} <br>
                                <strong>Email:</strong> {{ $order->email }} <br>
                                <strong>Phone:</strong> {{ $order->phone }} <br>
                                <strong>Total Orders:</strong> {{ $order->total_orders }}
                            </p>
                            {{-- <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Plates Ordered:</strong>
                                <ul>
                                    @foreach ($order->plates as $plate)
                                        <li>{{ $plate->name }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul> --}}
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
@endsection
