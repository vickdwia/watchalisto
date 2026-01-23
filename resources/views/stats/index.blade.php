@extends('layouts.usernav')

@section('content')
<style>
.stats-page {
    min-height: 100vh;
    display: flex;
    gap: 24px;
    padding: 40px 24px;
    background: linear-gradient(135deg, #0a0e1a 0%, #0f1419 100%);
    color: #e5e7eb;
}

/* Sidebar Filter */
.sidebar {
    width: 260px;
    background: rgba(15,23,42,0.7);
    backdrop-filter: blur(12px);
    border-radius: 16px;
    padding: 24px;
    flex-shrink: 0;
}

.sidebar h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #fff;
}

.filter-group {
    margin-bottom: 16px;
}

.filter-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #c4b5fd;
}

.filter-group select,
.filter-group input {
    width: 100%;
    padding: 8px 10px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(20,28,50,0.6);
    color: #fff;
}

/* Apply Button */
.apply-btn {
    display: inline-block;
    width: 100%;
    padding: 10px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    font-weight: 600;
    border-radius: 12px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
}

.apply-btn:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: 0 8px 20px rgba(102,126,234,0.3);
}

/* Main Stats Grid */
.stats-main {
    flex: 1;
}

.page-header h1 {
    font-size: 32px;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 6px;
}

.page-subtitle {
    font-size: 14px;
    color: #9ca3af;
    margin-bottom: 24px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

/* Row Style Card */
.stat-card {
    background: rgba(15,23,42,0.6);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    border: 1px solid rgba(255,255,255,0.05);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-3px) scale(1.02);
    border-color: rgba(139,92,246,0.3);
    box-shadow: 0 12px 28px rgba(0,0,0,0.4);
}

.stat-icon {
    font-size: 36px;
    flex-shrink: 0;
    color: #c4b5fd;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}

.stat-label {
    font-size: 13px;
    font-weight: 600;
    color: #c4b5fd;
}

/* Responsive */
@media (max-width: 1024px) {
    .stats-page {
        flex-direction: column;
        padding: 24px 16px;
    }

    .sidebar {
        width: 100%;
        margin-bottom: 20px;
    }

    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    }
}
</style>

<div class="stats-page">

    {{-- Sidebar Filter --}}
    <div class="sidebar">
        <h3>Filter Stats</h3>

        <form action="{{ route('stats.index') }}" method="GET">
            <div class="filter-group">
                <label for="type">Media Type</label>
                <select id="type" name="type">
                    <option value="">All</option>
                    <option value="drama" {{ request('type')=='drama'?'selected':'' }}>Drama</option>
                    <option value="manhwa" {{ request('type')=='manhwa'?'selected':'' }}>Manhwa</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="">All</option>
                    <option value="watching" {{ request('status')=='watching'?'selected':'' }}>Watching</option>
                    <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
                    <option value="planned" {{ request('status')=='planned'?'selected':'' }}>Planned</option>
                </select>
            </div>

            <div class="filter-group">
                <label for="rating">Rating ≥</label>
                <input type="number" id="rating" name="rating" min="0" max="10" step="0.1" value="{{ request('rating') }}">
            </div>

            <button type="submit" class="apply-btn">Apply Filter</button>
        </form>
    </div>

    {{-- Main Stats Grid --}}
    <div class="stats-main">
        <div class="page-header">
            <h1>Stats Overview</h1>
            <p class="page-subtitle">All your media stats at a glance</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🎬</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['total_media'] }}</div>
                    <div class="stat-label">Total Media</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📺</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['total_drama'] }}</div>
                    <div class="stat-label">Drama</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['total_manhwa'] }}</div>
                    <div class="stat-label">Manhwa</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['completed'] }}</div>
                    <div class="stat-label">Completed</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⏳</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['watching'] }}</div>
                    <div class="stat-label">Watching</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['planned'] }}</div>
                    <div class="stat-label">Planned</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⭐</div>
                <div class="stat-info">
                    <div class="stat-value">{{ $stats['avg_rating'] ?? '-' }}</div>
                    <div class="stat-label">Avg Rating</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⏱️</div>
                <div class="stat-info">
                    <div class="stat-value">
                        {{ floor($stats['time_spent']/60) }}h {{ $stats['time_spent'] % 60 }}m
                    </div>
                    <div class="stat-label">Time Spent</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
