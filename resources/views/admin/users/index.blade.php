<x-admin-layout>
    @section('header', 'Gestion des Utilisateurs')

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

        /* ── Wrapper ── */
        .index-wrapper {
            padding: 24px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ── Alert ── */
        .alert-success-custom {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #065f46;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .alert-success-custom svg {
            flex-shrink: 0;
            width: 16px;
            height: 16px;
        }

        /* ── Page Header ── */
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

        /* ── Toolbar ── */
        .toolbar {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .show-select {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.83rem;
            color: #6b7280;
        }

        .show-select select {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 7px 10px;
            font-family: inherit;
            font-size: 0.83rem;
            background: #fff;
            cursor: pointer;
            outline: none;
        }

        .btn-toolbar {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 0.83rem;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.18s;
            white-space: nowrap;
        }

        .btn-toolbar:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            color: #1a1d23;
        }

        .btn-toolbar svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }

        .btn-primary-action {
            background: #4F6EF7;
            color: #fff;
            border-color: #4F6EF7;
            font-weight: 600;
        }

        .btn-primary-action:hover {
            background: #3a57e8;
            border-color: #3a57e8;
            color: #fff;
            box-shadow: 0 4px 14px rgba(79, 110, 247, .35);
            transform: translateY(-1px);
        }

        /* ── Table Card ── */
        .table-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        /* ── Desktop Table ── */
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

        .sort-icon {
            display: inline-block;
            margin-left: 3px;
            opacity: 0.4;
            font-size: 0.68rem;
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

        .user-name {
            font-weight: 600;
            color: #1a1d23;
            font-size: 0.88rem;
        }

        .id-badge {
            font-family: 'Courier New', monospace;
            font-size: 0.75rem;
            color: #9499a8;
            background: #f5f6fa;
            padding: 3px 8px;
            border-radius: 6px;
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
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .badge-admin {
            background: #fef2f2;
            color: #dc2626;
        }

        .badge-admin .badge-dot {
            background: #dc2626;
        }

        .badge-formateur {
            background: #eff6ff;
            color: #2563eb;
        }

        .badge-formateur .badge-dot {
            background: #2563eb;
        }

        .badge-apprenant {
            background: #f0fdf4;
            color: #16a34a;
        }

        .badge-apprenant .badge-dot {
            background: #16a34a;
        }

        .date-text {
            font-size: 0.8rem;
            color: #6b7280;
        }

        /* Action buttons */
        .actions-cell {
            display: flex;
            align-items: center;
            gap: 6px;
            justify-content: center;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.18s;
            text-decoration: none;
        }

        .btn-edit {
            background: #eff6ff;
            color: #2563eb;
        }

        .btn-edit:hover {
            background: #2563eb;
            color: #fff;
        }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: #fff;
        }

        .btn-action svg {
            width: 14px;
            height: 14px;
        }

        /* Empty state */
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

        /* Pagination */
        .pagination-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 20px;
            border-top: 1px solid #f0f1f5;
            font-size: 0.8rem;
            color: #9499a8;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-btns {
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
        }

        .page-btn {
            min-width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #4b5563;
            font-size: 0.8rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 8px;
            transition: all 0.15s;
            text-decoration: none;
        }

        .page-btn:hover {
            border-color: #4F6EF7;
            color: #4F6EF7;
        }

        .page-btn.active {
            background: #4F6EF7;
            color: #fff;
            border-color: #4F6EF7;
        }

        /* ══════════════════════════════
       MOBILE CARD LIST  (≤ 700px)
       Hide table, show cards instead
    ══════════════════════════════ */
        .mobile-cards {
            display: none;
        }

        .user-card {
            padding: 16px;
            border-bottom: 1px solid #f5f6fa;
            transition: background 0.15s;
        }

        .user-card:last-child {
            border-bottom: none;
        }

        .user-card:hover {
            background: #fafbff;
        }

        .user-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .user-card-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
            min-width: 0;
        }

        .user-card-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1a1d23;
        }

        .user-card-email {
            font-size: 0.75rem;
            color: #9499a8;
            margin-top: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-card-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .user-card-actions {
            display: flex;
            gap: 6px;
            flex-shrink: 0;
        }

        /* ══════════════════════════════
       BREAKPOINTS
    ══════════════════════════════ */

        /* Tablet ≤ 900px */
        @media (max-width: 900px) {
            .page-header {
                gap: 12px;
            }

            .page-title {
                font-size: 1.3rem;
            }

            /* Hide Filter/Export labels, keep icons */
            .btn-label {
                display: none;
            }

            .btn-toolbar {
                padding: 8px 10px;
            }

            .show-select span {
                display: none;
            }
        }

        /* Mobile ≤ 700px — switch to card list */
        @media (max-width: 700px) {
            .index-wrapper {
                padding: 16px 12px;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .page-meta {
                font-size: 0.75rem;
            }

            /* Header: title on top, toolbar below */
            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .toolbar {
                justify-content: flex-start;
            }

            /* Hide table, show cards */
            .table-responsive-wrap {
                display: none;
            }

            .mobile-cards {
                display: block;
            }

            /* Pagination row adjust */
            .pagination-row {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Tiny ≤ 380px */
        @media (max-width: 380px) {
            .btn-primary-action .btn-label-full {
                display: none;
            }

            .btn-primary-action::after {
                content: 'Ajouter';
            }
        }
    </style>

    <div class="index-wrapper">

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert-success-custom">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <div class="page-title">Utilisateurs</div>
                <div class="page-meta">{{ $users->count() }} utilisateurs trouvés</div>
            </div>

            <div class="toolbar">
                <div class="show-select">
                    <span>Showing</span>
                    <select onchange="window.location.href='?per_page='+this.value">
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <button class="btn-toolbar">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h18M7 12h10M11 20h2" />
                    </svg>
                    <span class="btn-label">Filter</span>
                </button>

                <button class="btn-toolbar">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                    </svg>
                    <span class="btn-label">Export</span>
                </button>

                <a href="{{ route('admin.create-user') }}" class="btn-toolbar btn-primary-action">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="btn-label">Ajouter Utilisateur</span>
                </a>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="table-card">

            {{-- ── Desktop Table ── --}}
            <div class="table-responsive-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#ID <span class="sort-icon">↕</span></th>
                            <th>Nom <span class="sort-icon">↕</span></th>
                            <th>Email <span class="sort-icon">↕</span></th>
                            <th>Rôle <span class="sort-icon">↕</span></th>
                            <th>Date de Création <span class="sort-icon">↕</span></th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @php
                                $colors = ['#4F6EF7', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6', '#06b6d4', '#ec4899'];
                                $color = $colors[$user->id % count($colors)];
                                $initials = strtoupper(substr($user->name, 0, 1));
                                $roleName = $user->role->name ?? 'apprenant';
                                $badgeClass = match ($roleName) {
                                    'administrateur' => 'badge-admin',
                                    'formateur' => 'badge-formateur',
                                    default => 'badge-apprenant',
                                };
                            @endphp
                            <tr>
                                <td><span class="id-badge">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span></td>
                                <td>
                                    <div class="user-cell">
                                        <div class="avatar" style="background:{{ $color }}">{{ $initials }}
                                        </div>
                                        <div class="user-name">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="date-text">{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $badgeClass }}">
                                        <span class="badge-dot"></span>{{ ucfirst($roleName) }}
                                    </span>
                                </td>
                                <td class="date-text">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="actions-cell">
                                        <a href="{{ route('admin.edit-user', $user->id) }}" class="btn-action btn-edit"
                                            title="Modifier">
                                            <svg fill="none" stroke="currentColor" stroke-width="2"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828A2 2 0 0110 16H8v-2a2 2 0 01.586-1.414z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Supprimer">
                                                <svg fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.5"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <p>Aucun utilisateur trouvé.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- ── Mobile Card List ── --}}
            <div class="mobile-cards">
                @forelse($users as $user)
                    @php
                        $colors = ['#4F6EF7', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6', '#06b6d4', '#ec4899'];
                        $color = $colors[$user->id % count($colors)];
                        $initials = strtoupper(substr($user->name, 0, 1));
                        $roleName = $user->role->name ?? 'apprenant';
                        $badgeClass = match ($roleName) {
                            'administrateur' => 'badge-admin',
                            'formateur' => 'badge-formateur',
                            default => 'badge-apprenant',
                        };
                    @endphp
                    <div class="user-card">
                        <div class="user-card-top">
                            <div class="user-card-left">
                                <div class="avatar"
                                    style="background:{{ $color }}; width:42px; height:42px; font-size:0.95rem; flex-shrink:0;">
                                    {{ $initials }}</div>
                                <div style="min-width:0;">
                                    <div class="user-card-name">{{ $user->name }}</div>
                                    <div class="user-card-email">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="user-card-actions">
                                <a href="{{ route('admin.edit-user', $user->id) }}" class="btn-action btn-edit">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828A2 2 0 0110 16H8v-2a2 2 0 01.586-1.414z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.delete-user', $user->id) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Supprimer ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <svg fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="user-card-meta">
                            <span class="id-badge">#{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <span class="badge {{ $badgeClass }}">
                                <span class="badge-dot"></span>{{ ucfirst($roleName) }}
                            </span>
                            <span class="date-text">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p>Aucun utilisateur trouvé.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->total() > 0)
                <div class="pagination-row">
                    <span>{{ $users->firstItem() }}–{{ $users->lastItem() }} sur {{ $users->total() }}</span>
                    <div class="pagination-btns">
                        @if ($users->onFirstPage())
                            <span class="page-btn" style="opacity:.4;cursor:default;">← Préc.</span>
                        @else
                            <a class="page-btn" href="{{ $users->previousPageUrl() }}">← Préc.</a>
                        @endif

                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            <a class="page-btn {{ $page == $users->currentPage() ? 'active' : '' }}"
                                href="{{ $url }}">{{ $page }}</a>
                        @endforeach

                        @if ($users->hasMorePages())
                            <a class="page-btn" href="{{ $users->nextPageUrl() }}">Suiv. →</a>
                        @else
                            <span class="page-btn" style="opacity:.4;cursor:default;">Suiv. →</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>{{-- /.table-card --}}
    </div>{{-- /.index-wrapper --}}
</x-admin-layout>
