@extends('layouts.adminside')

@section('title', 'Kelola Media')

@push('styles')
<style>
/* ===== LIST HEADER ===== */
.list-header {
    margin-bottom: 24px;
    padding: 16px 20px;
    background: rgba(17, 25, 40, 0.55);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.list-header h1 {
    font-size: 26px;
    font-weight: 800;
    color: #14b8a6;
    margin-bottom: 0;
}

.list-header p {
    font-size: 14px;
    color: #9ca3af;
    margin: 4px 0 0 0;
}

.btn-add {
    background: linear-gradient(120deg, #14b8a6, #0d9488);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 6px rgba(20, 184, 166, 0.25);
    text-decoration: none;
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(20, 184, 166, 0.35);
    background: linear-gradient(120deg, #0d9488, #0f766e);
}

/* ===== FILTER BAR ===== */
.filter-bar {
    background: rgba(17, 25, 40, 0.5);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,.08);
    padding: 16px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}

.filter-group {
    display: flex;
    gap: 12px;
    align-items: center;
}

.filter-label {
    color: #cbd5f5;
    font-size: 14px;
    font-weight: 500;
}

.filter-select {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 8px;
    padding: 8px 12px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
}

.filter-select:hover {
    border-color: rgba(20, 184, 166, 0.5);
}

/* ===== TABLE ===== */
.media-table {
    width: 100%;
    background: rgba(17, 25, 40, 0.7);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
}

.media-table > table {
    width: 100%;
    border-collapse: collapse;
}

.media-table thead {
    background: rgba(20, 184, 166, 0.15);
    border-bottom: 2px solid rgba(20, 184, 166, 0.3);
}

.media-table th {
    padding: 16px 20px;
    text-align: left;
    font-weight: 700;
    color: #14b8a6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.media-table td {
    padding: 14px 20px;
    border-top: 1px solid rgba(255,255,255,.08);
    color: #cbd5f5;
    font-size: 14px;
}

.media-table tbody tr {
    transition: all 0.2s ease;
}

.media-table tbody tr:hover {
    background: rgba(20, 184, 166, 0.08);
    transform: translateX(4px);
}

.media-table tbody tr:last-child td {
    border-bottom: none;
}

/* ===== BADGES ===== */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.badge-drama {
    background: rgba(20, 184, 166, 0.15);
    color: #14b8a6;
}

.badge-manhwa {
    background: rgba(168, 85, 247, 0.15);
    color: #a855f7;
}

/* ===== ACTIONS ===== */
.action-buttons {
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

.btn-action {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-edit {
    background: rgba(59, 130, 246, 0.15);
    color: #3b82f6;
}

.btn-edit:hover {
    background: rgba(59, 130, 246, 0.25);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.25);
}

/* ===== MODAL ===== */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal.active {
    display: flex;
}

.modal-content {
    background: rgba(17, 25, 40, 0.95);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    display: flex;
    flex-direction: column; /* stack header-body-footer */
    overflow: hidden;       /* biar modal-body scroll sendiri */
    box-shadow: 0 20px 50px rgba(0,0,0,0.5);
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.3s ease;
}

.modal.active .modal-content {
    transform: translateY(0);
    opacity: 1;
}

.modal-header {
    padding: 20px 24px;
    border-bottom: 1px solid rgba(255,255,255,.08);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h2 {
    font-size: 22px;
    font-weight: 700;
    color: #e5e7eb;
}

.close-modal {
    background: none;
    border: none;
    color: #9ca3af;
    font-size: 24px;
    cursor: pointer;
    transition: color 0.2s;
}

.close-modal:hover {
    color: #ef4444;
}

.modal-body {
    padding: 24px;
    overflow-y: auto;       /* scroll kalau isi terlalu tinggi */
    flex: 1 1 auto;         /* isi tumbuh sesuai konten */
    display: flex;
    flex-direction: column;
    gap: 16px;
}

#mediaForm {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #e5e7eb;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 8px;
    color: #fff;
    font-size: 15px;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: rgba(20, 184, 166, 0.5);
    box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.btn-submit {
    background: linear-gradient(120deg, #14b8a6, #0d9488);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    width: 100%;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 8px;
    align-self: flex-start;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
}

/* ===== GENRE DROPDOWN ===== */
.genre-dropdown {
    position: relative;
}

.genre-toggle {
    width: 100%;
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 8px;
    padding: 10px 14px;
    color: #cbd5f5;
    text-align: left;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 14px;
}

.genre-toggle:hover {
    border-color: rgba(20, 184, 166, 0.5);
}

.genre-toggle.active {
    border-color: #14b8a6;
    background: rgba(20, 184, 166, 0.1);
}

.genre-checkboxes {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    padding: 8px;
    background: rgba(17, 25, 40, 0.95);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 8px;
    margin-top: 4px;
    z-index: 100;
    display: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.genre-checkboxes.show {
    display: block;
}

.genre-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 0;
    cursor: pointer;
    transition: all 0.2s ease;
}

.genre-option:hover {
    background: rgba(20, 184, 166, 0.1);
    border-radius: 6px;
}

.genre-option input[type="checkbox"] {
    width: 16px;
    height: 16px;
    cursor: pointer;
    accent-color: #14b8a6;
}

/* Scrollbar styling */
.genre-checkboxes::-webkit-scrollbar {
    width: 6px;
}

.genre-checkboxes::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.05);
    border-radius: 3px;
}

.genre-checkboxes::-webkit-scrollbar-thumb {
    background: rgba(20, 184, 166, 0.5);
    border-radius: 3px;
}

.genre-checkboxes::-webkit-scrollbar-thumb:hover {
    background: rgba(20, 184, 166, 0.7);
}

/* ===== CUSTOM DROPDOWN WITH BOOTSTRAP ICONS ===== */
/* Sembunyikan panah default browser */
select.form-control,
select.filter-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2.5rem; /* Ruang untuk icon */
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 16px;
}

/* Icon Bootstrap untuk semua dropdown */
select.form-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23cbd5f5' viewBox='0 0 16 16'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

select.form-control:hover {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2314b8a6' viewBox='0 0 16 16'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    border-color: rgba(20, 184, 166, 0.5);
}

select.form-control:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2314b8a6' viewBox='0 0 16 16'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

/* Filter dropdowns */
select.filter-select {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%239ca3af' viewBox='0 0 16 16'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

select.filter-select:hover {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2314b8a6' viewBox='0 0 16 16'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    border-color: rgba(20, 184, 166, 0.5);
}

/* Active state untuk filter */
select.filter-select:focus {
    outline: none;
    border-color: #14b8a6;
    box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2314b8a6' viewBox='0 0 16 16'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

/* ===== GENRE TOGGLE ICON (sudah ada, pastikan konsisten) ===== */
.genre-toggle .bi {
    transition: transform 0.3s ease;
}

.genre-toggle.active .bi {
    transform: rotate(180deg);
}

/* Hover effect untuk genre toggle */
.genre-toggle:hover .bi {
    color: #14b8a6;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .media-table {
        display: block;
        overflow-x: auto;
    }
    
    .media-table thead,
    .media-table tbody,
    .media-table tr,
    .media-table td,
    .media-table th {
        display: block;
    }
    
    .media-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
    
    .media-table tr {
        margin-bottom: 16px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 12px;
        background: rgba(17, 25, 40, 0.7);
    }
    
    .media-table td {
        border: none;
        position: relative;
        padding-left: 50%;
        text-align: left;
    }
    
    .media-table td::before {
        position: absolute;
        left: 16px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        font-weight: 600;
        color: #14b8a6;
    }
    
    .media-table td:nth-child(1)::before { content: "ID"; }
    .media-table td:nth-child(2)::before { content: "Judul"; }
    .media-table td:nth-child(3)::before { content: "Tipe"; }
    .media-table td:nth-child(4)::before { content: "Tahun"; }
    .media-table td:nth-child(5)::before { content: "Aksi"; }
    
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        width: 100%;
        justify-content: space-between;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .list-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn-add {
        align-self: stretch;
        width: 100%;
    }
}
</style>
@endpush

@section('content')
{{-- HEADER --}}
<div class="list-header">
    <div>
        <h1>Kelola Media</h1>
        <p id="mediaCount">{{ $medias->count() }} media • Kelola koleksi drama dan manhwa</p>
    </div>
    <button class="btn-add" id="openAddModal">
        <i class="bi bi-plus-circle"></i> Tambah Media
    </button>
</div>

{{-- FILTER BAR --}}
<div class="filter-bar">
    <div class="filter-group">
        <span class="filter-label">Tampilkan:</span>
        <select class="filter-select" id="typeFilter">
            <option value="all">Semua Tipe</option>
            <option value="drama">Drama</option>
            <option value="manhwa">Manhwa</option>
        </select>
    </div>
    <div class="filter-group">
        <span class="filter-label">Urutkan:</span>
        <select class="filter-select" id="sortFilter">
            <option value="newest">Terbaru</option>
            <option value="oldest">Terlama</option>
            <option value="title">Judul (A-Z)</option>
        </select>
    </div>
</div>

{{-- MEDIA TABLE --}}
<div class="media-table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Media</th>
                <th>Tipe</th>
                <th>Genre</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="mediaTableBody">
            @foreach ($medias as $media)
            <tr data-id="{{ $media->id }}" data-type="{{ $media->type }}">
                <td>{{ $media->id }}</td>
                <td>{{ $media->title }}</td>
                <td>
                    <span class="badge {{ $media->type == 'manhwa' ? 'badge-manhwa' : 'badge-drama' }}">
                        {{ ucfirst($media->type) }}
                    </span>
                </td>
                <td>
                    @foreach ($media->genres as $genre)
                        <span class="badge badge-genre">{{ $genre->name }}</span>
                    @endforeach
                </td>
                <td>{{ $media->release_year }}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" data-id="{{ $media->id }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button class="btn-action btn-delete" data-id="{{ $media->id }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- {{-- PAGINATION (dummy, bisa ganti sesuai paginate) --}}
<div class="pagination">
    <span class="disabled">&laquo; Previous</span>
    <span class="active">1</span>
    <a href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">&raquo; Next</a>
</div> -->

{{-- MODAL TAMBAH/EDIT MEDIA --}}
<div class="modal" id="mediaModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah Media Baru</h2>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="mediaForm" action="{{ route('admin.media.store') }}" method="POST">
                @csrf
                <input type="hidden" id="mediaId" name="id">

                <div class="form-group">
                    <label for="title">Judul Media <span style="color:#ef4444">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" placeholder="Masukkan judul media" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="type">Tipe Media <span style="color:#ef4444">*</span></label>
                        <select id="type" name="type" class="form-control" required>
                            <option value="">Pilih tipe media</option>
                            <option value="drama">Drama</option>
                            <option value="manhwa">Manhwa</option>
                        </select>
                    </div>

                    {{-- ===== DETAIL DRAMA ===== --}}
                    <div id="dramaFields" style="display:none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Total Episode</label>
                                <input type="number" name="total_episode" id="total_episode"
                                    class="form-control" min="1">
                            </div>

                            <div class="form-group">
                                <label>Total Season</label>
                                <input type="number" name="total_season" id="total_season"
                                    class="form-control" min="1">
                            </div>
                        </div>
                    </div>

                    {{-- ===== DETAIL MANHWA ===== --}}
                    <div id="manhwaFields" style="display:none;">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Total Chapter</label>
                                <input type="number" name="total_chapter" id="total_chapter"
                                    class="form-control" min="1">
                            </div>

                            <div class="form-group">
                                <label>Total Volume</label>
                                <input type="number" name="total_volume" id="total_volume"
                                    class="form-control" min="1">
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="genres">Genre <span style="color:#ef4444">*</span></label>
                        <div class="genre-dropdown">
                            <button type="button" class="genre-toggle form-control" id="genreToggle">
                                <span class="genre-placeholder">Pilih genre...</span>
                                <i class="bi bi-chevron-down ms-2"></i>
                            </button>
                            <div class="genre-checkboxes" id="genreCheckboxes">
                                @foreach($genres as $genre)
                                    <label class="genre-option">
                                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}"> {{ $genre->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="release_year">Tahun Rilis <span style="color:#ef4444">*</span></label>
                        <input type="number" id="release_year" name="release_year" class="form-control" placeholder="Contoh: 2023" min="1900" max="2100" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status <span style="color:#ef4444">*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="ongoing">Ongoing</option>
                        <option value="finished">Finished</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="poster">URL Poster <span style="color:#ef4444">*</span></label>
                    <input type="text" id="poster" name="poster" class="form-control" placeholder="https://example.com/poster.jpg">
                </div>

                <div class="form-group">
                    <label>Sinopsis <span style="color:#ef4444">*</span></label>
                    <textarea id="synopsis" name="synopsis" class="form-control" rows="3" placeholder="Deskripsi singkat tentang media ini"></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Simpan Media
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const openAddModalBtn = document.getElementById('openAddModal');
    const closeModalBtn = document.getElementById('closeModal');
    const mediaModal = document.getElementById('mediaModal');
    const mediaForm = document.getElementById('mediaForm');
    const typeSelect = document.getElementById('type');
    const dramaFields = document.getElementById('dramaFields');
    const manhwaFields = document.getElementById('manhwaFields');
    const totalEpisode = document.getElementById('total_episode');
    const totalSeason = document.getElementById('total_season');
    const totalChapter = document.getElementById('total_chapter');
    const totalVolume = document.getElementById('total_volume');
    const modalTitle = document.getElementById('modalTitle');
    const mediaTableBody = document.getElementById('mediaTableBody');

    const genreToggle = document.getElementById('genreToggle');
    const genreCheckboxes = document.getElementById('genreCheckboxes');

    function toggleDetailFields(type) {
        // DRAMA
        dramaFields.style.display = type === 'drama' ? 'block' : 'none';
        dramaFields.querySelectorAll('input').forEach(input => {
            input.disabled = type !== 'drama';
        });

        // MANHWA
        manhwaFields.style.display = type === 'manhwa' ? 'block' : 'none';
        manhwaFields.querySelectorAll('input').forEach(input => {
            input.disabled = type !== 'manhwa';
        });
    }


    typeSelect.addEventListener('change', function () {
        toggleDetailFields(this.value);

        totalEpisode.required = false;
        totalSeason.required = false;
        totalChapter.required = false;
        totalVolume.required = false;

        if (this.value === 'drama') {
            totalEpisode.required = true;
            totalSeason.required = true;
        }

        if (this.value === 'manhwa') {
            totalChapter.required = true;
            totalVolume.required = true;
        }
    });


    // ===== GENRE DROPDOWN =====
    if (genreToggle && genreCheckboxes) {
        genreToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            genreCheckboxes.classList.toggle('show');
            if (genreCheckboxes.classList.contains('show')) {
                document.addEventListener('click', closeDropdown);
            } else {
                document.removeEventListener('click', closeDropdown);
            }
        });

        function closeDropdown(e) {
            if (!genreCheckboxes.contains(e.target) && !genreToggle.contains(e.target)) {
                genreToggle.classList.remove('active');
                genreCheckboxes.classList.remove('show');
                document.removeEventListener('click', closeDropdown);
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && genreCheckboxes.classList.contains('show')) {
                genreToggle.classList.remove('active');
                genreCheckboxes.classList.remove('show');
                document.removeEventListener('click', closeDropdown);
            }
        });

        document.querySelectorAll('#genreCheckboxes input[type="checkbox"]').forEach(cb => {
            cb.addEventListener('change', function() {
                const checked = Array.from(document.querySelectorAll('#genreCheckboxes input[type="checkbox"]:checked'))
                    .map(cb => cb.closest('.genre-option').textContent.trim());
                const placeholder = document.querySelector('.genre-placeholder');
                placeholder.textContent = checked.length > 0 ? checked.join(', ') : 'Pilih genre...';
            });
        });
    }

    // ===== EDIT & DELETE =====
    function attachRowEvents(row) {
        const editBtn = row.querySelector('.btn-edit');
        const deleteBtn = row.querySelector('.btn-delete');

        // EDIT
        editBtn?.addEventListener('click', function() {
            const id = this.getAttribute('data-id');

            fetch(`/admin/media-admin/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('mediaId').value = data.media.id;
                    document.getElementById('title').value = data.media.title;
                    document.getElementById('type').value = data.media.type;
                    document.getElementById('release_year').value = data.media.release_year;
                    document.getElementById('poster').value = data.media.poster ?? '';
                    document.getElementById('synopsis').value = data.media.synopsis ?? '';
                    
                    // ===== SET STATUS =====
                    document.getElementById('status').value = data.media.status || 'ongoing';

                    // Set genre
                    const ids = data.media.genres.map(g => g.id);
                    document.querySelectorAll('#genreCheckboxes input[type=checkbox]').forEach(cb => {
                        cb.checked = ids.includes(parseInt(cb.value));
                    });

                    // Update text genre di toggle
                    const placeholder = document.querySelector('.genre-placeholder');
                    placeholder.textContent = data.media.genres.length
                        ? data.media.genres.map(g => g.name).join(', ')
                        : 'Pilih genre...';


                    modalTitle.textContent = 'Edit Media';
                    mediaModal.classList.add('active');

                    // Tambahkan _method PUT jika belum ada
                    if (!mediaForm.querySelector('input[name="_method"]')) {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        mediaForm.appendChild(methodInput);
                    }

                    // Action update
                    mediaForm.action = `/admin/media-admin/${id}`;

                    toggleDetailFields(data.media.type);
                    typeSelect.dispatchEvent(new Event('change'));

                    // RESET VALUE BIAR GAK NYANGKUT
                    document.getElementById('total_episode').value = '';
                    document.getElementById('total_season').value = '';
                    document.getElementById('total_chapter').value = '';
                    document.getElementById('total_volume').value = '';

                    if (data.media.type === 'drama' && data.media.drama_detail) {
                        document.getElementById('total_episode').value =
                            data.media.drama_detail.total_episode ?? '';
                        document.getElementById('total_season').value =
                            data.media.drama_detail.total_season ?? '';
                    }

                    if (data.media.type === 'manhwa' && data.media.manhwa_detail) {
                        document.getElementById('total_chapter').value =
                            data.media.manhwa_detail.total_chapter ?? '';
                        document.getElementById('total_volume').value =
                            data.media.manhwa_detail.total_volume ?? '';
                    }
                });
        });

        // DELETE
        deleteBtn?.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            if (confirm('Apakah Anda yakin ingin menghapus media ini?')) {
                fetch(`/admin/media-admin/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                })
                .then(res => res.json())
                .then(res => {
                    if(res.success) {
                        row.remove();
                    } else {
                        alert('Gagal menghapus media.');
                    }
                });
            }
        });
    }

    document.querySelectorAll('#mediaTableBody tr').forEach(attachRowEvents);

    // ===== FILTER & SORT =====
    const typeFilter = document.getElementById('typeFilter');
    const sortFilter = document.getElementById('sortFilter');

    function applyFilters() {
        const typeValue = typeFilter.value;
        const sortValue = sortFilter.value;
        const allRows = Array.from(mediaTableBody.querySelectorAll('tr'));

        // Filter dengan display
        allRows.forEach(row => {
            const rowType = row.getAttribute('data-type');
            const match = typeValue === 'all' || rowType === typeValue;
            row.style.display = match ? '' : 'none';
        });

        // Ambil row yang visible untuk sort
        const visibleRows = allRows.filter(row => row.style.display !== 'none');

        visibleRows.sort((a, b) => {
            if (sortValue === 'newest') return parseInt(b.children[0].textContent) - parseInt(a.children[0].textContent);
            if (sortValue === 'oldest') return parseInt(a.children[0].textContent) - parseInt(b.children[0].textContent);
            if (sortValue === 'title') return a.children[1].textContent.localeCompare(b.children[1].textContent);
            return 0;
        });

        // Re-append visible row untuk urutkan
        visibleRows.forEach(row => mediaTableBody.appendChild(row));
    }

    typeFilter.addEventListener('change', applyFilters);
    sortFilter.addEventListener('change', applyFilters);

    // Jalankan sekali saat load
    applyFilters();

    // ===== FUNCTION RESET GENRE =====
    function resetGenreState() {
        document.querySelectorAll('#genreCheckboxes input[type="checkbox"]').forEach(cb => {
            cb.checked = false;
        });
        document.querySelector('.genre-placeholder').textContent = 'Pilih genre...';
    }

    // ===== FINAL VALIDATION SAAT SUBMIT =====
    mediaForm.addEventListener('submit', function (e) {
        // VALIDASI GENRE
        const checkedGenres = document.querySelectorAll('#genreCheckboxes input[type="checkbox"]:checked');
        if (checkedGenres.length === 0) {
            e.preventDefault();
            alert('Minimal pilih 1 genre');
            return;
        }

        const type = typeSelect.value;

        // VALIDASI TIPE
        if (!type) {
            e.preventDefault();
            alert('Tipe media wajib dipilih');
            return;
        }

        // VALIDASI DRAMA
        if (type === 'drama') {
            if (!totalEpisode.value || !totalSeason.value) {
                e.preventDefault();
                alert('Total episode dan total season wajib diisi');
                return;
            }
        }

        // VALIDASI MANHWA
        if (type === 'manhwa') {
            if (!totalChapter.value || !totalVolume.value) {
                e.preventDefault();
                alert('Total chapter dan total volume wajib diisi');
                return;
            }
        }
    });

    // ===== OPEN MODAL TAMBAH =====
    openAddModalBtn.addEventListener('click', () => {
        // Reset form standar
        mediaForm.reset();
        document.getElementById('mediaId').value = '';

        // RESET GENRE (ANTI BOCOR STATE)
        resetGenreState();

        // Reset status default
        document.getElementById('status').value = 'ongoing';

        // Reset form action (ADD)
        mediaForm.action = "{{ route('admin.media.store') }}";

        // Hapus _method PUT jika ada
        const existingMethod = mediaForm.querySelector('input[name="_method"]');
        if (existingMethod) existingMethod.remove();

        toggleDetailFields('');

        modalTitle.textContent = 'Tambah Media Baru';
        mediaModal.classList.add('active');
    });

    // ===== CLOSE MODAL =====
    function closeModal() {
        mediaModal.classList.remove('active');

        // RESET GENRE BIAR EDIT TIDAK NYANGKUT
        resetGenreState();
    }

    closeModalBtn.addEventListener('click', closeModal);
    mediaModal.addEventListener('click', e => {
        if (e.target === mediaModal) closeModal();
    });
});
</script>
@endpush