<?php
/**
 * Страница категории подкаста
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../data/audio.php';

$categoryKey = 'podcast';
$categoryInfo = $SITE_CONFIG['categories'][$categoryKey];
$sortedAudio = getAudioByCategory($categoryKey);
$categoryColor = $categoryInfo['color'];

$pageTitle = $categoryInfo['title'];
$pageDescription = $categoryInfo['description'];
$pageImage = $SITE_CONFIG['author']['avatar'];

require_once __DIR__ . '/../includes/header.php';

// Добавляем структурированные данные для категории
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

<!-- Schema.org structured data -->
<script type="application/ld+json">
<?= json_encode($categorySchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumbs -->
        <?= renderBreadcrumbs([['label' => $categoryInfo['title']]]) ?>

        <!-- Category Header -->
        <div class="mb-12">
            <?php if (!empty($categoryInfo['image'])): ?>
                <div class="flex flex-col md:flex-row gap-8 items-start mb-8">
                    <div class="flex-shrink-0">
                        <img
                            src="<?= e($categoryInfo['image']) ?>"
                            alt="<?= e($categoryInfo['title']) ?>"
                            class="w-64 md:w-80 rounded-2xl shadow-2xl"
                        />
                    </div>
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 mb-4 break-words">
                            <?= e($categoryInfo['title']) ?>
                        </h1>
                        <p class="text-lg md:text-xl text-slate-600 mb-6 break-words">
                            <?= e($categoryInfo['description']) ?>
                        </p>
                        <?php if (!empty($categoryInfo['platforms'])): ?>
                            <div class="flex flex-wrap gap-3 mt-2">
                                <?php foreach ($categoryInfo['platforms'] as $platform): ?>
                                    <a
                                        href="<?= e($platform['url']) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="inline-flex items-center gap-2 px-5 py-3 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-xl transition-colors"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        <?= e($platform['name']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <h1 class="text-3xl md:text-5xl font-bold text-slate-900 mb-4 break-words">
                    <?= e($categoryInfo['title']) ?>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 mb-6 break-words">
                    <?= e($categoryInfo['description']) ?>
                </p>
            <?php endif; ?>

            <?php if (!empty($categoryInfo['story'])): ?>
                <div class="bg-gradient-to-br from-slate-50 to-blue-50 border-l-4 border-<?= e($categoryColor) ?>-500 rounded-xl p-6 mb-8">
                    <p class="text-slate-700 leading-relaxed italic">
                        <?= e($categoryInfo['story']) ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <?php if (count($sortedAudio) > 0): ?>
            <!-- Audio Stats -->
            <div class="flex flex-wrap items-center justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900">
                        Все записи
                        <span class="text-slate-500 font-normal ml-2">
                            (<?= count($sortedAudio) ?> <?= pluralRecords(count($sortedAudio)) ?>)
                        </span>
                    </h2>
                </div>
            </div>

            <!-- Audio Grid -->
            <div id="audio-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($sortedAudio as $audio): ?>
                    <?= renderAudioCard($audio) ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-20">
                <div class="flex justify-center mb-4">
                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-2">Пока нет записей</h3>
                <p class="text-slate-600">
                    Аудиоматериалы в этой категории скоро появятся
                </p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>