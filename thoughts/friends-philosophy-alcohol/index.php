<?php
/**
 * Эпизод: Друзья, философия, коньяк - не помогло. Что теперь?
 */

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../data/audio.php';

$audioId = 'thoughts/friends-philosophy-alcohol';
$audio = getAudioById($audioId);

if (!$audio) {
    header('HTTP/1.0 404 Not Found');
    header('Location: /');
    exit;
}

$categoryInfo = $SITE_CONFIG['categories'][$audio['category']];
$relatedAudio = getRelatedAudio($audioId, $audio['category'], 3);
$platforms = $audio['platforms'] ?? [];

$pageTitle = $audio['title'];
$pageDescription = $audio['description'];
$pageType = 'article';

require_once __DIR__ . '/../../includes/header.php';

$formattedDate = formatDate($audio['publishDate']);
?>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <!-- Breadcrumbs -->
    <?= renderBreadcrumbs([
        ['label' => $categoryInfo['title'], 'href' => '/' . e($audio['category'])],
        ['label' => $audio['title']]
    ]) ?>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Audio Player Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8">
                <!-- Title -->
                <div class="px-6 pt-6 pb-6">
                    <h1 class="text-2xl md:text-4xl font-bold text-slate-900 mb-4 break-words">
                        <?= e($audio['title']) ?>
                    </h1>
                    <div class="flex items-center gap-4 text-sm text-slate-500">
                        <span><?= $formattedDate ?></span>
                        <span><?= e($audio['duration']) ?></span>
                    </div>
                </div>

                <!-- Audio Player -->
                <div class="px-6 pb-6">
                    <?= renderAudioPlayer($audio) ?>
                </div>

                <!-- Platform Buttons -->
                <?= renderPlatformButtons($platforms) ?>

                <!-- Description -->
                <div class="px-6 pb-6 border-t border-slate-100 pt-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-3">Описание</h2>
                    <p class="text-slate-600 leading-relaxed">
                        <?= e($audio['description']) ?>
                    </p>
                </div>

            </div>

            <!-- About Author -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Об авторе</h2>
                <p class="text-slate-600 leading-relaxed mb-4">
                    <?= e($SITE_CONFIG['author']['bio']) ?>
                </p>
                <a
                    href="<?= e($SITE_CONFIG['author']['website']) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium"
                >
                    Посетить личный сайт
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <?php if (count($relatedAudio) > 0): ?>
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">
                        Похожие записи
                    </h2>
                    <div class="space-y-4">
                        <?php foreach ($relatedAudio as $related): ?>
                            <a href="/<?= e($related['category']) ?>/<?= e(basename($related['id'])) ?>" class="block group">
                                <div class="p-4 bg-slate-50 hover:bg-slate-100 rounded-lg transition-colors">
                                    <h3 class="font-semibold text-slate-900 group-hover:text-blue-600 mb-2 line-clamp-2">
                                        <?= e($related['title']) ?>
                                    </h3>
                                    <div class="flex items-center gap-3 text-sm text-slate-500">
                                        <span><?= e($related['duration']) ?></span>
                                        <span><?= formatDate($related['publishDate']) ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <a
                        href="/<?= e($audio['category']) ?>"
                        class="block mt-6 px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-center font-medium rounded-lg transition-colors"
                    >
                        Все записи категории
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>