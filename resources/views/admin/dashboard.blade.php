@extends('layouts.adminside')

@section('title', 'Dashboard Admin')

<!-- @push('style')
<style>
    .chartjs-tooltip-key {
    background-color: transparent !important; /* Hilangkan background putih */
    border: none !important; /* Hapus border abu-abu */
}
</style>
@endpush -->

@section('content')
    <div class="stats-grid">
        <div class="stat-card"><h3>{{ $totalUsers }}</h3><p>Total User</p></div>
        <div class="stat-card"><h3>{{ $totalAdmins }}</h3><p>Total Admin</p></div>
        <div class="stat-card"><h3>{{ $totalMedia }}</h3><p>Total Media</p></div>
        <div class="stat-card"><h3>{{ $totalDrama }}</h3><p>Total Drama</p></div>
        <div class="stat-card"><h3>{{ $totalManhwa }}</h3><p>Total Manhwa</p></div>
    </div>

    <div class="card recent-media">
        <h2>Media Terbaru</h2>
        <ul>
            @forelse($recentMedia as $media)
                <li>{{ $media->title }} <span class="badge">{{ $media->type }}</span></li>
            @empty
                <li>Belum ada media</li>
            @endforelse
        </ul>
    </div>

    <div class="charts-container">
        <div class="chart-card">
            <h2>Media Distribution</h2>
            <div class="chart-wrapper">
                <canvas id="mediaChart"></canvas>
            </div>
        </div>
        <div class="chart-card">
            <h2>Media per Genre</h2>
            <div class="chart-wrapper">
                <canvas id="genreChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    new Chart(document.getElementById('mediaChart'), {
        type:'doughnut',
        data:{
            labels:['Drama','Manhwa'],
            datasets:[{
                data:[{{ $totalDrama }},{{ $totalManhwa }}],
                backgroundColor:['#14b8a6','#38bdf8'],
                borderWidth:0
            }]
        },
        options: {
            cutout: '65%',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom', 
                    labels: {
                        color: '#cbd5f5',
                        padding: 16,
                        boxWidth: 14,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('genreChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($genres->pluck('name')) !!},
            datasets: [
                {
                    label: 'Drama',
                    data: {!! json_encode($genres->pluck('drama_count')) !!},
                    borderColor: '#14b8a6',
                    backgroundColor: 'rgba(20,184,166,0.15)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4
                },
                {
                    label: 'Manhwa',
                    data: {!! json_encode($genres->pluck('manhwa_count')) !!},
                    borderColor: '#38bdf8',
                    backgroundColor: 'rgba(56,189,248,0.15)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    enabled: false
                    // backgroundColor: 'rgba(17, 25, 40, 0.95)',
                    // titleColor: '#e5e7eb',
                    // bodyColor: '#cbd5f5',
                    // borderColor: 'rgba(255,255,255,.1)',
                    // borderWidth: 1,
                    // padding: 12,
                    // displayColors: true,
                    // usePointStyle: true,
                    // boxWidth: 10,
                    // boxHeight: 10
                },
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#cbd5f5',
                        padding: 16,
                        usePointStyle: true
                    }
                }
            },
            scales: {
                x: {
                    ticks: { color: '#cbd5f5' },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#cbd5f5', precision: 0 },
                    grid: { color: 'rgba(255,255,255,0.08)' }
                }
            }
        }
    });
</script>
@endpush