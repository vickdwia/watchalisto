<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Watchalisto</title>
  <link rel="icon" href="{{ asset('images/logoup.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<style>
  /* ===== GLOBAL ===== */
  body {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    min-height: 100vh;
    color: #fff;
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    padding-top: 72px;
  }

  /* ===== HEADER - GLASS ===== */
  header {
    background: rgba(17, 25, 40, 0.65);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
  }

  .logo-img {
    height: 40px;
    transition: transform 0.25s ease;
  }

  .logo-img:hover {
    transform: scale(1.05);
  }

  @media (min-width: 768px) {
    .logo-img {
      height: 50px;
    }
  }

  /* ===== BUTTONS ===== */
  .btn-teal {
    background: linear-gradient(135deg, #14b8a6, #0d9488);
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 10px;
    padding: 0.65rem 1.5rem;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
  }

  .btn-teal:hover {
    background: linear-gradient(135deg, #0d9488, #0a7d72);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(20, 184, 166, 0.45);
  }

  .btn-outline-teal {
    border: 1.5px solid #14b8a6;
    color: #14b8a6;
    background: transparent;
    font-weight: 600;
    border-radius: 10px;
    padding: 0.6rem 1.4rem;
    transition: all 0.3s ease;
  }

  .btn-outline-teal:hover {
    background: rgba(20, 184, 166, 0.12);
    border-color: #14b8a6;
    color: white;
    transform: translateY(-1px);
  }

  /* ===== HERO SECTION ===== */
  .hero-section {
    position: relative;
    text-align: center;
    overflow: hidden;
    margin-top: -72px;
    padding-top: 120px;
  }

  .hero-bg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.55) contrast(1.1);
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(0deg, rgba(0, 0, 0, 0.92) 0%, rgba(13, 148, 136, 0.15) 100%);
  }

  .hero-content {
    position: relative;
    z-index: 10;
    padding: 6rem 1.5rem;
  }

  @media (min-width: 768px) {
    .hero-content {
      padding: 10rem 1.5rem;
    }
  }

  .hero-content h1 {
    background: linear-gradient(90deg, #fff, #14b8a6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 0 5px 25px rgba(0, 0, 0, 0.4);
    line-height: 1.2;
  }

  /* ===== ABOUT SECTION ===== */
  .about-section {
    background: rgba(17, 25, 40, 0.45);
    backdrop-filter: blur(10px);
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    position: relative;
    overflow: hidden;
  }

  .about-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at top right, rgba(20, 184, 166, 0.05), transparent 40%);
    pointer-events: none;
  }

  /* ===== FITUR CARDS - GLASS ===== */
  .fitur {
    background: rgba(17, 25, 40, 0.55);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 16px;
    transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    position: relative;
    overflow: hidden;
    padding: 2rem !important;
  }

  .fitur::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(20, 184, 166, 0.03), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 0;
  }

  .fitur:hover {
    transform: translateY(-8px);
    border-color: rgba(20, 184, 166, 0.35);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 0 0 30px rgba(20, 184, 166, 0.25);
  }

  .fitur:hover::before {
    opacity: 1;
  }

  .fitur h3 {
    color: #14b8a6;
    margin-bottom: 15px;
    font-weight: 700;
    font-size: 1.35rem;
    position: relative;
    z-index: 1;
  }

  .fitur p {
    color: rgba(255, 255, 255, 0.82);
    line-height: 1.7;
    position: relative;
    z-index: 1;
    margin-bottom: 0;
  }

  /* ===== MEDIA CARD - DASHBOARD STYLE WITH OVERLAY ===== */
  .media-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    text-decoration: none;
    display: block;
    background: rgba(31, 41, 55, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.06);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
  }

  .media-card img {
    width: 100%;
    height: 280px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
  }

  .media-card:hover img {
    transform: scale(1.1);
  }

  /* ===== OVERLAY - SAMA PERSIS DENGAN DASHBOARD ===== */
  .media-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.95), transparent 60%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 1.25rem;
    opacity: 0;
    transition: opacity 0.35s ease;
    color: white;
    z-index: 2;
  }

  .media-card:hover .media-overlay {
    opacity: 1;
  }

  .media-overlay h6 {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0.35rem;
    color: white;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
  }

  .media-overlay .rating {
    font-size: 0.85rem;
    font-weight: 600;
    color: #fbbf24;
    margin-bottom: 0.4rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
  }

  .media-overlay .rating i {
    font-size: 0.9rem;
  }

  .genre-tags-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 0.3rem;
    margin-top: 0.25rem;
  }

  .genre-tag {
    display: inline-block;
    background: rgba(20, 184, 166, 0.85);
    color: #fff;
    padding: 0.2rem 0.55rem;
    border-radius: 4px;
    font-size: 0.7rem;
    font-weight: 600;
    white-space: nowrap;
    letter-spacing: 0.3px;
  }

  /* ===== SECTION TITLES ===== */
  .display-5,
  .display-6 {
    font-weight: 800 !important;
  }

  .text-teal {
    color: #14b8a6 !important;
  }

  .display-6.text-teal {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.75rem !important;
  }

  .display-6.text-teal i {
    font-size: 1.9rem;
  }

  /* ===== FOOTER ===== */
  .footer {
    background: rgba(15, 23, 42, 0.92);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: white;
    margin-top: 4rem;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    padding-top: 2.5rem;
    padding-bottom: 2.5rem;
  }

  /* ===== TYPOGRAPHY ===== */
  h1, h2, h3, h4, h5, h6 {
    font-weight: 700;
  }

  .text-secondary {
    color: rgba(255, 255, 255, 0.75) !important;
  }

  .fst-italic {
    color: #14b8a6;
    font-style: italic;
    font-size: 1.15rem;
  }

  /* ===== RESPONSIVE ===== */
  @media (max-width: 767px) {
    body {
      padding-top: 64px;
    }
    
    .hero-section {
      padding-top: 100px;
      margin-top: -64px;
    }
    
    .hero-content {
      padding: 4rem 1rem;
    }
    
    .hero-content h1 {
      font-size: 2.2rem;
    }
    
    .fitur {
      padding: 1.5rem !important;
    }
    
    .media-card img {
      height: 240px;
    }
    
    .display-6.text-teal {
      font-size: 1.5rem !important;
    }
    
    .media-overlay h6 {
      font-size: 0.85rem;
    }
    
    .genre-tag {
      font-size: 0.65rem;
      padding: 0.15rem 0.45rem;
    }
  }

  @media (min-width: 992px) {
    .col-lg-2 {
      flex: 0 0 auto;
      width: 16.66666667%;
    }
  }
</style>

<body>

  <!-- Header -->
  <header class="d-flex fixed-top justify-content-between align-items-center px-4 py-3">
    <div class="d-flex align-items-center">
      <a href="{{ route('home') }}">
      <img src="{{ asset('images/WatchaListo.png') }}" alt="Watchalisto Logo" class="logo-img me-2">
      </a>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('login') }}" class="btn btn-sm btn-teal">
        Login
      </a>
      <a href="{{ route('register') }}" class="btn btn-sm btn-outline-teal">
        Register
      </a>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero-section">
    <img src="{{ asset('images/bghero.png') }}" alt=" drama dan manhwa" class="hero-bg">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="display-3 fw-bold mb-4">Kelola Drama & Manhwa Favoritmu dalam Satu Tempat</h1>
      <p class="fs-5 text-secondary mx-auto mb-4" style="max-width: 36rem;">
        Watchalisto membantu kamu mencatat, mengelola, dan merefleksikan perjalanan menonton drama dan membaca manhwa secara terorganisir dan personal.
      </p>
      <a href="{{ route('register') }}" class="btn btn-lg btn-teal">
        Mulai Sekarang
      </a>
    </div>
  </section>

  <!-- About -->
  <section class="about-section py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-4 display-5">Tentang Watchalisto</h2>
      <p class="text-secondary mx-auto" style="max-width: 700px;">
        Watchalisto adalah platform pencatatan media yang memungkinkan pengguna untuk mengelola daftar drama dan manhwa, mencatat status, rating, serta catatan pribadi, dan melihat ringkasan aktivitas media mereka dalam satu sistem terintegrasi.
      </p>
      <p class="fst-italic text-light mt-4">
        Watchalisto — karena setiap drama dan manhwa menyimpan cerita, dan setiap pengguna punya kisahnya sendiri.
      </p>
    </div>
  </section>

  <!-- Fitur -->
  <section class="py-5" id="fitur">
    <div class="container">
      <h2 class="text-center fw-bold mb-5 display-5">Fitur</h2>
      <div class="row g-4">
        <div class="col-sm-6 col-lg-4">
          <div class="fitur p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">Kelola List Drama & Manhwa</h3>
            <p class="text-secondary small">Tandai media sebagai ingin diikuti, sedang diikuti, atau sudah selesai.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="fitur p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">Diary & Rating Pribadi</h3>
            <p class="text-secondary small">Simpan kesan, catatan, dan penilaian untuk setiap media.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="fitur p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">Pencarian & Detail Media</h3>
            <p class="text-secondary small">Cari drama dan manhwa lalu lihat informasi detailnya.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="fitur p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">Statistik Aktivitas Media</h3>
            <p class="text-secondary small">Lihat ringkasan aktivitas menonton dan membaca secara personal.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Trending Dramas -->
  <section class="py-5">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold display-6 text-teal">
          <i class="bi bi-fire"></i> Trending Dramas
        </h2>
      </div>

      <div class="row g-4 justify-content-center">
        @foreach($trendingDramas as $drama)
          <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ route('login') }}" class="media-card">
              <img src="{{ Storage::url($drama->poster) }}" alt="{{ $drama->title }}">
              <div class="media-overlay">
                <h6>{{ $drama->title }}</h6>
                <div class="rating">
                  <i class="bi bi-star-fill"></i>
                  {{ $drama->user_media_lists_avg_rating ? number_format($drama->user_media_lists_avg_rating, 1) : 'N/A' }}
                </div>
                <div class="genre-tags-wrapper">
                  @foreach($drama->genres->take(2) as $genre)
                    <span class="genre-tag">{{ $genre->name }}</span>
                  @endforeach
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Trending Manhwa -->
  <section class="py-5">
    <div class="container-fluid">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold display-6 text-teal">
          <i class="bi bi-fire"></i> Trending Manhwa
        </h2>
      </div>

      <div class="row g-4 justify-content-center">
        @forelse($trendingManhwas as $manhwa)
          <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ route('login') }}" class="media-card">
              <img src="{{ Storage::url($manhwa->poster) }}" alt="{{ $manhwa->title }}">
              <div class="media-overlay">
                <h6>{{ $manhwa->title }}</h6>
                <div class="rating">
                  <i class="bi bi-star-fill"></i>
                  {{ $manhwa->user_media_lists_avg_rating ? number_format($manhwa->user_media_lists_avg_rating, 1) : 'N/A' }}
                </div>
                <div class="genre-tags-wrapper">
                  @foreach($manhwa->genres->take(2) as $genre)
                    <span class="genre-tag">{{ $genre->name }}</span>
                  @endforeach
                </div>
              </div>
            </a>
          </div>
        @empty
          <div class="col-12">
            <p class="text-center text-secondary py-4">
              <i class="bi bi-inbox fs-1 d-block mb-2"></i>
              Belum ada manhwa trending.
            </p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer py-5">
      <div class="container">
          <p class="text-center text-secondary small mb-0">
              © {{ date('Y') }} Watchalisto
          </p>
      </div>
  </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>