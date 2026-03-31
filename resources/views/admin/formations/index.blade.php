<x-admin-layout>
@section('header', 'Gestion des Formations')

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
        margin-bottom: 8px; flex-wrap: wrap;
    }
    .page-title { font-size: 1.55rem; font-weight: 700; color: #1a1d23; letter-spacing: -0.3px; }
    .page-meta  { font-size: 0.8rem; color: #9499a8; margin-top: 3px; }

    /* ── Toolbar ── */
    .toolbar-row {
        display: flex; align-items: center; gap: 10px;
        margin-bottom: 24px; flex-wrap: wrap;
    }
    .search-box {
        display: flex; align-items: center; gap: 8px;
        background: #fff; border: 1.5px solid #e5e7eb;
        border-radius: 10px; padding: 8px 14px;
        flex: 1; min-width: 180px; max-width: 320px;
        transition: border-color 0.18s;
    }
    .search-box:focus-within { border-color: #4F6EF7; }
    .search-box svg { color: #9499a8; flex-shrink: 0; width: 15px; height: 15px; }
    .search-box input {
        border: none; outline: none; font-family: 'DM Sans', sans-serif;
        font-size: 0.85rem; color: #1a1d23; background: transparent; width: 100%;
    }
    .search-box input::placeholder { color: #c1c5cf; }

    .view-toggle {
        display: flex; gap: 4px;
        background: #f0f1f5; border-radius: 8px; padding: 3px;
    }
    .view-btn {
        width: 32px; height: 32px; border-radius: 6px; border: none;
        cursor: pointer; display: flex; align-items: center; justify-content: center;
        background: transparent; color: #9499a8; transition: all 0.18s;
    }
    .view-btn.active { background: #fff; color: #4F6EF7; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
    .view-btn svg { width: 15px; height: 15px; }

    .sort-select {
        display: flex; align-items: center; gap: 6px;
        font-size: 0.83rem; color: #6b7280;
    }
    .sort-select select {
        border: 1px solid #e5e7eb; border-radius: 8px; padding: 7px 10px;
        font-family: 'DM Sans', sans-serif; font-size: 0.83rem;
        background: #fff; cursor: pointer; outline: none;
    }

    .toolbar-right { display: flex; align-items: center; gap: 8px; margin-left: auto; }

    .btn-toolbar {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 14px; border-radius: 10px; font-size: 0.83rem; font-weight: 500;
        cursor: pointer; border: 1px solid #e5e7eb; background: #fff;
        color: #4b5563; text-decoration: none; transition: all 0.18s; white-space: nowrap;
    }
    .btn-toolbar:hover { background: #f9fafb; border-color: #d1d5db; }
    .btn-toolbar svg { width: 14px; height: 14px; flex-shrink: 0; }
    .btn-primary-action {
        background: #4F6EF7; color: #fff; border-color: #4F6EF7; font-weight: 600;
    }
    .btn-primary-action:hover {
        background: #3a57e8; border-color: #3a57e8; color: #fff;
        box-shadow: 0 4px 14px rgba(79,110,247,.35); transform: translateY(-1px);
    }

    .count-label { font-size: 0.82rem; color: #9499a8; margin-bottom: 18px; }

    /* ── Formation Grid ── */
    .formation-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    /* ── Formation Card ── */
    .formation-card {
        background: #fff;
        border-radius: 16px;
        border: 1.5px solid #f0f1f5;
        padding: 20px;
        transition: all 0.2s ease;
        position: relative;
        overflow: hidden;
    }
    .formation-card:hover {
        border-color: #d4d8ff;
        box-shadow: 0 8px 28px rgba(79,110,247,0.10);
        transform: translateY(-3px);
    }

    /* Accent top bar */
    .formation-card::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, #4F6EF7, #06b6d4);
        opacity: 0;
        transition: opacity 0.2s;
    }
    .formation-card:hover::before { opacity: 1; }

    /* Card top row */
    .card-top {
        display: flex; align-items: flex-start;
        justify-content: space-between; gap: 10px; margin-bottom: 14px;
    }
    .card-icon {
        width: 46px; height: 46px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; flex-shrink: 0;
        background: #eff3ff; color: #4F6EF7;
        font-weight: 700;
    }
    .card-badge-group { display: flex; flex-direction: column; align-items: flex-end; gap: 5px; }

    /* Niveau badge */
    .niveau-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 20px;
        font-size: 0.72rem; font-weight: 600; white-space: nowrap;
    }
    .niveau-debutant    { background: #f0fdf4; color: #16a34a; }
    .niveau-intermediaire { background: #eff6ff; color: #2563eb; }
    .niveau-avance      { background: #fef2f2; color: #dc2626; }
    .niveau-default     { background: #f5f6fa; color: #6b7280; }
    .niveau-badge .dot  { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }

    /* Rating */
    .rating-badge {
        display: inline-flex; align-items: center; gap: 3px;
        background: #fef3c7; color: #b45309;
        padding: 3px 9px; border-radius: 20px;
        font-size: 0.72rem; font-weight: 700;
    }

    /* Card body */
    .card-title {
        font-size: 1rem; font-weight: 700; color: #1a1d23;
        margin-bottom: 4px; line-height: 1.3;
    }
    .card-sub {
        font-size: 0.78rem; color: #9499a8; margin-bottom: 14px;
    }

    /* Stats row */
    .card-stats {
        display: grid; grid-template-columns: 1fr 1fr 1fr;
        gap: 8px; padding: 12px 0;
        border-top: 1px solid #f0f1f5;
        border-bottom: 1px solid #f0f1f5;
        margin-bottom: 14px;
    }
    .stat-item { display: flex; flex-direction: column; gap: 2px; }
    .stat-label { font-size: 0.68rem; color: #9499a8; text-transform: uppercase; letter-spacing: 0.4px; }
    .stat-value { font-size: 0.9rem; font-weight: 700; color: #1a1d23; }
    .stat-value.blue  { color: #4F6EF7; }
    .stat-value.green { color: #10b981; }
    .stat-value.amber { color: #f59e0b; }

    /* Formateurs avatars */
    .formateur-row {
        display: flex; align-items: center; gap: 8px; margin-bottom: 14px;
    }
    .formateur-avatars { display: flex; }
    .fa-avatar {
        width: 26px; height: 26px; border-radius: 50%;
        border: 2px solid #fff; margin-left: -6px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .fa-avatar:first-child { margin-left: 0; }
    .formateur-label { font-size: 0.75rem; color: #9499a8; }

    /* Card actions */
    .card-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
    .btn-card {
        display: inline-flex; align-items: center; justify-content: center; gap: 5px;
        padding: 8px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 600;
        cursor: pointer; border: none; text-decoration: none; transition: all 0.18s;
    }
    .btn-card svg { width: 13px; height: 13px; }
    .btn-card-edit   { background: #eff3ff; color: #4F6EF7; }
    .btn-card-edit:hover { background: #4F6EF7; color: #fff; }
    .btn-card-delete { background: #fef2f2; color: #dc2626; }
    .btn-card-delete:hover { background: #dc2626; color: #fff; }

    /* ── Empty State ── */
    .empty-state {
        grid-column: 1 / -1; text-align: center;
        padding: 60px 20px; color: #9499a8;
    }
    .empty-state svg { width: 48px; height: 48px; opacity: 0.25; margin-bottom: 12px; display: block; margin-inline: auto; }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 1024px) {
        .formation-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .page-wrapper  { padding: 16px 14px; }
        .page-title    { font-size: 1.3rem; }
        .toolbar-row   { gap: 8px; }
        .search-box    { max-width: 100%; }
        .view-toggle   { display: none; }
        .sort-select span { display: none; }
        .btn-label     { display: none; }
        .btn-toolbar   { padding: 8px 10px; }
        .formation-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    }

    @media (max-width: 540px) {
        .page-header   { flex-direction: column; align-items: stretch; }
        .toolbar-right { margin-left: 0; }
        .toolbar-row   { flex-wrap: wrap; }
        .search-box    { max-width: 100%; flex: 1 1 100%; }
        .formation-grid { grid-template-columns: 1fr; }
        .card-stats    { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 360px) {
        .page-title { font-size: 1.1rem; }
        .card-stats { grid-template-columns: 1fr; }
    }
</style>

@php
    $avatarColors = ['#4F6EF7','#f59e0b','#10b981','#ef4444','#8b5cf6','#06b6d4','#ec4899'];
    $niveauMap = [
        'débutant'      => 'niveau-debutant',
        'debutant'      => 'niveau-debutant',
        'intermédiaire' => 'niveau-intermediaire',
        'intermediaire' => 'niveau-intermediaire',
        'avancé'        => 'niveau-avance',
        'avance'        => 'niveau-avance',
    ];
@endphp

<div class="page-wrapper">

    {{-- Alert --}}
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
            <div class="page-title">Formations</div>
            <div class="page-meta">{{ $formations->count() }} formations disponibles</div>
        </div>
        <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
            <button class="btn-toolbar">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 12h10M11 20h2"/></svg>
                <span class="btn-label">Filter</span>
            </button>
            <a href="{{ route('admin.create-formation') }}" class="btn-toolbar btn-primary-action">
                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                <span class="btn-label">Nouvelle Formation</span>
            </a>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="toolbar-row">
        {{-- View toggle --}}
        <div class="view-toggle">
            <button class="view-btn active" title="Grille">
                <svg fill="currentColor" viewBox="0 0 16 16"><path d="M1 2.5A1.5 1.5 0 012.5 1h3A1.5 1.5 0 017 2.5v3A1.5 1.5 0 015.5 7h-3A1.5 1.5 0 011 5.5v-3zm8 0A1.5 1.5 0 0110.5 1h3A1.5 1.5 0 0115 2.5v3A1.5 1.5 0 0113.5 7h-3A1.5 1.5 0 019 5.5v-3zm-8 8A1.5 1.5 0 012.5 9h3A1.5 1.5 0 017 10.5v3A1.5 1.5 0 015.5 15h-3A1.5 1.5 0 011 13.5v-3zm8 0A1.5 1.5 0 0110.5 9h3A1.5 1.5 0 0115 10.5v3A1.5 1.5 0 0113.5 15h-3A1.5 1.5 0 019 13.5v-3z"/></svg>
            </button>
            <button class="view-btn" title="Liste">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            </button>
        </div>

        {{-- Sort --}}
        <div class="sort-select">
            <span>Sort by</span>
            <select>
                <option>A → Z</option>
                <option>Z → A</option>
                <option>Tarif ↑</option>
                <option>Tarif ↓</option>
                <option>Durée ↑</option>
            </select>
        </div>

        {{-- Search --}}
        <div class="search-box">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z"/></svg>
            <input type="text" placeholder="Rechercher une formation..." id="searchInput">
        </div>

        <div class="toolbar-right">
            <a href="{{ route('admin.dashboard') }}" class="btn-toolbar">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span class="btn-label">Dashboard</span>
            </a>
        </div>
    </div>

    <div class="count-label">{{ $formations->count() }} formations showing</div>

    {{-- Formation Grid --}}
    <div class="formation-grid" id="formationGrid">

        @forelse($formations as $formation)
        @php
            $idx         = $loop->index;
            $color       = $avatarColors[$idx % count($avatarColors)];
            $letter      = strtoupper(substr($formation->titre, 0, 1));
            $niveauKey   = strtolower($formation->niveau ?? '');
            $niveauClass = $niveauMap[$niveauKey] ?? 'niveau-default';
            $niveauLabel = ucfirst($formation->niveau ?? 'Standard');
            $sessions    = $formation->sessions_count ?? ($formation->sessions ? $formation->sessions->count() : 0);
            $formateurs  = $formation->formateurs ?? collect();
        @endphp

        <div class="formation-card" data-title="{{ strtolower($formation->titre) }}">

            {{-- Top row --}}
            <div class="card-top">
                <div class="card-icon" style="background:{{ $color }}22; color:{{ $color }}; font-size:1.1rem;">
                    {{ $letter }}
                </div>
                <div class="card-badge-group">
                    <span class="rating-badge">★ 4.5</span>
                    <span class="niveau-badge {{ $niveauClass }}">
                        <span class="dot"></span>{{ $niveauLabel }}
                    </span>
                </div>
            </div>

            {{-- Title --}}
            <div class="card-title">{{ $formation->titre }}</div>
            <div class="card-sub">
                {{ Str::limit($formation->description ?? 'Formation professionnelle', 60) }}
            </div>

            {{-- Stats --}}
            <div class="card-stats">
                <div class="stat-item">
                    <span class="stat-label">Durée</span>
                    <span class="stat-value blue">{{ $formation->duree ?? 0 }}j</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Tarif</span>
                    <span class="stat-value green">{{ number_format($formation->tarif, 0, ',', ' ') }} DH</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Sessions</span>
                    <span class="stat-value amber">{{ $sessions }}</span>
                </div>
            </div>

            {{-- Formateurs --}}
            @if($formateurs->count() > 0)
            <div class="formateur-row">
                <div class="formateur-avatars">
                    @foreach($formateurs->take(4) as $fi => $formateur)
                    @php
                        $fc = $avatarColors[$fi % count($avatarColors)];
                        $fn = $formateur->user->name ?? $formateur->name ?? '?';
                    @endphp
                    <div class="fa-avatar" style="background:{{ $fc }};" title="{{ $fn }}">
                        {{ strtoupper(substr($fn, 0, 1)) }}
                    </div>
                    @endforeach
                    @if($formateurs->count() > 4)
                    <div class="fa-avatar" style="background:#e5e7eb; color:#6b7280;">
                        +{{ $formateurs->count() - 4 }}
                    </div>
                    @endif
                </div>
                <span class="formateur-label">{{ $formateurs->count() }} formateur{{ $formateurs->count() > 1 ? 's' : '' }}</span>
            </div>
            @else
            <div class="formateur-row">
                <span class="formateur-label" style="color:#c1c5cf; font-style:italic;">Aucun formateur assigné</span>
            </div>
            @endif

            {{-- Actions --}}
            <div class="card-actions">
                <a href="{{ route('admin.edit-formation', $formation->id) }}" class="btn-card btn-card-edit">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828A2 2 0 0110 16H8v-2a2 2 0 01.586-1.414z"/></svg>
                    Modifier
                </a>
                <form action="{{ route('admin.delete-formation', $formation->id) }}" method="POST"
                    onsubmit="return confirm('Supprimer cette formation ?')" style="display:contents;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-card btn-card-delete">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>

        @empty
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <p style="font-weight:600;color:#6b7280;margin-bottom:4px;">Aucune formation trouvée</p>
            <p style="font-size:0.8rem;">Créez votre première formation pour commencer.</p>
        </div>
        @endforelse

    </div>
</div>

<script>
    // Live search filter
    const searchInput = document.getElementById('searchInput');
    const cards       = document.querySelectorAll('.formation-card');
    searchInput.addEventListener('input', function() {
        const q = this.value.toLowerCase().trim();
        cards.forEach(card => {
            card.style.display = card.dataset.title.includes(q) ? '' : 'none';
        });
    });
</script>
</x-admin-layout>