<x-admin-layout>
@section('header', 'Nouvelle Formation')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; }
    body, .admin-content { font-family: 'DM Sans', sans-serif; background: #f5f6fa; color: #1a1d23; }

    .create-wrapper { padding: 24px 20px; max-width: 860px; margin: 0 auto; }

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

    /* ── Preview + Form layout ── */
    .layout { display: grid; grid-template-columns: 220px 1fr; gap: 20px; align-items: start; }

    /* ── Preview Card ── */
    .preview-card {
        background: #fff; border-radius: 16px;
        border: 1.5px solid #f0f1f5;
        padding: 20px; text-align: center;
        box-shadow: 0 2px 16px rgba(0,0,0,0.05);
    }
    .preview-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #9499a8; margin-bottom: 14px; }
    .preview-icon {
        width: 64px; height: 64px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem; font-weight: 700; color: #fff;
        margin: 0 auto 12px;
        background: linear-gradient(135deg, #4F6EF7, #06b6d4);
        transition: background 0.3s;
    }
    .preview-title {
        font-size: 0.95rem; font-weight: 700; color: #1a1d23;
        margin-bottom: 4px; line-height: 1.3; min-height: 1.3em;
    }
    .preview-sub { font-size: 0.75rem; color: #9499a8; margin-bottom: 14px; }
    .preview-divider { height: 1px; background: #f0f1f5; margin: 14px 0; }
    .preview-stat { display: flex; justify-content: space-between; font-size: 0.78rem; margin-bottom: 8px; }
    .preview-stat .ps-label { color: #9499a8; }
    .preview-stat .ps-value { font-weight: 700; color: #1a1d23; }
    .preview-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600;
        background: #eff3ff; color: #4F6EF7; margin-top: 4px;
    }

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
    .form-full  { grid-column: 1 / -1; }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
    .form-label { font-size: 0.82rem; font-weight: 600; color: #374151; }
    .form-hint  { font-size: 0.72rem; color: #9499a8; margin-top: 2px; }

    .form-control, .form-select {
        width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px;
        padding: 11px 14px; font-family: 'DM Sans', sans-serif;
        font-size: 1rem; color: #1a1d23; background: #fff; outline: none;
        transition: border-color 0.18s, box-shadow 0.18s;
        -webkit-appearance: none; appearance: none;
    }
    textarea.form-control { resize: vertical; min-height: 90px; }
    .form-control::placeholder { color: #c1c5cf; }
    .form-control:focus, .form-select:focus {
        border-color: #4F6EF7; box-shadow: 0 0 0 3px rgba(79,110,247,.12);
    }
    .form-control.is-invalid { border-color: #ef4444; }
    .invalid-feedback { font-size: 0.77rem; color: #ef4444; margin-top: 2px; }

    .input-icon-wrap { position: relative; }
    .input-icon-wrap .icon {
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        color: #c1c5cf; width: 15px; height: 15px; pointer-events: none;
    }
    .input-icon-wrap .form-control { padding-left: 36px; }
    .input-icon-wrap.top .icon { top: 16px; transform: none; }
    .input-icon-wrap.top textarea.form-control { padding-left: 36px; }

    /* Suffix badge (for units like DH, jours) */
    .input-suffix-wrap { position: relative; }
    .input-suffix-wrap .suffix {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        font-size: 0.75rem; font-weight: 600; color: #9499a8; pointer-events: none;
        background: #f5f6fa; padding: 2px 6px; border-radius: 5px;
    }
    .input-suffix-wrap .form-control { padding-right: 52px; }

    /* Select arrow */
    .select-wrap { position: relative; }
    .select-wrap::after {
        content: '';
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        width: 10px; height: 10px;
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='%239499a8'%3E%3Cpath fill-rule='evenodd' d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z' clip-rule='evenodd'/%3E%3C/svg%3E") no-repeat center;
        pointer-events: none;
    }
    .form-select { padding-right: 36px; }

    /* Formateurs multi-select */
    .formateur-select {
        width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px;
        padding: 6px; font-family: 'DM Sans', sans-serif; font-size: 0.88rem;
        background: #fff; outline: none; min-height: 90px;
        transition: border-color 0.18s;
    }
    .formateur-select:focus { border-color: #4F6EF7; box-shadow: 0 0 0 3px rgba(79,110,247,.12); }
    .formateur-select option {
        padding: 6px 10px; border-radius: 6px; margin: 2px 0;
    }
    .formateur-select option:checked { background: #eff3ff; color: #4F6EF7; }

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
        .preview-card { display: grid; grid-template-columns: 80px 1fr; gap: 16px; text-align: left; }
        .preview-icon { margin: 0; width: 52px; height: 52px; font-size: 1.2rem; }
        .preview-label { grid-column: 1/-1; margin-bottom: 0; }
        .preview-title { font-size: 0.9rem; }
        .preview-divider { grid-column: 1/-1; }
        .preview-stats-wrap { grid-column: 1/-1; display: flex; gap: 20px; }
        .preview-stat { flex: 1; flex-direction: column; gap: 2px; justify-content: flex-start; }
    }

    @media (max-width: 768px) {
        .create-wrapper { padding: 16px 14px; }
        .page-title { font-size: 1.2rem; }
        .form-card  { padding: 20px 16px; }
        .form-row, .form-row-3 { grid-template-columns: 1fr 1fr; }
    }

    @media (max-width: 540px) {
        .form-row, .form-row-3 { grid-template-columns: 1fr; gap: 0; }
        .form-actions { flex-direction: column; }
        .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
    }

    @media (max-width: 360px) {
        .back-btn { width: 34px; height: 34px; }
        .page-title { font-size: 1rem; }
    }
</style>

<div class="create-wrapper">

    {{-- Page Header --}}
    <div class="page-header">
        <a href="{{ route('admin.formations') }}" class="back-btn" title="Retour">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <div class="page-title">Nouvelle Formation</div>
            <div class="page-sub">Remplissez les informations pour créer une formation</div>
        </div>
    </div>

    @include('partials.alerts')

    <div class="layout">

        {{-- ── Preview Card ── --}}
        <div class="preview-card">
            <div class="preview-label">Aperçu</div>
            <div class="preview-icon" id="previewIcon">N</div>
            <div>
                <div class="preview-title" id="previewTitle">Titre de la formation</div>
                <div class="preview-sub" id="previewNiveau">Niveau</div>
                <span class="preview-badge" id="previewBadge">Nouvelle</span>
            </div>
            <div class="preview-divider"></div>
            <div class="preview-stats-wrap">
                <div class="preview-stat">
                    <span class="ps-label">Durée</span>
                    <span class="ps-value" id="previewDuree" style="color:#4F6EF7;">— j</span>
                </div>
                <div class="preview-stat">
                    <span class="ps-label">Tarif</span>
                    <span class="ps-value" id="previewTarif" style="color:#10b981;">— DH</span>
                </div>
            </div>
        </div>

        {{-- ── Form Card ── --}}
        <div class="form-card">
            <form action="{{ route('admin.store-formation') }}" method="POST" novalidate>
                @csrf

                {{-- Section: Infos --}}
                <div class="form-section-title">Informations Générales</div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="titre">Titre de la formation</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <input type="text" name="titre" id="titre"
                                class="form-control @error('titre') is-invalid @enderror"
                                value="{{ old('titre') }}" placeholder="Ex: Développement Web" id="titreInput">
                        </div>
                        @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="niveau">Niveau</label>
                        <div class="select-wrap">
                            <select name="niveau" id="niveau"
                                class="form-select @error('niveau') is-invalid @enderror">
                                <option value="">-- Choisir un niveau --</option>
                                <option value="Débutant"      {{ old('niveau')=='Débutant'?'selected':'' }}>Débutant</option>
                                <option value="Intermédiaire" {{ old('niveau')=='Intermédiaire'?'selected':'' }}>Intermédiaire</option>
                                <option value="Avancé"        {{ old('niveau')=='Avancé'?'selected':'' }}>Avancé</option>
                            </select>
                        </div>
                        @error('niveau')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Description</label>
                    <div class="input-icon-wrap top">
                        <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h8"/></svg>
                        <textarea name="description" id="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Décrivez le contenu et les objectifs de cette formation...">{{ old('description') }}</textarea>
                    </div>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Section: Details --}}
                <div class="divider"></div>
                <div class="form-section-title">Détails & Tarification</div>
                <div class="form-row-3">
                    <div class="form-group">
                        <label class="form-label" for="duree">Durée</label>
                        <div class="input-suffix-wrap">
                            <input type="number" name="duree" id="duree" min="1"
                                class="form-control @error('duree') is-invalid @enderror"
                                value="{{ old('duree') }}" placeholder="0">
                            <span class="suffix">jours</span>
                        </div>
                        @error('duree')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tarif">Tarif</label>
                        <div class="input-suffix-wrap">
                            <input type="number" name="tarif" id="tarif" min="0" step="0.01"
                                class="form-control @error('tarif') is-invalid @enderror"
                                value="{{ old('tarif') }}" placeholder="0">
                            <span class="suffix">DH</span>
                        </div>
                        @error('tarif')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Max Participants</label>
                        <input type="number" name="max_participants" min="1"
                            class="form-control" value="{{ old('max_participants') }}" placeholder="—">
                        <span class="form-hint">Optionnel</span>
                    </div>
                </div>

                {{-- Section: Formateurs --}}
                <div class="divider"></div>
                <div class="form-section-title">Formateurs</div>
                <div class="form-group">
                    <label class="form-label" for="formateur_ids">Assigner des formateurs</label>
                    <select name="formateur_ids[]" id="formateur_ids" class="formateur-select" multiple>
                        @foreach($formateurs as $formateur)
                        <option value="{{ $formateur->id }}"
                            {{ collect(old('formateur_ids', []))->contains($formateur->id) ? 'selected' : '' }}>
                            {{ $formateur->user->name ?? $formateur->name }}
                        </option>
                        @endforeach
                    </select>
                    <span class="form-hint">Maintenir Ctrl (ou Cmd) pour sélectionner plusieurs formateurs</span>
                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Créer la Formation
                    </button>
                    <a href="{{ route('admin.formations') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    // Live preview updates
    const titreInput  = document.getElementById('titre');
    const niveauInput = document.getElementById('niveau');
    const dureeInput  = document.getElementById('duree');
    const tarifInput  = document.getElementById('tarif');

    const previewIcon   = document.getElementById('previewIcon');
    const previewTitle  = document.getElementById('previewTitle');
    const previewNiveau = document.getElementById('previewNiveau');
    const previewDuree  = document.getElementById('previewDuree');
    const previewTarif  = document.getElementById('previewTarif');
    const previewBadge  = document.getElementById('previewBadge');

    const colors = ['#4F6EF7','#f59e0b','#10b981','#ef4444','#8b5cf6','#06b6d4','#ec4899'];

    function updatePreview() {
        const titre = titreInput.value.trim();
        previewTitle.textContent  = titre || 'Titre de la formation';
        previewIcon.textContent   = titre ? titre[0].toUpperCase() : 'N';
        previewNiveau.textContent = niveauInput.value || 'Niveau';
        previewBadge.textContent  = niveauInput.value || 'Nouvelle';
        previewDuree.textContent  = dureeInput.value ? dureeInput.value + ' j' : '— j';
        previewTarif.textContent  = tarifInput.value ? Number(tarifInput.value).toLocaleString('fr') + ' DH' : '— DH';
        if (titre) {
            const hash = titre.charCodeAt(0) % colors.length;
            previewIcon.style.background = `linear-gradient(135deg, ${colors[hash]}, ${colors[(hash+2)%colors.length]})`;
        }
    }

    titreInput.addEventListener('input', updatePreview);
    niveauInput.addEventListener('change', updatePreview);
    dureeInput.addEventListener('input', updatePreview);
    tarifInput.addEventListener('input', updatePreview);
</script>
</x-admin-layout>