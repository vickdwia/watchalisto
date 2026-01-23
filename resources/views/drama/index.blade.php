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
    background: #0f1419;
    color: #e5e7eb;
}

.drama-page {
    min-height: 100vh;
    padding: 32px 16px;
    background: linear-gradient(135deg, #0a0e1a 0%, #0f1419 100%);
    font-family: inherit;
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 4px;
}

.page-subtitle {
    color: #9ca3af;
    font-size: 14px;
}

/* ===== TABS ===== */
.content-tabs {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 24px;
    background: rgba(15, 23, 42, 0.6);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 4px;
    border: 1px solid rgba(255,255,255,.05);
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
    background: rgba(139,92,246,.12);
    color: #e5e7eb;
}

.tab-link.active {
    background: rgba(139,92,246,.15);
    color: #e5e7eb;
    border-bottom: 2px solid #8b5cf6;
}

/* ===== LAYOUT ===== */
.content-wrapper {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 24px;
}

/* ===== SIDEBAR ===== */
.filter-sidebar {
    background: rgba(15,23,42,.6);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.05);
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
    border-bottom: 1px solid rgba(255,255,255,.05);
}

.filter-group h3 {
    font-size: 12px;
    color: #a78bfa;
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: .1em;
    font-weight: 700;
}

.filter-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
}

.filter-option:hover {
    background: rgba(139,92,246,.1);
}

.filter-option input {
    width: 16px;
    height: 16px;
    accent-color: #8b5cf6;
}

.btn-filter {
    width: 100%;
    padding: 10px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    color: #fff;
    border-radius: 8px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
}

/* ===== DRAMA GRID ===== */
.drama-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); /* sesuaikan lebar poster */
    gap: 12px;
}

/* ===== CARD ===== */
.drama-card {
    background: #1f2937;
    border: none;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    cursor: pointer;
}

.drama-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
}

.poster {
    width: 100%; 
    height: 100%;
    object-fit: cover;
    background: #111827;
    display: block;
}

/* ===== OVERLAY INFO (on hover) ===== */
.card-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.85);
    padding: 12px;
    opacity: 0;
    transform: translateY(100%);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.drama-card:hover .card-overlay {
    opacity: 1;
    transform: translateY(0);
}

.title {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 8px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.release-year {
    font-size: 12px;
    font-weight: 400;
    color: #9ca3af;
}

.status-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 6px;
}

.status-dot.finished { background: #10b981; }
.status-dot.ongoing { background: #f59e0b; }

.progress-bar {
    height: 4px;
    background: rgba(255,255,255,.1);
    border-radius: 2px;
    margin: 6px 0;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: #8b5cf6;
    border-radius: 2px;
}

.score {
    font-size: 13px;
    color: #fde047;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
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

/* ===== MOBILE ===== */
@media (max-width: 768px) {
    .content-wrapper {
        grid-template-columns: 1fr;
    }

    .filter-sidebar {
        position: static;
        margin-bottom: 24px;
    }

    .drama-grid {
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    }
}

/* ===== DROPDOWN ===== */
.dropdown {
    position: relative;
    margin-bottom: 12px;
}

.dropbtn {
    width: 100%;
    background: rgba(30,41,59,.8);
    border: 1px solid rgba(255,255,255,.08);
    color: #e5e7eb;
    padding: 10px 12px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-align: left;
}

.dropbtn::after {
    content: "▾";
    float: right;
    opacity: .7;
}

.dropdown-content {
    display: none;
    position: absolute;
    left: 0;
    right: 0;
    margin-top: 6px;
    background: #020617;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 8px;
    padding: 8px 0;
    z-index: 20;
    max-height: 240px;
    overflow-y: auto;
}

.dropdown.open .dropdown-content {
    display: block;
}

.dropdown-content .filter-option {
    padding: 8px 12px;
    font-size: 13px;
}

.rating-dropdown {
    padding: 8px;
}

.rating-option {
    padding: 6px 12px;
    font-size: 13px;
    cursor: pointer;
    opacity: .85;
}

.rating-option:hover {
    background: rgba(255,255,255,.06);
    opacity: 1;
}

.star-rating {
    display: flex;
    gap: 6px;
    padding: 8px 12px;
    font-size: 20px;
    cursor: pointer;
}

.star-rating span {
    color: #374151;
    transition: color .15s ease;
}

.star-rating span.active {
    color: #facc15;
}

</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    const dropdowns   = document.querySelectorAll('.dropdown');
    const stars       = document.querySelectorAll('#ratingStars span');
    const ratingInput = document.getElementById('ratingInput');
    const form        = document.querySelector('.filter-sidebar form');
    const ratingOpts  = document.querySelectorAll('.rating-option');

    /* =====================
       DROPDOWN TOGGLE
    ===================== */
    if (dropdowns.length) {
        dropdowns.forEach(dropdown => {
            const btn = dropdown.querySelector('.dropbtn');
            if (!btn) return;

            btn.addEventListener('click', (e) => {
                e.stopPropagation();

                dropdowns.forEach(d => {
                    if (d !== dropdown) d.classList.remove('open');
                });

                dropdown.classList.toggle('open');
            });
        });

        document.addEventListener('click', () => {
            dropdowns.forEach(d => d.classList.remove('open'));
        });
    }

    /* =====================
       STAR RATING (FILTER)
       ala AniList
    ===================== */
    if (stars.length && ratingInput && form) {
        stars.forEach(star => {
            star.addEventListener('click', (e) => {
                e.stopPropagation();

                const value = star.dataset.value;
                ratingInput.value = value;

                // visual active stars
                stars.forEach(s => {
                    s.classList.toggle(
                        'active',
                        Number(s.dataset.value) <= Number(value)
                    );
                });

                // auto apply filter
                form.submit();
            });
        });
    }

    /* =====================
       ANY / NO RATING
    ===================== */
    if (ratingOpts.length && ratingInput && form) {
        ratingOpts.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();

                const value = option.dataset.value;
                ratingInput.value = value;

                // reset star visual
                stars.forEach(s => s.classList.remove('active'));

                form.submit();
            });
        });
    }

    const sortInput = document.getElementById('sortInput');

    document.querySelectorAll('.sort-option').forEach(option => {
        option.addEventListener('click', (e) => {
            e.stopPropagation();

            sortInput.value = option.dataset.value;
            form.submit();
        });
    });
});
</script>
@endpush



@section('content')
<div class="drama-page">
    <div class="container">

        {{-- HEADER --}}
        <div class="page-header">
            <h1>Drama List</h1>
            <p class="page-subtitle">Track and organize your watched dramas</p>
        </div>

        {{-- TABS --}}
        <div class="content-tabs">
            <a href="{{ route('media.overview') }}" class="tab-link {{ request()->routeIs('media.overview') ? 'active' : '' }}">Overview</a>
            <a href="{{ route('drama.index') }}" class="tab-link {{ request()->routeIs('drama.index') ? 'active' : '' }}">Drama List</a>
            <a href="{{ route('manhwa.index') }}" class="tab-link {{ request()->routeIs('manhwa.index') ? 'active' : '' }}">Manhwa List</a>
            <a href="{{ route('media.stats') }}" class="tab-link {{ request()->routeIs('media.stats') ? 'active' : '' }}">Stats</a>
        </div>

        <div class="content-wrapper">

            {{-- FILTER --}}
                <aside class="filter-sidebar">
                    <form method="GET" action="{{ route('drama.index') }}">
                    <input type="hidden" name="rating" id="ratingInput" value="{{ request('rating') }}">
                    <input type="hidden" name="sort" id="sortInput">
                    {{-- LISTS SECTION (Tanpa Dropdown) --}}
                        <div class="filter-section">
                            <h5 class="section-title">Lists</h5>
                            
                            <label class="filter-option">
                                <input type="radio" name="list_status" value=""
                                    {{ !request('list_status') ? 'checked' : '' }} onchange="this.form.submit()">
                                All
                            </label>

                            <label class="filter-option">
                                <input type="radio" name="list_status" value="watching"
                                    {{ request('list_status') === 'watching' ? 'checked' : '' }} onchange="this.form.submit()">
                                Watching
                            </label>

                            <label class="filter-option">
                                <input type="radio" name="list_status" value="completed"
                                    {{ request('list_status') === 'completed' ? 'checked' : '' }} onchange="this.form.submit()">
                                Completed
                            </label>

                            <label class="filter-option">
                                <input type="radio" name="list_status" value="planned"
                                    {{ request('list_status') === 'planned' ? 'checked' : '' }} onchange="this.form.submit()">
                                Planning
                            </label>
                        </div>

                        {{-- FILTERS SECTION (Semua Dropdown) --}}
                        <div class="filter-section">
                            <h5 class="section-title">Filters</h5>

                            {{-- STATUS DROPDOWN --}}
                            <div class="dropdown">
                                <button type="button" class="dropbtn">Status</button>
                                <div class="dropdown-content">
                                    <label class="filter-option">
                                        <input type="radio" name="drama_status" value="" {{ !request('drama_status') ? 'checked' : '' }} onchange="this.form.submit()">
                                        All
                                    </label>
                                    <label class="filter-option">
                                        <input type="radio" name="drama_status" value="finished" {{ request('drama_status') === 'finished' ? 'checked' : '' }} onchange="this.form.submit()">
                                        Finished
                                    </label>
                                    <label class="filter-option">
                                        <input type="radio" name="drama_status" value="ongoing" {{ request('drama_status') === 'ongoing' ? 'checked' : '' }} onchange="this.form.submit()">
                                        Ongoing
                                    </label>
                                </div>
                            </div>
                            
                            {{-- GENRES DROPDOWN --}} 
                            <div class="dropdown">
                                <button type="button" class="dropbtn">Genres</button>
                                <div class="dropdown-content">
                                    @foreach ($genres as $genre)
                                        <label class="filter-option"><input type="checkbox" name="genres[]" value="{{ $genre->id }}" {{ in_array($genre->id, request('genres', [])) ? 'checked' : '' }} onchange="this.form.submit()">{{ $genre->name }}</label>
                                    @endforeach
                                </div>
                            </div>


                            
                            {{-- RATING DROPDOWN --}}
                            <div class="dropdown">
                                <button type="button" class="dropbtn">
                                    Rating
                                </button>

                                <div class="dropdown-content rating-dropdown">
                                    <!-- ANY RATING -->
                                    <div class="rating-option js-rating-option" data-value="">
                                        Any rating
                                    </div>

                                    <!-- NO RATING -->
                                    <div class="rating-option js-rating-option" data-value="0">
                                        No rating
                                    </div>

                                    <!-- STAR RATING -->
                                    <div class="star-rating" id="ratingStars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span data-value="{{ $i }}">★</span>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            {{-- RELEASE YEAR DROPDOWN --}}
                            <div class="dropdown">
                                <button type="button" class="dropbtn">Release Year</button>

                                <div class="dropdown-content">
                                    <label class="filter-option">
                                        <input type="radio" name="year" value=""
                                            {{ !request('year') ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        All
                                    </label>

                                    @foreach ($years as $year)
                                        <label class="filter-option">
                                            <input type="radio" name="year" value="{{ $year }}"
                                                {{ request('year') == $year ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            {{ $year }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- SORT DROPDOWN --}}
                            <div class="filter-section">
                            <h5 class="section-title">Sort</h5>
                            <div class="dropdown">
                                <button type="button" class="dropbtn"></button>

                                <div class="dropdown-content">
                                    <div class="sort-option" data-value="rating">
                                        Rating (High → Low)
                                    </div>

                                    <div class="sort-option" data-value="title">
                                        Title (A–Z)
                                    </div>

                                    <div class="sort-option" data-value="newest">
                                        Newest
                                    </div>

                                    <div class="sort-option" data-value="oldest">
                                        Oldest
                                    </div>
                                </div>
                            </div>
                    </form>
                </aside>

            {{-- DRAMA LIST --}}
            <section>
                <div class="drama-grid">

                    @forelse ($dramas as $drama)
                        <div class="drama-card">
                            <img src="{{ Storage::url($drama->media->poster) }}" alt="{{ $drama->media->title }}" class="poster">

                            <div class="card-overlay">
                                <div class="title">{{ $drama->media->title }}</div>
                                <div class="release-year">{{ $drama->media->release_year ?? '—' }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4 12l-4-4 4-4V12h4v2h-4z"/>
                            </svg>
                            <p>No drama found</p>
                        </div>
                    @endforelse

                </div>
            </section>

        </div>
    </div>
</div>
@endsection