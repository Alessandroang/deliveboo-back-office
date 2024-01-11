@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Elenco degli Ordini</h1>
        <!-- Aggiunto link alle statistiche degli ordini -->
        <a href="{{ route('admin.order.statistics') }}">Visualizza Statistiche degli Ordini</a>
        @php
            $hasOrders = false;
        @endphp

        @foreach ($orders as $order)
            @php
                $firstPlate = $order->plates->first();
                $restaurantId = $firstPlate ? $firstPlate->restaurant->id : null;
            @endphp

            @if ($restaurantId === $userRestaurantId)
                @php
                    $hasOrders = true;
                @endphp

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
                            <strong>Totale Ordine:</strong> {{ $order->total_orders }} <br>
                            <strong>Data Ordine:</strong> {{ $order->created_at }} <br>


                        <ul class="list-group list-group-flush">
                            @foreach ($order->plates as $plate)
                                <li class="list-group-item">
                                    <strong>Piatto ordinato:</strong> {{ $plate->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Quantità:</strong> {{ $plate->pivot->quantity }}
                                </li>
                            @endforeach
                        </ul>

                        <strong>Nome Ristorante:</strong> {{ $firstPlate->restaurant->name }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Aggiunto controllo se non ci sono ordini  -->
        @if (!$hasOrders)
            <p>Nessun ordine disponibile per il tuo ristorante.</p>
        @endif

    </div>
@endsection
