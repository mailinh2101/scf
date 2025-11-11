#!/usr/bin/env php
<?php

/**
 * Filament Setup Verification Script
 * 
 * Run: php verify-filament.php
 * This script verifies that all Filament components are properly installed.
 */

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\File;

$checks = [
    'Composer Package' => [
        'file' => 'composer.json',
        'contains' => '"filament/filament": "3"',
    ],
    'Admin Provider' => [
        'file' => 'app/Providers/Filament/AdminPanelProvider.php',
        'contains' => 'class AdminPanelProvider extends PanelProvider',
    ],
    'User Model - FilamentUser' => [
        'file' => 'app/Models/User.php',
        'contains' => 'implements FilamentUser',
    ],
    'User Model - canAccessPanel' => [
        'file' => 'app/Models/User.php',
        'contains' => 'canAccessPanel',
    ],
    'Admin Seeder' => [
        'file' => 'database/seeders/FilamentAdminSeeder.php',
        'contains' => 'class FilamentAdminSeeder',
    ],
    'SiteSetting Resource' => [
        'file' => 'app/Filament/Admin/Resources/SiteSettingResource.php',
        'contains' => 'class SiteSettingResource extends Resource',
    ],
    'Product Resource' => [
        'file' => 'app/Filament/Admin/Resources/ProductResource.php',
        'contains' => 'class ProductResource extends Resource',
    ],
    'Post Resource' => [
        'file' => 'app/Filament/Admin/Resources/PostResource.php',
        'contains' => 'class PostResource extends Resource',
    ],
    'Job Resource' => [
        'file' => 'app/Filament/Admin/Resources/JobResource.php',
        'contains' => 'class JobResource extends Resource',
    ],
    'JobApplication Resource' => [
        'file' => 'app/Filament/Admin/Resources/JobApplicationResource.php',
        'contains' => 'class JobApplicationResource extends Resource',
    ],
    'Dashboard Page' => [
        'file' => 'app/Filament/Admin/Pages/Dashboard.php',
        'contains' => 'class Dashboard extends BaseDashboard',
    ],
    'Published Assets - CSS' => [
        'file' => 'public/css/filament/filament/app.css',
        'exists' => true,
    ],
    'Published Assets - JS' => [
        'file' => 'public/js/filament/filament/app.js',
        'exists' => true,
    ],
];

echo "\n";
echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║           FILAMENT SETUP VERIFICATION REPORT                      ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$passed = 0;
$failed = 0;

foreach ($checks as $name => $check) {
    $file = $check['file'];
    
    if (!file_exists($file)) {
        echo "❌ $name\n";
        echo "   → File not found: $file\n";
        $failed++;
        continue;
    }
    
    if (isset($check['exists']) && $check['exists']) {
        echo "✅ $name\n";
        echo "   → File exists: $file\n";
        $passed++;
        continue;
    }
    
    if (isset($check['contains'])) {
        $content = file_get_contents($file);
        if (strpos($content, $check['contains']) !== false) {
            echo "✅ $name\n";
            echo "   → Found in: $file\n";
            $passed++;
        } else {
            echo "❌ $name\n";
            echo "   → Not found: {$check['contains']}\n";
            echo "   → In file: $file\n";
            $failed++;
        }
    }
}

echo "\n";
echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║ SUMMARY: $passed Passed | $failed Failed\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

if ($failed === 0) {
    echo "🎉 All checks passed! Filament is properly installed.\n\n";
    echo "📝 Next steps:\n";
    echo "   1. Access: http://localhost/admin\n";
    echo "   2. Email: admin@example.com\n";
    echo "   3. Password: password\n";
    echo "   4. Change password after first login!\n\n";
    exit(0);
} else {
    echo "⚠️  Some checks failed. Please review the output above.\n\n";
    exit(1);
}
