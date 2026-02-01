@extends('layouts.adminside')

@section('title', 'Kelola Genre')

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
    transform: none;
}

.media-table tbody tr:last-child td {
    border-bottom: none;
}

/* ===== BADGES ===== */
.badge-in-use {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
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

.btn-delete:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-delete:disabled:hover {
    background: rgba(239, 68, 68, 0.15);
}

/* ===== TOOLTIP ===== */
.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltip-text {
    visibility: hidden;
    width: 220px;
    background-color: #1f2937;
    color: #fca5a5;
    text-align: center;
    border-radius: 6px;
    padding: 8px;
    position: absolute;
    z-index: 9999;
    bottom: 125%;
    right: 0;
    left: auto;
    transform: translateX(-18%);
    margin-left: -110px;
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 13px;
    border: 1px solid #ef4444;
    white-space: normal;
    pointer-events: none;
}

.tooltip:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
}

.tooltip .tooltip-text::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #1f2937 transparent transparent transparent;
}

/* ===== FIX TOOLTIP TABLE ===== */
.media-table td {
    overflow: visible;
}

.action-buttons {
    position: relative;
    overflow: visible;
}

.tooltip {
    position: relative;
    overflow: visible;
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
    max-width: 500px;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
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
    overflow-y: auto;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

#genreForm {
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
    .media-table td:nth-child(2)::before { content: "Nama Genre"; }
    .media-table td:nth-child(3)::before { content: "Jumlah Media"; }
    .media-table td:nth-child(4)::before { content: "Aksi"; }
    
    .list-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn-add {
        align-self: stretch;
        width: 100%;
    }
    
    .modal-content {
        width: 95%;
        max-width: 450px;
    }
}
</style>
@endpush

@section('content')
{{-- HEADER --}}
<div class="list-header">
    <div>
        <h1>Kelola Genre</h1>
        <p id="genreCount">{{ $genres->count() }} genre • Kelola master data genre untuk media</p>
    </div>
    <button class="btn-add" id="openAddModal">
        <i class="bi bi-plus-circle"></i> Tambah Genre
    </button>
</div>

{{-- GENRE TABLE --}}
<div class="media-table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Genre</th>
                <th>Jumlah Media</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="genreTableBody">
            @foreach ($genres as $genre)
            <tr data-id="{{ $genre->id }}">
                <td>{{ $genre->id }}</td>
                <td>{{ $genre->name }}</td>
                <td>
                    @if($genre->media_count > 0)
                        <span class="badge-in-use">{{ $genre->media_count }} media</span>
                    @else
                        <span style="color: #6b7280;">0 media</span>
                    @endif
                </td>
                <td class="action-cell">
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" data-id="{{ $genre->id }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>

                        <div class="tooltip">
                            <button class="btn-action btn-delete {{ $genre->media_count > 0 ? 'disabled' : '' }}" 
                                    data-id="{{ $genre->id }}" 
                                    {{ $genre->media_count > 0 ? 'disabled' : '' }}>
                                <i class="bi bi-trash"></i> Hapus
                            </button>

                            @if($genre->media_count > 0)
                                <span class="tooltip-text">
                                    Digunakan {{ $genre->media_count }} media
                                </span>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL TAMBAH/EDIT GENRE --}}
<div class="modal" id="genreModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah Genre Baru</h2>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="genreForm" action="{{ route('admin.genre.store') }}" method="POST">
                @csrf
                <input type="hidden" id="genreId" name="id">
                
                <div class="form-group">
                    <label for="name">Nama Genre <span style="color:#ef4444">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" 
                           placeholder="Contoh: Romance, Action, Fantasy" required>
                    <small style="color: #9ca3af; font-size: 12px; display: block; margin-top: 4px;">
                        Nama genre harus unik dan minimal 2 karakter
                    </small>
                </div>
                
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Simpan Genre
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const openAddModalBtn = document.getElementById('openAddModal');
    const closeModalBtn = document.getElementById('closeModal');
    const genreModal = document.getElementById('genreModal');
    const genreForm = document.getElementById('genreForm');
    const modalTitle = document.getElementById('modalTitle');
    const nameInput = document.getElementById('name');
    const genreIdInput = document.getElementById('genreId');
    const genreTableBody = document.getElementById('genreTableBody');

    // Close modal function
    function closeModal() {
        genreModal.classList.remove('active');
        genreForm.reset();
        genreIdInput.value = '';
        
        // Remove PUT method input if exists
        const methodInput = genreForm.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();
    }

    // Open Add Modal
    openAddModalBtn.addEventListener('click', () => {
        modalTitle.textContent = 'Tambah Genre Baru';
        genreForm.action = "{{ route('admin.genre.store') }}";
        closeModalBtn.focus();
        genreModal.classList.add('active');
        
        // Ensure no PUT method
        const methodInput = genreForm.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();
    });

    // Close modal events
    closeModalBtn.addEventListener('click', closeModal);
    genreModal.addEventListener('click', (e) => {
        if (e.target === genreModal) closeModal();
    });

    // Edit Button Handler - LOAD DATA VIA AJAX (seperti kelola media)
    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            
            // Load data via AJAX (seperti kelola media)
            fetch(`/admin/genre-admin/${id}`)
                .then(res => res.json())
                .then(data => {
                    // Set modal for edit
                    modalTitle.textContent = 'Edit Genre';
                    genreIdInput.value = data.genre.id;
                    nameInput.value = data.genre.name;
                    genreForm.action = `/admin/genres/${id}`;
                    
                    // Add PUT method spoofing
                    let methodInput = genreForm.querySelector('input[name="_method"]');
                    if (!methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        genreForm.appendChild(methodInput);
                    }
                    
                    genreModal.classList.add('active');
                    nameInput.focus();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data genre');
                });
        });
    });

    // Delete Button Handler - AJAX (seperti kelola media)
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            if (this.disabled) return;
            
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');
            const genreName = row.querySelector('td:nth-child(2)').textContent;
            
            if (confirm(`Yakin ingin menghapus genre "${genreName}"?`)) {
                fetch(`/admin/genre-admin/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus row langsung dari DOM (seperti kelola media)
                        row.remove();
                        
                        // Update counter
                        const countEl = document.getElementById('genreCount');
                        const currentCount = parseInt(countEl.textContent);
                        countEl.textContent = `${currentCount - 1} genre • Kelola master data genre untuk media`;
                    } else {
                        alert(data.message || 'Gagal menghapus genre');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus genre');
                });
            }
        });
    });

    // Reset form saat modal ditutup
    closeModalBtn.addEventListener('click', function() {
        genreForm.reset();
    });
});
</script>
@endpush