@extends('layouts.usernav')

@section('content')
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

.overview-page {
    min-height: 100vh;
    padding: 32px 16px;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

/* ===== HEADER ===== */
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

/* ===== STATS CARDS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 32px;
}

.stat-card {
    background: rgba(17, 25, 40, 0.55);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.08);
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    transition: transform 0.2s ease, border-color 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    border-color: rgba(20, 184, 166, 0.4);
}

.stat-icon {
    font-size: 28px;
    margin-bottom: 12px;
    opacity: 0.8;
}

.stat-value {
    font-size: 28px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 4px;
}

.stat-label {
    font-size: 12px;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

/* ===== SECTIONS ===== */
.section {
    margin-bottom: 40px;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.section-title {
    font-size: 20px;
    font-weight: 700;
    color: #e5e7eb;
}

.view-all-link {
    color: #a78bfa;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: color 0.2s ease;
}

.view-all-link:hover {
    color: #c4b5fd;
}

/* ===== MEDIA GRID (mirip drama-grid) ===== */
.media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 12px;
}

/* ===== MEDIA CARD (mirip drama-card) ===== */
.media-card {
    background: rgba(17, 25, 40, 0.5);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.media-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.media-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    background: #111827;
}

/* ===== OVERLAY INFO (on hover) ===== */
.card-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 12px;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.85),
        rgba(0,0,0,0.2),
        transparent
    );
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease;
}

.media-card:hover .card-overlay {
    opacity: 1;
    pointer-events: auto;
}

.card-overlay .title {
    font-size: 0.95rem;
    font-weight: 600;
    white-space: normal;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

.card-overlay .release-year {
    font-size: 0.8rem;
    opacity: 0.7;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: #9ca3af;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.empty-state-icon {
    font-size: 64px;
    opacity: 0.3;
}

.empty-text {
    font-size: 16px;
}

/* ===== MEDIA TABS STYLE ===== */
.nav-tabs-custom .nav-link.active {
    color: #14b8a6;
    border-bottom: 2px solid #14b8a6;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .media-grid {
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    }

    .section-title {
        font-size: 18px;
    }
}
</style>

<div class="overview-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="list-header">
            <h1>Overview</h1>
            <p>Your complete media collection at a glance</p>
        </div>

        {{-- TABS --}}
        <div class="content-tabs">
            <a href="{{ route('media.overview') }}" class="tab-link {{ request()->routeIs('media.overview') ? 'active' : '' }}">Overview</a>
            <a href="{{ route('drama.index') }}" class="tab-link {{ request()->routeIs('drama.index') ? 'active' : '' }}">Drama List</a>
            <a href="{{ route('manhwa.index') }}" class="tab-link {{ request()->routeIs('manhwa.index') ? 'active' : '' }}">Manhwa List</a>
            <a href="{{ route('diary.index') }}" class="tab-link {{ request()->routeIs('diary.index') ? 'active' : '' }}">Diary</a>
            <!-- <a href="{{ route('stats.index') }}" class="tab-link {{ request()->routeIs('stats.index') ? 'active' : '' }}">Stats</a> -->
        </div>

        {{-- MEDIA TYPE FILTER TABS --}}
        <div class="nav nav-tabs nav-tabs-custom mb-4">
            <a href="{{ route('media.overview') }}?type=drama" 
            class="nav-link {{ request('type') === 'drama' || !request('type') ? 'active' : '' }}">
                Dramas
            </a>
            <a href="{{ route('media.overview') }}?type=manhwa" 
            class="nav-link {{ request('type') === 'manhwa' ? 'active' : '' }}">
                Manhwa
            </a>
        </div>

        {{-- STATS OVERVIEW --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-value">{{ $totalMedia }}</div>
                <div class="stat-label">Total Media</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🎬</div>
                <div class="stat-value">{{ $totalDramas }}</div>
                <div class="stat-label">Dramas</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📚</div>
                <div class="stat-value">{{ $totalManhwas }}</div>
                <div class="stat-label">Manhwa</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-value">{{ $completedMedia }}</div>
                <div class="stat-label">Completed</div>
            </div>
        </div>

        {{-- RECENTLY ADDED --}}
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Recently Added</h2>
                <a href="#" class="view-all-link">View All →</a>
            </div>

            <div class="media-grid">
                @forelse ($recentMedia as $media)
                    <div class="media-card">
                        <img src="{{ Storage::url($media->poster) }}" alt="{{ $media->title }}">
                        <div class="card-overlay">
                            <div class="title">{{ $media->title }}</div>
                            <div class="release-year">{{ $media->release_year ?? '—' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">🎭</div>
                        <p class="empty-text">No media added yet</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- CURRENTLY WATCHING / READING --}}
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">
                    @if(request('type') === 'manhwa')
                        Currently Reading
                    @elseif(request('type') === 'drama')
                        Currently Watching
                    @else
                        Currently Watching / Reading
                    @endif
                </h2>
                <a href="{{ 
                    request('type') === 'manhwa' 
                        ? route('manhwa.index', ['list_status' => 'watching']) 
                        : route('drama.index', ['list_status' => 'watching']) 
                }}" class="view-all-link">View All →</a>
            </div>

            <div class="media-grid">
                @forelse ($ongoingMedia as $item)
                    @if($item->media)
                        <div class="media-card">
                            <img src="{{ Storage::url($item->media->poster) }}" alt="{{ $item->media->title }}">
                            <div class="card-overlay">
                                <div class="title">{{ $item->media->title }}</div>
                                <div class="release-year">{{ $item->media->release_year ?? '—' }}</div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">⏸️</div>
                        <p class="empty-text">
                            @if(request('type') === 'manhwa')
                                No manhwa in progress
                            @elseif(request('type') === 'drama')
                                No drama in progress
                            @else
                                No ongoing media
                            @endif
                        </p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection