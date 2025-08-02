<?php
// Auth layout - from working dev/sidebar.php implementation
$page_title = $page_title ?? 'Dashboard';

/**
 * Get human-readable label for system code
 */
function getSystemLabel($key) {
    $labels = [
        'finance' => 'Finance Center',
        'notes' => 'Notes System',
        'reports' => 'Reports System', 
        'admin' => 'Administration',
        'dashboard' => 'Dashboard',
        'users' => 'User Management',
        'settings' => 'Settings',
        'analytics' => 'Analytics',
        'inventory' => 'Inventory',
        'crm' => 'Customer Relations',
        'hr' => 'Human Resources',
        'gi' => 'General Intelligence'
    ];
    
    return $labels[$key] ?? ucfirst($key) . ' System';
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> - giskids</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link href="/css/output.css" rel="stylesheet">
    <script src="/js/jquery-library-one.js"></script>

<style>

/* Ensure right sidebar flush against edge - no right padding when pr-0 class active */
#content-wrapper.pr-0 {
    padding-right: 0 !important;

}



#main-content {
    width: 100% !important;

}

#sidebar {
    width: 256px !important;
}

</style>

</head>
<body class="bg-gray-100 h-screen flex flex-col">
    
    <!-- Header Bar -->
    <header class="bg-white shadow-md border-b border-gray-200 px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <!-- Burger Menu Button -->
            <button id="sidebar-toggle" class="p-2 rounded-md hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <a href="/" class="text-xl font-bold text-gray-800">giskids</a>
            <h1 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($page_title) ?></h1>
        </div>
        
        <!-- Auth Navigation -->
        <div class="flex items-center space-x-4">
            <?php if (class_exists('Auth') && Auth::check()): ?>
                <?php $authUser = Auth::user(); ?>
                <span class="text-sm text-gray-500">
                    <?= htmlspecialchars($authUser['email']) ?>
                </span>
                <a href="/" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                    ← Back to Website
                </a>
                <a href="/logout" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                    Logout
                </a>
            <?php else: ?>
                <a href="/login" class="text-gray-500 hover:text-gray-700 text-sm font-medium">
                    Login
                </a>
            <?php endif; ?>
            <div class="text-sm text-gray-500">
                Position: <span id="position-indicator" class="font-medium">none</span>
            </div>
        </div>
    </header>

    <!-- Main Layout Container -->
    <div id="layout" class="flex flex-1 overflow-hidden">
        
        <!-- Dynamic Sidebar -->
        <aside id="sidebar" class="hidden w-64 bg-white shadow-lg border-gray-200 flex-shrink-0 transition-all duration-300">
            <div class="p-4 h-full overflow-y-auto">
                <h3 id="sidebar-title" class="font-semibold text-gray-800 mb-4">Navigation</h3>
                <nav class="space-y-2">
                    <?php if (class_exists('Auth') && Auth::check()): ?>
                        <?php $accessSystems = Auth::getAccessibleSystems(); ?>
                        <?php if (!empty($accessSystems)): ?>
                            <?php foreach ($accessSystems as $system): ?>
                                <a href="/<?= htmlspecialchars($system) ?>/index" 
                                   class="block px-4 py-2 text-gray-700 hover:text-blue-500 hover:bg-gray-100 rounded-md transition-colors">
                                    <?= htmlspecialchars(getSystemLabel($system)) ?>
                                </a>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="px-4 py-2 text-gray-500 text-sm italic">
                                No accessible modules
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="px-4 py-2 text-gray-500 text-sm italic">
                            Please log in to view modules
                        </div>
                    <?php endif; ?>
                </nav>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main id="main-content" class="flex-1 overflow-y-auto">
            <div id="content-wrapper" class="p-6 w-full">
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
                <div class="w-full bg-blue-100">
                    <?= $content ?>
                </div>
            </div>
        </main>
        
    </div>

    <!-- Footer Bar -->
    <footer class="bg-white border-t border-gray-200 px-4 py-3">
        <div class="text-center text-sm text-gray-500">
            Copyright © <?php echo date('Y'); ?> giskids. All rights reserved.
        </div>
    </footer>

    <!-- JavaScript for Sidebar Toggle -->
    <script>
        $(document).ready(function() {
            console.log('🔧 Auth Layout Sidebar - Debug Mode');
            
            // Sidebar positions: none -> left -> right -> none
            const positions = ['none', 'left', 'right'];
            let currentPositionIndex = 0;
            
            // Load saved position from localStorage
            const savedPosition = localStorage.getItem('sidebar-position');
            console.log('📦 Loaded from localStorage:', savedPosition);
            
            if (savedPosition && positions.includes(savedPosition)) {
                currentPositionIndex = positions.indexOf(savedPosition);
                console.log('✅ Set position index to:', currentPositionIndex, '(', savedPosition, ')');
            } else {
                console.log('🔄 Using default position: none (index 0)');
            }
            
            // Apply initial position
            applySidebarPosition();
            
            // Toggle button click handler
            $('#sidebar-toggle').click(function() {
                console.log('🖱️ Toggle button clicked');
                
                // Cycle to next position
                const oldPosition = positions[currentPositionIndex];
                currentPositionIndex = (currentPositionIndex + 1) % positions.length;
                const newPosition = positions[currentPositionIndex];
                
                console.log('🔄 Position changed:', oldPosition, '->', newPosition, '(index:', currentPositionIndex, ')');
                
                applySidebarPosition();
                
                // Save to localStorage
                localStorage.setItem('sidebar-position', newPosition);
                console.log('💾 Saved to localStorage:', newPosition);
            });
            
            function applySidebarPosition() {
                const position = positions[currentPositionIndex];
                console.log('📐 Applying position:', position);
                
                const $sidebar = $('#sidebar');
                const $contentWrapper = $('#content-wrapper');
                const $sidebarTitle = $('#sidebar-title');
                
                if (position === 'none') {
                    // Hide sidebar completely, restore normal padding
                    $sidebar.addClass('hidden');
                    $contentWrapper.removeClass('pr-0').addClass('p-6');
                    console.log('🚫 Sidebar hidden - main content full width with normal padding');
                } else if (position === 'left') {
                    // Show sidebar on left: normal padding, right border
                    $sidebar.removeClass('hidden border-l')
                           .addClass('border-r')
                           .insertBefore($('#main-content'));
                    $contentWrapper.removeClass('pr-0').addClass('p-6');
                    $sidebarTitle.text('Navigation');
                    console.log('👈 Left sidebar: normal content padding');
                } else if (position === 'right') {
                    // Show sidebar on right: remove right padding from content, left border
                    $sidebar.removeClass('hidden border-r')
                           .addClass('border-l')
                           .insertAfter($('#main-content'));
                    $contentWrapper.removeClass('p-6 pr-6').addClass('pl-6 pt-6 pb-6 pr-0');
                    $sidebarTitle.text('Navigation');
                    console.log('👉 Right sidebar: removed right padding for flush design');
                }
                
                // Update position indicator
                $('#position-indicator').text(position);
                console.log('🏷️ Position indicator updated to:', position);
            }
            
            // Debug: Show current localStorage contents
            console.log('🗂️ Current localStorage contents:');
            for (let i = 0; i < localStorage.length; i++) {
                const key = localStorage.key(i);
                const value = localStorage.getItem(key);
                console.log('  ', key, '=', value);
            }
        });
    </script>

</body>
</html>