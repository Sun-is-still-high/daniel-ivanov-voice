<?php
/**
 * Главная страница
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/rss.php';

$pageTitle = $SITE_CONFIG['title'];
$pageDescription = $SITE_CONFIG['description'];
$pageImage = $SITE_CONFIG['author']['avatar'];

// Получаем последние записи из всех RSS-фидов
$allEpisodes = [];
foreach ($SITE_CONFIG['categories'] as $key => $category) {
    if (!empty($category['rssUrl'])) {
        $episodes = fetchRssEpisodes($category['rssUrl'], $key, $key);
        $allEpisodes = array_merge($allEpisodes, $episodes);
    }
}
usort($allEpisodes, function($a, $b) {
    return strtotime($b['publishDate']) - strtotime($a['publishDate']);
});
$latestAudio = array_slice($allEpisodes, 0, 9);

require_once __DIR__ . '/includes/header.php';

$authorSchema = [
    "@type" => "Person",
    "name" => $SITE_CONFIG['author']['name'],
    "description" => $SITE_CONFIG['author']['bio'],
    "url" => $SITE_CONFIG['author']['website'],
    "image" => "https://daniel-ivanov-voice.ru" . $SITE_CONFIG['author']['avatar'],
    "jobTitle" => "Психолог, психотерапевт",
    "knowsAbout" => ["психология", "психотерапия", "медитация", "осознанность", "выгорание", "TypeScript", "IT"],
    "sameAs" => [
        $SITE_CONFIG['social']['telegram'],
        $SITE_CONFIG['social']['telegramChannel'],
        $SITE_CONFIG['social']['youtube'],
        $SITE_CONFIG['social']['vk'],
        $SITE_CONFIG['social']['rutube'],
        $SITE_CONFIG['social']['dzen'],
        $SITE_CONFIG['author']['website'],
        $SITE_CONFIG['social']['blog'],
    ]
];

$homepageSchema = [
    "@context" => "https://schema.org",
    "@graph" => [
        [
            "@type" => "WebSite",
            "name" => $SITE_CONFIG['title'],
            "description" => $SITE_CONFIG['description'],
            "url" => "https://daniel-ivanov-voice.ru/",
            "inLanguage" => "ru",
            "author" => $authorSchema,
            "publisher" => $authorSchema
        ],
        [
            "@type" => "PodcastSeries",
            "name" => "Психопогромизм",
            "description" => $SITE_CONFIG['categories']['podcast']['description'],
            "url" => "https://daniel-ivanov-voice.ru/rebel-psychology/",
            "inLanguage" => "ru",
            "author" => ["@type" => "Person", "name" => $SITE_CONFIG['author']['name']],
            "webFeed" => $SITE_CONFIG['categories']['podcast']['rssUrl']
        ]
    ]
];
?>

<!-- Schema.org structured data -->
<script type="application/ld+json">
<?= json_encode($homepageSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<main class="container mx-auto px-6 md:px-8 py-24 md:py-36">
    <!-- Hero Section -->
    <section class="text-center mb-40 md:mb-56">
        <h1 class="text-5xl md:text-7xl font-bold text-slate-900 mb-8">
            Для тех, кто устал жить
            <span class="bg-gradient-to-r from-emerald-600 to-blue-600 bg-clip-text text-transparent">
                на автопилоте
            </span>
        </h1>
        <h2 class="text-xl md:text-2xl text-slate-600 max-w-4xl mx-auto leading-relaxed mb-12 font-normal">
            Медитации и подкасты от психолога, который говорит на языке айтишников.
            Никакой эзотерики — только доказательная психология для IT-специалистов.
        </h2>
        <div class="flex flex-wrap justify-center gap-6">
            <a
                href="#audio-catalog"
                class="px-10 py-4 bg-slate-900 hover:bg-slate-800 text-white text-lg font-semibold rounded-xl transition-colors shadow-lg"
            >
                Хочу попробовать
            </a>
            <a
                href="/about/"
                class="px-10 py-4 border-2 border-slate-900 hover:bg-slate-900 hover:text-white text-slate-900 text-lg font-semibold rounded-xl transition-colors"
            >
                О проекте
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
                        alt="<?= e($SITE_CONFIG['author']['name']) ?> — психолог, психотерапевт"
                        class="w-full max-w-md mx-auto mb-6 object-cover shadow-2xl rounded-2xl"
                    />
                    <p class="text-slate-800 font-semibold text-xl"><?= e($SITE_CONFIG['author']['name']) ?></p>
                    <p class="text-slate-600 text-base mt-2">Психолог, психотерапевт, член АКПН. Пишет на Typescript</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Onboarding -->
    <section id="audio-catalog" class="mb-20">
        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 md:p-10">
            <p class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-4">Здесь впервые?</p>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6">С чего начать</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <a href="/inside-the-silence/" class="group block p-6 bg-white border border-emerald-200 rounded-xl hover:border-emerald-400 hover:shadow-md transition-all">
                    <div class="text-emerald-600 font-bold text-sm mb-2">Нужно успокоиться прямо сейчас</div>
                    <div class="text-slate-900 font-semibold group-hover:text-emerald-700 transition-colors">Внутри тишины →</div>
                    <div class="text-slate-500 text-sm mt-1">Короткие практики 8–15 минут</div>
                </a>
                <a href="/netlenka/" class="group block p-6 bg-white border border-blue-200 rounded-xl hover:border-blue-400 hover:shadow-md transition-all">
                    <div class="text-blue-600 font-bold text-sm mb-2">Хочу честный разговор о жизни</div>
                    <div class="text-slate-900 font-semibold group-hover:text-blue-700 transition-colors">Нетленка →</div>
                    <div class="text-slate-500 text-sm mt-1">Блог вслух, коротко и по делу</div>
                </a>
                <a href="/rebel-psychology/" class="group block p-6 bg-white border border-purple-200 rounded-xl hover:border-purple-400 hover:shadow-md transition-all">
                    <div class="text-purple-600 font-bold text-sm mb-2">Хочу разобраться в себе глубже</div>
                    <div class="text-slate-900 font-semibold group-hover:text-purple-700 transition-colors">Психопогромизм →</div>
                    <div class="text-slate-500 text-sm mt-1">Подкаст для тех, кто думает системно</div>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Audio -->
    <section class="mb-32">
        <h2 class="text-4xl md:text-5xl font-bold text-slate-900 mb-10">Последние записи</h2>

        <div class="flex flex-col gap-5">
            <?php foreach ($latestAudio as $audio): ?>
                <?= renderPodcastEpisode($audio) ?>
            <?php endforeach; ?>
        </div>
    </section>

    <?php require_once __DIR__ . '/includes/cta-consultation.php' ?>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
