@extends('layouts.usernav')

@push('styles')
<style>
/* ==== STYLING SAMA SEPERTI KAMU ==== */
body {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    min-height: 100vh;
    color: #fff;
    font-family: 'Segoe UI', system-ui, sans-serif;
}

/* Glass Card */
.glass-card {
    background: rgba(17, 25, 40, 0.5);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 12px;
}

/* Section Title */
.section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #14b8a6;
    margin-bottom: 1.25rem;
}

/* Media Card */
.media-card {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease;
    min-width: 160px;
}
.media-card:hover {
    transform: scale(1.05);
    z-index: 2;
}
.media-card img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
}
.media-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
    padding: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
}
.media-card:hover .media-overlay {
    opacity: 1;
}
.media-overlay h6 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}
.genre-tag {
    display: inline-block;
    background: rgba(20, 184, 166);
    color: #fff;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    margin-top: 0.25rem;
}

/* Horizontal Scroll */
.horizontal-scroll {
    display: flex;
    gap: 1.25rem;
    overflow-x: auto;
    padding-bottom: 0.5rem;
    scrollbar-width: thin;
    scrollbar-color: #14b8a6 transparent;
}
.horizontal-scroll::-webkit-scrollbar {
    height: 6px;
}
.horizontal-scroll::-webkit-scrollbar-thumb {
    background: #14b8a6;
    border-radius: 3px;
}

/* Filter Group */
.filter-group {
    margin-bottom: 1.5rem;
}
.filter-label {
    font-size: 0.875rem;
    color: #cbd5e1;
    margin-bottom: 0.5rem;
    display: block;
}
.form-control,
.form-select {
    background: rgba(17, 25, 40, 0.6);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: white;
    border-radius: 8px;
    padding: 0.6rem 1rem;
}
.form-control:focus,
.form-select:focus {
    border-color: #14b8a6;
    box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.2);
}

/* Search Button */
.btn-search {
    background: rgba(20, 184, 166, 0.15);
    border: 1px solid rgba(20, 184, 166, 0.3);
    color: #14b8a6;
    border-radius: 8px;
    padding: 0.6rem 1.2rem;
    font-weight: 600;
    transition: all 0.2s;
}
.btn-search:hover {
    background: rgba(20, 184, 166, 0.25);
    border-color: #14b8a6;
}

/* Tabs */
.nav-tabs-custom .nav-link {
    color: #94a3b8;
    border: none;
    padding: 0.5rem 1rem;
    margin-right: 1rem;
    border-bottom: 2px solid transparent;
}
.nav-tabs-custom .nav-link.active {
    color: #14b8a6;
    border-bottom: 2px solid #14b8a6;
}
</style>
@endpush


@section('content')
@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row g-4">

        <!-- Sidebar Filter -->
        <div class="col-lg-3">
            <div class="glass-card p-4 mb-4">
                <h5 class="text-white mb-3">Search Filters</h5>

                <form method="GET" action="{{ route('drama.browse') }}">
                    <!-- Keyword -->
                    <div class="filter-group">
                        <label class="filter-label">Keyword</label>
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="e.g. Solo Leveling...">
                    </div>

                    <!-- Genre -->
                    <div class="filter-group">
                        <label class="filter-label">Genre</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($genres as $genre)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                        id="genre-{{ $genre->id }}"
                                        {{ in_array($genre->id, (array)request('genres')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genre-{{ $genre->id }}">
                                        {{ $genre->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Year -->
                    <div class="filter-group">
                        <label class="filter-label">Year</label>
                        <select name="year" class="form-select">
                            <option value="">Any Year</option>
                            @foreach(\App\Models\Media::where('type','drama')->distinct()->orderBy('release_year','desc')->pluck('release_year') as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-search w-100 mt-2">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <h5 class="section-title">Dramas</h5>
            <div class="horizontal-scroll mb-4">
                @forelse($dramas as $drama)
                    <div class="media-card">
                        <img src="{{ Storage::url($drama->poster) }}" alt="{{ $drama->title }}">
                        <div class="media-overlay">
                            <h6>{{ $drama->title }}</h6>
                            <div class="text-warning small">★ {{ $drama->rating ?? 'N/A' }}</div>
                            @foreach($drama->genres as $genre)
                                <span class="genre-tag">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No dramas found.</p>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $dramas->links() }}
            </div>  <!-- Pagination -->
        </div>
    </div>
</div>
@endsection
