@extends('layouts.usernav')

@section('content')
<style>
    /* ===== GLOBAL STYLES ===== */
    * {
        box-sizing: border-box;
    }

    /* ===== PAGE LAYOUT ===== */
    .overview-page {
        min-height: 100vh;
        background: linear-gradient(135deg, #0a0e1a 0%, #0f1419 100%);
        padding: 40px 24px;
        color: #e5e7eb;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* ===== HEADER ===== */
    .page-header {
        margin-bottom: 32px;
    }

    .page-header h1 {
        font-size: 36px;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #9ca3af;
        font-size: 15px;
    }

    /* ===== NAVIGATION TABS ===== */
    .content-tabs {
        display: flex;
        gap: 4px;
        margin-bottom: 32px;
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 6px;
        border-radius: 16px;
        width: fit-content;
    }

    .tab-link {
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 600;
        color: #9ca3af;
        text-decoration: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .tab-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .tab-link:hover {
        color: #e5e7eb;
    }

    .tab-link:hover::before {
        opacity: 1;
    }

    .tab-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
    }

    .tab-link.active::before {
        opacity: 0;
    }

    /* ===== STATS CARDS ===== */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 24px;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: rgba(139, 92, 246, 0.3);
    }

    .stat-icon {
        font-size: 32px;
        margin-bottom: 12px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 13px;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }

    /* ===== SECTIONS ===== */
    .section {
        margin-bottom: 48px;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 24px;
        font-weight: 700;
        color: #fff;
    }

    .view-all-link {
        color: #a78bfa;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .view-all-link:hover {
        color: #c4b5fd;
    }

    /* ===== MEDIA GRID ===== */
    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 24px;
    }

    /* ===== MEDIA CARDS ===== */
    .media-card {
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
    }

    .media-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
        z-index: 1;
    }

    .media-card:hover::before {
        opacity: 1;
    }

    .media-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5);
        border-color: rgba(139, 92, 246, 0.3);
    }

    .media-card-image {
        position: relative;
        overflow: hidden;
        padding-top: 140%;
    }

    .media-card img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .media-card:hover img {
        transform: scale(1.1);
    }

    .media-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, transparent 100%);
        padding: 16px 12px 12px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
    }

    .media-card:hover .media-overlay {
        opacity: 1;
    }

    /* ===== MEDIA INFO ===== */
    .media-info {
        padding: 16px;
        position: relative;
        z-index: 2;
    }

    .media-info h4 {
        font-size: 15px;
        margin-bottom: 10px;
        font-weight: 700;
        line-height: 1.4;
        color: #fff;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 42px;
    }

    .media-type-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 3;
        font-size: 10px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(10px);
    }

    .media-type-badge.drama {
        background: rgb(20, 184, 166);
        border: 1px solid rgba(13, 148, 136, 0.4);
        color: #ffffff;
    }

    .media-type-badge.manhwa {
        background: rgba(59, 130, 246, 0.2);
        border: 1px solid rgba(59, 130, 246, 0.5);
        color: #93c5fd;
    }

    .genre-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 10px;
        min-height: 24px;
    }

    .genre-tags span {
        display: inline-block;
        font-size: 10px;
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.3);
        color: #c4b5fd;
        padding: 4px 8px;
        border-radius: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    /* ===== STATUS BADGE ===== */
    .status-wrapper {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 3;
    }

    .status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .status::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        animation: pulse 2s ease-in-out infinite;
    }

    .status.finished {
        background: rgba(13, 148, 136, 0.2);
        border: 1px solid rgb(20, 184, 166);
        color: #2d8879;
    }

    .status.finished::before {
        background: #2d8879;
    }

    .status.ongoing {
        background: rgba(250, 204, 21, 0.2);
        border: 1px solid rgba(250, 204, 21, 0.5);
        color: #fde047;
    }

    .status.ongoing::before {
        background: #facc15;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 16px;
        opacity: 0.3;
    }

    .empty-text {
        color: #9ca3af;
        font-size: 18px;
        font-weight: 500;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .media-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 20px;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .overview-page {
            padding: 24px 16px;
        }

        .page-header h1 {
            font-size: 28px;
        }

        .content-tabs {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .content-tabs::-webkit-scrollbar {
            display: none;
        }

        .tab-link {
            padding: 10px 20px;
            font-size: 13px;
            white-space: nowrap;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .media-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 16px;
        }

        .section-title {
            font-size: 20px;
        }
    }
</style>

<div class="overview-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="page-header">
            <h1>Overview</h1>
            <p class="page-subtitle">Your complete media collection at a glance</p>
        </div>

        {{-- NAVIGATION TABS --}}
        <div class="content-tabs">
            <a href="{{ route('media.overview') }}" class="tab-link active">
                Overview
            </a>
            <a href="{{ route('drama.index') }}" class="tab-link">
                Drama List
            </a>
            <a href="{{ route('manhwa.index') }}" class="tab-link">
                Manhwa List
            </a>
            <a href="{{ route('media.stats') }}" class="tab-link">
                Stats
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

                        {{-- Media Type Badge --}}
                        <div class="media-type-badge {{ $media->type }}">
                            {{ ucfirst($media->type) }}
                        </div>


                        {{-- Status Badge --}}
                        <div class="status-wrapper">
                            <span class="status {{ $media->status }}">
                                {{ ucfirst($media->status) }}
                            </span>
                        </div>

                        {{-- Image --}}
                        <div class="media-card-image">
                            <img src="{{ Storage::url($media->poster) }}" alt="{{ $media->title }}">
                            
                            {{-- Hover Overlay --}}
                            <div class="media-overlay">
                                <div class="genre-tags">
                                    @foreach (optional($media->media)->genres?->take(2) ?? [] as $genre)
                                        <span>{{ $genre->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="media-info">
                            <h4>{{ $media->title }}</h4>
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

        {{-- CURRENTLY WATCHING --}}
        <section class="section">
            <div class="section-header">
                <h2 class="section-title">Currently Watching</h2>
                <a href="#" class="view-all-link">View All →</a>
            </div>

            <div class="media-grid">
                @forelse ($ongoingMedia as $media)
                    <div class="media-card">

                        {{-- Media Type Badge --}}
                        <div class="media-type-badge {{ $media->type }}">
                            {{ ucfirst($media->type) }}
                        </div>


                        {{-- Status Badge --}}
                        <div class="status-wrapper">
                            <span class="status {{ $media->status }}">
                                {{ ucfirst($media->status) }}
                            </span>
                        </div>

                        {{-- Image --}}
                        <div class="media-card-image">
                            <img src="{{ Storage::url($media->poster) }}" alt="{{ $media->title }}">
                            
                            {{-- Hover Overlay --}}
                            <div class="media-overlay">
                                <div class="genre-tags">
                                    @foreach (optional($media->media)->genres?->take(2) ?? [] as $genre)
                                        <span>{{ $genre->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="media-info">
                            <h4>{{ $media->title }}</h4>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">⏸️</div>
                        <p class="empty-text">No ongoing media</p>
                    </div>
                @endforelse
            </div>
        </section>

    </div>
</div>
@endsection