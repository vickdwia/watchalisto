<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Watchalisto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>

  <!-- Header -->
  <header class="d-flex justify-content-between align-items-center px-4 py-3">
    <div class="d-flex align-items-center">
      <img src="{{ asset('images/logoup.png') }}" alt="Watchalisto Logo" class="logo-img me-2">
      <span class="fs-2 fw-bold">Watchalisto</span>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('login') }}" class="btn btn-sm btn-teal">
        Login
      </a>
      <a href="{{ route('register') }}" class="btn btn-sm btn-outline-teal">
        Sign Up
      </a>
    </div>
  </header>

  <!-- Hero -->
  <section class="hero-section">
    <img src="{{ asset('images/bghero.jpg') }}" alt="Menonton film" class="hero-bg">
    <div class="hero-overlay"></div>
    <div class="hero-content">
      <h1 class="display-3 fw-bold mb-4">Kelola Tontonanmu, Abadikan Kesan</h1>
      <p class="fs-5 text-secondary mx-auto mb-4" style="max-width: 36rem;">
        Simpan daftar film, beri rating, ulasan, dan buat pengalaman menontonmu jadi lebih bermakna.
      </p>
      <a href="{{ route('register') }}" class="btn btn-lg btn-teal">
        Mulai Sekarang
      </a>
    </div>
  </section>

  <!-- Fitur -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center fw-bold mb-5 display-5">Fitur Utama</h2>
      <div class="row g-4">
        <div class="col-sm-6 col-lg-4">
          <div class="feature-card p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">📋 Daftar Tontonan</h3>
            <p class="text-secondary small">Kelola film yang ingin ditonton, sedang ditonton, atau sudah ditonton.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="feature-card p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">⭐ Rating & Ulasan</h3>
            <p class="text-secondary small">Beri penilaian dan ulasan singkat untuk setiap film favoritmu.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="feature-card p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">💬 Kutipan Favorit</h3>
            <p class="text-secondary small">Simpan kutipan terbaik yang kamu temukan dari film.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Top Film Section -->
  <section class="py-5">
    <div class="container">
      <h2 class="text-center fw-bold mb-5 display-5">Film Paling Dicatat Komunitas</h2>
      
      <div class="row g-4 justify-content-center">
        <!-- Film Card 1 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime1.jpeg') }}" alt="Everything Everywhere All At Once" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Everything Everywhere All At Once</h3>
              <div class="star-rating">
                <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Film Card 2 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime2.jpeg') }}" alt="Top Gun: Maverick" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Top Gun: Maverick</h3>
              <div class="star-rating">
                <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
              </div>
            </div>
          </div>
        </div>
    
        <!-- Film Card 3 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime3.jpeg') }}" alt="The Batman" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">The Batman</h3>
              <div class="star-rating">
                <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
              </div>
            </div>
          </div>
        </div>
    
        <!-- Film Card 4 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime1.jpeg') }}" alt="Avatar: The Way of Water" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Avatar: The Way of Water</h3>
              <div class="star-rating">
                <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
              </div>
            </div>
          </div>
        </div>
    
        <!-- Film Card 5 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime2.jpeg') }}" alt="Oppenheimer" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Oppenheimer</h3>
              <div class="star-rating">
                <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Testimonials Section -->
  <section id="testimonials" class="py-5">
    <div class="container">
      <h2 class="text-center fw-bold mb-5 display-5">Apa Kata Mereka</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="testimonial-card p-4 shadow h-100">
            <p class="fst-italic text-secondary">"Watchalisto bikin aku makin semangat nonton dan nggak lupa film-film yang udah kutonton."</p>
            <h4 class="mt-3 fw-semibold">— Raka</h4>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card p-4 shadow h-100">
            <p class="fst-italic text-secondary">"Fitur kutipannya gemes banget. Rasanya kayak punya album kenangan film pribadi."</p>
            <h4 class="mt-3 fw-semibold">— Sinta</h4>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card p-4 shadow h-100">
            <p class="fst-italic text-secondary">"Simpel tapi fungsional! Cocok buat movie geek kayak aku 🤓."</p>
            <h4 class="mt-3 fw-semibold">— Dimas</h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4 text-center">
    <small>© 2025 Watchalisto. All rights reserved.</small>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>