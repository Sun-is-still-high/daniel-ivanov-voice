<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/rss.php';

$categoryKey = 'inside-the-silence';
$categoryInfo = $SITE_CONFIG['categories'][$categoryKey];
$sortedAudio = getRssEpisodesByCategory($categoryKey);

$pageTitle = $categoryInfo['title'];
$pageDescription = $categoryInfo['description'];
$pageImage = $SITE_CONFIG['author']['avatar'];
$pageTheme = getCategoryPageTheme($categoryKey);

require_once __DIR__ . '/../includes/header.php';

$categorySchema = [
    "@context" => "https://schema.org",
    "@type" => "CollectionPage",
    "name" => $categoryInfo['title'],
    "description" => $categoryInfo['description'],
    "creator" => [
        "@type" => "Person",
        "name" => $SITE_CONFIG['author']['name']
    ]
];
?>

<script type="application/ld+json">
<?= json_encode($categorySchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <div class="max-w-6xl mx-auto">
        <?= renderBreadcrumbs([['label' => $categoryInfo['title']]]) ?>

        <section class="podcast-hero mb-12">
            <div class="podcast-hero-grid lg:grid-cols-[0.92fr_1.08fr] lg:items-center">
                <div class="podcast-cover-wrap mx-auto lg:mx-0">
                    <img
                        src="<?= e($categoryInfo['image']) ?>"
                        alt="<?= e($categoryInfo['title']) ?>"
                        class="podcast-cover"
                    />
                </div>
                <div>
                    <span class="category-chip mb-5">Медитации и практики</span>
                    <h1 class="display-title text-5xl md:text-7xl mb-5"><?= e($categoryInfo['title']) ?></h1>
                    <p class="podcast-lead max-w-3xl mb-6">
                        <?= e($categoryInfo['description']) ?>
                    </p>
                    <div class="podcast-story-panel max-w-3xl">
                        <p class="soft-kicker mb-3 text-emerald-700">Состояние</p>
                        <p class="text-slate-700 leading-relaxed text-lg">
                            <?= e($categoryInfo['story']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="podcast-notes-grid mb-12">
            <article class="podcast-note-card">
                <p class="soft-kicker mb-3 text-emerald-700">Когда включать</p>
                <p class="text-slate-700 leading-relaxed">После перегруженного дня, между задачами, перед сном или в тот момент, когда внутренний шум стал громче вас.</p>
            </article>
            <article class="podcast-note-card">
                <p class="soft-kicker mb-3 text-emerald-700">Как звучит</p>
                <p class="text-slate-700 leading-relaxed">Мягко, медленно и без избыточной драматизации. Здесь важны пауза, дыхание и возвращение внимания в тело.</p>
            </article>
        </section>

        <section class="podcast-metrics-grid mb-12">
            <article class="podcast-metric-card">
                <p class="soft-kicker mb-3 text-emerald-700">Ритм</p>
                <p class="text-slate-700 leading-relaxed">Короткие, понятные практики без перегруза терминами. Формат, который не требует специальной подготовки.</p>
            </article>
            <article class="podcast-metric-card">
                <p class="soft-kicker mb-3 text-emerald-700">Эффект</p>
                <p class="text-slate-700 leading-relaxed">Не убежать от жизни, а немного приглушить шум, чтобы снова почувствовать опору в настоящем моменте.</p>
            </article>
            <article class="podcast-metric-card">
                <p class="soft-kicker mb-3 text-emerald-700">В ленте</p>
                <div class="flex items-end gap-3 mb-2">
                    <span class="podcast-stat"><?= count($sortedAudio) ?></span>
                    <span class="text-slate-600 font-semibold mb-1"><?= pluralRecords(count($sortedAudio)) ?></span>
                </div>
                <p class="text-slate-700 leading-relaxed">Короткие практики, к которым удобно возвращаться и не нужно долго «созревать».</p>
            </article>
        </section>

        <section class="podcast-stream-panel mb-16">
            <div class="podcast-section-heading">
                <div>
                    <p class="soft-kicker mb-3 text-emerald-700">Лента практик</p>
                    <h2 class="display-title text-4xl md:text-5xl">Пространство, где можно немного выдохнуть</h2>
                </div>
                <p class="max-w-2xl text-slate-600 leading-relaxed">
                    Выпуски лучше работают не как марафон, а как точечная поддержка. Выбирайте по состоянию, а не по порядку.
                </p>
            </div>

            <?php if (count($sortedAudio) > 0): ?>
                <div class="podcast-episode-stack">
                    <?php foreach ($sortedAudio as $audio): ?>
                        <?= renderPodcastEpisode($audio) ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="podcast-empty-state">
                    Аудиоматериалы скоро появятся.
                </div>
            <?php endif; ?>
        </section>

        <?php require_once __DIR__ . '/../includes/cta-consultation.php' ?>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
