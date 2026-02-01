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
            color: rgba(255,255,255,0.7) !important;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-link.active {
            color: #14b8a6 !important;
        }

        .nav-link:hover {
            color: rgba(255,255,255,0.7) !important;
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

        .btn-add-list {
            background-color: #14b8a6; /* contoh: teal */
            border-color: #14b8a6;
            color: #fff;
            font-weight: 600;
        }

        .btn-add-list:hover {
            background-color: #0d9488;
            border-color: #0d9488;
        }

        .btn-add-list:focus,
        .btn-add-list:active,
        .btn-add-list:focus-visible {
            background-color: #0f766e !important;
            border-color: #0f766e !important;
            color: #fff;
            box-shadow: none;
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
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('drama.*') ? 'active' : '' }}"
                    href="{{ route('drama.index') }}">
                        Drama List
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('manhwa.*') ? 'active' : '' }}"
                    href="{{ route('manhwa.index') }}">
                        Manhwa List
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Browse
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item bi-play-circle" href="{{ route('browse.index', 'drama') }}">
                                Drama
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item bi-book" href="{{ route('browse.index', 'manhwa') }}">
                                Manhwa
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>


            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-add-list btn-sm"
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
@include('partials.remove-confirm-modal')

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
    // ===============================
    // HELPER FUNCTIONS
    // ===============================
    function setRating(value) {
        const scoreInput = document.getElementById('scoreInput');
        if (scoreInput) scoreInput.value = value ?? '';
        
        document.querySelectorAll('#scoreStars .star').forEach(star => {
            const isActive = parseInt(star.dataset.value) <= (parseInt(value) || 0);
            star.classList.toggle('bi-star-fill', isActive);
            star.classList.toggle('bi-star', !isActive);
            star.classList.toggle('text-warning', isActive);
            star.classList.toggle('text-secondary', !isActive);
        });
    }

    function toggleRemoveButton() {
        const btn = document.getElementById('removeStatusBtn');
        const recordId = document.getElementById('user_media_list_id')?.value;
        if (btn) {
            btn.classList.toggle('d-none', !recordId);
        }
    }

    // ===============================
    // OPEN STATUS MODAL
    // ===============================
    function openStatusModal(data) {
        const statusModalEl = document.getElementById('statusModal');
        if (!statusModalEl) return;
        
        const statusModal = bootstrap.Modal.getInstance(statusModalEl) || new bootstrap.Modal(statusModalEl);

        // Basic info
        const mediaId = data.media?.id ?? data.id;
        const type = data.media?.type ?? data.type;
        let poster = data.media?.poster ?? data.poster ?? '';

        if (poster && !poster.startsWith('http') && !poster.startsWith('/storage/')) {
            poster = `/storage/${poster}`;
        }

        if (!poster) {
            poster = 'https://via.placeholder.com/200x300?text=No+Poster';
        }
        
        const statusMediaId = document.getElementById('statusMediaId');
        const statusMediaType = document.getElementById('statusMediaType');
        const statusPoster = document.getElementById('statusPoster');
        
        if (statusMediaId) statusMediaId.value = mediaId;
        if (statusMediaType) statusMediaType.value = type;
        if (statusPoster) statusPoster.src = poster;

        // Elements
        const progressLabel = document.querySelector('#progressLabel');
        const progressInput = document.getElementById('progress');
        const extraCol = document.getElementById('extraProgressCol');
        const extraInput = document.getElementById('extraProgress');

        // Reset
        if (extraCol) extraCol.classList.add('d-none');
        if (progressInput) progressInput.max = '';
        if (extraInput) extraInput.max = '';
        if (progressInput) progressInput.value = '';
        if (extraInput) extraInput.value = '';

        // Configure based on type
        if (type === 'drama' && progressLabel && progressInput && extraCol && extraInput) {
            progressLabel.textContent = 'Episode';
            progressInput.placeholder = `Enter current episode (Max ${data.media?.total_episode ?? '-'})`;
            progressInput.max = data.media?.total_episode || '';
            
            const extraLabel = extraCol.querySelector('label');
            if (extraLabel) extraLabel.textContent = 'Season';
            extraInput.placeholder = `Enter current season (Max ${data.media?.total_season ?? '-'})`;
            extraInput.max = data.media?.total_season || '';
            
            extraCol.classList.remove('d-none');
        } 
        else if (type === 'manhwa' && progressLabel && progressInput && extraCol && extraInput) {
            progressLabel.textContent = 'Chapter';
            progressInput.placeholder = `Enter current chapter (Max ${data.media?.total_chapter ?? '-'})`;
            progressInput.max = data.media?.total_chapter || '';
            
            const extraLabel = extraCol.querySelector('label');
            if (extraLabel) extraLabel.textContent = 'Volume';
            extraInput.placeholder = `Enter current volume (Max ${data.media?.total_volume ?? '-'})`;
            extraInput.max = data.media?.total_volume || '';
            
            extraCol.classList.remove('d-none');
        }

        // Fill user data
        if (data.userMediaList) {
            const u = data.userMediaList;
            const userMediaListId = document.getElementById('user_media_list_id');
            const statusSelect = document.getElementById('statusSelect');
            const startedDate = document.getElementById('startedDate');
            const finishedDate = document.getElementById('finishedDate');
            const notes = document.getElementById('notes');

            if (userMediaListId) userMediaListId.value = u.id;
            if (statusSelect) statusSelect.value = u.status;
            if (progressInput) progressInput.value = u.progress ?? '';
            if (startedDate) startedDate.value = u.started_date?.slice(0,10) ?? '';
            if (finishedDate) finishedDate.value = u.finished_date?.slice(0,10) ?? '';
            if (notes) notes.value = u.notes ?? '';
            setRating(u.rating);

            if (extraInput && (type === 'drama' || type === 'manhwa')) {
                extraInput.value = u.extra_progress ?? '';
            }
        } 
        else {
            const userMediaListId = document.getElementById('user_media_list_id');
            const statusSelect = document.getElementById('statusSelect');
            const scoreInput = document.getElementById('scoreInput');
            const startedDate = document.getElementById('startedDate');
            const finishedDate = document.getElementById('finishedDate');
            const notes = document.getElementById('notes');

            if (userMediaListId) userMediaListId.value = '';
            if (statusSelect) statusSelect.value = 'planned';
            if (progressInput) progressInput.value = '';
            if (scoreInput) scoreInput.value = '';
            if (startedDate) startedDate.value = '';
            if (finishedDate) finishedDate.value = '';
            if (notes) notes.value = '';
            if (extraInput) extraInput.value = '';
            
            document.querySelectorAll('#scoreStars .star').forEach(star => {
                star.classList.remove('bi-star-fill', 'text-warning');
                star.classList.add('bi-star', 'text-secondary');
            });
            
            if (extraCol && (type === 'drama' || type === 'manhwa')) {
                extraCol.classList.remove('d-none');
            }
        }

        statusModal.show();
        toggleRemoveButton();
    }

    // ===============================
    // SEARCH MEDIA
    // ===============================
    const input = document.getElementById('modalSearchInput');
    const resultBox = document.getElementById('modalSearchResult');
    const addMediaModal = document.getElementById('addMovieModal');
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
                        resultBox.innerHTML = `<div class="text-muted px-2">No results</div>`;
                        return;
                    }

                    data.forEach(item => {
                        const el = document.createElement('div');
                        el.className = 'list-group-item search-item d-flex align-items-center gap-3';
                        el.innerHTML = `
                            <img src="/storage/${item.poster}" width="40" class="rounded">
                            <div class="flex-grow-1">
                                <div class="fw-semibold">${item.title}</div>
                                <small class="text-muted">${item.type.toUpperCase()} • ${item.release_year ?? '-'}</small>
                            </div>
                            <button type="button" class="add-btn add-to-list-btn" 
                                data-id="${item.id}" data-type="${item.type}" data-poster="/storage/${item.poster}">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        `;
                        resultBox.appendChild(el);
                    });
                })
                .catch(err => {
                    console.error('Search error:', err);
                    resultBox.innerHTML = `<div class="text-danger px-2">Error loading results</div>`;
                });
            }, 300);
        });
    }

    if (addMediaModal) {
        addMediaModal.addEventListener('hidden.bs.modal', () => {
            if (input) input.value = '';
            if (resultBox) resultBox.innerHTML = '';
            if (timeout) { clearTimeout(timeout); timeout = null; }
        });
    }

    // ===============================
    // CLICK HANDLERS
    // ===============================
    document.addEventListener('click', e => {
        // Add to list button
        const addToBtn = e.target.closest('.add-to-list-btn');
        if (addToBtn) {
            e.preventDefault();
            const mediaId = addToBtn.dataset.id;
            const poster = addToBtn.dataset.poster;

            fetch(`/user-media-list/by-media/${mediaId}`)
            .then(res => {
                if (res.ok) {
                    return res.json();
                }
                if (res.status === 404) {
                    return {
                        media: {
                            id: mediaId,
                            poster: poster,
                            type: addToBtn.dataset.type,
                            total_episode: null,
                            total_season: null,
                            total_chapter: null,
                            total_volume: null
                        }
                    };
                }
                throw new Error('Server error: ' + res.status);
            })
            .then(data => {
                if (!data.media) {
                    throw new Error('Media data incomplete');
                }
                openStatusModal(data);
            })
            .catch(err => {
                console.error('Error loading media:', err);
                openStatusModal({
                    media: {
                        id: mediaId,
                        poster: poster,
                        type: addToBtn.dataset.type,
                        total_episode: null,
                        total_season: null,
                        total_chapter: null,
                        total_volume: null
                    }
                });
            });
            return;
        }

        // Edit diary button
        const editDiaryBtn = e.target.closest('.edit-diary-btn');
        if (editDiaryBtn) {
            e.preventDefault();
            const id = editDiaryBtn.dataset.id;
            fetch(`/user-media-list/${id}`)
            .then(res => res.ok ? res.json() : Promise.reject('Failed to load diary data'))
            .then(data => openStatusModal(data))
            .catch(err => { 
                console.error(err); 
                alert(err.message || 'Error loading data'); 
            });
            return;
        }

        // Edit media grid button
        const editMediaBtn = e.target.closest('.edit-media-btn');
        if (editMediaBtn) {
            e.preventDefault();
            const mediaId = editMediaBtn.dataset.mediaId;
            fetch(`/user-media-list/by-media/${mediaId}`)
            .then(res => res.ok ? res.json() : Promise.reject('Data tidak ditemukan'))
            .then(data => {
                if (!data.media) throw new Error('Media data incomplete');
                openStatusModal(data);
            })
            .catch(err => { 
                console.error(err); 
                alert('Gagal memuat data'); 
            });
            return;
        }
    });

    // ===============================
    // AUTO DATE LOGIC
    // ===============================
    const statusSelect = document.getElementById('statusSelect');
    if (statusSelect) {
        statusSelect.addEventListener('change', () => {
            const today = new Date().toISOString().slice(0,10);
            const startedDate = document.getElementById('startedDate');
            const finishedDate = document.getElementById('finishedDate');
            
            if (statusSelect.value === 'watching' && startedDate && !startedDate.value) {
                startedDate.value = today;
            }
            if (statusSelect.value === 'completed' && finishedDate && !finishedDate.value) {
                finishedDate.value = today;
            }
        });
    }

    // ===============================
    // SAVE BUTTON
    // ===============================
    const saveBtn = document.getElementById('saveStatusBtn');
    if (saveBtn) {
        saveBtn.addEventListener('click', () => {
            const statusSelect = document.getElementById('statusSelect');
            const progressInput = document.getElementById('progress');
            const extraInput = document.getElementById('extraProgress');
            const mediaType = document.getElementById('statusMediaType')?.value || '';

            if (!statusSelect?.value) {
                statusSelect?.classList.add('is-invalid');
                statusSelect?.focus();
                alert('❌ Status wajib dipilih!');
                return;
            }
            statusSelect.classList.remove('is-invalid');

            // VALIDASI MAX - SKIP KALAU MAX NULL/EMPTY
            if (mediaType === 'drama') {
                if (progressInput?.max && progressInput.value && parseInt(progressInput.value) > parseInt(progressInput.max)) {
                    alert(`❌ Episode tidak boleh lebih dari ${progressInput.max}!`);
                    progressInput.focus();
                    return;
                }
                if (extraInput?.max && extraInput.value && parseInt(extraInput.value) > parseInt(extraInput.max)) {
                    alert(`❌ Season tidak boleh lebih dari ${extraInput.max}!`);
                    extraInput.focus();
                    return;
                }
            } 
            else if (mediaType === 'manhwa') {
                if (progressInput?.max && progressInput.value && parseInt(progressInput.value) > parseInt(progressInput.max)) {
                    alert(`❌ Chapter tidak boleh lebih dari ${progressInput.max}!`);
                    progressInput.focus();
                    return;
                }
                if (extraInput?.max && extraInput.value && parseInt(extraInput.value) > parseInt(extraInput.max)) {
                    alert(`❌ Volume tidak boleh lebih dari ${extraInput.max}!`);
                    extraInput.focus();
                    return;
                }
            }

            // KIRIM DATA KE BACKEND
            const recordId = document.getElementById('user_media_list_id')?.value;
            const payload = {
                media_id: document.getElementById('statusMediaId')?.value,
                status: statusSelect.value,
                progress: progressInput?.value || null,
                extra_progress: extraInput?.value || null,
                rating: document.getElementById('scoreInput')?.value || null,
                started_date: document.getElementById('startedDate')?.value || null,
                finished_date: document.getElementById('finishedDate')?.value || null,
                notes: document.getElementById('notes')?.value || null
            };

            fetch(recordId ? `/user-media-list/${recordId}` : `/user-media-list`, {
                method: recordId ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                },
                body: JSON.stringify(payload)
            })
            .then(async res => {
                const text = await res.text();
                console.log('Response:', text);
                
                if (!res.ok) {
                    try {
                        const json = JSON.parse(text);
                        throw new Error(json.message || `Error ${res.status}`);
                    } catch {
                        throw new Error(`Server error ${res.status}: ${text}`);
                    }
                }
                
                return JSON.parse(text);
            })
            .then(data => {
                if (data.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('statusModal'));
                    if (modal) modal.hide();
                    setTimeout(() => location.reload(), 400);
                }
            })
            .catch(err => {
                console.error('Save error:', err);
                alert('❌ ' + err.message);
            });
        });
    }

    // ===============================
    // REMOVE BUTTON
    // ===============================
    const removeBtn = document.getElementById('removeStatusBtn');
    const removeConfirmModalEl = document.getElementById('removeConfirmModal');
    const confirmRemoveBtn = document.getElementById('confirmRemoveBtn');

    if (removeBtn && removeConfirmModalEl) {
        removeBtn.addEventListener('click', () => {
            const modal = bootstrap.Modal.getInstance(removeConfirmModalEl) || new bootstrap.Modal(removeConfirmModalEl);
            modal.show();
        });
    }

    if (confirmRemoveBtn && removeConfirmModalEl) {
        confirmRemoveBtn.addEventListener('click', () => {
            const recordId = document.getElementById('user_media_list_id')?.value;
            if (!recordId) return;

            fetch(`/user-media-list/${recordId}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content }
            })
            .then(res => {
                if (!res.ok) throw new Error('Failed to remove');
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    const confirmModal = bootstrap.Modal.getInstance(removeConfirmModalEl);
                    const statusModal = bootstrap.Modal.getInstance(document.getElementById('statusModal'));
                    if (confirmModal) confirmModal.hide();
                    if (statusModal) statusModal.hide();
                    setTimeout(() => location.reload(), 400);
                }
            })
            .catch(err => alert(err.message || 'Error removing item'));
        });
    }

    // ===============================
    // REAL-TIME VALIDATION
    // ===============================
    const progressFld = document.getElementById('progress');
    const extraFld = document.getElementById('extraProgress');
    
    if (progressFld) {
        progressFld.addEventListener('input', function() {
            if (this.max && this.value && parseInt(this.value) > parseInt(this.max)) {
                this.value = this.max;
            }
        });
    }
    
    if (extraFld) {
        extraFld.addEventListener('input', function() {
            if (this.max && this.value && parseInt(this.value) > parseInt(this.max)) {
                this.value = this.max;
            }
        });
    }

    // ===============================
    // STAR RATING CLICK
    // ===============================
    document.querySelectorAll('#scoreStars .star').forEach(star => {
        star.addEventListener('click', () => setRating(star.dataset.value));
    });
});
</script>
@stack('scripts')
</body>
</html>