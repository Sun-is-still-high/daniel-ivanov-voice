<?php
/**
 * Страница категории: Мысли вслух
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/data/audio.php';

$category = 'thoughts';
$categoryInfo = $SITE_CONFIG['categories'][$category];
$sortedAudio = getAudioByCategory($category);

$pageTitle = $categoryInfo['title'];
$pageDescription = $categoryInfo['description'];

require_once __DIR__ . '/includes/header.php';
?>

<main class="container mx-auto px-4 py-12">
    <!-- Breadcrumbs -->
    <?= renderBreadcrumbs([['label' => $categoryInfo['title']]]) ?>

    <!-- Category Header -->
    <div class="mb-12">
        <h1 class="text-3xl md:text-5xl font-bold text-slate-900 mb-4 break-words">
            <?= e($categoryInfo['title']) ?>
        </h1>
        <p class="text-lg md:text-xl text-slate-600 mb-6 break-words">
            <?= e($categoryInfo['description']) ?>
        </p>

        <?php if (!empty($categoryInfo['story'])): ?>
            <div class="bg-gradient-to-br from-slate-50 to-blue-50 border-l-4 border-blue-500 rounded-xl p-6 mb-8">
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
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
