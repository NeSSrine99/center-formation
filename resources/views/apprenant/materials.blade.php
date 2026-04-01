<x-admin-layout>
    @section('header', 'Matériels de Cours')

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
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .page-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #1a1d23;
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .page-meta {
            font-size: 0.8rem;
            color: #9499a8;
            margin-top: 3px;
        }

        .materials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .material-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            overflow: hidden;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
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

        .material-card:hover {
            border-color: #fde3c5;
            box-shadow: 0 12px 32px rgba(245, 158, 11, 0.12);
            transform: translateY(-4px);
        }

        .material-card:hover::before {
            opacity: 1;
        }

        .card-header {
            background: linear-gradient(135deg, #f59e0b 0%, #f7776c 100%);
            color: #fff;
            padding: 18px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -40px;
            right: -40px;
        }

        .card-header-inner {
            position: relative;
            z-index: 1;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .card-subtitle {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .card-body {
            padding: 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .card-description {
            font-size: 0.85rem;
            color: #9499a8;
            line-height: 1.4;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: #9499a8;
            margin: 12px 0;
            padding: 12px 0;
            border-top: 1px solid #f0f1f5;
            border-bottom: 1px solid #f0f1f5;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .card-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
            padding-top: 12px;
            border-top: 1px solid #f0f1f5;
        }

        .btn-action {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.18s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
        }

        .btn-download {
            background: #fef3e2;
            color: #f59e0b;
        }

        .btn-download:hover {
            background: #f59e0b;
            color: #fff;
        }

        .btn-view {
            background: #eff3ff;
            color: #4F6EF7;
        }

        .btn-view:hover {
            background: #4F6EF7;
            color: #fff;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #9499a8;
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
        }

        .empty-state svg {
            width: 56px;
            height: 56px;
            opacity: 0.3;
            margin-bottom: 16px;
            display: block;
            margin-inline: auto;
        }

        @media (max-width: 1100px) {
            .materials-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .materials-grid {
                grid-template-columns: 1fr;
            }

            .page-wrapper {
                padding: 16px 14px;
            }

            .page-title {
                font-size: 1.3rem;
            }
        }
    </style>

    <div class="page-wrapper">
        <div class="page-header">
            <div>
                <div class="page-title">Matériels de Cours</div>
                <div class="page-meta">Téléchargez les ressources de vos formations</div>
            </div>
        </div>

        <div class="materials-grid">
            <div class="empty-state" style="grid-column: 1 / -1;">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 14v6m0 0l-3-3m3 3l3-3M3 10h18M7 3h10m-3 6h6m-9 6h18" />
                </svg>
                <p>Aucun matériel disponible pour le moment</p>
                <p style="font-size: 0.85rem; margin-top: 8px;"><a href="{{ route('apprenant.courses') }}"
                        style="color: #4F6EF7; text-decoration: none; font-weight: 600;">Accédez à vos cours →</a></p>
            </div>
        </div>
    </div>

</x-admin-layout>
