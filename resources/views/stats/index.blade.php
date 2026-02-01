@extends('layouts.usernav')

@push('styles')
<style>
/* ===== GLOBAL ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    min-height: 100vh;
    color: #fff;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* ===== LIST HEADER (TYPE 1) ===== */
.list-header {
    margin-bottom: 24px;
    padding: 16px 20px;
    background: rgba(17, 25, 40, 0.55);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 12px;
}

.list-header h1 {
    font-size: 26px;
    font-weight: 800;
    color: #14b8a6;
    margin-bottom: 6px;
}

.list-header p {
    font-size: 14px;
    color: #9ca3af;
    margin: 0;
}

.stats-page {
    min-height: 100vh;
    padding: 32px 16px;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

/* ===== TABS ===== */
.content-tabs {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 24px;
    background: rgba(17, 25, 40, 0.5);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,.08);
    overflow-x: auto;
    scrollbar-width: none;
}

.content-tabs::-webkit-scrollbar { display: none; }

.tab-link {
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #9ca3af;
    text-decoration: none;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.tab-link:hover {
    background: rgba(20, 184, 166, 0.1);
    color: #e5e7eb;
}

.tab-link.active {
    background: rgba(20, 184, 166, 0.15);
    color: #14b8a6;
    border-bottom: 2px solid #14b8a6;
}

/* ===== LAYOUT ===== */
.content-wrapper {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 24px;
}

/* ===== SIDEBAR FILTER ===== */
.filter-sidebar {
    background: rgba(17, 25, 40, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.08);
    padding: 20px;
    border-radius: 12px;
    position: sticky;
    top: 24px;
    height: fit-content;
}

.sidebar-title {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #e5e7eb;
}

.filter-group {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,.08);
}

.filter-group h3 {
    font-size: 12px;
    color: #14b8a6;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: .1em;
    font-weight: 700;
}

.filter-group select,
.filter-group input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(17, 25, 40, 0.6);
    color: #fff;
    font-size: 14px;
}

.btn-filter {
    width: 100%;
    padding: 10px;
    background: rgba(20, 184, 166, 0.25);
    border: 1px solid rgba(20, 184, 166, 0.4);
    color: #14b8a6;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
}

.btn-filter:hover {
    background: rgba(20, 184, 166, 0.35);
}

/* ===== STATS GRID ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}

.stat-card {
    background: rgba(17, 25, 40, 0.5);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 12px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0,0,0,0.25);
    border-color: rgba(139,92,246,0.3);
}

.stat-icon {
    font-size: 32px;
    flex-shrink: 0;
    color: #c4b5fd;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-size: 22px;
    font-weight: 800;
    color: #fff;
    line-height: 1;
}

.stat-label {
    font-size: 13px;
    font-weight: 600;
    color: #9ca3af;
}

/* ===== MOBILE ===== */
@media (max-width: 768px) {
    .content-wrapper {
        grid-template-columns: 1fr;
    }

    .filter-sidebar {
        position: static;
        margin-bottom: 24px;
    }

    .stats-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
}
</style>
@endpush

@section('content')
<div class="stats-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="list-header">
            <h1>Stats Overview</h1>
            <p>All your media stats at a glance</p>
        </div>

        {{-- TABS --}}
        <div class="content-tabs">
            <a href="{{ route('media.overview') }}" class="tab-link {{ request()->routeIs('media.overview') ? 'active' : '' }}">Overview</a>
            <a href="{{ route('drama.index') }}" class="tab-link {{ request()->routeIs('drama.index') ? 'active' : '' }}">Drama List</a>
            <a href="{{ route('manhwa.index') }}" class="tab-link {{ request()->routeIs('manhwa.index') ? 'active' : '' }}">Manhwa List</a>
            <a href="{{ route('diary.index') }}" class="tab-link {{ request()->routeIs('diary.index') ? 'active' : '' }}">Diary</a>
            <a href="{{ route('stats.index') }}" class="tab-link {{ request()->routeIs('stats.index') ? 'active' : '' }}">Stats</a>
        </div>

        <div class="content-wrapper">
            {{-- FILTER SIDEBAR --}}
            <aside class="filter-sidebar">
                <form method="GET" action="{{ route('stats.index') }}">
                    <div class="filter-group">
                        <h3>Media Type</h3>
                        <select name="type" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="drama" {{ request('type') == 'drama' ? 'selected' : '' }}>Drama</option>
                            <option value="manhwa" {{ request('type') == 'manhwa' ? 'selected' : '' }}>Manhwa</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <h3>Status</h3>
                        <select name="status" onchange="this.form.submit()">
                            <option value="">All</option>
                            <option value="watching" {{ request('status') == 'watching' ? 'selected' : '' }}>Watching</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="planned" {{ request('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <h3>Rating ≥</h3>
                        <input
                            type="number"
                            name="rating"
                            min="0"
                            max="10"
                            step="0.1"
                            value="{{ request('rating') }}"
                            placeholder="e.g. 8.5"
                            onchange="this.form.submit()"
                        >
                    </div>
                </form>
            </aside>

            {{-- MAIN STATS CONTENT --}}
            <main>
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
                            <div class="stat-value">{{ number_format($stats['days_watched'], 1) }}</div>
                            <div class="stat-label">Days Watched</div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection