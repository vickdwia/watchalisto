<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Watchalisto</title>
  <link rel="icon" href="{{ asset('images/logoup.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <!-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet">  -->
</head>

<style>
  /* semua */
body {
  background-color: #020510;
  color: white;
  min-height: 100vh;
}

/*header*/
header {
  background: rgba(17, 25, 40, 0.4); /* 0.4 = 40% opacity */
  backdrop-filter: blur(10px);
}

/* logo */
.logo-img {
  height: 40px;
  width: auto;
}

/*responsif */
@media (min-width: 768px) {
  .logo-img {
    height: 50px;
  }
}

/* button login/register*/
.btn-teal {
  background-color: rgb(20, 184, 166);
  border-color: rgb(20, 184, 166);
  color: white;
}

.btn-teal:hover {
  background-color: rgb(13, 148, 136);
  border-color: rgb(13, 148, 136);
  color: white;
}

.btn-outline-teal {
  border-color: rgb(20, 184, 166);
  color: rgb(20, 184, 166);
  background-color: transparent;
}

.btn-outline-teal:hover {
  background-color: rgb(20, 184, 166);
  border-color: rgb(20, 184, 166);
  color: white;
}

/* hero section */
.hero-section {
  position: relative;
  text-align: center;
  overflow: hidden;
}

.hero-bg {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background-color: rgba(0, 0, 0, 0.7);
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

/* fitur section */
.fitur {
    background: rgba(13, 148, 136, 0.05);
    border: 1px solid rgba(20, 184, 166, 0.15);
    border-radius: 15px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.fitur:hover {
    background: rgba(20, 184, 166, 0.1);
    border-color: rgba(13, 148, 136, 0.4);
    box-shadow: 0 10px 30px rgba(20, 184, 166, 0.25)!important;
}

.fitur h3 {
    color: white;
    margin-bottom: 15px;
}

.fitur p {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
}


/* film section */
.film-card {
  background-color: #1f2937;
  border-radius: 0.75rem;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.film-card:hover {
  transform: scale(1.05);
}

.film-card img {
  width: 100%;
  height: 280px; /* ubah tinggi seperti di anime-poster */
  object-fit: cover; /* biar gambar tetap proporsional */
  border-radius: 8px; /* biar sudutnya bulat */
  display: block;
}

/* ===========================
   Star Rating
   =========================== */
.star-rating {
  color: #fbbf24;
}

/* ===========================
   Testimonial Cards
   =========================== */
.testimonial-card {
  background-color: #1f2937;
  border-radius: 0.75rem;
  transition: transform 0.3s ease;
}

.testimonial-card:hover {
  transform: scale(1.05);
}

/* footer */
.footer {
  background: #0f172a;
  color: white;
  margin-top: 3rem;
}

.footer-nav {
  color: #9ca3af;
  text-decoration: none;
  transition: color 0.3s;
}

.footer-nav:hover {
  color: #e1e5ec;
}

.medsos {
  color: #9ca3af;
  text-decoration: none;
  font-size: 0.9rem;
  transition: color 0.3s;
}

.medsos:hover {
  color: #e1e5ec;
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
    <img src="{{ asset('images/bghero.png') }}" alt="Menonton film" class="hero-bg">
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

  <!-- About -->
  <section class="about-section py-5">
    <div class="container text-center">
      <h2 class="fw-bold mb-4 display-5">Tentang Watchalisto</h2>
      <p class="text-secondary mx-auto" style="max-width: 700px;">
        Watchalisto adalah ruang bagi pecinta film untuk lebih dari sekadar menonton. 
        Di sini, kamu bisa mencatat perjalanan menontonmu, menulis kesan pribadi, 
        menyimpan kutipan favorit, dan melihat perkembangan seleramu dari waktu ke waktu.
      </p>
      <p class="fst-italic text-light mt-4">
        Watchalisto — karena setiap film menyimpan cerita, dan setiap penonton punya kisahnya sendiri.
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
            <h3 class="fs-4 fw-semibold mb-3">Daftar Tontonan</h3>
            <p class="text-secondary small">Kelola film yang ingin ditonton, sedang ditonton, atau sudah ditonton.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="fitur p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">Rating & Ulasan</h3>
            <p class="text-secondary small">Beri penilaian dan ulasan singkat untuk setiap film favoritmu.</p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="fitur p-4 text-center shadow h-100">
            <h3 class="fs-4 fw-semibold mb-3">Kutipan Favorit</h3>
            <p class="text-secondary small">Simpan kutipan terbaik yang kamu temukan dari film.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Top Film Section -->
  <section class="py-5">
    <div class="container-fluid">
      <h2 class="text-center fw-bold mb-5 display-5">Film Populer</h2>
      
      <div class="row g-4 justify-content-center">
        <!-- Film Card 1 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime1.jpeg') }}" alt="Everything Everywhere All At Once" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Everything Everywhere All At Once</h3>
            </div>
          </div>
        </div>
        
        <!-- Film Card 2 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime1.jpeg') }}" alt="Top Gun: Maverick" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Top Gun: Maverick</h3>
            </div>
          </div>
        </div>
    
        <!-- Film Card 3 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime1.jpeg') }}" alt="The Batman" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">The Batman</h3>
            </div>
          </div>
        </div>
    
        <!-- Film Card 4 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime1.jpeg') }}" alt="Avatar: The Way of Water" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Avatar: The Way of Water</h3>
            </div>
          </div>
        </div>
    
        <!-- Film Card 5 -->
        <div class="col-6 col-md-4 col-lg-2">
          <div class="film-card shadow">
            <img src="{{ asset('images/anime1.jpeg') }}" alt="Oppenheimer" class="w-100">
            <div class="p-3 text-center">
              <h3 class="fs-6 fw-semibold mb-2">Oppenheimer</h3>
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
            <p class="fst-italic text-secondary">"Rasanya kayak punya album kenangan film pribadi."</p>
            <h4 class="mt-3 fw-semibold">— Sinta</h4>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial-card p-4 shadow h-100">
            <p class="fst-italic text-secondary">"Simpel tapi fungsional! Cocok buat movie geek kayak aku."</p>
            <h4 class="mt-3 fw-semibold">— Dimas</h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
<footer class="footer py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Brand Section -->
      <div class="col-md-4">
        <div class="d-flex align-items-center mb-3">
          <img src="{{ asset('images/WatchaListo.png') }}" alt="Watchalisto Logo" class="logo-img me-2">
        </div>
        <p class="text-secondary small">
          Platform terbaik untuk mengelola dan mengabadikan pengalaman menonton filmmu.
        </p>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4">
        <h5 class="fw-bold mb-3">Quick Links</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="footer-nav">Beranda</a></li>
          <li class="mb-2"><a href="#" class="footer-nav">Tentang Kami</a></li>
          <li class="mb-2"><a href="#" class="footer-nav">Fitur</a></li>
          <li class="mb-2"><a href="#" class="footer-nav">FAQ</a></li>
        </ul>
      </div>

      <!-- Social Media -->
      <div class="col-md-4">
        <h5 class="fw-bold mb-3">Follow Us</h5>
        <div class="d-flex gap-3">
          <a href="#" class="medsos">
            <i class="bi bi-instagram"></i> Instagram
          </a>
          <a href="#" class="medsos">
            <i class="bi bi-twitter-x"></i> Twitter
          </a>
          <a href="#" class="medsos">
            <i class="bi bi-facebook"></i> Facebook
          </a>
        </div>
      </div>
    </div>
    </div>
  </div>
</footer>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>