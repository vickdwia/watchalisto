@extends('layouts.adminside')

@section('title', 'Kelola User')

@push('styles')
<style>
/* ===== SUMMARY CARDS ===== */
.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}

.summary-card {
    background: rgba(17, 25, 40, 0.7);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.summary-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    border-color: rgba(255,255,255,.12);
}

.summary-card h3 {
    font-size: 32px;
    font-weight: 800;
    margin: 0;
    background: linear-gradient(135deg, #14b8a6, #38bdf8);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.summary-card p {
    font-size: 14px;
    color: #9ca3af;
    margin: 0;
    font-weight: 500;
}

.summary-card .icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.summary-card:nth-child(1) .icon {
    background: rgba(20, 184, 166, 0.15);
    color: #14b8a6;
}

.summary-card:nth-child(2) .icon {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
}

.summary-card:nth-child(3) .icon {
    background: rgba(168, 85, 247, 0.15);
    color: #a855f7;
}

/* ===== USER TABLE ===== */
.user-table-container {
    background: rgba(17, 25, 40, 0.7);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
}

.user-table-container h2 {
    font-size: 22px;
    font-weight: 700;
    color: #e5e7eb;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-table-container h2 i {
    color: #14b8a6;
}

.user-table {
    width: 100%;
    border-collapse: collapse;
}

.user-table thead {
    background: rgba(20, 184, 166, 0.15);
    border-bottom: 2px solid rgba(20, 184, 166, 0.3);
}

.user-table th {
    padding: 16px 20px;
    text-align: left;
    font-weight: 700;
    color: #14b8a6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.user-table td {
    padding: 14px 20px;
    border-top: 1px solid rgba(255,255,255,.08);
    color: #cbd5f5;
    font-size: 14px;
}

.user-table tbody tr {
    transition: all 0.2s ease;
}

.user-table tbody tr:hover {
    background: rgba(20, 184, 166, 0.08);
}

.user-table tbody tr:last-child td {
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

.badge-active {
    background: rgba(34, 197, 94, 0.15);
    color: #22c55e;
}

.badge-inactive {
    background: rgba(156, 163, 175, 0.15);
    color: #9ca3af;
}

.badge-admin {
    background: rgba(249, 115, 22, 0.15);
    color: #f97316;
}

/* ===== AVATAR ===== */
.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #14b8a6, #38bdf8);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
    color: white;
    flex-shrink: 0;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .summary-grid {
        grid-template-columns: 1fr;
    }
    
    .user-table {
        display: block;
        overflow-x: auto;
    }
    
    .user-table thead,
    .user-table tbody,
    .user-table tr,
    .user-table td,
    .user-table th {
        display: block;
    }
    
    .user-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }
    
    .user-table tr {
        margin-bottom: 16px;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 12px;
        background: rgba(17, 25, 40, 0.7);
    }
    
    .user-table td {
        border: none;
        position: relative;
        padding-left: 50%;
        text-align: left;
    }
    
    .user-table td::before {
        position: absolute;
        left: 16px;
        width: 45%;
        padding-right: 10px;
        white-space: nowrap;
        font-weight: 600;
        color: #14b8a6;
    }
    
    .user-table td:nth-child(1)::before { content: "ID"; }
    .user-table td:nth-child(2)::before { content: "User"; }
    .user-table td:nth-child(3)::before { content: "Email"; }
    .user-table td:nth-child(4)::before { content: "Role"; }
    .user-table td:nth-child(5)::before { content: "Status"; }
    .user-table td:nth-child(6)::before { content: "Media"; }
    .user-table td:nth-child(7)::before { content: "Join"; }
}
</style>
@endpush

@section('content')
{{-- ===== A. SUMMARY CARDS ===== --}}
<div class="summary-grid">
    {{-- Card 1: Total User Aktif --}}
    <div class="summary-card">
        <div class="icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <h3>{{ $totalActiveUsers }}</h3>
        <p>Total User Aktif</p>
    </div>

    {{-- Card 2: User Baru Minggu Ini --}}
    <div class="summary-card">
        <div class="icon">
            <i class="bi bi-person-plus-fill"></i>
        </div>
        <h3>{{ $newUsersThisWeek }}</h3>
        <p>User Baru Minggu Ini</p>
    </div>

    {{-- Card 3: Rata-rata Media per User --}}
    <div class="summary-card">
        <div class="icon">
            <i class="bi bi-graph-up-arrow"></i>
        </div>
        <h3>{{ number_format($avgMediaPerUser, 1) }}</h3>
        <p>Rata-rata Media per User</p>
    </div>
</div>

{{-- ===== B. TABEL DAFTAR USER ===== --}}
<div class="user-table-container">
    <h2><i class="bi bi-list-ul"></i> Daftar User</h2>
    
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Media</th>
                <th>Join Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span>{{ $user->name }}</span>
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->media_count ?? 0 }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 40px; color: #9ca3af;">
                    <i class="bi bi-inbox" style="font-size: 48px; margin-bottom: 12px;"></i>
                    <p>Belum ada user terdaftar</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection