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

.diary-page {
    min-height: 100vh;
    padding: 32px 16px;
    background: transparent;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

/* ===== HEADER ===== */
.page-header {
    margin-bottom: 24px;
}

.page-header h1 {
    font-size: 28px;
    font-weight: 800;
    color: #14b8a6;
}

.page-subtitle {
    color: #9ca3af;
    font-size: 14px;
}

/* ===== TABS (SAMAKAN DENGAN DRAMALIST) ===== */
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

/* ===== DIARY LIST (LETTERBOXD STYLE) ===== */
.diary-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.diary-entry {
    display: grid;
    grid-template-columns: 110px 1fr;
    gap: 16px;
    padding: 16px;
    background: rgba(17, 25, 40, 0.5);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 12px;
    transition: transform 0.3s ease;
}

.diary-entry:hover {
    transform: translateY(-2px);
    border-color: rgba(20, 184, 166, 0.3);
}

.entry-poster {
    width: 100%;
    height: 165px;
    object-fit: cover;
    border-radius: 8px;
    background: #111827;
}

.entry-content {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.entry-header {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
}

.entry-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #e5e7eb;
    line-height: 1.3;
}

.entry-meta {
    display: flex;
    gap: 12px;
    font-size: 13px;
    color: #9ca3af;
    flex-wrap: wrap;
}

.entry-status {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 2px 8px;
    border-radius: 12px;
    background: rgba(20, 184, 166, 0.1);
    color: #14b8a6;
    font-size: 12px;
}

.entry-notes {
    line-height: 1.5;
    color: #cbd5e1;
    font-size: 14px;
    white-space: pre-line;
    padding-top: 4px;
    border-top: 1px solid rgba(255,255,255,.08);
}

.entry-date {
    font-size: 12px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 4px;
}

.entry-actions {
    display: flex;
    align-items: center;
    gap: 10px;
}

.edit-diary-btn {
    background: transparent;
    border: none;
    color: #9ca3af;
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.edit-diary-btn:hover {
    color: #14b8a6;
    background: rgba(20, 184, 166, 0.1);
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

.empty-state svg {
    width: 64px;
    height: 64px;
    fill: #9ca3af;
}

.empty-state p {
    font-size: 16px;
}
</style>
@endpush

@section('content')
<div class="diary-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="list-header">
            <h1>Diary</h1>
            <p>{{ $notes->count() }} entries • Your personal watch journal</p>
        </div>

        {{-- TABS (SAMAKAN DENGAN DRAMALIST) --}}
        <div class="content-tabs">
            <a href="{{ route('media.overview') }}" class="tab-link {{ request()->routeIs('media.overview') ? 'active' : '' }}">Overview</a>
            <a href="{{ route('drama.index') }}" class="tab-link {{ request()->routeIs('drama.index') ? 'active' : '' }}">Drama List</a>
            <a href="{{ route('manhwa.index') }}" class="tab-link {{ request()->routeIs('manhwa.index') ? 'active' : '' }}">Manhwa List</a>
            <a href="{{ route('diary.index') }}" class="tab-link active">Diary</a>
            <!-- <a href="{{ route('stats.index') }}" class="tab-link {{ request()->routeIs('stats.index') ? 'active' : '' }}">Stats</a> -->
        </div>

        {{-- DIARY LIST (AMBIL DARI NOTES USER MEDIALIST) --}}
        <div class="diary-list">
            @forelse($notes as $item)
                <div class="diary-entry">
                    <img src="{{ Storage::url($item->media->poster) }}" 
                         alt="{{ $item->media->title }}" 
                         class="entry-poster">
                    
                    <div class="entry-content">
                        <div class="entry-header">
                            <h2 class="entry-title">{{ $item->media->title }}</h2>
                            <div class="entry-actions">
                                <span class="entry-date">
                                    <i class="bi bi-calendar"></i> 
                                    {{ $item->updated_at->format('d M Y') }}
                                </span>
                                <button
                                    class="edit-diary-btn"
                                    data-id="{{ $item->id }}"
                                    title="Edit diary">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="entry-meta">
                            <span class="entry-status">
                                {{ ucfirst($item->status) }}
                            </span>
                            @if($item->rating)
                                <div class="entry-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $item->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>
                            @endif
                        </div>
                        
                        <div class="entry-notes">
                            {{ $item->notes }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4 12l-4-4 4-4V12h4v2h-4z"/>
                    </svg>
                    <p>No diary entries found</p>
                    <small class="text-muted">Write notes in status modal to see them here</small>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection