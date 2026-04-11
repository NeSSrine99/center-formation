<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@php
    $unreadCount = \App\Models\Notification::where('user_id', auth()->id())->where('read', false)->count();
    $notifications = \App\Models\Notification::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Centre de Formation') }} — Admin</title>

    <!-- Bootstrap (for utility classes used in child views) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DM Sans — matches every redesigned page -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           CSS VARIABLES — single source of truth
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        :root {
            --sidebar-w: 240px;
            --sidebar-w-mini: 68px;
            --header-h: 64px;
            --bg: #f0f2f8;
            --surface: #ffffff;
            --border: #f0f1f5;
            --primary: #4F6EF7;
            --primary-light: #eff3ff;
            --text-main: #1a1d23;
            --text-muted: #9499a8;
            --text-sub: #6b7280;
            --radius-card: 18px;
            --shadow-card: 0 2px 20px rgba(0, 0, 0, 0.05);
            --transition: 0.22s ease;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           RESET & BASE
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            height: 100%;
            overflow-x: hidden;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           LAYOUT SHELL
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        .shell {
            display: flex;
            min-height: 100vh;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           SIDEBAR
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1.5px solid var(--border);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: width var(--transition), transform var(--transition);
            overflow: hidden;
        }

        /* Mini mode (icon-only) */
        .sidebar.mini {
            width: var(--sidebar-w-mini);
        }

        /* Mobile: slide in/out */
        .sidebar.hidden {
            transform: translateX(-100%);
        }

        /* Logo area */
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 18px;
            height: var(--header-h);
            border-bottom: 1.5px solid var(--border);
            flex-shrink: 0;
            overflow: hidden;
            white-space: nowrap;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #06b6d4);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(79, 110, 247, 0.3);
        }

        .logo-icon svg {
            width: 18px;
            height: 18px;
            color: #fff;
        }

        .logo-text {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.3px;
            transition: opacity var(--transition);
        }

        .logo-sub {
            font-size: 0.65rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .sidebar.mini .logo-text,
        .sidebar.mini .logo-sub {
            opacity: 0;
            pointer-events: none;
            width: 0;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 16px 10px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 3px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 99px;
        }

        .nav-section-label {
            font-size: 0.62rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-muted);
            padding: 10px 8px 6px;
            white-space: nowrap;
            overflow: hidden;
            transition: opacity var(--transition);
        }

        .sidebar.mini .nav-section-label {
            opacity: 0;
            height: 0;
            padding: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 12px;
            color: var(--text-sub);
            text-decoration: none;
            font-size: 0.87rem;
            font-weight: 500;
            transition: all 0.18s;
            position: relative;
            white-space: nowrap;
            overflow: hidden;
        }

        .nav-item:hover {
            background: var(--primary-light);
            color: var(--primary);
        }

        .nav-item.active {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            bottom: 20%;
            width: 3px;
            background: var(--primary);
            border-radius: 0 3px 3px 0;
        }

        .nav-item-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.18s;
            font-size: 1rem;
        }

        .nav-item:hover .nav-item-icon,
        .nav-item.active .nav-item-icon {
            background: rgba(79, 110, 247, 0.12);
        }

        .nav-item svg {
            width: 17px;
            height: 17px;
            flex-shrink: 0;
        }

        .nav-item-label {
            transition: opacity var(--transition), width var(--transition);
            overflow: hidden;
        }

        .sidebar.mini .nav-item-label {
            opacity: 0;
            width: 0;
        }

        .nav-badge {
            margin-left: auto;
            background: var(--primary);
            color: #fff;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            flex-shrink: 0;
            transition: opacity var(--transition);
        }

        .sidebar.mini .nav-badge {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        /* Tooltip on mini mode */
        .nav-item[data-tip] {
            position: relative;
        }

        .sidebar.mini .nav-item[data-tip]:hover::after {
            content: attr(data-tip);
            position: absolute;
            left: calc(100% + 12px);
            top: 50%;
            transform: translateY(-50%);
            background: #1a1d23;
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 8px;
            white-space: nowrap;
            pointer-events: none;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .sidebar.mini .nav-item[data-tip]:hover::before {
            content: '';
            position: absolute;
            left: calc(100% + 6px);
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: #1a1d23;
            pointer-events: none;
            z-index: 9999;
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 12px 10px;
            border-top: 1.5px solid var(--border);
            flex-shrink: 0;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            transition: background 0.18s;
            cursor: pointer;
            text-decoration: none;
            overflow: hidden;
        }

        .sidebar-user:hover {
            background: var(--primary-light);
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            flex-shrink: 0;
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info {
            overflow: hidden;
            transition: opacity var(--transition);
        }

        .user-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-main);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.68rem;
            color: var(--text-muted);
        }

        .sidebar.mini .user-info {
            opacity: 0;
            width: 0;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           MAIN AREA
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        .main-area {
            flex: 1;
            margin-left: var(--sidebar-w);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: margin-left var(--transition);
        }

        .main-area.mini {
            margin-left: var(--sidebar-w-mini);
        }

        .main-area.full {
            margin-left: 0;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           TOP HEADER
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        .top-header {
            height: var(--header-h);
            background: var(--surface);
            border-bottom: 1.5px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* Hamburger */
        .menu-toggle {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            border: 1.5px solid var(--border);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.18s;
            flex-shrink: 0;
        }

        .menu-toggle:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .menu-toggle svg {
            width: 16px;
            height: 16px;
            color: var(--text-sub);
        }

        .menu-toggle:hover svg {
            color: var(--primary);
        }

        /* Breadcrumb */
        .header-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.2px;
        }

        .header-sub {
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        /* Search */
        .header-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 8px 14px;
            margin-left: auto;
            width: 240px;
            transition: all 0.18s;
        }

        .header-search:focus-within {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(79, 110, 247, 0.1);
            width: 300px;
        }

        .header-search svg {
            width: 14px;
            height: 14px;
            color: var(--text-muted);
            flex-shrink: 0;
        }

        .header-search input {
            border: none;
            outline: none;
            background: transparent;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.83rem;
            color: var(--text-main);
            width: 100%;
        }

        .header-search input::placeholder {
            color: #c1c5cf;
        }

        /* Header actions */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .h-btn {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            border: 1.5px solid var(--border);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.18s;
            position: relative;
        }

        .h-btn:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .h-btn svg {
            width: 16px;
            height: 16px;
            color: var(--text-sub);
        }

        .h-btn:hover svg {
            color: var(--primary);
        }

        .h-btn-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid #fff;
            position: absolute;
            top: 5px;
            right: 5px;
        }

        .notif-item.inscription-notification {
            background: #eff6ff !important;
            border-left: 3px solid #3b82f6;
        }

        .notif-item.inscription-notification:hover {
            background: #dbeafe !important;
        }

        .notif-icon.inscription-icon {
            background: #dbeafe;
            color: #3b82f6;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notif-icon.inscription-icon svg {
            width: 16px;
            height: 16px;
        }

        .notif-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 320px;
            background: #fff;
            border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease;
            z-index: 9999;
        }

        .notification-wrapper.open .notif-dropdown {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateY(0);
        }

        .notif-item {
            display: flex;
            gap: 10px;
            padding: 12px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
            transition: 0.15s;
        }

        .notif-item:hover {
            background: #f9fafb;
        }

        .notif-icon {
            font-size: 18px;
        }

        .notif-content {
            flex: 1;
        }

        .notif-title {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .notif-msg {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .notif-time {
            font-size: 0.7rem;
            color: #9ca3af;
        }

        .notif-dot {
            width: 8px;
            height: 8px;
            background: #f59e0b;
            border-radius: 50%;
        }

        /* User dropdown */
        .header-user {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 5px 10px 5px 6px;
            border-radius: 10px;
            border: 1.5px solid var(--border);
            cursor: pointer;
            transition: all 0.18s;
            position: relative;
        }

        .header-user:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }

        .h-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4F6EF7, #06b6d4);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .h-user-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .h-user-chevron {
            width: 13px;
            height: 13px;
            color: var(--text-muted);
        }

        /* Dropdown menu */
        .user-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            border: 1.5px solid var(--border);
            min-width: 200px;
            overflow: hidden;
            opacity: 0;
            pointer-events: none;
            transform: translateY(-8px);
            transition: all 0.18s;
            z-index: 9999;
        }

        .header-user.open .user-dropdown {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
        }

        .dropdown-header .d-name {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .dropdown-header .d-email {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            font-size: 0.83rem;
            color: var(--text-sub);
            text-decoration: none;
            transition: background 0.15s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            font-family: 'DM Sans', sans-serif;
        }

        .dropdown-item-custom:hover {
            background: var(--bg);
            color: var(--text-main);
        }

        .dropdown-item-custom svg {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
        }

        .dropdown-item-custom.danger {
            color: #dc2626;
        }

        .dropdown-item-custom.danger:hover {
            background: #fef2f2;
        }

        .dropdown-divider-custom {
            height: 1px;
            background: var(--border);
            margin: 4px 0;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           PAGE CONTENT
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        .page-content {
            flex: 1;
            background: var(--bg);
            overflow-y: auto;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           MOBILE OVERLAY
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1035;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           RESPONSIVE
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        @media (max-width: 1024px) {
            :root {
                --sidebar-w: 220px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-w) !important;
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-area {
                margin-left: 0 !important;
            }

            .header-search {
                display: none;
            }

            .h-user-name {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .top-header {
                padding: 0 14px;
                gap: 10px;
            }

            .header-title {
                font-size: 0.95rem;
            }
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           SCROLLBAR global
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #dde1ea;
            border-radius: 99px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #c1c5d0;
        }

        /* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
           ADMIN CONTENT (used by child views)
        ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
        .admin-content {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
        }
    </style>
</head>

<body>

    <div class="shell">

        <!-- ══════════════════════════════════════
         SIDEBAR
    ══════════════════════════════════════ -->
        <aside class="sidebar" id="sidebar">

            <!-- Logo -->
            <div class="sidebar-logo">
                <div class="logo-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <div>
                    <div class="logo-text">FormaPro</div>
                    <div class="logo-sub">
                        @php
                            $userRole = auth()->user()->role;
                            $roleName = '';

                            // If role is a model object, get the name property
                            if (is_object($userRole)) {
                                $roleName = $userRole->name ?? 'user';
                            } elseif (is_numeric($userRole)) {
                                // If it's an ID, map it
    $roleIdMap = [1 => 'admin', 2 => 'formateur', 3 => 'apprenant'];
    $roleName = $roleIdMap[$userRole] ?? 'user';
} else {
    $roleName = $userRole ?? 'user';
}

$roleMap = [
    'admin' => 'Admin Panel',
    'formateur' => 'Formateur',
    'apprenant' => 'Apprenant',
];
echo $roleMap[$roleName] ?? 'Dashboard';
                        @endphp
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">

                @php
                    $userRole = auth()->user()->role;
                    $roleName = '';

                    // If role is a model object, get the name property
                    if (is_object($userRole)) {
                        $roleName = $userRole->name ?? 'guest';
                    } elseif (is_numeric($userRole)) {
                        // If it's an ID, map it
    $roleIdMap = [1 => 'administrateur', 2 => 'formateur', 3 => 'apprenant'];
    $roleName = $roleIdMap[$userRole] ?? 'guest';
} else {
    $roleName = $userRole ?? 'guest';
                    }
                    $role = $roleName;
                @endphp

                <!-- ═══════════ ADMIN DASHBOARD ═══════════ -->
                @if ($role === 'administrateur')
                    <div class="nav-section-label">Principal</div>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        data-tip="Dashboard">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Dashboard</span>
                    </a>

                    <div class="nav-section-label">Gestion</div>

                    <a href="{{ route('admin.users') }}"
                        class="nav-item {{ request()->routeIs('admin.users*') || request()->routeIs('admin.create-user') || request()->routeIs('admin.edit-user*') ? 'active' : '' }}"
                        data-tip="Utilisateurs">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Utilisateurs</span>
                        @php $usersCount = \App\Models\User::count(); @endphp
                        @if ($usersCount > 0)
                            <span class="nav-badge">{{ $usersCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.formations') }}"
                        class="nav-item {{ request()->routeIs('admin.formations*') || request()->routeIs('admin.create-formation') || request()->routeIs('admin.edit-formation*') ? 'active' : '' }}"
                        data-tip="Formations">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Formations</span>
                        @php $formCount = \App\Models\Formation::count(); @endphp
                        @if ($formCount > 0)
                            <span class="nav-badge" style="background:#06b6d4;">{{ $formCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.sessions') }}"
                        class="nav-item {{ request()->routeIs('admin.sessions*') || request()->routeIs('admin.create-session') || request()->routeIs('admin.edit-session*') ? 'active' : '' }}"
                        data-tip="Sessions">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Sessions</span>
                        @php $sessCount = \App\Models\FormationSession::where('statut','ouverte')->count(); @endphp
                        @if ($sessCount > 0)
                            <span class="nav-badge" style="background:#f76c8f;">{{ $sessCount }}</span>
                        @endif
                    </a>

                    <div class="nav-section-label">Système</div>

                    <a href="{{ route('admin.settings') }}"
                        class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
                        data-tip="Paramètres">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Paramètres</span>
                    </a>
                @endif

                <!-- ═══════════ FORMATEUR DASHBOARD ═══════════ -->
                @if ($role === 'formateur')
                    <div class="nav-section-label">Principal</div>
                    <a href="{{ route('formateur.dashboard') }}"
                        class="nav-item {{ request()->routeIs('formateur.dashboard') ? 'active' : '' }}"
                        data-tip="Dashboard">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Dashboard</span>
                    </a>

                    <div class="nav-section-label">Mes Formations</div>

                    <a href="{{ route('formateur.courses') }}"
                        class="nav-item {{ request()->routeIs('formateur.courses*') ? 'active' : '' }}"
                        data-tip="Mes Cours">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Mes Cours</span>
                    </a>

                    <a href="{{ route('formateur.materials') }}"
                        class="nav-item {{ request()->routeIs('formateur.materials*') ? 'active' : '' }}"
                        data-tip="Matériels">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 14l6-6m-5.5.5h.01m4 4h.01m4 4h.01M9 7.5A4.5 4.5 0 1018 7.5A4.5 4.5 0 009 7.5z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Matériels</span>
                    </a>

                    <a href="{{ route('formateur.students') }}"
                        class="nav-item {{ request()->routeIs('formateur.students*') ? 'active' : '' }}"
                        data-tip="Étudiants">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6-4a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Étudiants</span>
                    </a>
                @endif

                <!-- ═══════════ APPRENANT DASHBOARD ═══════════ -->
                @if ($role === 'apprenant')
                    <div class="nav-section-label">Principal</div>
                    <a href="{{ route('apprenant.dashboard') }}"
                        class="nav-item {{ request()->routeIs('apprenant.dashboard') ? 'active' : '' }}"
                        data-tip="Dashboard">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Dashboard</span>
                    </a>

                    <div class="nav-section-label">Mon Apprentissage</div>

                    <a href="{{ route('apprenant.courses') }}"
                        class="nav-item {{ request()->routeIs('apprenant.courses*') ? 'active' : '' }}"
                        data-tip="Mes Cours">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Mes Cours</span>
                    </a>

                    <a href="{{ route('apprenant.inscriptions') }}"
                        class="nav-item {{ request()->routeIs('apprenant.inscriptions*') ? 'active' : '' }}"
                        data-tip="Inscriptions">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Inscriptions</span>
                    </a>

                    <a href="{{ route('apprenant.progress') }}"
                        class="nav-item {{ request()->routeIs('apprenant.progress*') ? 'active' : '' }}"
                        data-tip="Progression">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Ma Progression</span>
                    </a>

                    <a href="{{ route('apprenant.materials') }}"
                        class="nav-item {{ request()->routeIs('apprenant.materials*') ? 'active' : '' }}"
                        data-tip="Matériels">
                        <div class="nav-item-icon">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 14l6-6m-5.5.5h.01m4 4h.01m4 4h.01M9 7.5A4.5 4.5 0 1018 7.5A4.5 4.5 0 009 7.5z" />
                            </svg>
                        </div>
                        <span class="nav-item-label">Matériels</span>
                    </a>
                @endif

                <div class="nav-section-label">Autres</div>

                <a href="{{ route('home') }}" class="nav-item" data-tip="Retour au site">
                    <div class="nav-item-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <span class="nav-item-label">Retour au site</span>
                </a>
            </nav>

            <!-- User info footer -->
            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">
                            @php
                                $userRole = auth()->user()->role;
                                $roleName = '';

                                // If role is a model object, get the name property
                                if (is_object($userRole)) {
                                    $roleName = $userRole->name ?? 'user';
                                } elseif (is_numeric($userRole)) {
                                    // If it's an ID, map it
    $roleIdMap = [1 => 'admin', 2 => 'formateur', 3 => 'apprenant'];
    $roleName = $roleIdMap[$userRole] ?? 'user';
} else {
    $roleName = $userRole ?? 'user';
}

$roleLabels = [
    'admin' => 'Administrateur',
    'formateur' => 'Formateur',
    'apprenant' => 'Apprenant',
];
echo $roleLabels[$roleName] ?? 'Utilisateur';
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile overlay -->
        <div class="sidebar-overlay" id="overlay"></div>

        <!-- ══════════════════════════════════════
         MAIN AREA
    ══════════════════════════════════════ -->
        <div class="main-area" id="mainArea">

            <!-- ── TOP HEADER ── -->
            <header class="top-header">

                <!-- Toggle -->
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle sidebar">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Page title -->
                <div>
                    <div class="header-title">@yield('header', 'Administration')</div>
                </div>

                <!-- Search -->
                <div class="header-search">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-4.35-4.35M17 11A6 6 0 105 11a6 6 0 0012 0z" />
                    </svg>
                    <input type="text" placeholder="Rechercher...">
                </div>

                <!-- Actions -->
                <div class="header-actions">

                    <!-- Notifications -->
                    <div class="notification-wrapper" style="position: relative;">

                        <button class="h-btn" id="notifTrigger" title="Notifications">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>

                            @if (isset($unreadCount) && $unreadCount > 0)
                                <span class="h-btn-dot"></span>
                            @endif
                        </button>

                        <!-- DROPDOWN -->
                        <div class="notif-dropdown" id="notifDropdown">

                            <div style="padding: 12px 14px; border-bottom: 1px solid #eee; font-weight: 600;">
                                Notifications
                            </div>

                            @if (isset($notifications) && $notifications->count() > 0)

                                @foreach ($notifications as $notification)
                                    @php
                                        $isInscriptionNotif = str_contains($notification->title, 'Nouvelle inscription') ||
                                                             str_contains($notification->title, 'inscription') ||
                                                             isset($notification->data['inscription_id']);
                                    @endphp
                                    <div class="notif-item {{ $isInscriptionNotif ? 'inscription-notification' : '' }}" data-id="{{ $notification->id }}">

                                        <div class="notif-icon {{ $isInscriptionNotif ? 'inscription-icon' : '' }}">
                                            @if($isInscriptionNotif)
                                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            @else
                                                🔔
                                            @endif
                                        </div>

                                        <div class="notif-content">
                                            <div class="notif-title">{{ $notification->title }}</div>
                                            <div class="notif-msg">{{ $notification->message }}</div>
                                            <div class="notif-time">{{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        </div>

                                        @if (!$notification->read)
                                            <span class="notif-dot"></span>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div style="padding: 16px; text-align: center; color: #999;">
                                    No notifications
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- User Dropdown -->
                    <div class="header-user" id="userDropdownTrigger">
                        <div class="h-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="h-user-name">{{ Str::limit(auth()->user()->name, 14) }}</span>
                        <svg class="h-user-chevron" fill="none" stroke="currentColor" stroke-width="2.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>

                        <!-- Dropdown -->
                        <div class="user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-name">{{ auth()->user()->name }}</div>
                                <div class="d-email">{{ auth()->user()->email }}</div>
                            </div>

                            <div style="padding: 6px 0;">
                                @if(auth()->user()->isAdministrateur())
                                    <a href="{{ route('admin.settings') }}" class="dropdown-item-custom">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Paramètres
                                    </a>
                                @endif
                                <a href="{{ route('home') }}" class="dropdown-item-custom">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Retour au site
                                </a>
                            </div>

                            <div class="dropdown-divider-custom"></div>

                            <div style="padding: 6px 0;">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item-custom danger">
                                        <svg fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ── PAGE CONTENT ── -->
            <div class="page-content admin-content">
                {{ $slot }}
            </div>

        </div>{{-- /.main-area --}}
    </div>{{-- /.shell --}}

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainArea = document.getElementById('mainArea');
        const toggle = document.getElementById('menuToggle');
        const overlay = document.getElementById('overlay');
        const isMobile = () => window.innerWidth <= 768;

        // ── TOGGLE LOGIC ──
        toggle.addEventListener('click', () => {
            if (isMobile()) {
                // Mobile: slide in/out
                const isOpen = sidebar.classList.contains('mobile-open');
                sidebar.classList.toggle('mobile-open', !isOpen);
                overlay.classList.toggle('show', !isOpen);
            } else {
                // Desktop: mini / full
                const isMini = sidebar.classList.contains('mini');
                sidebar.classList.toggle('mini', !isMini);
                mainArea.classList.toggle('mini', !isMini);
            }
        });

        // Close on overlay click (mobile)
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        });

        // On resize: clean up classes
        window.addEventListener('resize', () => {
            if (!isMobile()) {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('show');
                // Restore margin
                if (!sidebar.classList.contains('mini')) {
                    mainArea.classList.remove('full');
                }
            }
        });

        // ── USER DROPDOWN ──
        const userTrigger = document.getElementById('userDropdownTrigger');
        userTrigger.addEventListener('click', (e) => {
            userTrigger.classList.toggle('open');
            e.stopPropagation();
        });
        document.addEventListener('click', () => {
            userTrigger.classList.remove('open');
        });

        // ── ACTIVE NAV HIGHLIGHT on mini mode tooltip ──
        // Already handled by CSS :hover pseudo-elements

        const notifTrigger = document.getElementById('notifTrigger');
        const notifWrapper = document.querySelector('.notification-wrapper');

        notifTrigger.addEventListener('click', (e) => {
            notifWrapper.classList.toggle('open');
            e.stopPropagation();
        });

        document.addEventListener('click', () => {
            notifWrapper.classList.remove('open');
        });

        // ── NOTIFICATION CLICK HANDLING ──
        document.querySelectorAll('.notif-item').forEach(item => {
            item.addEventListener('click', function() {
                const notificationId = this.getAttribute('data-id');
                const isInscriptionNotif = this.classList.contains('inscription-notification');

                if (notificationId) {
                    // Mark as read first
                    markNotificationAsRead(notificationId);

                    // If it's an inscription notification, redirect to admin inscriptions page
                    if (isInscriptionNotif) {
                        window.location.href = '/admin/inscriptions';
                        return;
                    }
                }
            });
        });

        function markNotificationAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the notification item appearance
                    const notificationItem = document.querySelector(`[data-id="${notificationId}"]`);
                    if (notificationItem) {
                        notificationItem.style.opacity = '0.7';
                        const dot = notificationItem.querySelector('.notif-dot');
                        if (dot) {
                            dot.style.display = 'none';
                        }
                    }

                    // Update the notification count
                    const currentCount = parseInt(document.querySelector('.h-btn-dot')?.textContent) || 0;
                    if (currentCount > 1) {
                        // Update count display if there's a count element
                    } else {
                        // Hide the red dot
                        const dot = document.querySelector('.h-btn-dot');
                        if (dot) {
                            dot.style.display = 'none';
                        }
                    }
                }
            })
            .catch(error => console.error('Error marking notification as read:', error));
        }
    </script>

</body>

</html>
