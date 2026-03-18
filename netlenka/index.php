<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/rss.php';

$categoryKey = 'netlenka';
$categoryInfo = $SITE_CONFIG['categories'][$categoryKey];
$sortedAudio = getRssEpisodesByCategory($categoryKey);

$pageTitle = $categoryInfo['title'];
$pageDescription = 'Нетленка — аудиоблог о психологии, терапии и жизни без воды, эзотерики и мотивационного мусора. Короткие, плотные и честные тексты.';
$pageImage = $SITE_CONFIG['author']['avatar'];
$pageTheme = 'netlenka';

require_once __DIR__ . '/../includes/header.php';
?>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <div class="max-w-6xl mx-auto">
        <?= renderBreadcrumbs([['label' => $categoryInfo['title']]]) ?>

        <section class="podcast-page-card podcast-masthead mb-12">
            <div class="relative z-10 grid lg:grid-cols-[0.85fr_1.15fr] gap-8 items-center p-8 md:p-12">
                <div>
                    <img src="<?= e($categoryInfo['image']) ?>" alt="<?= e($categoryInfo['title']) ?>" class="w-full max-w-sm rounded-[2rem] shadow-2xl" />
                </div>
                <div>
                    <span class="category-chip mb-5">Аудиоблог</span>
                    <h1 class="display-title text-5xl md:text-7xl mb-5"><?= e($categoryInfo['title']) ?></h1>
                    <p class="text-xl text-slate-700 leading-relaxed mb-6"><?= e($categoryInfo['description']) ?></p>
                    <div class="quote-panel rounded-[1.5rem] p-6">
                        <p class="relative z-10 text-slate-700 leading-relaxed"><?= e($categoryInfo['story']) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="theme-card">
                <p class="soft-kicker mb-3 text-blue-700">Тембр</p>
                <p class="text-slate-700 leading-relaxed">Редакционный, плотный, без лишней нежности. Словно заметки на полях о психологии и жизни, которые читают вслух.</p>
            </div>
            <div class="theme-card">
                <p class="soft-kicker mb-3 text-blue-700">Для кого</p>
                <p class="text-slate-700 leading-relaxed">Для тех, кому нужен короткий, точный и иногда неудобный разговор о психологии, терапии, самообмане и жизни без красивых ширм.</p>
            </div>
            <div class="theme-card">
                <p class="soft-kicker mb-3 text-blue-700">Формат</p>
                <p class="text-slate-700 leading-relaxed"><?= count($sortedAudio) ?> <?= pluralRecords(count($sortedAudio)) ?> в ленте. Небольшие выпуски, которые хочется включить между делами.</p>
            </div>
        </section>

        <section class="mb-16">
            <div class="flex items-end justify-between gap-6 mb-8 flex-wrap">
                <div>
                    <p class="soft-kicker mb-3 text-blue-700">Лента выпусков</p>
                    <h2 class="display-title text-4xl md:text-5xl">Честные записи без воды</h2>
                </div>
                <p class="max-w-2xl text-slate-600 leading-relaxed">
                    Здесь работает тот же принцип, что и во всём проекте: один выпуск, одна мысль, один точный поворот внимания.
                </p>
            </div>

            <?php if (count($sortedAudio) > 0): ?>
                <div class="flex flex-col gap-5">
                    <?php foreach ($sortedAudio as $audio): ?>
                        <?= renderPodcastEpisode($audio) ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="section-shell rounded-[2rem] p-10 text-center text-slate-600">
                    Выпуски скоро появятся.
                </div>
            <?php endif; ?>
        </section>

        <?php require_once __DIR__ . '/../includes/cta-consultation.php' ?>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
