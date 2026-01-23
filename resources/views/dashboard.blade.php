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
    background: linear-gradient(to top, rgba(0,0,0,.9), transparent);
    padding: 1rem;
    opacity: 0;
    transition: .3s;
}
.media-card:hover .media-overlay { opacity: 1; }

/* Horizontal Scroll */
.horizontal-scroll {
    display: flex;
    gap: 1rem;
    overflow-x: auto;
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
<div class="container-fluid px-4 py-4">
    <div class="row g-4">
        
        <!-- Left Sidebar - User Overview -->
        <div class="col-lg-3">
            <div class="glass-card p-4 mb-4">
                <div class="text-center mb-3">
                    <img src="https://via.placeholder.com/80" alt="Avatar" class="user-avatar mb-3">
                    <h5 class="text-white mb-1">{{ auth()->user()->name }}</h5>
                    <p class="text-muted small mb-0">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="glass-card p-4 mb-4">
                <h6 class="text-white mb-3 fw-bold">Overview</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Total Watched</span>
                        <span class="text-white fw-bold">127</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 75%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Episodes</span>
                        <span class="text-white fw-bold">2,431</span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Days Watched</span>
                        <span class="text-white fw-bold">64.2</span>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Mean Score</span>
                        <span class="text-white fw-bold">7.8</span>
                    </div>
                </div>
            </div>

            <!-- Top Genres -->
            <div class="glass-card p-4">
                <h6 class="text-white mb-3 fw-bold">Top Genres</h6>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-white small">Action</span>
                        <span class="badge-custom">42</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 85%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-white small">Romance</span>
                        <span class="badge-custom">38</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 70%"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-white small">Drama</span>
                        <span class="badge-custom">35</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 65%"></div>
                    </div>
                </div>
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-white small">Comedy</span>
                        <span class="badge-custom">28</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 50%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            
            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <i class="bi bi-film fs-2 text-info mb-2"></i>
                        <div class="stat-number">127</div>
                        <div class="text-muted small">Total Watched</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <i class="bi bi-play-circle fs-2 text-success mb-2"></i>
                        <div class="stat-number">23</div>
                        <div class="text-muted small">Watching</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <i class="bi bi-bookmark-star fs-2 text-warning mb-2"></i>
                        <div class="stat-number">45</div>
                        <div class="text-muted small">Plan to Watch</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card text-center">
                        <i class="bi bi-clock-history fs-2 text-danger mb-2"></i>
                        <div class="stat-number">64.2</div>
                        <div class="text-muted small">Days Watched</div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="glass-card p-4 mb-4">
                <h5 class="section-title">
                    <i class="bi bi-activity"></i> Recent Activity
                </h5>
                
                <div class="activity-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-white fw-semibold">Watched episode 12 of</span>
                            <span class="text-info"> The Glory Season 2</span>
                            <div class="text-muted small mt-1">
                                <i class="bi bi-clock"></i> 2 hours ago
                            </div>
                        </div>
                        <span class="badge-custom">Drama</span>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-white fw-semibold">Completed</span>
                            <span class="text-success"> Solo Leveling</span>
                            <span class="text-white"> and rated it </span>
                            <span class="text-warning">★ 9.5</span>
                            <div class="text-muted small mt-1">
                                <i class="bi bi-clock"></i> 5 hours ago
                            </div>
                        </div>
                        <span class="badge-custom">Manhwa</span>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-white fw-semibold">Added to planning</span>
                            <span class="text-info"> True Beauty</span>
                            <div class="text-muted small mt-1">
                                <i class="bi bi-clock"></i> 1 day ago
                            </div>
                        </div>
                        <span class="badge-custom">Drama</span>
                    </div>
                </div>
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs nav-tabs-custom mb-4" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#dramas">Dramas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#manhwa">Manhwa</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                
                <!-- Dramas Tab -->
                <div class="tab-pane fade show active" id="dramas">
                    
                    <!-- Trending Dramas -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-fire"></i> Trending Dramas
                        </h5>
                        <div class="horizontal-scroll">
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/14b8a6/ffffff?text=Queen+of+Tears" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Queen of Tears</h6>
                                    <div class="text-warning small">★ 9.2</div>
                                    <span class="genre-tag">Romance</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/3b82f6/ffffff?text=The+Glory" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">The Glory</h6>
                                    <div class="text-warning small">★ 9.0</div>
                                    <span class="genre-tag">Thriller</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/8b5cf6/ffffff?text=My+Demon" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">My Demon</h6>
                                    <div class="text-warning small">★ 8.8</div>
                                    <span class="genre-tag">Fantasy</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/ec4899/ffffff?text=Lovely+Runner" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Lovely Runner</h6>
                                    <div class="text-warning small">★ 9.3</div>
                                    <span class="genre-tag">Romance</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/f59e0b/ffffff?text=A+Shop+for+Killers" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">A Shop for Killers</h6>
                                    <div class="text-warning small">★ 8.6</div>
                                    <span class="genre-tag">Action</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Most Popular Dramas -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-heart-fill"></i> Most Popular
                        </h5>
                        <div class="horizontal-scroll">
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/ef4444/ffffff?text=Goblin" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Goblin</h6>
                                    <div class="text-warning small">★ 9.4</div>
                                    <span class="genre-tag">Fantasy</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/10b981/ffffff?text=Crash+Landing+on+You" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Crash Landing on You</h6>
                                    <div class="text-warning small">★ 9.5</div>
                                    <span class="genre-tag">Romance</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/6366f1/ffffff?text=Itaewon+Class" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Itaewon Class</h6>
                                    <div class="text-warning small">★ 8.9</div>
                                    <span class="genre-tag">Drama</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/14b8a6/ffffff?text=Hotel+Del+Luna" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Hotel Del Luna</h6>
                                    <div class="text-warning small">★ 9.1</div>
                                    <span class="genre-tag">Fantasy</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/f97316/ffffff?text=Mr.+Sunshine" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Mr. Sunshine</h6>
                                    <div class="text-warning small">★ 9.2</div>
                                    <span class="genre-tag">Historical</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Dramas -->
                    <div>
                        <h5 class="section-title">
                            <i class="bi bi-stars"></i> New Releases
                        </h5>
                        <div class="horizontal-scroll">
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/06b6d4/ffffff?text=Marry+My+Husband" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Marry My Husband</h6>
                                    <div class="text-warning small">★ 8.7</div>
                                    <span class="genre-tag">Drama</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/a855f7/ffffff?text=Doctor+Slump" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Doctor Slump</h6>
                                    <div class="text-warning small">★ 8.5</div>
                                    <span class="genre-tag">Romance</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/84cc16/ffffff?text=Welcome+to+Samdalri" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Welcome to Samdalri</h6>
                                    <div class="text-warning small">★ 8.4</div>
                                    <span class="genre-tag">Romance</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/f43f5e/ffffff?text=Perfect+Marriage+Revenge" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Perfect Marriage Revenge</h6>
                                    <div class="text-warning small">★ 8.3</div>
                                    <span class="genre-tag">Drama</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/0ea5e9/ffffff?text=Knight+Flower" alt="Drama">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Knight Flower</h6>
                                    <div class="text-warning small">★ 8.6</div>
                                    <span class="genre-tag">Historical</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manhwa Tab -->
                <div class="tab-pane fade" id="manhwa">
                    
                    <!-- Trending Manhwa -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-fire"></i> Trending Manhwa
                        </h5>
                        <div class="horizontal-scroll">
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/14b8a6/ffffff?text=Solo+Leveling" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Solo Leveling</h6>
                                    <div class="text-warning small">★ 9.8</div>
                                    <span class="genre-tag">Action</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/3b82f6/ffffff?text=ORV" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Omniscient Reader</h6>
                                    <div class="text-warning small">★ 9.7</div>
                                    <span class="genre-tag">Fantasy</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/8b5cf6/ffffff?text=TBATE" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">The Beginning After The End</h6>
                                    <div class="text-warning small">★ 9.6</div>
                                    <span class="genre-tag">Fantasy</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/ec4899/ffffff?text=True+Beauty" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">True Beauty</h6>
                                    <div class="text-warning small">★ 9.2</div>
                                    <span class="genre-tag">Romance</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/f59e0b/ffffff?text=Eleceed" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Eleceed</h6>
                                    <div class="text-warning small">★ 9.5</div>
                                    <span class="genre-tag">Action</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Most Popular Manhwa -->
                    <div class="mb-4">
                        <h5 class="section-title">
                            <i class="bi bi-heart-fill"></i> Most Popular
                        </h5>
                        <div class="horizontal-scroll">
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/ef4444/ffffff?text=Tower+of+God" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Tower of God</h6>
                                    <div class="text-warning small">★ 9.4</div>
                                    <span class="genre-tag">Adventure</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/10b981/ffffff?text=Lookism" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Lookism</h6>
                                    <div class="text-warning small">★ 9.3</div>
                                    <span class="genre-tag">Action</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/6366f1/ffffff?text=Noblesse" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Noblesse</h6>
                                    <div class="text-warning small">★ 9.1</div>
                                    <span class="genre-tag">Supernatural</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/14b8a6/ffffff?text=Windbreaker" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Wind Breaker</h6>
                                    <div class="text-warning small">★ 9.0</div>
                                    <span class="genre-tag">Action</span>
                                </div>
                            </div>
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/f97316/ffffff?text=Cheese+in+the+Trap" alt="Manhwa">
                                                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Cheese in the Trap</h6>
                                    <div class="text-warning small">★ 8.9</div>
                                    <span class="genre-tag">Romance</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Manhwa -->
                    <div>
                        <h5 class="section-title">
                            <i class="bi bi-stars"></i> New Releases
                        </h5>
                        <div class="horizontal-scroll">
                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/06b6d4/ffffff?text=SSS+Class+Revival" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">SSS-Class Revival Hunter</h6>
                                    <div class="text-warning small">★ 9.4</div>
                                    <span class="genre-tag">Action</span>
                                </div>
                            </div>

                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/a855f7/ffffff?text=Mercenary+Enrollment" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Mercenary Enrollment</h6>
                                    <div class="text-warning small">★ 9.3</div>
                                    <span class="genre-tag">Action</span>
                                </div>
                            </div>

                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/84cc16/ffffff?text=Villain+to+Kill" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Villain to Kill</h6>
                                    <div class="text-warning small">★ 9.1</div>
                                    <span class="genre-tag">Fantasy</span>
                                </div>
                            </div>

                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placeholder.com/180x280/f43f5e/ffffff?text=Nano+Machine" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Nano Machine</h6>
                                    <div class="text-warning small">★ 9.6</div>
                                    <span class="genre-tag">Martial Arts</span>
                                </div>
                            </div>

                            <div class="media-card" style="min-width: 180px;">
                                <img src="https://via.placehold.co/180x280/0ea5e9/ffffff?text=Return+of+Mount+Hua" alt="Manhwa">
                                <div class="media-overlay">
                                    <h6 class="text-white mb-1">Return of the Mount Hua Sect</h6>
                                    <div class="text-warning small">★ 9.7</div>
                                    <span class="genre-tag">Martial Arts</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end manhwa tab -->
            </div> <!-- end tab-content -->
        </div> <!-- end main content -->
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection