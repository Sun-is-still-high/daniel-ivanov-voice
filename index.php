<?php
/**
 * Главная страница
 */

require_once __DIR__ . '/includes/header.php';

// Получаем отсортированные аудиозаписи
$sortedAudio = getSortedAudio();
?>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <!-- Hero Section -->
    <section class="text-center mb-32 md:mb-40">
        <h1 class="text-5xl md:text-7xl font-bold text-slate-900 mb-8">
            Для тех, кто устал жить
            <span class="bg-gradient-to-r from-emerald-600 to-blue-600 bg-clip-text text-transparent">
                на автопилоте
            </span>
        </h1>
        <p class="text-xl md:text-2xl text-slate-600 max-w-4xl mx-auto leading-relaxed mb-12">
            Медитации и подкасты от психолога, который говорит на языке айтишников.
            Никакой эзотерики — только то, что имеет доказательную базу.
        </p>
        <div class="flex flex-wrap justify-center gap-6">
            <a
                href="#audio-catalog"
                class="px-10 py-4 bg-slate-900 hover:bg-slate-800 text-white text-lg font-semibold rounded-xl transition-colors shadow-lg"
            >
                Хочу попробовать
            </a>
            <a
                href="/about.php"
                class="px-10 py-4 border-2 border-slate-900 hover:bg-slate-900 hover:text-white text-slate-900 text-lg font-semibold rounded-xl transition-colors"
            >
                Как это работает?
            </a>
        </div>
    </section>

    <!-- About Author -->
    <section class="mb-32 bg-white rounded-3xl shadow-xl p-10 md:p-16">
        <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold text-slate-900 mb-6">Об авторе</h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-8">
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
            <div class="flex items-center justify-center">
                <div class="text-center">
                    <img
                        src="<?= e($SITE_CONFIG['author']['avatar']) ?>"
                        alt="<?= e($SITE_CONFIG['author']['name']) ?>"
                        class="w-full max-w-md mx-auto mb-6 object-cover shadow-2xl rounded-2xl"
                    />
                    <p class="text-slate-800 font-semibold text-xl"><?= e($SITE_CONFIG['author']['name']) ?></p>
                    <p class="text-slate-600 text-base mt-2">Психолог, психотерапевт, член АКПН. Пишу на Typescript</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="audio-catalog" class="mb-32">
        <h2 class="text-5xl font-bold text-slate-900 mb-16 text-center">Категории</h2>

        <div class="grid md:grid-cols-2 gap-10 md:gap-12 mb-16">
            <?php foreach ($SITE_CONFIG['categories'] as $key => $category): ?>
                <?php
                $count = getAudioCountByCategory($key);
                $isDisabled = $category['disabled'];
                $colorClasses = $CATEGORY_COLORS[$category['color']] ?? '';
                ?>
                <?php if ($isDisabled): ?>
                    <div class="group relative overflow-hidden bg-white rounded-3xl shadow-lg transition-all duration-300 p-10 md:p-12 opacity-60 cursor-not-allowed">
                        <div class="absolute top-6 right-6 px-4 py-2 bg-slate-900 text-white text-sm font-semibold rounded-full">
                            Скоро
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-br <?= $colorClasses ?> opacity-0 transition-opacity"></div>
                        <div class="relative">
                            <h3 class="text-3xl font-bold mb-4 text-slate-500">
                                <?= e($category['title']) ?>
                            </h3>
                            <p class="text-lg mb-6 text-slate-400">
                                <?= e($category['description']) ?>
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-400">В разработке</span>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <a
                        href="/<?= e($key) ?>"
                        class="group relative overflow-hidden bg-white rounded-3xl shadow-lg transition-all duration-300 p-10 md:p-12 hover:shadow-2xl cursor-pointer"
                    >
                        <div class="absolute inset-0 bg-gradient-to-br <?= $colorClasses ?> opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        <div class="relative">
                            <h3 class="text-3xl font-bold mb-4 text-slate-900">
                                <?= e($category['title']) ?>
                            </h3>
                            <p class="text-lg mb-6 text-slate-600">
                                <?= e($category['description']) ?>
                            </p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-slate-400">
                                    <?= $count ?> <?= pluralRecords($count) ?>
                                </span>
                                <span class="text-slate-400 group-hover:text-slate-600 transition-colors">→</span>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Podcast Platforms -->
    <section class="mb-32">
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-3xl p-10 md:p-16 text-center">
            <h2 class="text-4xl font-bold text-slate-900 mb-4">Психопогромизм</h2>
            <p class="text-lg text-slate-600 mb-8 max-w-2xl mx-auto">
                Слушайте подкаст на удобной платформе
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://mave.stream/rebel-psychology" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Mave
                </a>
                <a href="https://music.yandex.ru/album/40512697" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Яндекс Музыка
                </a>
                <a href="https://castbox.fm/channel/id7001251" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Castbox
                </a>
                <a href="https://zvuk.com/podcast/48659120" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Звук
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Audio -->
    <section class="mb-32">
        <div class="flex flex-wrap items-center justify-between mb-10 gap-6">
            <h2 class="text-4xl md:text-5xl font-bold text-slate-900">Последние записи</h2>
        </div>

        <div id="audio-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            <?php
            $displayAudio = array_slice($sortedAudio, 0, 9);
            foreach ($displayAudio as $audio) {
                echo renderAudioCard($audio);
            }
            ?>
        </div>

        <?php if (count($sortedAudio) > 9): ?>
            <div class="text-center mt-12">
                <p class="text-slate-600 mb-4">Всего <?= count($sortedAudio) ?> <?= pluralRecords(count($sortedAudio)) ?></p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
