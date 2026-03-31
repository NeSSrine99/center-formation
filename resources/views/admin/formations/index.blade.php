<x-admin-layout>
    @section('header', 'Gestion des Formations')

    <style>
        body {
            background: #f1f5f9;
        }

        .admin-wrapper {
            padding: 40px 20px;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        /* HEADER */
        .header-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            max-width: 1200px;
            margin-inline: auto;
        }

        .page-title {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
        }

        .btn-create {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            padding: 12px 22px;
            border-radius: 14px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.25);
            transition: 0.3s;
        }

        .btn-create:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(99, 102, 241, 0.35);
        }

        /* GRID */
        .formation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            max-width: 1200px;
            margin: auto;
        }

        /* CARD */
        .formation-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 26px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.06);
            transition: 0.35s;
            position: relative;
            overflow: hidden;
        }

        .formation-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #6366f1, #ec4899);
        }

        .formation-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.1);
        }

        /* ICON */
        .icon-box {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        }

        .rating-badge {
            background: #fef3c7;
            color: #b45309;
            padding: 5px 12px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
        }

        .card-header-icons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        /* AVATAR */
        .avatar-placeholder {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 30px;
            font-weight: bold;
            margin: auto;
            margin-bottom: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .formation-title {
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .formation-level {
            text-align: center;
            color: #9ca3af;
            font-size: 13px;
        }

        /* INFO */
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .info-group .label {
            font-size: 11px;
            color: #94a3b8;
            text-transform: uppercase;
        }

        .info-group .value {
            font-weight: 700;
            font-size: 15px;
        }

        .text-blue {
            color: #3b82f6;
        }

        .text-green {
            color: #10b981;
        }

        /* BUTTONS */
        .card-footer-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-action {
            padding: 10px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-edit {
            background: #eef2ff;
            color: #4f46e5;
        }

        .btn-edit:hover {
            background: #6366f1;
            color: white;
        }

        .btn-delete {
            background: #fee2e2;
            color: #ef4444;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: white;
        }
    </style>

    <div class="admin-wrapper">

        <div class="header-controls">
            <h1 class="page-title">🎓 Gestion des Formations</h1>

            <div>
                <a href="{{ route('admin.dashboard') }}" class="me-3 text-muted text-decoration-none">
                    ← Dashboard
                </a>

                <a href="{{ route('admin.create-formation') }}" class="btn-create">
                    + Nouvelle Formation
                </a>
            </div>
        </div>

        @include('partials.alerts')

        <div class="formation-grid">

            @foreach ($formations as $formation)
                <div class="formation-card">

                    <div class="card-header-icons">
                        <div class="icon-box">🎓</div>
                        <div class="rating-badge">★ 4.5</div>
                    </div>

                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($formation->titre, 0, 1)) }}
                    </div>

                    <h3 class="formation-title">{{ $formation->titre }}</h3>
                    <p class="formation-level">{{ $formation->niveau ?? 'Standard Level' }}</p>

                    <div class="info-row">
                        <div class="info-group">
                            <span class="label">Durée</span>
                            <div class="value text-blue">{{ $formation->duree ?? 0 }} jours</div>
                        </div>

                        <div class="info-group text-end">
                            <span class="label">Tarif</span>
                            <div class="value text-green">
                                {{ number_format($formation->tarif, 0, ',', ' ') }} DH
                            </div>
                        </div>
                    </div>

                    <div class="card-footer-actions">
                        <a href="{{ route('admin.edit-formation', $formation->id) }}" class="btn-action btn-edit">
                            ✏️ Modifier
                        </a>

                        <form action="{{ route('admin.delete-formation', $formation->id) }}" method="POST"
                            onsubmit="return confirm('Supprimer cette formation ?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-action btn-delete w-100">
                                🗑 Supprimer
                            </button>
                        </form>
                    </div>

                </div>
            @endforeach

        </div>

    </div>
</x-admin-layout>
