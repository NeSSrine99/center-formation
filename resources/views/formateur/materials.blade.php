<x-admin-layout>
    @section('header', 'Supports de Cours')

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body,
        .admin-content {
            font-family: 'DM Sans', sans-serif;
            background: #f5f6fa;
            color: #1a1d23;
        }

        .page-wrapper {
            padding: 24px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .page-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #1a1d23;
            letter-spacing: -0.3px;
        }

        .page-meta {
            font-size: 0.8rem;
            color: #9499a8;
            margin-top: 3px;
        }

        .materials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .material-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            padding: 20px;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .material-card:hover {
            border-color: #ffd8b8;
            box-shadow: 0 8px 28px rgba(245, 158, 11, 0.10);
            transform: translateY(-3px);
        }

        .material-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #f59e0b, #f7776c);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .material-card:hover::before {
            opacity: 1;
        }

        .material-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
            background: #fff7ed;
            color: #f59e0b;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .material-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1d23;
            margin-bottom: 4px;
            line-height: 1.3;
            word-break: break-word;
        }

        .material-desc {
            font-size: 0.78rem;
            color: #9499a8;
            margin-bottom: 14px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .material-size {
            font-size: 0.75rem;
            color: #9499a8;
            margin-bottom: 14px;
            padding: 8px 0;
            border-top: 1px solid #f0f1f5;
            border-bottom: 1px solid #f0f1f5;
        }

        .material-actions {
            display: flex;
            gap: 8px;
        }

        .btn-card {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.18s;
            flex: 1;
        }

        .btn-card svg {
            width: 13px;
            height: 13px;
        }

        .btn-download {
            background: #fff7ed;
            color: #f59e0b;
        }

        .btn-download:hover {
            background: #f59e0b;
            color: #fff;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #9499a8;
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
            opacity: 0.25;
            margin-bottom: 12px;
            display: block;
            margin-inline: auto;
        }

        @media (max-width: 1024px) {
            .materials-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 16px 14px;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .materials-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
        }

        @media (max-width: 540px) {
            .page-header {
                flex-direction: column;
            }

            .materials-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @php
        $materials = \App\Models\CourseMaterial::whereHas(
            'formation',
            fn($q) => $q->where('formateur_id', auth()->id()),
        )
            ->latest()
            ->get();
    @endphp

    <div class="page-wrapper">
        <div class="page-header">
            <div>
                <div class="page-title">Supports de Cours</div>
                <div class="page-meta">{{ $materials->count() }} supports disponibles</div>
            </div>
        </div>

        @if ($materials->isEmpty())
            <div class="materials-grid">
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    <p>Aucun support disponible pour vos cours</p>
                </div>
            </div>
        @else
            <div class="materials-grid">
                @foreach ($materials as $material)
                    <div class="material-card">
                        <div class="material-icon">📄</div>
                        <div class="material-title">{{ $material->title }}</div>
                        <div class="material-desc">{{ $material->description }}</div>
                        <div class="material-size">📦 Fichier disponible</div>
                        <div class="material-actions">
                            <a href="{{ asset('storage/' . $material->file_path) }}" class="btn-card btn-download"
                                target="_blank" rel="noopener noreferrer">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Télécharger
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-admin-layout>
