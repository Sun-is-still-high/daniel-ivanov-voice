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

    <!-- Tailwind CSS -->
    <script src="/assets/js/tailwindcss.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                        display: ['Literata', 'serif'],
                        mono: ['"IBM Plex Sans"', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        @font-face {
            font-family: 'Manrope';
            src: url('/assets/fonts/manrope-400.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Manrope';
            src: url('/assets/fonts/manrope-500.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Manrope';
            src: url('/assets/fonts/manrope-600.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Manrope';
            src: url('/assets/fonts/manrope-700.ttf') format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Manrope';
            src: url('/assets/fonts/manrope-800.ttf') format('truetype');
            font-weight: 800;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Literata';
            src: url('/assets/fonts/literata-500.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Literata';
            src: url('/assets/fonts/literata-700.ttf') format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'IBM Plex Sans';
            src: url('/assets/fonts/ibm-plex-sans-400.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'IBM Plex Sans';
            src: url('/assets/fonts/ibm-plex-sans-500.ttf') format('truetype');
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'IBM Plex Sans';
            src: url('/assets/fonts/ibm-plex-sans-600.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'IBM Plex Sans';
            src: url('/assets/fonts/ibm-plex-sans-700.ttf') format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        :root {
            --page-bg: #f4efe6;
            --surface: rgba(255, 255, 255, 0.84);
            --surface-strong: rgba(255, 255, 255, 0.96);
            --surface-border: rgba(15, 23, 42, 0.09);
            --text-main: #172033;
            --text-muted: #536179;
            --accent: #0f766e;
            --accent-soft: rgba(15, 118, 110, 0.14);
            --accent-strong: #0b5d57;
            --hero-start: rgba(255, 255, 255, 0.92);
            --hero-end: rgba(226, 232, 240, 0.78);
            --hero-orb: rgba(15, 118, 110, 0.16);
            --pattern: rgba(148, 163, 184, 0.08);
            --button-text: #f8fafc;
            --theme-outline: rgba(15, 23, 42, 0.14);
            --theme-shadow: rgba(15, 23, 42, 0.12);
            --theme-panel-glow: rgba(255, 255, 255, 0.55);
        }

        body {
            font-family: 'Manrope', sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(circle at top left, var(--hero-orb), transparent 30%),
                radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.08), transparent 32%),
                linear-gradient(135deg, var(--page-bg) 0%, #edf2f7 48%, #f8fafc 100%);
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(var(--pattern) 1px, transparent 1px),
                linear-gradient(90deg, var(--pattern) 1px, transparent 1px);
            background-size: 64px 64px;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,0.45), transparent 82%);
            z-index: -1;
        }

        body.theme-home,
        body.theme-about {
            --page-bg: #f3ece2;
            --accent: #b45309;
            --accent-soft: rgba(180, 83, 9, 0.12);
            --accent-strong: #92400e;
            --hero-start: rgba(255, 251, 235, 0.94);
            --hero-end: rgba(226, 232, 240, 0.75);
            --hero-orb: rgba(180, 83, 9, 0.16);
        }

        body.theme-netlenka {
            --page-bg: #e8edf4;
            --accent: #1d4ed8;
            --accent-soft: rgba(29, 78, 216, 0.14);
            --accent-strong: #1e3a8a;
            --hero-start: rgba(239, 246, 255, 0.94);
            --hero-end: rgba(219, 234, 254, 0.78);
            --hero-orb: rgba(37, 99, 235, 0.18);
            --theme-outline: rgba(30, 58, 138, 0.24);
        }

        body.theme-podcast {
            --page-bg: #ebe6f5;
            --accent: #7c3aed;
            --accent-soft: rgba(124, 58, 237, 0.14);
            --accent-strong: #5b21b6;
            --hero-start: rgba(245, 243, 255, 0.95);
            --hero-end: rgba(233, 213, 255, 0.74);
            --hero-orb: rgba(124, 58, 237, 0.18);
            --theme-outline: rgba(91, 33, 182, 0.24);
        }

        body.theme-inside-the-silence {
            --page-bg: #e6f2ef;
            --accent: #0f766e;
            --accent-soft: rgba(15, 118, 110, 0.14);
            --accent-strong: #115e59;
            --hero-start: rgba(236, 253, 245, 0.94);
            --hero-end: rgba(209, 250, 229, 0.72);
            --hero-orb: rgba(13, 148, 136, 0.16);
            --theme-outline: rgba(17, 94, 89, 0.2);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .site-header {
            background: rgba(255, 255, 255, 0.58);
            border-color: rgba(15, 23, 42, 0.08);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
        }

        .site-logo {
            font-family: 'Literata', serif;
            letter-spacing: -0.04em;
        }

        .glass-panel,
        .section-shell {
            background: var(--surface);
            border: 1px solid var(--surface-border);
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(18px);
        }

        .hero-panel {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--hero-start), var(--hero-end));
            border: 1px solid rgba(255, 255, 255, 0.68);
            box-shadow: 0 28px 80px rgba(15, 23, 42, 0.10);
        }

        .hero-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 15% 20%, rgba(255, 255, 255, 0.78), transparent 28%),
                radial-gradient(circle at 85% 15%, var(--hero-orb), transparent 24%);
            pointer-events: none;
        }

        .eyebrow,
        .category-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.7rem 1rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.66);
            border: 1px solid rgba(255, 255, 255, 0.78);
            color: var(--accent-strong);
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.16em;
        }

        .display-title {
            font-family: 'Literata', serif;
            letter-spacing: -0.05em;
            line-height: 0.95;
        }

        .soft-kicker {
            color: var(--accent-strong);
            font-family: 'IBM Plex Sans', sans-serif;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .accent-dot {
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
            box-shadow: 0 0 0 8px var(--accent-soft);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent), var(--accent-strong));
            color: var(--button-text);
            box-shadow: 0 18px 35px rgba(15, 23, 42, 0.12);
        }

        .btn-ghost {
            background: rgba(255, 255, 255, 0.72);
            color: var(--text-main);
            border: 1px solid rgba(15, 23, 42, 0.1);
        }

        .theme-grid {
            display: grid;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .theme-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .theme-card,
        .podcast-page-card,
        .episode-card {
            background: var(--surface-strong);
            border: 1px solid rgba(15, 23, 42, 0.07);
            box-shadow: 0 18px 44px rgba(15, 23, 42, 0.06);
        }

        .theme-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            padding: 1.5rem;
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .theme-card:hover,
        .episode-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 54px rgba(15, 23, 42, 0.10);
        }

        .theme-card::after {
            content: '';
            position: absolute;
            inset: auto -15% -35% auto;
            width: 8rem;
            height: 8rem;
            border-radius: 999px;
            background: var(--accent-soft);
        }

        .podcast-page-card {
            border-radius: 1.75rem;
        }

        .podcast-masthead {
            position: relative;
            overflow: hidden;
        }

        .podcast-masthead::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(125deg, rgba(255, 255, 255, 0.2), transparent 40%),
                radial-gradient(circle at top right, var(--accent-soft), transparent 28%);
            pointer-events: none;
        }

        .quote-panel {
            position: relative;
            overflow: hidden;
            border-left: 4px solid var(--accent);
            background: linear-gradient(135deg, rgba(255,255,255,0.62), rgba(255,255,255,0.28));
        }

        .quote-panel::before {
            content: '“';
            position: absolute;
            top: -0.4rem;
            right: 1.25rem;
            font-family: 'Literata', serif;
            font-size: 5rem;
            line-height: 1;
            color: rgba(15, 23, 42, 0.07);
        }

        .cta-panel {
            background:
                radial-gradient(circle at top right, var(--accent-soft), transparent 28%),
                linear-gradient(135deg, #111827, #1f2937);
        }

        .cta-panel,
        .footer-shell {
            position: relative;
            overflow: hidden;
        }

        .cta-panel::before,
        .footer-shell::before {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at top right, var(--accent-soft), transparent 24%),
                linear-gradient(120deg, rgba(255,255,255,0.08), transparent 38%);
        }

        .footer-shell {
            background:
                radial-gradient(circle at top right, var(--accent-soft), transparent 26%),
                linear-gradient(135deg, #0f172a, #111827 52%, #1f2937);
        }

        .footer-kicker {
            color: rgba(255, 255, 255, 0.72);
            font-family: 'IBM Plex Sans', sans-serif;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .footer-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 1.5rem;
            padding: 1.25rem;
            backdrop-filter: blur(12px);
        }

        .theme-netlenka .footer-shell {
            background:
                repeating-linear-gradient(
                    -10deg,
                    rgba(255,255,255,0.03),
                    rgba(255,255,255,0.03) 14px,
                    transparent 14px,
                    transparent 28px
                ),
                linear-gradient(135deg, #0f172a, #10223f 52%, #0b1327);
        }

        .theme-podcast .footer-shell {
            background:
                radial-gradient(circle at top right, rgba(124, 58, 237, 0.18), transparent 24%),
                linear-gradient(135deg, #140f24, #23153f 52%, #111827);
        }

        .theme-inside-the-silence .footer-shell {
            background:
                radial-gradient(circle at top right, rgba(15, 118, 110, 0.14), transparent 24%),
                linear-gradient(135deg, #0f1f22, #133034 52%, #102127);
        }

        .player-panel {
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.82), rgba(255, 255, 255, 0.62)),
                radial-gradient(circle at top right, var(--accent-soft), transparent 34%);
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 1.5rem;
            padding: 1.5rem;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .episode-meta-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.8rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(15, 23, 42, 0.08);
            color: var(--text-muted);
            font-size: 0.78rem;
            font-weight: 600;
        }

        .podcast-hero {
            position: relative;
            overflow: hidden;
            border-radius: 2rem;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.34)),
                linear-gradient(135deg, var(--hero-start), var(--hero-end));
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 28px 80px var(--theme-shadow);
        }

        .podcast-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top left, var(--theme-panel-glow), transparent 32%),
                radial-gradient(circle at bottom right, var(--accent-soft), transparent 34%);
            pointer-events: none;
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

        .podcast-cover-wrap::before {
            content: '';
            position: absolute;
            inset: -1rem;
            border-radius: 2rem;
            background: radial-gradient(circle, var(--accent-soft), transparent 65%);
            filter: blur(8px);
        }

        .podcast-cover {
            position: relative;
            width: 100%;
            border-radius: 1.85rem;
            object-fit: cover;
            box-shadow: 0 28px 60px rgba(15, 23, 42, 0.18);
        }

        .podcast-lead {
            font-size: 1.15rem;
            line-height: 1.8;
            color: #334155;
        }

        .podcast-story-panel,
        .podcast-metric-card,
        .podcast-note-card,
        .podcast-platform-card,
        .podcast-stream-panel,
        .episode-layout-card,
        .episode-sidebar-card {
            position: relative;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 18px 44px rgba(15, 23, 42, 0.06);
            backdrop-filter: blur(16px);
        }

        .podcast-story-panel,
        .podcast-stream-panel,
        .episode-layout-card,
        .episode-sidebar-card {
            border-radius: 1.75rem;
        }

        .podcast-metric-card,
        .podcast-note-card,
        .podcast-platform-card {
            border-radius: 1.5rem;
            padding: 1.4rem;
        }

        .podcast-story-panel {
            padding: 1.5rem;
        }

        .podcast-story-panel::after,
        .podcast-metric-card::after,
        .podcast-note-card::after,
        .podcast-platform-card::after,
        .podcast-stream-panel::after,
        .episode-layout-card::after,
        .episode-sidebar-card::after {
            content: '';
            position: absolute;
            inset: auto -15% -35% auto;
            width: 8rem;
            height: 8rem;
            border-radius: 999px;
            background: var(--accent-soft);
            opacity: 0.7;
            pointer-events: none;
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

        .podcast-stat {
            font-family: 'Literata', serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1;
            letter-spacing: -0.05em;
            color: var(--text-main);
        }

        .podcast-stream-panel {
            padding: 2rem;
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
            color: var(--text-muted);
        }

        .episode-layout-card,
        .episode-sidebar-card {
            padding: 1.5rem;
        }

        .episode-title {
            font-family: 'Literata', serif;
            letter-spacing: -0.05em;
            line-height: 0.98;
        }

        .theme-netlenka .display-title,
        .theme-netlenka .episode-title {
            font-family: 'IBM Plex Sans', sans-serif;
            letter-spacing: -0.06em;
            line-height: 0.92;
        }

        .theme-netlenka .podcast-hero {
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.84), rgba(244, 247, 255, 0.58)),
                repeating-linear-gradient(
                    -12deg,
                    rgba(255, 255, 255, 0.1),
                    rgba(255, 255, 255, 0.1) 14px,
                    transparent 14px,
                    transparent 28px
                ),
                linear-gradient(135deg, var(--hero-start), var(--hero-end));
        }

        .theme-netlenka .podcast-story-panel,
        .theme-netlenka .podcast-stream-panel,
        .theme-netlenka .episode-layout-card,
        .theme-netlenka .episode-sidebar-card,
        .theme-netlenka .episode-card {
            border-color: var(--theme-outline);
        }

        .theme-netlenka .podcast-metric-card {
            border-top: 3px solid var(--accent);
        }

        .theme-podcast .podcast-hero {
            background:
                radial-gradient(circle at top right, rgba(124, 58, 237, 0.2), transparent 28%),
                linear-gradient(135deg, rgba(255, 255, 255, 0.82), rgba(237, 233, 254, 0.48)),
                linear-gradient(135deg, var(--hero-start), var(--hero-end));
        }

        .theme-podcast .podcast-hero::after,
        .theme-podcast .episode-layout-card::before {
            content: '';
            position: absolute;
            inset: 1.25rem;
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.38);
            pointer-events: none;
        }

        .theme-podcast .podcast-metric-card {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.76), rgba(243, 232, 255, 0.68));
        }

        .theme-inside-the-silence .podcast-hero {
            background:
                radial-gradient(circle at top center, rgba(255, 255, 255, 0.58), transparent 32%),
                linear-gradient(180deg, rgba(244, 253, 250, 0.92), rgba(225, 243, 238, 0.84));
        }

        .theme-inside-the-silence .display-title,
        .theme-inside-the-silence .episode-title {
            letter-spacing: -0.045em;
            line-height: 1;
        }

        .theme-inside-the-silence .podcast-story-panel,
        .theme-inside-the-silence .podcast-stream-panel,
        .theme-inside-the-silence .episode-layout-card,
        .theme-inside-the-silence .episode-sidebar-card {
            background: rgba(255, 255, 255, 0.64);
        }

        .nav-link:hover,
        .footer-link:hover,
        .breadcrumb-link:hover {
            color: var(--accent-strong);
        }
    </style>
</head>
<body class="min-h-screen theme-<?= e($pageTheme) ?>">

<header class="sticky top-0 z-50 site-header backdrop-blur-xl border-b">
    <div class="container mx-auto px-6 md:px-8 py-5 md:py-6">
        <nav class="flex items-center justify-between">
            <a href="/" class="site-logo text-2xl md:text-3xl font-bold text-slate-900 transition-colors">
                <?= e($SITE_CONFIG['title']) ?>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <?php foreach ($SITE_CONFIG['categories'] as $key => $category): ?>
                    <?php if ($category['disabled']): ?>
                        <span class="text-slate-400 font-medium cursor-not-allowed">
                            <?= e($category['title']) ?> <span class="text-xs">(Скоро)</span>
                        </span>
                    <?php else: ?>
                        <a href="/<?= e($key) ?>/" class="nav-link text-slate-700 font-medium transition-colors">
                            <?= e($category['title']) ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <a href="/about/" class="nav-link text-slate-700 font-medium transition-colors">
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
                    <a href="/<?= e($key) ?>/" class="nav-link block py-2 text-slate-700 font-medium">
                        <?= e($category['title']) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
            <a href="/about/" class="nav-link block py-2 text-slate-700 font-medium">
                О проекте
            </a>
        </div>
    </div>
</header>
