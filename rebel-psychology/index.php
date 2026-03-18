<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/rss.php';

$categoryKey = 'podcast';
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
            <div class="podcast-hero-grid lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
                <div class="podcast-cover-wrap">
                    <img
                        src="<?= e($categoryInfo['image']) ?>"
                        alt="<?= e($categoryInfo['title']) ?>"
                        class="podcast-cover"
                    />
                </div>
                <div>
                    <span class="category-chip mb-5">Большой разговор</span>
                    <h1 class="display-title text-5xl md:text-7xl mb-5"><?= e($categoryInfo['title']) ?></h1>
                    <p class="podcast-lead max-w-3xl mb-6">
                        <?= e($categoryInfo['description']) ?>
                    </p>
                    <div class="podcast-story-panel max-w-3xl">
                        <p class="soft-kicker mb-3 text-violet-700">Оптика подкаста</p>
                        <p class="text-slate-700 leading-relaxed text-lg">
                            <?= e($categoryInfo['story']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="podcast-metrics-grid mb-8">
            <article class="podcast-metric-card">
                <p class="soft-kicker mb-3 text-violet-700">Характер</p>
                <p class="text-slate-700 leading-relaxed">Интеллектуальный, спорящий, неуспокаивающий. Не терапия-как-сервис, а разговор, в котором хочется участвовать.</p>
            </article>
            <article class="podcast-metric-card">
                <p class="soft-kicker mb-3 text-violet-700">Собеседник</p>
                <p class="text-slate-700 leading-relaxed">Технари, системно мыслящие люди и все, кому важно понимать не только что чувствовать, но и как это устроено.</p>
            </article>
            <article class="podcast-metric-card">
                <p class="soft-kicker mb-3 text-violet-700">В ленте</p>
                <div class="flex items-end gap-3 mb-2">
                    <span class="podcast-stat"><?= count($sortedAudio) ?></span>
                    <span class="text-slate-600 font-semibold mb-1"><?= pluralRecords(count($sortedAudio)) ?></span>
                </div>
                <p class="text-slate-700 leading-relaxed">Длиннее, глубже и плотнее по идеям, чем остальные линии проекта.</p>
            </article>
        </section>

        <?php if (!empty($categoryInfo['platforms'])): ?>
            <section class="podcast-stream-panel mb-12">
                <div class="podcast-section-heading">
                    <div>
                        <p class="soft-kicker mb-3 text-violet-700">Площадки</p>
                        <h2 class="display-title text-4xl md:text-5xl">Слушать там, где вам удобно</h2>
                    </div>
                    <p class="max-w-2xl text-slate-600 leading-relaxed">
                        Подкаст живет не в одном приложении. Можно выбрать привычную среду и не менять свои маршруты ради контента.
                    </p>
                </div>
                <div class="podcast-platform-grid">
                    <?php foreach ($categoryInfo['platforms'] as $platform): ?>
                        <a
                            href="<?= e($platform['url']) ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="podcast-platform-card hover:-translate-y-1 transition-transform"
                        >
                            <p class="soft-kicker mb-2 text-violet-700">Площадка</p>
                            <p class="text-xl font-semibold text-slate-900"><?= e($platform['name']) ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <section class="podcast-stream-panel mb-16">
            <div class="podcast-section-heading">
                <div>
                    <p class="soft-kicker mb-3 text-violet-700">Архив выпусков</p>
                    <h2 class="display-title text-4xl md:text-5xl">Разговоры, в которые стоит входить не с края</h2>
                </div>
                <p class="max-w-2xl text-slate-600 leading-relaxed">
                    Эта лента не про фон. Здесь лучше слушать с вниманием: мысли цепляются друг за друга, а вопросы часто звучат важнее ответов.
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
