@extends('layouts.usernav')

@section('content')
<style>
    /* ===== GLOBAL STYLES ===== */
    * {
        box-sizing: border-box;
    }

    /* ===== PAGE LAYOUT ===== */
    .manhwa-page {
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

    /* ===== CONTENT WRAPPER ===== */
    .content-wrapper {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 28px;
        align-items: start;
    }

    /* ===== SIDEBAR ===== */
    .filter-sidebar {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        padding: 24px;
        border-radius: 16px;
        position: sticky;
        top: 24px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    .sidebar-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 24px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sidebar-title::before {
        content: "⚡";
        font-size: 20px;
    }

    /* ===== FILTER GROUPS ===== */
    .filter-group {
        margin-bottom: 28px;
        padding-bottom: 28px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .filter-group:last-of-type {
        border-bottom: none;
        padding-bottom: 0;
    }

    .filter-group h3 {
        font-size: 12px;
        color: #a78bfa;
        margin-bottom: 14px;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 700;
    }

    .filter-option {
        display: flex;
        align-items: center;
        padding: 10px 12px;
        margin-bottom: 6px;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .filter-option:hover {
        background: rgba(139, 92, 246, 0.1);
        transform: translateX(4px);
    }

    .filter-option input[type="radio"],
    .filter-option input[type="checkbox"] {
        margin: 0;
        margin-right: 12px;
        cursor: pointer;
        width: 18px;
        height: 18px;
        accent-color: #8b5cf6;
    }

    .filter-option label {
        flex: 1;
        font-size: 14px;
        color: #e5e7eb;
        cursor: pointer;
        margin: 0;
        user-select: none;
        font-weight: 500;
    }

    .filter-option input:checked ~ label {
        color: #a78bfa;
        font-weight: 600;
    }

    /* ===== BUTTONS ===== */
    .btn-filter {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: #fff;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
    }

    .btn-filter:active {
        transform: translateY(0);
    }

    /* ===== MANHWA GRID ===== */
    .manhwa-list-wrapper {
        min-height: 400px;
    }

    .manhwa-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 24px;
    }

    /* ===== MANHWA CARDS ===== */
    .manhwa-card {
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
    }

    .manhwa-card::before {
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

    .manhwa-card:hover::before {
        opacity: 1;
    }

    .manhwa-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.5);
        border-color: rgba(139, 92, 246, 0.3);
    }

    .manhwa-card-image {
        position: relative;
        overflow: hidden;
        padding-top: 140%;
    }

    .manhwa-card img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .manhwa-card:hover img {
        transform: scale(1.1);
    }

    .manhwa-overlay {
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

    .manhwa-card:hover .manhwa-overlay {
        opacity: 1;
    }

    /* ===== MANHWA INFO ===== */
    .manhwa-info {
        padding: 16px;
        position: relative;
        z-index: 2;
    }

    .manhwa-info h4 {
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
        background: rgba(34, 197, 94, 0.2);
        border: 1px solid rgba(34, 197, 94, 0.5);
        color: #86efac;
    }

    .status.finished::before {
        background: #22c55e;
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
        .content-wrapper {
            grid-template-columns: 240px 1fr;
            gap: 20px;
        }

        .manhwa-list {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .manhwa-page {
            padding: 24px 16px;
        }

        .content-wrapper {
            grid-template-columns: 1fr;
        }

        .filter-sidebar {
            position: static;
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

        .manhwa-list {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 16px;
        }
    }
</style>

<div class="manhwa-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="page-header">
            <h1>Manhwa List</h1>
            <p class="page-subtitle">Discover and track your favorite dramas and manhwa</p>
        </div>

        {{-- NAVIGATION TABS --}}
        <div class="content-tabs">
            <a href="{{ route('media.overview') }}" class="tab-link {{ request()->routeIs('media.overview') ? 'active' : '' }}">
                Overview
            </a>
            <a href="{{ route('drama.index') }}" class="tab-link {{ request()->routeIs('drama.index') ? 'active' : '' }}">
                Drama List
            </a>
            <a href="{{ route('manhwa.index') }}" class="tab-link {{ request()->routeIs('manhwa.index') ? 'active' : '' }}">
                Manhwa List
            </a>
            <a href="{{ route('media.stats') }}" class="tab-link {{ request()->routeIs('media.stats') ? 'active' : '' }}">
                Stats
            </a>
        </div>

        <div class="content-wrapper">

            {{-- FILTER --}}
                <aside class="filter-sidebar">
                <form method="GET" action="{{ route('drama.index') }}">

                <div class="filter-group">
                <h3>Status</h3>

                <label class="filter-option">
                <input type="radio" name="status" value="" {{ request('status') === null ? 'checked' : '' }}>
                All
                </label>

                <label class="filter-option">
                <input type="radio" name="status" value="finished" {{ request('status') === 'finished' ? 'checked' : '' }}>
                Finished
                </label>

                <label class="filter-option">
                <input type="radio" name="status" value="ongoing" {{ request('status') === 'ongoing' ? 'checked' : '' }}>
                Ongoing
                </label>
                </div>

                <div class="filter-group">
                <h3>Genres</h3>
                @foreach ($genres as $genre)
                <label class="filter-option">
                <input type="checkbox" name="genres[]" value="{{ $genre->id }}"
                {{ in_array($genre->id, request('genres', [])) ? 'checked' : '' }}>
                {{ $genre->name }}
                </label>
                @endforeach
                </div>

                <button class="btn-filter">Apply Filters</button>
                </form>
                </aside>

            {{-- MANHWA LIST --}}
            <section class="manhwa-list-wrapper">
                <div class="manhwa-list">

                    @forelse ($manhwas as $manhwa)
                        <div class="manhwa-card">

                            {{-- Status Badge --}}
                            <div class="status-wrapper">
                                <span class="status {{ $manhwa->status }}">
                                    {{ ucfirst($manhwa->status) }}
                                </span>
                            </div>

                            {{-- Image --}}
                            <div class="manhwa-card-image">
                                <img src="{{ asset($manhwa->poster) }}" alt="{{ $manhwa->title }}">
                                
                                {{-- Hover Overlay --}}
                                <div class="manhwa-overlay">
                                    <div class="genre-tags">
                                        @foreach ($manhwa->genres->take(2) as $genre)
                                            <span>{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="manhwa-info">
                                <h4>{{ $manhwa->title }}</h4>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon">📚</div>
                            <p class="empty-text">No manhwa found with the selected filters</p>
                        </div>
                    @endforelse

                </div>
            </section>

        </div>
    </div>
</div>

<script>
    // Auto-submit on filter change (optional)
    // document.querySelectorAll('.filter-option input').forEach(input => {
    //     input.addEventListener('change', () => {
    //         input.closest('form').submit();
    //     });
    // });
</script>
@endsection