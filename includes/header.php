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

$pageTitle = isset($pageTitle) ? getPageTitle($pageTitle) : $SITE_CONFIG['title'];
$pageDescription = isset($pageDescription) ? $pageDescription : $SITE_CONFIG['description'];
$pageType = isset($pageType) ? $pageType : 'website';
$pageImage = isset($pageImage) ? $pageImage : $SITE_CONFIG['author']['avatar'];
$pageTheme = isset($pageTheme) ? $pageTheme : 'site';

if (strpos((string) $pageImage, 'http://') !== 0 && strpos((string) $pageImage, 'https://') !== 0) {
    $pageImage = 'https://daniel-ivanov-voice.ru' . $pageImage;
}
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
    <link rel="alternate" type="application/rss+xml" title="Daniel's Voice RSS Feed" href="/rss.xml">

    <title><?= e($pageTitle) ?></title>
    
    <!-- Verification tags if needed -->
    <!-- <meta name="yandex-verification" content="your_yandex_verification_code"> -->
    <!-- <meta name="google-site-verification" content="your_google_verification_code"> -->

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script','https://mc.yandex.ru/metrika/tag.js?id=106894387', 'ym');

        ym(106894387, 'init', {ssr:true, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/106894387" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Fonts: Вольт — Unbounded / Manrope / JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="/assets/js/tailwindcss.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        display: ['Unbounded', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace']
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="/assets/css/volt.css">
    <style>
        .episode-title {
            font-family: var(--font-display);
            letter-spacing: -0.03em;
            line-height: 0.98;
            text-transform: uppercase;
            color: var(--ink);
        }

        .podcast-hero,
        .podcast-story-panel,
        .podcast-metric-card,
        .podcast-note-card,
        .podcast-platform-card,
        .podcast-stream-panel,
        .episode-layout-card,
        .episode-sidebar-card {
            position: relative;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--line);
            box-shadow: var(--shadow-1);
        }

        .podcast-hero {
            border-radius: var(--r-3);
        }

        .podcast-story-panel,
        .podcast-stream-panel,
        .episode-layout-card,
        .episode-sidebar-card {
            border-radius: var(--r-3);
        }

        .podcast-metric-card,
        .podcast-note-card,
        .podcast-platform-card {
            border-radius: var(--r-3);
            padding: 1.4rem;
        }

        .podcast-story-panel,
        .episode-layout-card,
        .episode-sidebar-card {
            padding: 1.5rem;
        }

        .podcast-stream-panel {
            padding: 2rem;
        }

        .podcast-hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            gap: 2rem;
            padding: 2rem;
        }

        @media (min-width: 768px) {
            .podcast-hero-grid {
                padding: 3rem;
            }
        }

        .podcast-cover-wrap {
            position: relative;
            max-width: 24rem;
        }

        .podcast-cover {
            position: relative;
            width: 100%;
            border-radius: var(--r-3);
            object-fit: cover;
            box-shadow: var(--shadow-3);
            filter: grayscale(0.85) contrast(1.1) brightness(0.85);
        }

        .podcast-lead {
            font-size: 1.15rem;
            line-height: 1.8;
            color: var(--ink-2);
        }

        .podcast-metrics-grid,
        .podcast-notes-grid,
        .podcast-platform-grid {
            display: grid;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .podcast-metrics-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .podcast-notes-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .podcast-platform-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .podcast-section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .podcast-episode-stack {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .podcast-empty-state {
            padding: 3rem 2rem;
            text-align: center;
            color: var(--ink-3);
        }

        @media (max-width: 380px) {
            html,
            body {
                max-width: 100%;
                overflow-x: hidden;
            }

            * {
                min-width: 0;
            }

            p,
            h1,
            h2,
            h3,
            li,
            a,
            span {
                overflow-wrap: anywhere;
            }

            img,
            svg,
            video,
            audio,
            iframe {
                max-width: 100%;
            }

            .container {
                padding-left: 0.9rem !important;
                padding-right: 0.9rem !important;
            }

            .site-header .container {
                padding-top: 0.8rem !important;
                padding-bottom: 0.8rem !important;
            }

            .site-logo {
                font-size: 1.4rem !important;
                line-height: 1.05;
            }

            #mobile-menu {
                padding-top: 0.75rem;
            }

            main.container {
                padding-top: 2.5rem !important;
                padding-bottom: 2.8rem !important;
            }

            .display-title,
            .episode-title,
            h1.text-5xl,
            h1.text-6xl,
            h1.text-7xl {
                font-size: clamp(2rem, 10vw, 2.45rem) !important;
                line-height: 1.05 !important;
                letter-spacing: -0.04em;
            }

            .text-7xl,
            .text-6xl,
            .text-5xl {
                font-size: clamp(2rem, 10vw, 2.45rem) !important;
                line-height: 1.05 !important;
            }

            .text-4xl {
                font-size: clamp(1.65rem, 8.2vw, 2rem) !important;
                line-height: 1.12 !important;
            }

            .text-3xl {
                font-size: 1.45rem !important;
                line-height: 1.18 !important;
            }

            .text-2xl {
                font-size: 1.25rem !important;
                line-height: 1.24 !important;
            }

            .text-xl {
                font-size: 1rem !important;
                line-height: 1.55 !important;
            }

            .text-lg {
                font-size: 0.98rem !important;
                line-height: 1.6 !important;
            }

            .rounded-\[2rem\] {
                border-radius: 1.15rem !important;
            }

            .rounded-\[1\.75rem\] {
                border-radius: 1rem !important;
            }

            .rounded-\[1\.5rem\] {
                border-radius: 0.95rem !important;
            }

            .podcast-hero-grid,
            .podcast-stream-panel,
            .podcast-story-panel,
            .episode-layout-card,
            .episode-sidebar-card,
            .player-panel {
                padding: 1rem !important;
            }

            .podcast-hero-grid {
                gap: 1rem;
            }

            .podcast-cover-wrap {
                max-width: 100%;
            }

            .podcast-lead {
                font-size: 1rem;
                line-height: 1.65;
            }

            .eyebrow,
            .category-chip {
                gap: 0.4rem;
                padding: 0.52rem 0.7rem;
                font-size: 0.64rem;
                letter-spacing: 0.1em;
                white-space: normal;
            }

            .soft-kicker {
                font-size: 0.68rem;
                letter-spacing: 0.07em;
            }

            .theme-card,
            .podcast-page-card,
            .episode-card,
            .footer-card {
                padding: 1rem !important;
            }

            .whitespace-nowrap {
                white-space: normal !important;
            }

            .episode-meta-pill {
                font-size: 0.72rem;
            }

            .cta-panel a {
                max-width: 100%;
                white-space: normal;
                text-align: left;
            }

            #cookie-banner .container {
                gap: 0.8rem;
            }
        }
    </style>
</head>
<body class="min-h-screen theme-<?= e($pageTheme) ?>">

<header class="sticky top-0 z-50 site-header backdrop-blur-xl border-b">
    <div class="container mx-auto px-6 md:px-8 py-5 md:py-6">
        <nav class="flex items-center justify-between">
            <a href="/" class="site-logo text-lg md:text-xl transition-colors">
                <?= e($SITE_CONFIG['title']) ?>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <?php foreach ($SITE_CONFIG['categories'] as $key => $category): ?>
                    <?php if ($category['disabled']): ?>
                        <span class="text-[color:var(--ink-4)] font-medium cursor-not-allowed">
                            <?= e($category['title']) ?> <span class="text-xs">(Скоро)</span>
                        </span>
                    <?php else: ?>
                        <a href="/<?= e($key) ?>/" class="nav-link font-medium transition-colors">
                            <?= e($category['title']) ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a href="/about/" class="nav-link font-medium transition-colors">
                    О проекте
                </a>
            </div>

            <!-- Mobile menu button -->
            <button
                type="button"
                id="mobile-menu-button"
                class="md:hidden p-2 text-[color:var(--ink-2)] hover:text-[color:var(--ink)]"
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
                    <span class="block py-2 text-[color:var(--ink-4)] font-medium cursor-not-allowed">
                        <?= e($category['title']) ?> <span class="text-xs">(Скоро)</span>
                    </span>
                <?php else: ?>
                    <a href="/<?= e($key) ?>/" class="nav-link block py-2 font-medium">
                        <?= e($category['title']) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
            <a href="/about/" class="nav-link block py-2 font-medium">
                О проекте
            </a>
        </div>
    </div>
</header>
