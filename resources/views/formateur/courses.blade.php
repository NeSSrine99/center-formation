    <x-admin-layout>
        @section('header', 'Mes Formations')

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

            .formation-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 18px;
            }

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
                box-shadow: 0 8px 28px rgba(79, 110, 247, 0.10);
                transform: translateY(-3px);
            }

            .formation-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #3db9e5, #2196f3);
                opacity: 0;
                transition: opacity 0.2s;
            }

            .formation-card:hover::before {
                opacity: 1;
            }

            .card-top {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 10px;
                margin-bottom: 14px;
            }

            .card-icon {
                width: 46px;
                height: 46px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.3rem;
                flex-shrink: 0;
                background: #eff8ff;
                color: #3db9e5;
                font-weight: 700;
            }

            .card-title {
                font-size: 1rem;
                font-weight: 700;
                color: #1a1d23;
                margin-bottom: 4px;
                line-height: 1.3;
            }

            .card-sub {
                font-size: 0.78rem;
                color: #9499a8;
                margin-bottom: 14px;
            }

            .card-stats {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
                padding: 12px 0;
                border-top: 1px solid #f0f1f5;
                border-bottom: 1px solid #f0f1f5;
                margin-bottom: 14px;
            }

            .stat-item {
                display: flex;
                flex-direction: column;
                gap: 2px;
            }

            .stat-label {
                font-size: 0.68rem;
                color: #9499a8;
                text-transform: uppercase;
                letter-spacing: 0.4px;
            }

            .stat-value {
                font-size: 0.9rem;
                font-weight: 700;
                color: #3db9e5;
            }

            .card-actions {
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

            .btn-card-view {
                background: #eff8ff;
                color: #3db9e5;
            }

            .btn-card-view:hover {
                background: #3db9e5;
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
                .formation-grid {
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

                .formation-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 14px;
                }
            }

            @media (max-width: 540px) {
                .page-header {
                    flex-direction: column;
                }

                .formation-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        @php
            $courses = \App\Models\Formation::where('formateur_id', auth()->id())
                ->latest()
                ->get();
        @endphp

        <div class="page-wrapper">
            <div class="page-header">
                <div>
                    <div class="page-title">Mes Formations</div>
                    <div class="page-meta">{{ $courses->count() }} formations</div>
                </div>
            </div>

            @if ($courses->isEmpty())
                <div class="formation-grid">
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p>Vous n'avez encore aucune formation</p>
                    </div>
                </div>
            @else
                <div class="formation-grid">
                    @foreach ($courses as $course)
                        <div class="formation-card">
                            <div class="card-top">
                                <div class="card-icon">📚</div>
                            </div>
                            <div class="card-title">{{ $course->titre }}</div>
                            <div class="card-sub">{{ Str::limit($course->description, 60) }}</div>
                            <div class="card-stats">
                                <div class="stat-item">
                                    <span class="stat-label">Sessions</span>
                                    <span class="stat-value">{{ $course->sessions->count() }}</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-label">Inscrits</span>
                                    <span
                                        class="stat-value">{{ $course->sessions->sum(fn($s) => $s->inscriptions->count()) }}</span>
                                </div>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('formateur.courses.show', $course->id) }}" class="btn-card btn-card-view">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                    Détails
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </x-admin-layout>
