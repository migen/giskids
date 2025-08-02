<?php
// Admin layout configuration
$sidebar_position = $sidebar_position ?? 'left'; // 'left', 'right', or 'none'
$page_title = $page_title ?? 'Admin Dashboard';

// Determine body classes based on sidebar position
$body_classes = 'bg-gray-50 min-h-screen';
if ($sidebar_position === 'left') {
    $body_classes .= ' admin-sidebar-left';
} elseif ($sidebar_position === 'right') {
    $body_classes .= ' admin-sidebar-right';
} else {
    $body_classes .= ' admin-no-sidebar';
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> - giskids Admin</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link href="/css/output.css" rel="stylesheet">
    <script src="/js/jquery-library-one.js"></script>
    <style>
        /* Flexbox Order Classes */
        .order-1 { order: 1; }
        .order-2 { order: 2; }
        
        /* Sidebar States */
        .sidebar-hidden {
            width: 0 !important;
            min-width: 0 !important;
            overflow: hidden;
        }
        
        .sidebar-visible {
            width: 16rem; /* w-64 equivalent */
        }
        
        /* Mobile behavior */
        @media (max-width: 1023px) {
            .sidebar-hidden.order-1 {
                width: 16rem !important;
                transform: translateX(-100%);
            }
            
            .sidebar-hidden.order-2 {
                width: 16rem !important;
                transform: translateX(100%);
            }
            
            .sidebar-visible {
                transform: translateX(0);
            }
        }
        
        /* Desktop behavior for right sidebar */
        @media (min-width: 1024px) {
            .sidebar-hidden.order-2 {
                width: 0 !important;
            }
            
            .sidebar-visible.order-2 {
                width: 16rem;
            }
        }
    </style>
</head>
<body class="<?= $body_classes ?> h-screen flex overflow-hidden">
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-600 bg-opacity-75 z-40 hidden lg:hidden" onclick="closeSidebar()"></div>

    <?php if ($sidebar_position !== 'none'): ?>
    <!-- Sidebar -->
    <aside id="admin-sidebar" class="sidebar-hidden <?= $sidebar_position === 'right' ? 'order-2' : 'order-1' ?> flex-shrink-0 w-64 bg-white shadow-lg transition-all duration-300 ease-in-out lg:flex lg:flex-col <?= $sidebar_position === 'right' ? 'lg:border-l' : 'lg:border-r' ?> border-gray-200 fixed lg:relative inset-y-0 <?= $sidebar_position === 'right' ? 'right-0' : 'left-0' ?> z-30">
        <div class="flex flex-col h-full">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-blue-600 text-white">
                <h2 class="text-lg font-semibold">Admin Panel</h2>
                <button onclick="closeSidebar()" class="lg:hidden text-white hover:text-gray-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="/dashboard" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <?php if (!empty($systems_menu)): ?>
                    <!-- Systems Menu -->
                    <?php foreach ($systems_menu as $item): ?>
                        <a href="<?= htmlspecialchars($item['url'] ?? '#') ?>" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                            <?php if (!empty($item['icon'])): ?>
                                <?php
                                // Icon mapping for common icons
                                $iconPaths = [
                                    'currency-dollar' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1',
                                    'user-group' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                                    'document-text' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                                    'users' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
                                    'cog' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
                                ];
                                $iconPath = $iconPaths[$item['icon']] ?? $iconPaths['document-text'];
                                ?>
                                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $iconPath ?>" />
                                </svg>
                            <?php else: ?>
                                <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            <?php endif; ?>
                            <?= htmlspecialchars($item['name'] ?? 'Unknown') ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>

                <!-- User area -->
                <div class="mt-auto pt-4">
                    <div class="px-4 py-2 text-sm text-gray-500">
                        <?php if (function_exists('Auth') && Auth::check()): ?>
                            <?php $user = Auth::user(); ?>
                            Logged in as:<br>
                            <span class="font-medium text-gray-700"><?= htmlspecialchars($user['email']) ?></span>
                            <br>
                            <span class="text-xs text-blue-600"><?= ucfirst(Auth::getPrivilegeName()) ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <a href="/dashboard" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Dashboard
                    </a>
                    
                    <a href="/logout" class="flex items-center px-4 py-2 text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                        <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </a>
                </div>
            </nav>
        </div>
    </aside>
    <?php endif; ?>

    <!-- Main Content -->
    <div id="main-content" class="flex-1 flex flex-col overflow-hidden <?= $sidebar_position === 'right' ? 'order-1' : 'order-2' ?>">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm border-b">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <?php if ($sidebar_position !== 'none'): ?>
                        <button onclick="toggleSidebar()" class="mr-4 text-gray-500 hover:text-gray-700">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <?php endif; ?>
                        
                        <h1 class="text-2xl font-bold text-gray-900"><?= htmlspecialchars($page_title) ?></h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="/" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                            ← Back to Website
                        </a>
                        
                        <?php if (function_exists('Auth') && Auth::check()): ?>
                            <?php $user = Auth::user(); ?>
                            <div class="hidden sm:flex items-center space-x-2 text-sm text-gray-500">
                                <span><?= htmlspecialchars($user['email']) ?></span>
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                    <?= ucfirst(Auth::getPrivilegeName()) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto py-6">
            <div class="px-4 sm:px-6 lg:px-8">
                <!-- Flash Messages -->
                <?php if ($successMessage = flash('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        <span class="block sm:inline"><?= htmlspecialchars($successMessage) ?></span>
                    </div>
                <?php endif; ?>
                
                <?php if ($errorMessage = flash('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <span class="block sm:inline"><?= htmlspecialchars($errorMessage) ?></span>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <?= $content ?>
            </div>
        </main>
    </div>
    
    <script>
    $(document).ready(function() {
        var sidebarPosition = '<?= $sidebar_position ?? 'left' ?>';
        
        // Check localStorage for sidebar state (default to hidden)
        var sidebarState = localStorage.getItem('adminSidebarState');
        if (sidebarState === 'visible') {
            // Show sidebar if previously set to visible
            $('#admin-sidebar').removeClass('sidebar-hidden').addClass('sidebar-visible');
        } else {
            // Default to hidden
            $('#admin-sidebar').removeClass('sidebar-visible').addClass('sidebar-hidden');
        }
        
        // Toggle sidebar function
        window.toggleSidebar = function() {
            var $sidebar = $('#admin-sidebar');
            var $overlay = $('#sidebar-overlay');
            var isMobile = window.innerWidth < 1024;
            
            if ($sidebar.hasClass('sidebar-hidden')) {
                // Show sidebar
                $sidebar.removeClass('sidebar-hidden').addClass('sidebar-visible');
                if (isMobile) {
                    $overlay.removeClass('hidden');
                }
                localStorage.setItem('adminSidebarState', 'visible');
            } else {
                // Hide sidebar
                $sidebar.removeClass('sidebar-visible').addClass('sidebar-hidden');
                $overlay.addClass('hidden');
                localStorage.setItem('adminSidebarState', 'hidden');
            }
        };
        
        // Close sidebar function (mainly for mobile)
        window.closeSidebar = function() {
            $('#admin-sidebar').removeClass('sidebar-visible').addClass('sidebar-hidden');
            $('#sidebar-overlay').addClass('hidden');
            localStorage.setItem('adminSidebarState', 'hidden');
        };
        
        // Handle window resize - close mobile overlay if switching to desktop
        $(window).on('resize', function() {
            var isMobile = window.innerWidth < 1024;
            if (!isMobile) {
                $('#sidebar-overlay').addClass('hidden');
            }
        });
        
        // Add active state to current page link
        var currentPath = window.location.pathname;
        $('#admin-sidebar a').each(function() {
            if ($(this).attr('href') === currentPath) {
                $(this).addClass('bg-blue-50 text-blue-700');
            }
        });
    });
    </script>
</body>
</html>