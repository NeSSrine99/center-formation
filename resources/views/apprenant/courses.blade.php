<x-admin-layout>
    @section('header', 'Mes Cours')

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

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .course-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #f0f1f5;
            overflow: hidden;
            transition: all 0.2s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .course-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #4F6EF7, #06b6d4);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .course-card:hover {
            border-color: #d4d8ff;
            box-shadow: 0 12px 32px rgba(79, 110, 247, 0.12);
            transform: translateY(-4px);
        }

        .course-card:hover::before {
            opacity: 1;
        }

        .card-header {
            background: linear-gradient(135deg, #4F6EF7 0%, #06b6d4 100%);
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
            margin-bottom: 8px;
        }

        .card-subtitle {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .card-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
            margin-top: 8px;
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

        .card-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 12px 0;
            padding: 12px 0;
            border-top: 1px solid #f0f1f5;
            border-bottom: 1px solid #f0f1f5;
            font-size: 0.8rem;
        }

        .detail-item {}

        .detail-label {
            color: #9499a8;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .detail-value {
            color: #1a1d23;
            font-weight: 600;
            margin-top: 4px;
        }

        .progress-section {
            margin-top: 12px;
        }

        .progress-label {
            font-size: 0.75rem;
            color: #9499a8;
            font-weight: 600;
            margin-bottom: 6px;
            text-transform: uppercase;
        }

        .progress-bar {
            height: 6px;
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
            font-size: 0.7rem;
            color: #4F6EF7;
            font-weight: 600;
            margin-top: 4px;
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

        .empty-state p {
            font-size: 0.95rem;
        }

        @media (max-width: 1100px) {
            .courses-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .courses-grid {
                grid-template-columns: 1fr;
            }

            .page-wrapper {
                padding: 16px 14px;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .card-details {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @php
        $colors = ['#4F6EF7', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6'];
    @endphp

    <div class="page-wrapper">
        <div class="page-header">
            <div>
                <div class="page-title">Mes Cours</div>
                <div class="page-meta">Suivez vos cours et améliorez vos compétences</div>
            </div>
        </div>

        @if (isset($courses) && $courses->count() > 0)
            <div class="courses-grid">
                @foreach ($courses as $idx => $course)
                    @php
                        $bgColor = $colors[$idx % count($colors)];
                        $progress = rand(0, 100); // Replace with actual progress data
                    @endphp
                    <div class="course-card">
                        <div class="card-header" style="background: linear-gradient(135deg, {{ $bgColor }} 0%, {{ color_adjust($bgColor, -20) }} 100%);">
                            <div class="card-header-inner">
                                <div class="card-title">{{ $course->titre ?? 'Formation' }}</div>
                                <div class="card-subtitle">Cours</div>
                                <div class="card-badge">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 12px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    Contenu disponible
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <p class="card-description">{{ Str::limit($course->description ?? 'Cours complet avec tous les matériaux', 80) }}</p>

                            <div class="card-details">
                                <div class="detail-item">
                                    <div class="detail-label">FORMATEUR</div>
                                    <div class="detail-value">
                                        @if ($course->formateurs && $course->formateurs->first())
                                            {{ $course->formateurs->first()->user->name }}
                                        @else
                                            Disponible
                                        @endif
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <div class="detail-label">DURÉE</div>
                                    <div class="detail-value">{{ $course->duree ?? 30 }} jours</div>
                                </div>
                            </div>

                            <div class="progress-section">
                                <div class="progress-label">Progression</div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $progress }}%"></div>
                                </div>
                                <div class="progress-text">{{ $progress }}% complet</div>
                            </div>

                            <div class="card-actions">
                                <a href="{{ route('course.detail', $course->id) }}" class="btn-action btn-view">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="width: 13px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Voir le cours
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <p>Vous n'avez pas encore de cours</p>
                <p style="font-size: 0.85rem; margin-top: 8px;"><a href="{{ route('apprenant.inscriptions') }}" style="color: #4F6EF7; text-decoration: none; font-weight: 600;">Consulter les formations disponibles →</a></p>
            </div>
        @endif
    </div>

</x-admin-layout>