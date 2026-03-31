<x-admin-layout>
@section('header', 'Modifier Formation')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    *, *::before, *::after { box-sizing: border-box; }
    body, .admin-content { font-family: 'DM Sans', sans-serif; background: #f5f6fa; color: #1a1d23; }

    .edit-wrapper { padding: 24px 20px; max-width: 860px; margin: 0 auto; }

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
        padding: 20px; text-align: center; box-shadow: 0 2px 16px rgba(0,0,0,0.05);
        position: sticky; top: 20px;
    }
    .preview-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; color: #9499a8; margin-bottom: 14px; }
    .preview-icon {
        width: 64px; height: 64px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem; font-weight: 700; color: #fff;
        margin: 0 auto 12px; transition: background 0.3s;
    }
    .preview-title { font-size: 0.95rem; font-weight: 700; color: #1a1d23; margin-bottom: 4px; line-height: 1.3; }
    .preview-sub   { font-size: 0.75rem; color: #9499a8; margin-bottom: 10px; }

    .niveau-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600;
    }
    .niveau-badge .dot { width: 5px; height: 5px; border-radius: 50%; background: currentColor; }
    .niveau-debutant    { background: #f0fdf4; color: #16a34a; }
    .niveau-intermediaire { background: #eff6ff; color: #2563eb; }
    .niveau-avance      { background: #fef2f2; color: #dc2626; }
    .niveau-default     { background: #f5f6fa; color: #6b7280; }

    .preview-divider { height: 1px; background: #f0f1f5; margin: 14px 0; }
    .preview-stat { display: flex; justify-content: space-between; font-size: 0.78rem; margin-bottom: 8px; }
    .ps-label { color: #9499a8; }
    .ps-value  { font-weight: 700; color: #1a1d23; }

    /* Formateurs avatars in preview */
    .preview-formateurs { display: flex; justify-content: center; gap: 0; margin-top: 4px; }
    .pf-avatar {
        width: 28px; height: 28px; border-radius: 50%; border: 2px solid #fff;
        margin-left: -6px; display: flex; align-items: center; justify-content: center;
        font-size: 0.65rem; font-weight: 700; color: #fff;
    }
    .pf-avatar:first-child { margin-left: 0; }

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
    .input-icon-wrap.top .icon { top: 14px; transform: none; }

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

    .formateur-select {
        width: 100%; border: 1.5px solid #e5e7eb; border-radius: 10px;
        padding: 6px; font-family: 'DM Sans', sans-serif; font-size: 0.88rem;
        background: #fff; outline: none; min-height: 90px;
        transition: border-color 0.18s;
    }
    .formateur-select:focus { border-color: #4F6EF7; box-shadow: 0 0 0 3px rgba(79,110,247,.12); }
    .formateur-select option { padding: 6px 10px; }
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
        .preview-card {
            display: flex; align-items: center; gap: 16px;
            text-align: left; padding: 16px; position: static;
        }
        .preview-icon { margin: 0; width: 52px; height: 52px; font-size: 1.2rem; flex-shrink: 0; }
        .preview-body { flex: 1; min-width: 0; }
        .preview-divider { display: none; }
        .preview-stats-row { display: flex; gap: 20px; margin-top: 8px; }
        .preview-stat { flex: 1; flex-direction: column; gap: 2px; }
        .preview-formateurs { justify-content: flex-start; }
    }

    @media (max-width: 768px) {
        .edit-wrapper { padding: 16px 14px; }
        .page-title   { font-size: 1.2rem; }
        .form-card    { padding: 20px 16px; }
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

@php
    $colors      = ['#4F6EF7','#f59e0b','#10b981','#ef4444','#8b5cf6','#06b6d4','#ec4899'];
    $letter      = strtoupper(substr($formation->titre, 0, 1));
    $colorIdx    = ord($letter) % count($colors);
    $iconColor   = $colors[$colorIdx];
    $iconColor2  = $colors[($colorIdx + 2) % count($colors)];
    $niveauKey   = strtolower($formation->niveau ?? '');
    $niveauMap   = [
        'débutant'=>'niveau-debutant','debutant'=>'niveau-debutant',
        'intermédiaire'=>'niveau-intermediaire','intermediaire'=>'niveau-intermediaire',
        'avancé'=>'niveau-avance','avance'=>'niveau-avance',
    ];
    $niveauClass = $niveauMap[$niveauKey] ?? 'niveau-default';
@endphp

<div class="edit-wrapper">

    {{-- Page Header --}}
    <div class="page-header">
        <a href="{{ route('admin.formations') }}" class="back-btn" title="Retour">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <div class="page-title">Modifier la Formation</div>
            <div class="page-sub">Mise à jour de <strong>{{ $formation->titre }}</strong></div>
        </div>
    </div>

    @include('partials.alerts')

    <div class="layout">

        {{-- ── Preview Card ── --}}
        <div class="preview-card">
            <div class="preview-label">Aperçu</div>

            <div class="preview-icon" id="previewIcon"
                style="background: linear-gradient(135deg, {{ $iconColor }}, {{ $iconColor2 }})">
                {{ $letter }}
            </div>

            <div class="preview-body">
                <div class="preview-title" id="previewTitle">{{ $formation->titre }}</div>
                <div class="preview-sub" id="previewNiveau">{{ $formation->niveau ?? 'Standard' }}</div>
                <span class="niveau-badge {{ $niveauClass }}" id="previewBadge">
                    <span class="dot"></span>
                    <span id="previewBadgeText">{{ $formation->niveau ?? 'Standard' }}</span>
                </span>

                <div class="preview-stats-row" style="display:flex;gap:16px;margin-top:10px;flex-wrap:wrap;">
                    <div class="preview-stat" style="display:flex;flex-direction:column;gap:2px;">
                        <span class="ps-label" style="font-size:0.68rem;color:#9499a8;">Durée</span>
                        <span class="ps-value" id="previewDuree" style="font-weight:700;color:#4F6EF7;">{{ $formation->duree ?? '—' }} j</span>
                    </div>
                    <div class="preview-stat" style="display:flex;flex-direction:column;gap:2px;">
                        <span class="ps-label" style="font-size:0.68rem;color:#9499a8;">Tarif</span>
                        <span class="ps-value" id="previewTarif" style="font-weight:700;color:#10b981;">{{ number_format($formation->tarif ?? 0, 0, ',', ' ') }} DH</span>
                    </div>
                </div>

                {{-- Formateurs avatars --}}
                @if(isset($formation->formateurs) && $formation->formateurs->count() > 0)
                <div class="preview-formateurs" style="margin-top:10px;">
                    @foreach($formation->formateurs->take(4) as $fi => $f)
                    @php $fc = $colors[$fi % count($colors)]; $fn = $f->user->name ?? $f->name ?? '?'; @endphp
                    <div class="pf-avatar" style="background:{{ $fc }};" title="{{ $fn }}">{{ strtoupper(substr($fn,0,1)) }}</div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Desktop divider + extra meta --}}
            <div class="preview-divider" style="width:100%;"></div>
            <div class="desktop-meta" style="width:100%;">
                <div class="preview-stat">
                    <span class="ps-label">ID</span>
                    <span class="ps-value">#{{ str_pad($formation->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="preview-stat">
                    <span class="ps-label">Créée le</span>
                    <span class="ps-value">{{ $formation->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>

        {{-- ── Form Card ── --}}
        <div class="form-card">
            <form action="{{ route('admin.update-formation', $formation->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                {{-- Section: Infos --}}
                <div class="form-section-title">Informations Générales</div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="titre">Titre</label>
                        <div class="input-icon-wrap">
                            <svg class="icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            <input type="text" name="titre" id="titre"
                                class="form-control @error('titre') is-invalid @enderror"
                                value="{{ old('titre', $formation->titre) }}" required>
                        </div>
                        @error('titre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="niveau">Niveau</label>
                        <div class="select-wrap">
                            <select name="niveau" id="niveau"
                                class="form-select @error('niveau') is-invalid @enderror">
                                <option value="">-- Niveau --</option>
                                <option value="Débutant"      {{ old('niveau', $formation->niveau)=='Débutant'?'selected':'' }}>Débutant</option>
                                <option value="Intermédiaire" {{ old('niveau', $formation->niveau)=='Intermédiaire'?'selected':'' }}>Intermédiaire</option>
                                <option value="Avancé"        {{ old('niveau', $formation->niveau)=='Avancé'?'selected':'' }}>Avancé</option>
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
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $formation->description) }}</textarea>
                    </div>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Section: Détails --}}
                <div class="divider"></div>
                <div class="form-section-title">Détails & Tarification</div>
                <div class="form-row-3">
                    <div class="form-group">
                        <label class="form-label" for="duree">Durée</label>
                        <div class="input-suffix-wrap">
                            <input type="number" name="duree" id="duree" min="1"
                                class="form-control @error('duree') is-invalid @enderror"
                                value="{{ old('duree', $formation->duree) }}">
                            <span class="suffix">jours</span>
                        </div>
                        @error('duree')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tarif">Tarif</label>
                        <div class="input-suffix-wrap">
                            <input type="number" name="tarif" id="tarif" min="0" step="0.01"
                                class="form-control @error('tarif') is-invalid @enderror"
                                value="{{ old('tarif', $formation->tarif) }}">
                            <span class="suffix">DH</span>
                        </div>
                        @error('tarif')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Max Participants</label>
                        <input type="number" name="max_participants" min="1"
                            class="form-control"
                            value="{{ old('max_participants', $formation->max_participants ?? '') }}" placeholder="—">
                        <span class="form-hint">Optionnel</span>
                    </div>
                </div>

                {{-- Section: Formateurs --}}
                <div class="divider"></div>
                <div class="form-section-title">Formateurs</div>
                <div class="form-group">
                    <label class="form-label" for="formateur_ids">Formateurs assignés</label>
                    <select name="formateur_ids[]" id="formateur_ids" class="formateur-select" multiple>
                        @foreach($formateurs as $formateur)
                        <option value="{{ $formateur->id }}"
                            @if($formation->formateurs->contains($formateur->id)) selected @endif>
                            {{ $formateur->user->name ?? $formateur->name }}
                        </option>
                        @endforeach
                    </select>
                    <span class="form-hint">Maintenir Ctrl (ou Cmd) pour sélectionner plusieurs</span>
                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Sauvegarder
                    </button>
                    <a href="{{ route('admin.formations') }}" class="btn-cancel">Annuler</a>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    const colors   = ['#4F6EF7','#f59e0b','#10b981','#ef4444','#8b5cf6','#06b6d4','#ec4899'];
    const titreEl  = document.getElementById('titre');
    const niveauEl = document.getElementById('niveau');
    const dureeEl  = document.getElementById('duree');
    const tarifEl  = document.getElementById('tarif');

    const previewIcon      = document.getElementById('previewIcon');
    const previewTitle     = document.getElementById('previewTitle');
    const previewNiveauSub = document.getElementById('previewNiveau');
    const previewBadge     = document.getElementById('previewBadge');
    const previewBadgeText = document.getElementById('previewBadgeText');
    const previewDuree     = document.getElementById('previewDuree');
    const previewTarif     = document.getElementById('previewTarif');

    const niveauClasses = {
        'Débutant':      'niveau-debutant',
        'Intermédiaire': 'niveau-intermediaire',
        'Avancé':        'niveau-avance',
    };

    function updatePreview() {
        const titre  = titreEl.value.trim();
        const niveau = niveauEl.value;

        previewTitle.textContent = titre || '{{ $formation->titre }}';
        previewIcon.textContent  = titre ? titre[0].toUpperCase() : '{{ $letter }}';

        if (titre) {
            const h = titre.charCodeAt(0) % colors.length;
            previewIcon.style.background = `linear-gradient(135deg, ${colors[h]}, ${colors[(h+2)%colors.length]})`;
        }

        previewNiveauSub.textContent = niveau || '{{ $formation->niveau ?? "Standard" }}';
        previewBadgeText.textContent = niveau || '{{ $formation->niveau ?? "Standard" }}';

        // Badge class
        previewBadge.className = 'niveau-badge ' + (niveauClasses[niveau] || 'niveau-default');

        previewDuree.textContent = dureeEl.value ? dureeEl.value + ' j' : '{{ $formation->duree ?? "—" }} j';
        previewTarif.textContent = tarifEl.value
            ? Number(tarifEl.value).toLocaleString('fr') + ' DH'
            : '{{ number_format($formation->tarif ?? 0, 0, ",", " ") }} DH';
    }

    titreEl.addEventListener('input',  updatePreview);
    niveauEl.addEventListener('change', updatePreview);
    dureeEl.addEventListener('input',  updatePreview);
    tarifEl.addEventListener('input',  updatePreview);
</script>
</x-admin-layout>