<x-admin-layout>
@section('header', 'Gestion des Sessions')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; }
    body, .admin-content { font-family: 'DM Sans', sans-serif; background: #f5f6fa; color: #1a1d23; }

    .page-wrapper { padding: 24px 20px; max-width: 1200px; margin: 0 auto; }

    /* ── Alert ── */
    .alert-success-custom {
        background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46;
        border-radius: 10px; padding: 12px 16px; font-size: 0.88rem;
        display: flex; align-items: center; gap: 8px; margin-bottom: 20px;
    }

    /* ── Page Header ── */
    .page-header {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 16px;
        margin-bottom: 22px; flex-wrap: wrap;
    }
    .page-title { font-size: 1.55rem; font-weight: 700; color: #1a1d23; letter-spacing: -0.3px; }
    .page-meta  { font-size: 0.8rem; color: #9499a8; margin-top: 3px; }

    .header-actions { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

    .btn-toolbar {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 14px; border-radius: 10px; font-size: 0.83rem; font-weight: 500;
        cursor: pointer; border: 1px solid #e5e7eb; background: #fff;
        color: #4b5563; text-decoration: none; transition: all 0.18s; white-space: nowrap;
    }
    .btn-toolbar:hover { background: #f9fafb; border-color: #d1d5db; color: #1a1d23; }
    .btn-toolbar svg { width: 14px; height: 14px; flex-shrink: 0; }
    .btn-primary-action {
        background: #4F6EF7; color: #fff !important; border-color: #4F6EF7; font-weight: 600;
    }
    .btn-primary-action:hover {
        background: #3a57e8 !important; border-color: #3a57e8; color: #fff !important;
        box-shadow: 0 4px 14px rgba(79,110,247,.35); transform: translateY(-1px);
    }

    /* ── Stats Row ── */
    .stats-row {
        display: grid; grid-template-columns: repeat(4, 1fr);
        gap: 14px; margin-bottom: 22px;
    }
    .stat-card {
        background: #fff; border-radius: 14px; padding: 16px 18px;
        border: 1.5px solid #f0f1f5; display: flex; align-items: center; gap: 14px;
        transition: all 0.18s;
    }
    .stat-card:hover { border-color: #d4d8ff; box-shadow: 0 4px 14px rgba(79,110,247,.08); }
    .stat-icon {
        width: 42px; height: 42px; border-radius: 11px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .stat-icon svg { width: 20px; height: 20px; }
    .stat-label { font-size: 0.72rem; color: #9499a8; text-transform: uppercase; letter-spacing: 0.4px; }
    .stat-value { font-size: 1.35rem; font-weight: 700; color: #1a1d23; line-height: 1.1; }

    /* ── Table Card ── */
    .table-card {
        background: #fff; border-radius: 18px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06); overflow: hidden;
    }
    .table-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 20px; border-bottom: 1px solid #f0f1f5; flex-wrap: wrap; gap: 10px;
    }
    .table-card-title { font-size: 0.9rem; font-weight: 700; color: #1a1d23; }
    .search-box {
        display: flex; align-items: center; gap: 8px;
        background: #f5f6fa; border: 1.5px solid #f0f1f5;
        border-radius: 9px; padding: 7px 12px;
        transition: border-color 0.18s; min-width: 200px;
    }
    .search-box:focus-within { border-color: #4F6EF7; background: #fff; }
    .search-box svg { color: #9499a8; width: 14px; height: 14px; flex-shrink: 0; }
    .search-box input {
        border: none; outline: none; font-family: 'DM Sans', sans-serif;
        font-size: 0.83rem; color: #1a1d23; background: transparent; width: 100%;
    }
    .search-box input::placeholder { color: #c1c5cf; }

    /* Desktop table */
    .table-responsive-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    table { width: 100%; border-collapse: collapse; min-width: 700px; }
    thead { background: #f9fafb; border-bottom: 1px solid #f0f1f5; }
    thead th {
        padding: 12px 18px; font-size: 0.72rem; font-weight: 600;
        color: #9499a8; text-transform: uppercase; letter-spacing: 0.5px; white-space: nowrap;
    }
    tbody tr { border-bottom: 1px solid #f5f6fa; transition: background 0.15s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #fafbff; }
    tbody td { padding: 13px 18px; font-size: 0.86rem; color: #374151; vertical-align: middle; }

    /* Formation cell */
    .formation-cell { display: flex; align-items: center; gap: 10px; }
    .f-icon {
        width: 34px; height: 34px; border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .f-name { font-weight: 600; color: #1a1d23; font-size: 0.88rem; }

    /* Date cell */
    .date-range {
        display: flex; align-items: center; gap: 6px; font-size: 0.82rem; color: #374151;
    }
    .date-range .arrow { color: #c1c5cf; }

    /* Lieu */
    .lieu-cell { display: flex; align-items: center; gap: 5px; color: #6b7280; font-size: 0.82rem; }
    .lieu-cell svg { width: 13px; height: 13px; flex-shrink: 0; color: #9499a8; }

    /* Capacity bar */
    .capacity-wrap { display: flex; flex-direction: column; gap: 4px; min-width: 80px; }
    .capacity-bar-bg { height: 5px; background: #f0f1f5; border-radius: 99px; overflow: hidden; }
    .capacity-bar-fill { height: 100%; border-radius: 99px; transition: width 0.3s; }
    .capacity-label { font-size: 0.72rem; color: #9499a8; }

    /* ID badge */
    .id-badge {
        font-family: 'Courier New', monospace; font-size: 0.74rem;
        color: #9499a8; background: #f5f6fa; padding: 3px 7px; border-radius: 6px;
    }

    /* Status badge */
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 11px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; white-space: nowrap;
    }
    .status-badge .dot { width: 6px; height: 6px; border-radius: 50%; }
    .badge-ouverte { background: #f0fdf4; color: #16a34a; }
    .badge-ouverte .dot { background: #16a34a; }
    .badge-fermee  { background: #fef2f2; color: #dc2626; }
    .badge-fermee .dot  { background: #dc2626; }

    /* Inscriptions */
    .inscriptions-cell { display: flex; align-items: center; gap: 6px; }
    .ins-count { font-weight: 700; font-size: 0.9rem; color: #1a1d23; }
    .ins-label { font-size: 0.74rem; color: #9499a8; }

    /* Actions */
    .actions-cell { display: flex; align-items: center; gap: 6px; }
    .btn-action {
        width: 32px; height: 32px; border-radius: 8px; border: none; cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        transition: all 0.18s; text-decoration: none; flex-shrink: 0;
    }
    .btn-action svg { width: 14px; height: 14px; }
    .btn-edit   { background: #eff3ff; color: #4F6EF7; }
    .btn-edit:hover   { background: #4F6EF7; color: #fff; }
    .btn-delete { background: #fef2f2; color: #dc2626; }
    .btn-delete:hover { background: #dc2626; color: #fff; }

    /* Empty state */
    .empty-state { text-align: center; padding: 60px 20px; color: #9499a8; }
    .empty-state svg { width: 44px; height: 44px; opacity: 0.25; margin: 0 auto 10px; display: block; }

    /* Pagination */
    .pagination-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 14px 20px; border-top: 1px solid #f0f1f5;
        font-size: 0.8rem; color: #9499a8; flex-wrap: wrap; gap: 10px;
    }
    .pagination-btns { display: flex; gap: 4px; }
    .page-btn {
        min-width: 32px; height: 32px; border-radius: 8px; border: 1px solid #e5e7eb;
        background: #fff; color: #4b5563; font-size: 0.8rem; cursor: pointer;
        display: inline-flex; align-items: center; justify-content: center;
        padding: 0 8px; transition: all 0.15s; text-decoration: none;
    }
    .page-btn:hover { border-color: #4F6EF7; color: #4F6EF7; }
    .page-btn.active { background: #4F6EF7; color: #fff; border-color: #4F6EF7; }

    /* ── Mobile Cards ── */
    .mobile-cards { display: none; }
    .session-card {
        padding: 16px; border-bottom: 1px solid #f5f6fa; transition: background 0.15s;
    }
    .session-card:last-child { border-bottom: none; }
    .session-card:hover { background: #fafbff; }
    .sc-top { display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
    .sc-left { display: flex; align-items: center; gap: 10px; flex: 1; min-width: 0; }
    .sc-name { font-weight: 600; font-size: 0.9rem; color: #1a1d23; }
    .sc-lieu { font-size: 0.75rem; color: #9499a8; margin-top: 2px; }
    .sc-meta { display: flex; gap: 8px; margin-top: 10px; flex-wrap: wrap; align-items: center; }
    .sc-actions { display: flex; gap: 6px; flex-shrink: 0; }

    /* ══════════════════════
       RESPONSIVE
    ══════════════════════ */
    @media (max-width: 1024px) {
        .stats-row { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .page-wrapper { padding: 16px 14px; }
        .page-title { font-size: 1.3rem; }
        .stats-row { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .stat-card { padding: 13px 14px; }
        .stat-value { font-size: 1.15rem; }
    }

    @media (max-width: 640px) {
        .page-header { flex-direction: column; align-items: stretch; }
        .header-actions { justify-content: flex-start; }
        .table-responsive-wrap { display: none; }
        .mobile-cards { display: block; }
        .table-card-header { flex-direction: column; align-items: stretch; }
        .search-box { min-width: 0; }
        .stats-row { grid-template-columns: 1fr 1fr; }
        .pagination-row { flex-direction: column; align-items: flex-start; }
    }

    @media (max-width: 400px) {
        .stats-row { grid-template-columns: 1fr; }
        .stat-card { padding: 12px; }
    }
</style>

@php
    $colors  = ['#4F6EF7','#f59e0b','#10b981','#ef4444','#8b5cf6','#06b6d4','#ec4899'];
    $total   = $sessions->count();
    $ouvertes = $sessions->where('statut','ouverte')->count();
    $fermees  = $sessions->where('statut','fermee')->count();
    $totalIns = $sessions->sum(fn($s) => $s->inscriptions->count());
@endphp

<div class="page-wrapper">

    @if(session('success'))
    <div class="alert-success-custom">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @include('partials.alerts')

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <div class="page-title">Sessions</div>
            <div class="page-meta">{{ $total }} sessions au total</div>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-toolbar">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.create-session') }}" class="btn-toolbar btn-primary-action">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Nouvelle Session
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff3ff;">
                <svg fill="none" stroke="#4F6EF7" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <div class="stat-label">Total Sessions</div>
                <div class="stat-value">{{ $total }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdf4;">
                <svg fill="none" stroke="#16a34a" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="stat-label">Ouvertes</div>
                <div class="stat-value" style="color:#16a34a;">{{ $ouvertes }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef2f2;">
                <svg fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <div class="stat-label">Fermées</div>
                <div class="stat-value" style="color:#dc2626;">{{ $fermees }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef3c7;">
                <svg fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <div>
                <div class="stat-label">Inscriptions</div>
                <div class="stat-value" style="color:#f59e0b;">{{ $totalIns }}</div>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="table-card">
        <div class="table-card-header">
            <div class="table-card-title">Liste des Sessions</div>
            <div class="search-box">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/></svg>
                <input type="text" id="searchInput" placeholder="Rechercher...">
            </div>
        </div>

        {{-- Desktop table --}}
        <div class="table-responsive-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Formation</th>
                        <th>Période</th>
                        <th>Lieu</th>
                        <th>Capacité</th>
                        <th>Statut</th>
                        <th>Inscrits</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($sessions as $session)
                    @php
                        $idx    = $loop->index;
                        $color  = $colors[$idx % count($colors)];
                        $title  = $session->formation->titre ?? '—';
                        $letter = strtoupper(substr($title, 0, 1));
                        $ins    = $session->inscriptions->count();
                        $cap    = $session->capacite ?: 1;
                        $pct    = min(100, round(($ins / $cap) * 100));
                        $barColor = $pct >= 80 ? '#ef4444' : ($pct >= 50 ? '#f59e0b' : '#10b981');
                    @endphp
                    <tr data-search="{{ strtolower($title . ' ' . $session->lieu) }}">
                        <td><span class="id-badge">#{{ str_pad($session->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                        <td>
                            <div class="formation-cell">
                                <div class="f-icon" style="background:{{ $color }}">{{ $letter }}</div>
                                <span class="f-name">{{ Str::limit($title, 28) }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="date-range">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="13" height="13" style="color:#9499a8;flex-shrink:0;"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ optional($session->date_debut)->format('d/m/Y') ?? '—' }}
                                <span class="arrow">→</span>
                                {{ optional($session->date_fin)->format('d/m/Y') ?? '—' }}
                            </div>
                        </td>
                        <td>
                            <div class="lieu-cell">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $session->lieu ?? '—' }}
                            </div>
                        </td>
                        <td>
                            <div class="capacity-wrap">
                                <div class="capacity-bar-bg">
                                    <div class="capacity-bar-fill" style="width:{{ $pct }}%; background:{{ $barColor }};"></div>
                                </div>
                                <div class="capacity-label">{{ $ins }}/{{ $session->capacite }}</div>
                            </div>
                        </td>
                        <td>
                            @php $sc = $session->statut === 'ouverte' ? 'badge-ouverte' : 'badge-fermee'; @endphp
                            <span class="status-badge {{ $sc }}">
                                <span class="dot"></span>
                                {{ ucfirst($session->statut) }}
                            </span>
                        </td>
                        <td>
                            <div class="inscriptions-cell">
                                <span class="ins-count">{{ $ins }}</span>
                                <span class="ins-label">inscrits</span>
                            </div>
                        </td>
                        <td>
                            <div class="actions-cell" style="justify-content:center;">
                                <a href="{{ route('admin.edit-session', $session->id) }}" class="btn-action btn-edit" title="Éditer">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828A2 2 0 0110 16H8v-2a2 2 0 01.586-1.414z"/></svg>
                                </a>
                                <form action="{{ route('admin.delete-session', $session->id) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Supprimer cette session ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Supprimer">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8">
                        <div class="empty-state">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p>Aucune session trouvée.</p>
                        </div>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile cards --}}
        <div class="mobile-cards" id="mobileCards">
            @forelse($sessions as $session)
            @php
                $idx    = $loop->index;
                $color  = $colors[$idx % count($colors)];
                $title  = $session->formation->titre ?? '—';
                $letter = strtoupper(substr($title, 0, 1));
                $ins    = $session->inscriptions->count();
                $sc     = $session->statut === 'ouverte' ? 'badge-ouverte' : 'badge-fermee';
            @endphp
            <div class="session-card" data-search="{{ strtolower($title . ' ' . $session->lieu) }}">
                <div class="sc-top">
                    <div class="sc-left">
                        <div class="f-icon" style="background:{{ $color }}; width:40px; height:40px; border-radius:10px; flex-shrink:0;">{{ $letter }}</div>
                        <div style="min-width:0;">
                            <div class="sc-name">{{ Str::limit($title, 30) }}</div>
                            <div class="sc-lieu">
                                {{ optional($session->date_debut)->format('d/m/Y') }} → {{ optional($session->date_fin)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="sc-actions">
                        <a href="{{ route('admin.edit-session', $session->id) }}" class="btn-action btn-edit">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828A2 2 0 0110 16H8v-2a2 2 0 01.586-1.414z"/></svg>
                        </a>
                        <form action="{{ route('admin.delete-session', $session->id) }}" method="POST"
                            style="display:inline;" onsubmit="return confirm('Supprimer ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="sc-meta">
                    <span class="id-badge">#{{ str_pad($session->id, 4, '0', STR_PAD_LEFT) }}</span>
                    <span class="status-badge {{ $sc }}"><span class="dot"></span>{{ ucfirst($session->statut) }}</span>
                    @if($session->lieu)
                    <span style="font-size:0.75rem;color:#9499a8;">📍 {{ $session->lieu }}</span>
                    @endif
                    <span style="font-size:0.75rem;color:#6b7280;">{{ $ins }} inscrits / {{ $session->capacite }}</span>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p>Aucune session trouvée.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($sessions instanceof \Illuminate\Pagination\LengthAwarePaginator && $sessions->total() > 0)
        <div class="pagination-row">
            <span>{{ $sessions->firstItem() }}–{{ $sessions->lastItem() }} sur {{ $sessions->total() }}</span>
            <div class="pagination-btns">
                @if($sessions->onFirstPage())
                    <span class="page-btn" style="opacity:.4;cursor:default;">← Préc.</span>
                @else
                    <a class="page-btn" href="{{ $sessions->previousPageUrl() }}">← Préc.</a>
                @endif
                @foreach($sessions->getUrlRange(1, $sessions->lastPage()) as $page => $url)
                    <a class="page-btn {{ $page == $sessions->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                @endforeach
                @if($sessions->hasMorePages())
                    <a class="page-btn" href="{{ $sessions->nextPageUrl() }}">Suiv. →</a>
                @else
                    <span class="page-btn" style="opacity:.4;cursor:default;">Suiv. →</span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const tableRows   = document.querySelectorAll('#tableBody tr[data-search]');
    const mobileCards = document.querySelectorAll('#mobileCards .session-card[data-search]');

    searchInput.addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        [...tableRows, ...mobileCards].forEach(el => {
            el.style.display = el.dataset.search.includes(q) ? '' : 'none';
        });
    });
</script>
</x-admin-layout>