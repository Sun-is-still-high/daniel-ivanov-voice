<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/rss.php';

$categoryKey = (string) ($_GET['category'] ?? '');
$episodeSlug = (string) ($_GET['episode'] ?? '');

if ($categoryKey === '' || $episodeSlug === '' || empty($SITE_CONFIG['categories'][$categoryKey])) {
    header('HTTP/1.0 404 Not Found');
    require_once __DIR__ . '/includes/header.php';
    echo '<main class="container mx-auto px-6 md:px-8 py-16 md:py-24"><div class="section-shell rounded-[2rem] p-10"><h1 class="display-title text-4xl mb-4">Страница не найдена</h1><p class="text-slate-600">Такого выпуска нет.</p></div></main>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$audio = getRssEpisodeBySlug($categoryKey, $episodeSlug);
if (!$audio) {
    header('HTTP/1.0 404 Not Found');
    require_once __DIR__ . '/includes/header.php';
    echo '<main class="container mx-auto px-6 md:px-8 py-16 md:py-24"><div class="section-shell rounded-[2rem] p-10"><h1 class="display-title text-4xl mb-4">Страница не найдена</h1><p class="text-slate-600">Такого выпуска нет.</p></div></main>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

if ($episodeSlug !== ($audio['slug'] ?? '')) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $audio['pageUrl']);
    exit;
}

$categoryInfo = $SITE_CONFIG['categories'][$categoryKey];
$relatedAudio = getRssRelatedEpisodes($categoryKey, $audio['slug'], 3);
$platforms = $audio['platforms'] ?? [];

$pageTitle = $audio['title'] . ' | ' . $categoryInfo['title'];
$pageDescription = trim($audio['description']);
if ($pageDescription === '') {
    $pageDescription = $categoryInfo['title'] . ' — выпуск Даниила Иванова о психологии без эзотерики.';
}
if (mb_strlen($pageDescription, 'UTF-8') > 160) {
    $pageDescription = buildDescriptionTeaser($pageDescription, 157);
}
$pageType = 'article';
$pageImage = $audio['image'] ?: $SITE_CONFIG['author']['avatar'];
$pageTheme = getCategoryPageTheme($categoryKey);

require_once __DIR__ . '/includes/header.php';
?>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "AudioObject",
    "name": <?= json_encode($audio['title'], JSON_UNESCAPED_UNICODE) ?>,
    "description": <?= json_encode($audio['description'], JSON_UNESCAPED_UNICODE) ?>,
    "duration": "<?= formatDurationForSchema($audio['duration']) ?>",
    "uploadDate": "<?= $audio['publishDate'] ?>",
    "author": {
        "@type": "Person",
        "name": <?= json_encode($SITE_CONFIG['author']['name'], JSON_UNESCAPED_UNICODE) ?>
    },
    "contentUrl": <?= json_encode($audio['audioFile'], JSON_UNESCAPED_UNICODE) ?>,
    "encodingFormat": "audio/mpeg"
}
</script>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24" itemscope itemtype="https://schema.org/AudioObject">
    <link rel="canonical" href="https://daniel-ivanov-voice.ru<?= e($audio['pageUrl']) ?>">

    <div class="max-w-6xl mx-auto">
        <?= renderBreadcrumbs([
            ['label' => $categoryInfo['title'], 'href' => '/' . e($categoryKey)],
            ['label' => $audio['title']]
        ]) ?>

        <meta itemprop="name" content="<?= e($audio['title']) ?>">
        <meta itemprop="description" content="<?= e($audio['description']) ?>">
        <meta itemprop="duration" content="<?= formatDurationForSchema($audio['duration']) ?>">
        <meta itemprop="datePublished" content="<?= e($audio['publishDate']) ?>">
        <meta itemprop="contentUrl" content="<?= e($audio['audioFile']) ?>">
        <meta itemprop="encodingFormat" content="audio/mpeg">
        <div itemprop="author" itemscope itemtype="https://schema.org/Person">
            <meta itemprop="name" content="<?= e($SITE_CONFIG['author']['name']) ?>">
        </div>

        <div class="grid lg:grid-cols-[1.35fr_0.65fr] gap-8">
            <section class="episode-layout-card">
                <div class="podcast-masthead mb-6">
                    <div class="flex flex-wrap items-center gap-2 mb-5">
                        <span class="category-chip"><?= e($categoryInfo['title']) ?></span>
                        <span class="episode-meta-pill"><?= formatDate($audio['publishDate']) ?></span>
                        <?php if (!empty($audio['duration'])): ?>
                            <span class="episode-meta-pill"><?= e($audio['duration']) ?></span>
                        <?php endif; ?>
                    </div>
                    <h1 class="episode-title text-4xl md:text-6xl mb-5"><?= e($audio['title']) ?></h1>
                    <p class="text-lg text-slate-600 leading-relaxed max-w-3xl" itemprop="description">
                        <?= formatDescription($audio['description']) ?>
                    </p>
                </div>

                <div class="mb-6">
                    <?php if (!empty($audio['embedUrl'])): ?>
                        <iframe
                            src="<?= e($audio['embedUrl']) ?>"
                            style="width: 100%"
                            height="235"
                            scrolling="no"
                            frameborder="no"
                            loading="lazy"
                            title="<?= e($audio['title']) ?>"
                        ></iframe>
                    <?php else: ?>
                        <?= renderAudioPlayer($audio) ?>
                    <?php endif; ?>
                </div>

                <?php if (!empty($platforms)): ?>
                    <?= renderPlatformButtons($platforms) ?>
                <?php endif; ?>

                <div class="pt-2">
                    <div class="quote-panel rounded-[1.5rem] p-6 mb-6">
                        <p class="relative z-10 text-slate-700 leading-relaxed">
                            <?= e($categoryInfo['story']) ?>
                        </p>
                    </div>
                    <?php if (!empty($audio['externalUrl'])): ?>
                        <a
                            href="<?= e($audio['externalUrl']) ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 text-[color:var(--accent-strong)] hover:opacity-80 font-semibold transition-opacity"
                        >
                            Открыть выпуск на Mave
                        </a>
                    <?php endif; ?>
                </div>
            </section>

            <aside class="space-y-6">
                <div class="episode-sidebar-card sticky top-28">
                    <p class="soft-kicker mb-3">Об авторе</p>
                    <h2 class="text-2xl font-bold text-slate-900 mb-3"><?= e($SITE_CONFIG['author']['name']) ?></h2>
                    <p class="text-slate-600 leading-relaxed mb-4"><?= e($SITE_CONFIG['author']['bio']) ?></p>
                    <a
                        href="<?= e($SITE_CONFIG['author']['website']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 text-[color:var(--accent-strong)] hover:opacity-80 font-semibold transition-opacity"
                    >
                        Личный сайт
                    </a>
                </div>

                <?php if (count($relatedAudio) > 0): ?>
                    <div class="episode-sidebar-card">
                        <p class="soft-kicker mb-3">Рядом по теме</p>
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Похожие записи</h2>
                        <div class="space-y-4">
                            <?php foreach ($relatedAudio as $related): ?>
                                <a href="<?= e($related['pageUrl']) ?>" class="theme-card block">
                                    <h3 class="font-semibold text-slate-900 mb-2 line-clamp-2"><?= e($related['title']) ?></h3>
                                    <div class="flex flex-wrap gap-3 text-sm text-slate-500">
                                        <?php if (!empty($related['duration'])): ?>
                                            <span><?= e($related['duration']) ?></span>
                                        <?php endif; ?>
                                        <span><?= formatDate($related['publishDate']) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
