<x-admin-layout>
    @section('header', 'Mes Apprenants')

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

        .index-wrapper {
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
            line-height: 1.2;
        }

        .page-meta {
            font-size: 0.8rem;
            color: #9499a8;
            margin-top: 3px;
        }

        .table-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .table-responsive-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-card table {
            width: 100%;
            border-collapse: collapse;
            min-width: 640px;
        }

        .table-card thead {
            background: #f9fafb;
            border-bottom: 1px solid #f0f1f5;
        }

        .table-card thead th {
            padding: 13px 18px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #9499a8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
            cursor: pointer;
            user-select: none;
        }

        .table-card tbody tr {
            border-bottom: 1px solid #f5f6fa;
            transition: background 0.15s;
        }

        .table-card tbody tr:last-child {
            border-bottom: none;
        }

        .table-card tbody tr:hover {
            background: #fafbff;
        }

        .table-card tbody td {
            padding: 13px 18px;
            font-size: 0.86rem;
            color: #374151;
            vertical-align: middle;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.82rem;
            flex-shrink: 0;
            color: #fff;
        }

        .avatar-color-0 {
            background: #10b981;
        }

        .avatar-color-1 {
            background: #3db9e5;
        }

        .avatar-color-2 {
            background: #f59e0b;
        }

        .avatar-color-3 {
            background: #ef4444;
        }

        .avatar-color-4 {
            background: #8b5cf6;
        }

        .user-name {
            font-weight: 600;
            color: #1a1d23;
            font-size: 0.88rem;
        }

        .user-email {
            font-size: 0.75rem;
            color: #9499a8;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 11px;
            border-radius: 20px;
            font-size: 0.76rem;
            font-weight: 600;
            white-space: nowrap;
            background: #eff8ff;
            color: #3db9e5;
        }

        .date-text {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9499a8;
        }

        .empty-state svg {
            width: 44px;
            height: 44px;
            opacity: 0.3;
            margin-bottom: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        @media (max-width: 768px) {
            .index-wrapper {
                padding: 16px 14px;
            }

            .page-title {
                font-size: 1.3rem;
            }

            .table-card table {
                min-width: 100%;
            }
        }

        @media (max-width: 540px) {
            .page-header {
                flex-direction: column;
            }

            .table-card thead th {
                padding: 10px 12px;
                font-size: 0.7rem;
            }

            .table-card tbody td {
                padding: 10px 12px;
                font-size: 0.8rem;
            }
        }
    </style>

    <div class="index-wrapper">
        <div class="page-header">
            <div>
                <div class="page-title">Mes Apprenants</div>
                <div class="page-meta">{{ $students->count() }} apprenant(s) inscrit(s)</div>
            </div>
        </div>

        @if ($students->isEmpty())
            <div class="table-card">
                <div class="empty-state">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p>Aucun apprenant inscrit pour vos cours</p>
                </div>
            </div>
        @else
            <div class="table-card">
                <div class="table-responsive-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Apprenant</th>
                                <th>Email</th>
                                <th>Cours</th>
                                <th>Date d'inscription</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $idx => $inscription)
                                @php
                                    $colors = [
                                        'avatar-color-0',
                                        'avatar-color-1',
                                        'avatar-color-2',
                                        'avatar-color-3',
                                        'avatar-color-4',
                                    ];
                                    $avatarColor = $colors[$idx % count($colors)];
                                    $initials = strtoupper(substr($inscription->apprenant->name, 0, 2));
                                @endphp
                                <tr>
                                    <td>
                                        <div class="user-cell">
                                            <div class="avatar {{ $avatarColor }}">{{ $initials }}</div>
                                            <div>
                                                <div class="user-name">{{ $inscription->apprenant->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $inscription->apprenant->email }}</td>
                                    <td><span class="badge">{{ $inscription->session->formation->titre }}</span></td>
                                    <td><span
                                            class="date-text">{{ \Carbon\Carbon::parse($inscription->date_inscription)->format('d/m/Y') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-admin-layout>
