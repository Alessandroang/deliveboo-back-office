@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Statistiche degli Ordini</h1>

        @if (!empty($statistics))
            <table class="table">
                <thead>
                    <tr>
                        <th>Mese</th>
                        <th>Anno</th>
                        <th>Ordini Totali</th>
                        <th>Quantità Totale</th>
                        <th>Vendite Totali</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statistics as $statistic)
                        <tr>
                            <td>{{ $statistic->month }}</td>
                            <td>{{ $statistic->year }}</td>
                            <td>{{ $statistic->total_orders }}</td>
                            <td>{{ $statistic->total_quantity }}</td>
                            <td>{{ $statistic->total_sales }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="alert alert-info">Nessuna statistica degli ordini disponibile.</p>
        @endif
    </div>
@endsection
