@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Statistiche degli Ordini</h1>

        @if (!empty($statistics))
            <div class="chart-container">
                <!-- Grafico per i mesi -->
                <div class="chart-container">
                    <h2>Statistica per Mesi</h2>
                    <canvas id="monthlyChart" width="400" height="200"></canvas>
                </div>

                <!-- Grafico per gli anni -->
                <div class="chart-container">
                    <h2>Statistica per Anni</h2>
                    <canvas id="yearlyChart" width="400" height="200"></canvas>
                </div>
            </div>

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
            var monthlyData = {
                labels: statistics.map(item => item.month),
                datasets: [{
                        label: 'Ordini Totali',
                        data: statistics.map(item => item.total_orders),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Quantità Totali',
                        data: statistics.map(item => item.total_quantity),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Vendite Totali',
                        data: statistics.map(item => item.total_sales),
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }
                ]
            };

            var yearlyData = {
                labels: [...new Set(statistics.map(item => item.year))],
                datasets: [{
                        label: 'Ordini Totali',
                        data: statistics.reduce((acc, item) => {
                            acc[item.year] = (acc[item.year] || 0) + item.total_orders;
                            return acc;
                        }, {}),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Quantità Totali',
                        data: statistics.reduce((acc, item) => {
                            acc[item.year] = (acc[item.year] || 0) + item.total_quantity;
                            return acc;
                        }, {}),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Vendite Totali',
                        data: statistics.reduce((acc, item) => {
                            acc[item.year] = (acc[item.year] || 0) + item.total_sales;
                            return acc;
                        }, {}),
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }
                ]
            };

            // Creare il grafico mensile
            var monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            var monthlyChart = new Chart(monthlyCtx, {
                type: 'bar',
                data: monthlyData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Creare il grafico annuale
            var yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
            var yearlyChart = new Chart(yearlyCtx, {
                type: 'bar',
                data: yearlyData,
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    var statistics = {!! json_encode($statistics) !!};

                    // Estrai i totali per ogni mese
                    var monthlyData = {
                        labels: statistics.map(item => item.month),
                        datasets: [{
                                label: 'Ordini Totali',
                                data: statistics.map(item => item.total_orders),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Quantità Totali',
                                data: statistics.map(item => item.total_quantity),
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Vendite Totali',
                                data: statistics.map(item => item.total_sales),
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            }
                        ]
                    };

                    var yearlyData = {
                        labels: [...new Set(statistics.map(item => item.year))],
                        datasets: [{
                                label: 'Ordini Totali',
                                data: statistics.reduce((acc, item) => {
                                    acc[item.year] = (acc[item.year] || 0) + item.total_orders;
                                    return acc;
                                }, {}),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Quantità Totali',
                                data: statistics.reduce((acc, item) => {
                                    acc[item.year] = (acc[item.year] || 0) + item.total_quantity;
                                    return acc;
                                }, {}),
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Vendite Totali',
                                data: statistics.reduce((acc, item) => {
                                    acc[item.year] = (acc[item.year] || 0) + item.total_sales;
                                    return acc;
                                }, {}),
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            }
                        ]
                    };
    </script>
@endsection
