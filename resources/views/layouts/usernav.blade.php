<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Watchalisto' }}</title>

    {{-- FAVICON --}}
    <link rel="icon" type="image/png" href="{{ asset('images/logoup.png') }}">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    {{-- NAVBAR + FOOTER STYLE --}}
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .navbar {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            z-index: 1030;
        }

        .nav-link {
            color: rgba(255,255,255,0.7);
            font-weight: 500;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #14b8a6;
        }

        .logo-img {
            height: 38px;
        }

        .footer {
            background: #0f172a;
            color: white;
            margin-top: 3rem;
        }

        .footer-nav,
        .medsos {
            color: #9ca3af;
            text-decoration: none;
        }

        .footer-nav:hover,
        .medsos:hover {
            color: #e1e5ec;
        }
        /* STATUS MODAL */
        .status-modal .modal-content {
            border-radius: 18px;
            background: linear-gradient(180deg, #0f172a, #020617);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .status-modal .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .status-title {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .status-sub {
            font-size: 0.9rem;
            color: #94a3b8;
        }

        .status-section {
            margin-bottom: 1.2rem;
        }

        .status-label {
            font-size: 0.85rem;
            color: #94a3b8;
            margin-bottom: 6px;
        }

        /* STATUS BUTTON */
        .status-select {
            display: flex;
            gap: 10px;
        }

        .status-pill {
            flex: 1;
            padding: 10px;
            border-radius: 999px;
            text-align: center;
            cursor: pointer;
            font-size: 0.85rem;
            border: 1px solid rgba(255,255,255,0.1);
            color: #cbd5f5;
        }

        .status-pill.active {
            background: #14b8a6;
            color: #022c22;
            font-weight: 600;
        }

        /* SCORE */
        .score-stars i {
            font-size: 1.7rem;
            cursor: pointer;
        }

        /* FOOTER */
        .status-footer {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 1rem;
        }
    </style>

    {{-- CSS DARI PAGE --}}
    @stack('styles')
</head>
<body>

{{-- ================= NAVBAR ================= --}}
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-4">
        <a href="/dashboard" class="d-flex align-items-center">
            <img src="{{ asset('images/WatchaListo.png') }}" class="logo-img me-2">
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="/dashboard">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('drama.index') }}">Drama List</a></li>
                <li class="nav-item"><a class="nav-link" href="/manhwa">Manhwa List</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('drama.browse') }}">Browse</a></li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#addMovieModal">
                    <i class="bi bi-plus-lg"></i> Add List
                </button>

                <div class="dropdown">
                    <a class="text-white dropdown-toggle text-decoration-none"
                       data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end bg-dark">
                        <li><a class="dropdown-item text-light" href="/profile">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

@include('partials.add-list-modal')
@include('partials.status-modal')

{{-- ================= CONTENT ================= --}}
@yield('content')

{{-- ================= FOOTER ================= --}}
<footer class="footer py-5">
    <div class="container">
        <p class="text-center text-secondary small mb-0">
            © {{ date('Y') }} Watchalisto
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('page-script')
<script>
document.addEventListener('DOMContentLoaded', () => {

  /* ===============================
     SEARCH MEDIA (MODAL SEARCH)
  =============================== */
  const input = document.getElementById('modalSearchInput');
  const resultBox = document.getElementById('modalSearchResult');
  let timeout = null;

  if (input && resultBox) {
    input.addEventListener('input', () => {
      clearTimeout(timeout);
      const query = input.value.trim();

      if (query.length < 1) {
        resultBox.innerHTML = '';
        return;
      }

      timeout = setTimeout(() => {
        fetch(`/search-media?q=${encodeURIComponent(query)}`)
          .then(res => res.json())
          .then(data => {
            resultBox.innerHTML = '';

            if (!data || data.length === 0) {
              resultBox.innerHTML =
                `<div class="text-muted px-2">No results</div>`;
              return;
            }

            data.forEach(item => {
              const el = document.createElement('div');
              el.className =
                'list-group-item search-item d-flex align-items-center gap-3';

              el.innerHTML = `
                <img src="/storage/${item.poster}" width="40" class="rounded">

                <div class="flex-grow-1">
                  <div class="fw-semibold">${item.title}</div>
                  <small class="text-muted">
                    ${item.type.toUpperCase()} • ${item.release_year ?? '-'}
                  </small>
                </div>

                <button
                  type="button"
                  class="add-btn add-to-list-btn"
                  data-id="${item.id}"
                  data-type="${item.type}"
                  data-poster="/storage/${item.poster}">
                  <i class="bi bi-plus-lg"></i>
                </button>
              `;

              resultBox.appendChild(el);
            });
          });
      }, 300);
    });
  }

  /* ===============================
     CLICK + BUTTON
  =============================== */
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.add-to-list-btn');
    if (!btn) return;

    e.preventDefault();

    document.getElementById('statusMediaId').value = btn.dataset.id;
    document.getElementById('statusPoster').src = btn.dataset.poster;

    // reset form
    document.getElementById('statusSelect').value = 'planned';
    document.getElementById('progress').value = '';
    document.getElementById('scoreInput').value = '';
    document.getElementById('startedDate').value = '';
    document.getElementById('finishedDate').value = '';
    document.getElementById('notes').value = '';

    document.querySelectorAll('#scoreStars .star').forEach(star => {
      star.classList.remove('bi-star-fill', 'text-warning');
      star.classList.add('bi-star', 'text-secondary');
    });

    new bootstrap.Modal(document.getElementById('statusModal')).show();
  });

  /* ===============================
     STAR RATING
  =============================== */
    const scoreStars = document.querySelectorAll('#scoreStars .star');
        if (scoreStars.length > 0) {
        scoreStars.forEach(star => {
            star.addEventListener('click', () => {
            const value = star.dataset.value;
            document.getElementById('scoreInput').value = value;

            scoreStars.forEach(s => {
                if (s.dataset.value <= value) {
                s.classList.remove('bi-star', 'text-secondary');
                s.classList.add('bi-star-fill', 'text-warning');
                } else {
                s.classList.remove('bi-star-fill', 'text-warning');
                s.classList.add('bi-star', 'text-secondary');
                }
            });
            });
        });
    }

  /* ===============================
     AUTO DATE LOGIC (SMART UX)
  =============================== */
  const statusSelect = document.getElementById('statusSelect');

  statusSelect?.addEventListener('change', () => {
        const today = new Date().toISOString().slice(0, 10);

        if (statusSelect.value === 'watching') {
            if (!document.getElementById('startedDate').value) {
                document.getElementById('startedDate').value = today;
            }
        }

        if (statusSelect.value === 'completed') {
            if (!document.getElementById('finishedDate').value) {
                document.getElementById('finishedDate').value = today;
            }
        }
    });

  /* ===============================
     SAVE TO USER MEDIA LIST
  =============================== */
  document.getElementById('saveStatusBtn')?.addEventListener('click', () => {
    const payload = {
      media_id: document.getElementById('statusMediaId').value,
      status: document.getElementById('statusSelect').value,
      progress: document.getElementById('progress').value || null,
      rating: document.getElementById('scoreInput').value || null,
      started_date: document.getElementById('startedDate').value || null,
      finished_date: document.getElementById('finishedDate').value || null,
      notes: document.getElementById('notes').value || null,
    };

    fetch('/user-media-list', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
            .querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(payload)
        })
        .then(res => {
                if (!res.ok) {
                    throw new Error('Gagal menyimpan data');
                }
            return res.json();
            })
            .then(data => {
                if (data.success) {
                    bootstrap.Modal
                    .getInstance(document.getElementById('statusModal'))
                    .hide();

                    // sementara reload dulu
                    setTimeout(() => location.reload(), 500);
                }
            })
            .catch(err => {
            // klo backend error
            alert(err.message);
        });
    });

});
</script>
@stack('scripts')
</body>
</html>