<x-admin-layout>
    @section('header', 'Ma Progression')

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
            max-width: 1000px;
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

        .progress-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            padding: 24px;
            margin-bottom: 20px;
        }

        .progress-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .progress-info h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1d23;
            margin: 0 0 4px;
        }

        .progress-info p {
            font-size: 0.8rem;
            color: #9499a8;
            margin: 0;
        }

        .progress-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            background: #eff3ff;
            color: #4F6EF7;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .progress-section {
            margin-bottom: 24px;
        }

        .progress-label {
            font-size: 0.75rem;
            color: #9499a8;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .progress-bar {
            height: 8px;
            background: #f0f1f5;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4F6EF7, #06b6d4);
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 0.8rem;
            color: #1a1d23;
            font-weight: 600;
            margin-top: 6px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-top: 20px;
        }

        .stat-box {
            background: #f9fafb;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
        }

        .stat-value {
            font-size: 1.3rem;
            font-weight: 700;
            color: #4F6EF7;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #9499a8;
            font-weight: 600;
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #9499a8;
        }

        .empty-state svg {
            width: 56px;
            height: 56px;
            opacity: 0.3;
            margin-bottom: 16px;
            display: block;
            margin-inline: auto;
        }

        @media (max-width: 768px) {
            .stats-grid {
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
                <div class="page-title">Ma Progression</div>
                <div class="page-meta">Suivez vos progrès dans vos cours</div>
            </div>
        </div>

        <div class="progress-card">
            <div class="progress-header">
                <div class="progress-info">
                    <h3>Progression globale</h3>
                    <p>Vos apprentissages cette année</p>
                </div>
                <span class="progress-badge">
                    <svg fill="currentColor" viewBox="0 0 24 24" style="width: 14px;">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    En cours
                </span>
            </div>

            <div class="progress-section">
                <div class="progress-label">Progression générale</div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: 65%"></div>
                </div>
                <div class="progress-text">65% complet</div>
            </div>

            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-value">12</div>
                    <div class="stat-label">Cours suivis</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">8</div>
                    <div class="stat-label">Complétés</div>
                </div>
                <div class="stat-box">
                    <div class="stat-value">4</div>
                    <div class="stat-label">En cours</div>
                </div>
            </div>
        </div>

        <div class="empty-state" style="margin-top: 40px;">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p>Vos données de progression détaillées seront affichées ici</p>
        </div>
    </div>

</x-admin-layout>
