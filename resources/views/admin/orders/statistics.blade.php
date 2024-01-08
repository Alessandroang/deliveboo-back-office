@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Statistiche degli Ordini</h1>

        @if (!empty($statistics))
            <canvas id="myChart" width="400" height="200"></canvas>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var statistics = {!! json_encode($statistics) !!};

            // Estrai i totali per ogni mese
            var totalOrders = statistics.map(item => item.total_orders);
            var totalQuantity = statistics.map(item => item.total_quantity);
            var totalSales = statistics.map(item => item.total_sales);

            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: statistics.map(item => item.month), // Etichette mesi
                    datasets: [{
                            label: 'Ordini Totali',
                            data: totalOrders,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Quantità Totali',
                            data: totalQuantity,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Vendite Totali',
                            data: totalSales,
                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>


@endsection
