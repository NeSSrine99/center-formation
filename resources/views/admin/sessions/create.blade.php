<x-admin-layout>
@section('header', 'Nouvelle Session')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; }
    body, .admin-content { font-family: 'DM Sans', sans-serif; background: #f5f6fa; color: #1a1d23; }

    .create-wrapper { padding: 24px 20px; max-width: 880px; margin: 0 auto; }

    /* ── Page Header ── */
    .page-header { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
    .back-btn {
        flex-shrink: 0; width: 38px; height: 38px; border-radius: 10px;
        border: 1.5px solid #e5e7eb; background: #fff; color: #4b5563;
        display: inline-flex; align-items: center; justify-content: center;
        text-decoration: none; transition: all 0.18s;
    }
    .back-btn:hover { border-color: #4F6EF7; color: #4F6EF7; }
    .back-btn svg { width: 16px; height: 16px; }
    .page-title { font-size: 1.4rem; font-weight: 700; color: #1a1d23; letter-spacing: -0.3px; }
    .page-sub   { font-size: 0.8rem; color: #9499a8; margin-top: 3px; }

    /* ── Layout ── */
    .layout { display: grid; grid-template-columns: 220px 1fr; gap: 20px; align-items: start; }

    /* ── Preview Card ── */
    .preview-card {
        background: #fff; border-radius: 16px; border: 1.5px solid #f0f1f5;
        padding: 20px; box-shadow: 0 2px 16px rgba(0,0,0,0.05);
        position: sticky; top: 20px;
    }
    .preview-label {
        font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.6px; color: #9499a8; margin-bottom: 16px;
    }

    /* Calendar visual */
    .preview-calendar {
        background: linear-gradient(135deg, #4F6EF7, #06b6d4);
        border-radius: 12px; padding: 14px; margin-bottom: 14px; color: #fff;
        text-align: center;
    }
    .cal-month { font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.8; }
    .cal-range { font-size: 1.05rem; font-weight: 700; margin-top: 4px; }
    .cal-days  { font-size: 0.72rem; opacity: 0.7; margin-top: 3px; }

    .preview-formation {
        font-size: 0.88rem; font-weight: 600; color: #1a1d23; margin-bottom: 12px;
        padding: 10px 12px; background: #f5f6fa; border-radius: 9px;
        display: flex; align-items: center; gap: 8px;
    }
    .preview-formation svg { width: 14px; height: 14px; color: #4F6EF7; flex-shrink: 0; }
    .pf-text { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 0.82rem; }

    .preview-divider { height: 1px; background: #f0f1f5; margin: 12px 0; }

    .preview-meta { display: flex; flex-direction: column; gap: 9px; }
    .pm-row { display: flex; align-items: center; justify-content: space-between; font-size: 0.78rem; }
    .pm-label { color: #9499a8; display: flex; align-items: center; gap: 5px; }
    .pm-label svg { width: 12px; height: 12px; }
    .pm-value { font-weight: 600; color: #374151; }

    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 11px; border-radius: 20px; font-size: 0.75rem; font-weight: 600;
    }
    .status-badge .dot { width: 6px; height: 6px; border-radius: 50%; }
    .badge-ouverte { background: #f0fdf4; color: #16a34a; }
    .badge-ouverte .dot { background: #16a34a; }
    .badge-fermee  { background: #fef2f2; color: #dc2626; }
    .badge-fermee .dot  { background: #dc2626; }

    /* ── Form Card ── */
    .form-card {
        background: #fff; border-radius: 18px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.06); padding: 28px 26px;
    }
    .form-section-title {
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase;
        color: #9499a8; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid #f0f1f5;
    }
    .form-row   { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
    .form-label { font-size: 0.82rem; font-weight: 600; color: #374151; }

    .form-control, .form-select {
        width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px;
        padding: 11px 14px; font-family: 'DM Sans', sans-serif;
        font-size: 1rem; color: #1a1d23; background: #fff; outline: none;
        transition: border-color 0.18s, box-shadow 0.18s;
        -webkit-appearance: none; appearance: none;
    }
    .form-control::placeholder { color: #c1c5cf; }
    .form-control:focus, .form-select:focus { border-color: #4F6EF7; box-shadow: 0 0 0 3px rgba(79,110,247,.12); }
    .form-control.is-invalid { border-color: #ef4444; }
    .invalid-feedback { font-size: 0.77rem; color: #ef4444; margin-top: 2px; }

    .input-icon-wrap { position: relative; }
    .input-icon-wrap .icon {
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        color: #c1c5cf; width: 15px; height: 15px; pointer-events: none;
    }
    .input-icon-wrap .form-control, .input-icon-wrap .form-select { padding-left: 36px; }

    .input-suffix-wrap { position: relative; }
    .input-suffix-wrap .suffix {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        font-size: 0.75rem; font-weight: 600; color: #9499a8;
        background: #f5f6fa; padding: 2px 6px; border-radius: 5px; pointer-events: none;
    }
    .input-suffix-wrap .form-control { padding-right: 52px; }

    .select-wrap { position: relative; }
    .select-wrap::after {
        content: '';
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        width: 10px; height: 10px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%239499a8'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E") no-repeat center;
        pointer-events: none;
    }
    .form-select { padding-right: 36px; }

    /* Status pill toggle */
    .status-pills { display: flex; gap: 8px; }
    .status-pill input { display: none; }
    .status-pill label {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 16px; border-radius: 10px; border: 1.5px solid #e5e7eb;
        font-size: 0.84rem; font-weight: 500; cursor: pointer; color: #4b5563;
        background: #fff; transition: all 0.18s;
    }
    .status-pill label .dot { width: 8px; height: 8px; border-radius: 50%; }
    .status-pill input[value="ouverte"]:checked + label { border-color: #16a34a; background: #f0fdf4; color: #16a34a; }
    .status-pill input[value="fermee"]:checked  + label { border-color: #dc2626; background: #fef2f2; color: #dc2626; }

    .divider { height: 1px; background: #f0f1f5; margin: 18px 0; }

    /* Buttons */
    .form-actions { display: flex; gap: 10px; margin-top: 24px; flex-wrap: wrap; }
    .btn-submit {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 12px 24px; border-radius: 10px; background: #4F6EF7;
        color: #fff; font-family: 'DM Sans', sans-serif; font-size: 0.9rem;
        font-weight: 600; border: none; cursor: pointer; transition: all 0.18s;
    }
    .btn-submit:hover { background: #3a57e8; box-shadow: 0 4px 14px rgba(79,110,247,.35); transform: translateY(-1px); }
    .btn-submit svg { width: 16px; height: 16px; }
    .btn-cancel {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 12px 20px; border-radius: 10px; border: 1.5px solid #e5e7eb;
        background: #fff; color: #4b5563; font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem; font-weight: 500; text-decoration: none; transition: all 0.18s;
    }
    .btn-cancel:hover { background: #f9fafb; border-color: #d1d5db; color: #1a1d23; }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 900px) {
        .layout { grid-template-columns: 1fr; }
        .preview-card { display: flex; align-items: center; gap: 16px; padding: 16px; position: static; }
        .preview-calendar { flex-shrink: 0; width: 110px; margin: 0; padding: 10px 12px; }
        .cal-range { font-size: 0.88rem; }
        .preview-label { display: none; }
        .preview-body { flex: 1; min-width: 0; }
        .preview-divider { display: none; }
        .preview-meta { flex-direction: row; flex-wrap: wrap; gap: 12px; }
        .pm-row { flex: 1 1 auto; }
    }
    @media (max-width: 768px) {
        .create-wrapper { padding: 16px 14px; }
        .page-title { font-size: 1.2rem; }
        .form-card  { padding: 20px 16px; }
        .form-row, .form-row-3 { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 540px) {
        .form-row, .form-row-3 { grid-template-columns: 1fr; gap: 0; }
        .status-pills { flex-direction: column; }
        .form-actions { flex-direction: column; }
        .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
        .preview-card { flex-direction: column; text-align: center; }
        .preview-calendar { width: 100%; }
        .preview-label { display: block; }
        .preview-meta { justify-content: center; }
    }
    @media (max-width: 360px) {
        .back-btn { width: 34px; height: 34px; }
        .page-title { font-size: 1rem; }
    }
</style>

<div class="create-wrapper">

    <div class="page-header">
        <a href="{{ route('admin.sessions') }}" class="back-btn" title="Retour">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <div class="page-title">Nouvelle Session</div>
            <div class="page-sub">Planifiez une nouvelle session de formation</div>
        </div>
    </div>

    @include('partials.alerts')

    <div class="layout">

        {{-- Preview Card --}}
        <div class="preview-card">
            <div class="preview-label">Aperçu</div>

            <div class="preview-calendar" id="previewCal">
                <div class="cal-month" id="previewMonth">Période</div>
                <div class="cal-range" id="previewRange">— → —</div>
                <div class="cal-days" id="previewDays">— jours</div>
            </div>

            <div class="preview-body">
                <div class="preview-formation">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    <span class="pf-text" id="previewFormation">Choisir une formation</span>
                </div>

                <div class="preview-divider"></div>
                <div class="preview-meta">
                    <div class="pm-row">
                        <span class="pm-label">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            Lieu
                        </span>
                        <span class="pm-value" id="previewLieu">—</span>
                    </div>
                    <div class="pm-row">
                        <span class="pm-label">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Capacité
                        </span>
                        <span class="pm-value" id="previewCap">—</span>
                    </div>
                    <div class="pm-row">
                        <span class="pm-label">Statut</span>
                        <span class="status-badge badge-ouverte" id="previewStatus">
                            <span class="dot"></span><span id="previewStatusText">Ouverte</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="form-card">
            <form action="{{ route('admin.store-session') }}" method="POST" novalidate>
                @csrf

                {{-- Formation --}}
                <div class="form-section-title">Formation</div>
                <div class="form-group">
                    <label class="form-label" for="formation_id">Sélectionner une formation</label>
                    <div class="input-icon-wrap select-wrap">
                        <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <select name="formation_id" id="formation_id"
                            class="form-select @error('formation_id') is-invalid @enderror" required>
                            <option value="">-- Choisir une formation --</option>
                            @foreach($formations as $formation)
                            <option value="{{ $formation->id }}" {{ old('formation_id') == $formation->id ? 'selected' : '' }}>
                                {{ $formation->titre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('formation_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Dates --}}
                <div class="divider"></div>
                <div class="form-section-title">Planification</div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="date_debut">Date de début</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <input type="date" name="date_debut" id="date_debut"
                                class="form-control @error('date_debut') is-invalid @enderror"
                                value="{{ old('date_debut') }}" required>
                        </div>
                        @error('date_debut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="date_fin">Date de fin</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <input type="date" name="date_fin" id="date_fin"
                                class="form-control @error('date_fin') is-invalid @enderror"
                                value="{{ old('date_fin') }}" required>
                        </div>
                        @error('date_fin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="lieu">Lieu</label>
                    <div class="input-icon-wrap">
                        <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <input type="text" name="lieu" id="lieu"
                            class="form-control @error('lieu') is-invalid @enderror"
                            value="{{ old('lieu') }}" placeholder="Ex: Salle 101, En ligne...">
                    </div>
                    @error('lieu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Capacité & Statut --}}
                <div class="divider"></div>
                <div class="form-section-title">Capacité & Statut</div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="capacite">Capacité maximale</label>
                        <div class="input-suffix-wrap">
                            <input type="number" name="capacite" id="capacite" min="1"
                                class="form-control @error('capacite') is-invalid @enderror"
                                value="{{ old('capacite', 20) }}" required>
                            <span class="suffix">pers.</span>
                        </div>
                        @error('capacite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Statut de la session</label>
                        <div class="status-pills">
                            <div class="status-pill">
                                <input type="radio" name="statut" id="statut_ouverte" value="ouverte"
                                    {{ old('statut', 'ouverte') == 'ouverte' ? 'checked' : '' }}>
                                <label for="statut_ouverte">
                                    <span class="dot" style="background:#16a34a;"></span> Ouverte
                                </label>
                            </div>
                            <div class="status-pill">
                                <input type="radio" name="statut" id="statut_fermee" value="fermee"
                                    {{ old('statut') == 'fermee' ? 'checked' : '' }}>
                                <label for="statut_fermee">
                                    <span class="dot" style="background:#dc2626;"></span> Fermée
                                </label>
                            </div>
                        </div>
                        @error('statut')<div class="invalid-feedback" style="display:block;margin-top:6px;">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Créer la Session
                    </button>
                    <a href="{{ route('admin.sessions') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const formations = @json($formations->pluck('titre', 'id'));

    const formationSel = document.getElementById('formation_id');
    const dateDebut    = document.getElementById('date_debut');
    const dateFin      = document.getElementById('date_fin');
    const lieuInput    = document.getElementById('lieu');
    const capInput     = document.getElementById('capacite');
    const statusRadios = document.querySelectorAll('input[name="statut"]');

    const previewFormation  = document.getElementById('previewFormation');
    const previewRange      = document.getElementById('previewRange');
    const previewMonth      = document.getElementById('previewMonth');
    const previewDays       = document.getElementById('previewDays');
    const previewLieu       = document.getElementById('previewLieu');
    const previewCap        = document.getElementById('previewCap');
    const previewStatus     = document.getElementById('previewStatus');
    const previewStatusText = document.getElementById('previewStatusText');

    const monthNames = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];

    function fmt(dateStr) {
        if (!dateStr) return '—';
        const d = new Date(dateStr);
        return d.getDate().toString().padStart(2,'0') + '/' + (d.getMonth()+1).toString().padStart(2,'0');
    }

    function updatePreview() {
        // Formation
        const fId = formationSel.value;
        previewFormation.textContent = fId ? (formations[fId] || '—') : 'Choisir une formation';

        // Dates
        const d1 = dateDebut.value, d2 = dateFin.value;
        previewRange.textContent = (d1 || d2) ? fmt(d1) + ' → ' + fmt(d2) : '— → —';

        if (d1) {
            const dt = new Date(d1);
            previewMonth.textContent = monthNames[dt.getMonth()] + ' ' + dt.getFullYear();
        } else { previewMonth.textContent = 'Période'; }

        if (d1 && d2) {
            const diff = Math.round((new Date(d2) - new Date(d1)) / 86400000);
            previewDays.textContent = diff > 0 ? diff + ' jour' + (diff > 1 ? 's' : '') : '—';
        } else { previewDays.textContent = '— jours'; }

        // Lieu & Capacité
        previewLieu.textContent = lieuInput.value.trim() || '—';
        previewCap.textContent  = capInput.value ? capInput.value + ' pers.' : '—';

        // Status
        const checked = document.querySelector('input[name="statut"]:checked');
        const statut  = checked ? checked.value : 'ouverte';
        previewStatus.className = 'status-badge ' + (statut === 'ouverte' ? 'badge-ouverte' : 'badge-fermee');
        previewStatusText.textContent = statut === 'ouverte' ? 'Ouverte' : 'Fermée';
    }

    formationSel.addEventListener('change', updatePreview);
    dateDebut.addEventListener('change', updatePreview);
    dateFin.addEventListener('change', updatePreview);
    lieuInput.addEventListener('input', updatePreview);
    capInput.addEventListener('input', updatePreview);
    statusRadios.forEach(r => r.addEventListener('change', updatePreview));

    updatePreview();
</script>
</x-admin-layout>