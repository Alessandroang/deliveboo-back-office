@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Elenco degli Ordini</h1>

        @foreach ($orders as $order)
            <!-- Check se l'ordine appartiene al ristorante desiderato -->

            {{-- @if ($order->plate->restaurant_id) --}}
            @php
                $userId = Auth::user()->id; // Assumi che l'ID del ristorante del cliente sia accessibile tramite Auth::user()
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
                        <strong>Total Orders:</strong> {{ $order->total_orders }} <br>



                    <ul class="list-group list-group-flush">
                        @foreach ($order->plates as $plate)
                            {{--  
                                @if ($userId === $plate->restaurant_id)
                            --}}

                            <li class="list-group-item">
                                <strong>Plates Ordered:</strong> {{ $plate->name }}
                            </li>
                            <!-- Visualizza l'ID del ristorante associato al piatto-->
                            <li class="list-group-item">
                                <strong>Quantità: </strong> {{ $plate->pivot->quantity }}

                            </li>

                            <li class="list-group-item">
                                <strong>Date Orders:</strong> {{ $plate->pivot->created_at }} <br>
                            </li>
                            {{-- 
                                @else
                                <strong>Non ci sono ordini</strong>
                                @endif 
                                --}}
                            @if (count($order->plates) < 2)
                                <li class="list-group-item"> <strong>Id Restaurant from Plate:</strong>
                                    {{ $plate->restaurant_id }}
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    @if (count($order->plates) < 2)
                        <strong>Name Restaurant:</strong> {{ $plate->restaurant->name }}
                    @endif

                    </p>
                </div>
            </div>
            {{--  @endif --}}
        @endforeach
    </div>
@endsection
