@extends('layouts.usernav')

@push('styles')
<style>
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
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;
}

/* Stat Card */
.stat-card {
    background: linear-gradient(135deg, rgba(20,184,166,0.1), rgba(59,130,246,0.1));
    border: 1px solid rgba(20,184,166,0.2);
    border-radius: 12px;
    padding: 1.5rem;
}

/* Media Card */
.media-card {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    transition: 0.3s;
}
.media-card:hover { transform: scale(1.05); }

.media-card img {
    width: 100%;
    height: 280px;
    object-fit: cover;
}

.media-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.9), transparent);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
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

.genre-tags-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    margin-top: 0.25rem;
}

.genre-tag {
    display: inline-block;
    background: rgba(20, 184, 166);
    color: #fff;
    padding: 0.2rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    white-space: nowrap;
}

/* Horizontal Scroll */
.horizontal-scroll {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
    padding-bottom: 0.5rem;
    scrollbar-width: none; /* Firefox */
}

/* Chrome, Edge, Safari */
.horizontal-scroll::-webkit-scrollbar {
    display: none;
}

/* Optional: Efek fade-out di ujung kanan (biar lebih smooth) */
.horizontal-scroll::after {
    content: '';
    position: absolute;
    right: 0;
    top: 0;
    width: 50px;
    height: 100%;
    background: linear-gradient(to right, rgba(17,25,40,0) 0%, rgba(17,25,40,0.8) 100%);
    pointer-events: none;
    z-index: 1;
}

/* Style tombol "Show All" */
.btn-outline-info {
    border-color: #14b8a6;
    color: #14b8a6;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-outline-info:hover {
    background: rgba(20, 184, 166, 0.15);
    border-color: #14b8a6;
    color: #14b8a6;
}

.btn-outline-info i {
    font-size: 0.9rem;
}

/* Section Title */
.section-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #14b8a6;
}

/* Activity */
.activity-item {
    background: rgba(17,25,40,.4);
    border-left: 3px solid #14b8a6;
    padding: 1rem;
    border-radius: 6px;
}

/* Tabs */
.nav-tabs-custom .nav-link.active {
    color: #14b8a6;
    border-bottom: 2px solid #14b8a6;
}
</style>
@endpush

@section('content')
<div class="container-fluid px-4 py-2">
    <div class="row g-4">
        
                <!-- Left Sidebar - User Overview -->
                <div class="col-lg-3">
                    <div class="glass-card p-4 mb-4">
                        <div class="text-center mb-3">
                            <!-- <img src="https://via.placeholder.com/80 " alt="Avatar" class="user-avatar mb-3"> -->
                             <i class="bi bi-person fs-2 mb-2"></i>
                            <h5 class="text-white mb-1">{{ auth()->user()->name }}</h5>
                            <p class="text-muted small mb-0">
                                Member since {{ auth()->user()->created_at->format('M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

            <!-- Stats Cards -->
                <div class="col-lg-9 d-flex align-items-start">
                    <div class="row g-3 w-100">

                        {{-- Drama Completed --}}
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="bi bi-film fs-2 text-info mb-2"></i>
                                <div class="stat-number">{{ $dramaCompleted }}</div>
                                <div class="text-muted small">Drama Completed</div>
                            </div>
                        </div>

                        {{-- Drama Watching --}}
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="bi bi-play-circle fs-2 text-success mb-2"></i>
                                <div class="stat-number">{{ $dramaWatching }}</div>
                                <div class="text-muted small">Drama Watching</div>
                            </div>
                        </div>

                        {{-- Manhwa Completed --}}
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="bi bi-book fs-2 text-warning mb-2"></i>
                                <div class="stat-number">{{ $manhwaCompleted }}</div>
                                <div class="text-muted small">Manhwa Completed</div>
                            </div>
                        </div>

                        {{-- Manhwa Reading --}}
                        <div class="col-md-3">
                            <div class="stat-card text-center">
                                <i class="bi bi-journal-text fs-2 text-danger mb-2"></i>
                                <div class="stat-number">{{ $manhwaReading }}</div>
                                <div class="text-muted small">Manhwa Reading</div>
                            </div>
                        </div>

                    </div>
                </div>


            <!-- Recent Activity -->
                <div class="glass-card p-4 mb-4">
                    <h5 class="section-title">
                        <i class="bi bi-activity"></i> Recent Activity
                    </h5>

                    @forelse($recentActivities as $activity)
                        <div class="activity-item mb-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    {{-- STATUS LOGIC --}}
                                    @if($activity->status === 'completed')
                                        <span class="text-white fw-semibold">Completed</span>
                                        <span class="text-info"> {{ $activity->media->title }}</span>

                                        @if($activity->rating)
                                            <span class="text-white"> and rated it </span>
                                            <span class="text-warning">★ {{ number_format($activity->rating, 1) }}</span>
                                        @endif

                                    @elseif($activity->status === 'watching')
                                        <span class="text-white fw-semibold">
                                            Watching episode {{ $activity->progress }}
                                        </span>
                                        <span class="text-info"> of {{ $activity->media->title }}</span>
                                    
                                    @elseif($activity->status === 'reading')
                                        <span class="text-white fw-semibold">
                                            Reading chapter {{ $activity->progress }}
                                        </span>
                                        <span class="text-info"> of {{ $activity->media->title }}</span>

                                    @elseif($activity->status === 'planned')
                                        <span class="text-white fw-semibold">Added to planning</span>
                                        <span class="text-info"> {{ $activity->media->title }}</span>
                                    @endif

                                    {{-- TIME --}}
                                    <div class="text-muted small mt-1">
                                        <i class="bi bi-clock"></i>
                                        {{ $activity->updated_at->diffForHumans() }}
                                    </div>
                                </div>

                                {{-- TYPE --}}
                                <span class="badge-custom">
                                    {{ ucfirst($activity->media->type) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">No recent activity yet.</p>
                    @endforelse
                </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs nav-tabs-custom mb-4 px-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#dramas">Dramas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#manhwa">Manhwa</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content px-4">
                
                <!-- Dramas Tab -->     
                <div class="tab-pane fade show active" id="dramas">
                    
                    <!-- Trending Dramas -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="section-title mb-0">
                            <i class="bi bi-fire"></i> Trending Dramas
                        </h5>
                        <a href="{{ route('browse.index', ['type' => 'drama', 'sort' => 'trending']) }}"
                            class="btn btn-outline-info btn-sm d-flex align-items-center gap-1 px-3 py-1 rounded-pill">
                            <i class="bi bi-arrow-right"></i> Show All
                        </a>
                    </div>
                    <div class="horizontal-scroll">
                        @foreach($trendingDramas as $drama)
                            <a href="{{ route('media.show', $drama->id) }}" class="media-card" style="min-width: 180px;">
                                <img src="{{ Storage::url($drama->poster) }}" alt="{{ $drama->title }}">
                                <div class="media-overlay">
                                    <h6>{{ $drama->title }}</h6>
                                    <div class="text-warning small">
                                        ★ {{ $drama->user_media_lists_avg_rating ? number_format($drama->user_media_lists_avg_rating, 1) : 'N/A' }}
                                    </div>
                                    <div class="genre-tags-wrapper">
                                        @foreach($drama->genres as $genre)
                                            <span class="genre-tag">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Most Popular Dramas -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="section-title mb-0">
                            <i class="bi bi-heart-fill"></i> Most Watched
                        </h5>
                        <a href="{{ route('browse.index', ['type' => 'drama', 'sort' => 'popular']) }}"
                            class="btn btn-outline-info btn-sm d-flex align-items-center gap-1 px-3 py-1 rounded-pill">
                            <i class="bi bi-arrow-right"></i> Show All
                        </a>
                    </div>
                    <div class="horizontal-scroll">
                        @foreach($popularDramas as $drama)
                            <a href="{{ route('media.show', $drama->id) }}" class="media-card" style="min-width: 180px;">
                                <img src="{{ Storage::url($drama->poster) }}" alt="{{ $drama->title }}">
                                <div class="media-overlay">
                                    <h6>{{ $drama->title }}</h6>
                                    <div class="text-warning small">
                                        ★ {{ $drama->user_media_lists_avg_rating ? number_format($drama->user_media_lists_avg_rating, 1) : 'N/A' }}
                                    </div>
                                    <div class="genre-tags-wrapper">
                                        @foreach($drama->genres as $genre)
                                            <span class="genre-tag">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- New Releases -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="section-title mb-0">
                                <i class="bi bi-stars"></i> New Releases
                            </h5>
                            <a href="{{ route('browse.index', ['type' => 'drama', 'sort' => 'newest']) }}"
                                class="btn btn-outline-info btn-sm d-flex align-items-center gap-1 px-3 py-1 rounded-pill">
                                <i class="bi bi-arrow-right"></i> Show All
                            </a>
                        </div>
                        <div class="horizontal-scroll mb-2"> <!-- kurangi margin bawah -->
                            @foreach($newDramas as $drama)
                                <a href="{{ route('media.show', $drama->id) }}" class="media-card" style="min-width: 180px;">
                                    <img src="{{ Storage::url($drama->poster) }}" alt="{{ $drama->title }}">
                                    <div class="media-overlay">
                                        <h6>{{ $drama->title }}</h6>
                                        <div class="text-warning small">
                                            ★ {{ $drama->user_media_lists_avg_rating ? number_format($drama->user_media_lists_avg_rating, 1) : 'N/A' }}
                                        </div>
                                        <div class="genre-tags-wrapper">
                                            @foreach($drama->genres as $genre)
                                                <span class="genre-tag">{{ $genre->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                <!-- Manhwa Tab -->
                <div class="tab-pane fade" id="manhwa">

                    <!-- Trending Manhwa -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="section-title mb-0">
                            <i class="bi bi-fire"></i> Trending Manhwa
                        </h5>
                        <a href="{{ route('browse.index', ['type' => 'manhwa', 'sort' => 'trending']) }}"
                            class="btn btn-outline-info btn-sm d-flex align-items-center gap-1 px-3 py-1 rounded-pill">
                            <i class="bi bi-arrow-right"></i> Show All
                        </a>
                    </div>
                    <div class="horizontal-scroll mb-4">
                        @foreach($trendingManhwas as $manhwa)
                            <a href="{{ route('media.show', $manhwa->id) }}" class="media-card" style="min-width: 180px;">
                                <img src="{{ Storage::url($manhwa->poster) }}" alt="{{ $manhwa->title }}">
                                <div class="media-overlay">
                                    <h6>{{ $manhwa->title }}</h6>
                                    <div class="text-warning small">
                                        ★ {{ $manhwa->user_media_lists_avg_rating ? number_format($manhwa->user_media_lists_avg_rating, 1) : 'N/A' }}
                                    </div>
                                    <div class="genre-tags-wrapper">
                                        @foreach($manhwa->genres as $genre)
                                            <span class="genre-tag">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Most Popular Manhwa -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="section-title mb-0">
                            <i class="bi bi-heart-fill"></i> Most Popular
                        </h5>
                        <a href="{{ route('browse.index', ['type' => 'manhwa', 'sort' => 'popular']) }}"
                            class="btn btn-outline-info btn-sm d-flex align-items-center gap-1 px-3 py-1 rounded-pill">
                            <i class="bi bi-arrow-right"></i> Show All
                        </a>
                    </div>
                    <div class="horizontal-scroll mb-4">
                        @foreach($popularManhwas as $manhwa)
                            <a href="{{ route('media.show', $manhwa->id) }}" class="media-card" style="min-width: 180px;">
                                <img src="{{ Storage::url($manhwa->poster) }}" alt="{{ $manhwa->title }}">
                                <div class="media-overlay">
                                    <h6>{{ $manhwa->title }}</h6>
                                    <div class="text-warning small">
                                        ★ {{ $manhwa->user_media_lists_avg_rating ? number_format($manhwa->user_media_lists_avg_rating, 1) : 'N/A' }}
                                    </div>
                                    <div class="genre-tags-wrapper">
                                        @foreach($manhwa->genres as $genre)
                                            <span class="genre-tag">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- New Releases -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="section-title mb-0">
                            <i class="bi bi-stars"></i> New Releases
                        </h5>
                        <a href="{{ route('browse.index', ['type' => 'manhwa', 'sort' => 'newest']) }}"
                            class="btn btn-outline-info btn-sm d-flex align-items-center gap-1 px-3 py-1 rounded-pill">
                            <i class="bi bi-arrow-right"></i> Show All
                        </a>
                    </div>
                    <div class="horizontal-scroll mb-4">
                        @foreach($newManhwas as $manhwa)
                            <a href="{{ route('media.show', $manhwa->id) }}" class="media-card" style="min-width: 180px;">
                                <img src="{{ Storage::url($manhwa->poster) }}" alt="{{ $manhwa->title }}">
                                <div class="media-overlay">
                                    <h6>{{ $manhwa->title }}</h6>
                                    <div class="text-warning small">
                                        ★ {{ $manhwa->user_media_lists_avg_rating ? number_format($manhwa->user_media_lists_avg_rating, 1) : 'N/A' }}
                                    </div>
                                    <div class="genre-tags-wrapper">
                                        @foreach($manhwa->genres as $genre)
                                            <span class="genre-tag">{{ $genre->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div> <!-- end manhwa tab -->
            </div> <!-- end tab-content -->
        </div> <!-- end main content -->
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection