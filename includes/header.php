<?php
/**
 * Шапка сайта и начало HTML документа
 *
 * Переменные, которые можно задать до подключения:
 * - $pageTitle - заголовок страницы
 * - $pageDescription - описание для meta
 * - $pageType - тип страницы для Open Graph (website/article)
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/../data/audio.php';

$pageTitle = isset($pageTitle) ? getPageTitle($pageTitle) : $SITE_CONFIG['title'];
$pageDescription = isset($pageDescription) ? $pageDescription : $SITE_CONFIG['description'];
$pageType = isset($pageType) ? $pageType : 'website';
$pageImage = isset($pageImage) ? $pageImage : $SITE_CONFIG['author']['avatar'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?= e($pageType) ?>">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:image" content="<?= e($pageImage) ?>">
    <meta property="og:site_name" content="<?= e($SITE_CONFIG['title']) ?>">
    <meta property="og:locale" content="ru_RU">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($pageTitle) ?>">
    <meta name="twitter:description" content="<?= e($pageDescription) ?>">
    <meta name="twitter:image" content="<?= e($pageImage) ?>">

    <!-- Additional SEO -->
    <meta name="author" content="<?= e($SITE_CONFIG['author']['name']) ?>">
    <meta name="robots" content="index, follow">

    <title><?= e($pageTitle) ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {}
            }
        }
    </script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 text-slate-900">

<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-slate-200 shadow-sm">
    <div class="container mx-auto px-6 md:px-8 py-5 md:py-6">
        <nav class="flex items-center justify-between">
            <a href="/" class="text-2xl md:text-3xl font-bold text-slate-900 hover:text-slate-700 transition-colors">
                <?= e($SITE_CONFIG['title']) ?>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <?php foreach ($SITE_CONFIG['categories'] as $key => $category): ?>
                    <?php if ($category['disabled']): ?>
                        <span class="text-slate-400 font-medium cursor-not-allowed">
                            <?= e($category['title']) ?> <span class="text-xs">(Скоро)</span>
                        </span>
                    <?php else: ?>
                        <a href="/<?= e($key) ?>.php" class="text-slate-700 hover:text-slate-900 font-medium transition-colors">
                            <?= e($category['title']) ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a href="/about.php" class="text-slate-700 hover:text-slate-900 font-medium transition-colors">
                    О проекте
                </a>
            </div>

            <!-- Mobile menu button -->
            <button
                type="button"
                id="mobile-menu-button"
                class="md:hidden p-2 text-slate-700 hover:text-slate-900"
                aria-label="Меню"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </nav>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden pt-4 pb-2">
            <?php foreach ($SITE_CONFIG['categories'] as $key => $category): ?>
                <?php if ($category['disabled']): ?>
                    <span class="block py-2 text-slate-400 font-medium cursor-not-allowed">
                        <?= e($category['title']) ?> <span class="text-xs">(Скоро)</span>
                    </span>
                <?php else: ?>
                    <a href="/<?= e($key) ?>.php" class="block py-2 text-slate-700 hover:text-slate-900 font-medium">
                        <?= e($category['title']) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
            <a href="/about.php" class="block py-2 text-slate-700 hover:text-slate-900 font-medium">
                О проекте
            </a>
        </div>
    </div>
</header>
