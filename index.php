<?php
/**
 * Р“Р»Р°РІРЅР°СЏ СЃС‚СЂР°РЅРёС†Р°
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/rss.php';

$pageTitle = $SITE_CONFIG['title'];
$pageDescription = $SITE_CONFIG['description'];
$pageImage = $SITE_CONFIG['author']['avatar'];
$pageTheme = 'home';

// РџРѕР»СѓС‡Р°РµРј РїРѕСЃР»РµРґРЅРёРµ Р·Р°РїРёСЃРё РёР· РІСЃРµС… RSS-С„РёРґРѕРІ
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
    "jobTitle" => "РџСЃРёС…РѕР»РѕРі, РїСЃРёС…РѕС‚РµСЂР°РїРµРІС‚",
    "knowsAbout" => ["РїСЃРёС…РѕР»РѕРіРёСЏ", "РїСЃРёС…РѕС‚РµСЂР°РїРёСЏ", "РјРµРґРёС‚Р°С†РёСЏ", "РѕСЃРѕР·РЅР°РЅРЅРѕСЃС‚СЊ", "РІС‹РіРѕСЂР°РЅРёРµ", "TypeScript", "IT"],
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
            "name" => "РџСЃРёС…РѕРїРѕРіСЂРѕРјРёР·Рј",
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

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <section class="hero-panel rounded-[2rem] px-8 py-10 md:px-14 md:py-16 mb-14">
        <div class="relative z-10 grid gap-10 lg:grid-cols-[1.3fr_0.7fr] lg:items-end">
            <div>
                <span class="eyebrow mb-6">
                    <span class="accent-dot"></span>
                    Психология без эзотерики
                </span>
                <h1 class="display-title text-5xl md:text-7xl text-slate-900 mb-6">
                    Для тех, кто устал жить на автопилоте
                </h1>
                <p class="text-xl md:text-2xl text-slate-700 max-w-3xl leading-relaxed mb-10">
                    Медитации и подкасты от психолога, который говорит с айтишниками не сверху вниз, а на одном языке.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#audio-catalog" class="btn-accent px-8 py-4 rounded-2xl text-lg font-semibold transition-all">
                        Выбрать формат
                    </a>
                    <a href="/about/" class="btn-ghost px-8 py-4 rounded-2xl text-lg font-semibold transition-all">
                        О проекте
                    </a>
                </div>
            </div>
            <div class="glass-panel rounded-[1.75rem] p-6 md:p-8">
                <p class="soft-kicker mb-4">Что здесь важно</p>
                <div class="space-y-5 text-slate-700">
                    <p class="leading-relaxed">Без подписок, лишних экранов и обещаний «починить жизнь за 5 минут».</p>
                    <p class="leading-relaxed">Только ясный голос, прикладная психология и контент, который можно слушать между релизами, созвонами и дедлайнами.</p>
                    <p class="leading-relaxed font-semibold text-slate-900">Нужен покой, честный разговор или интеллектуальная провокация — на сайте есть свой маршрут для каждого состояния.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell rounded-[2rem] p-8 md:p-12 mb-14">
        <div class="grid md:grid-cols-[0.95fr_1.05fr] gap-10 md:gap-14 items-center">
            <div class="relative">
                <div class="absolute -inset-4 rounded-[2rem] bg-white/30 blur-2xl"></div>
                <img
                    src="<?= e($SITE_CONFIG['author']['avatar']) ?>"
                    alt="<?= e($SITE_CONFIG['author']['name']) ?> — психолог, психотерапевт"
                    class="relative w-full max-w-md mx-auto rounded-[2rem] object-cover shadow-2xl"
                />
            </div>
            <div>
                <p class="soft-kicker mb-4">Автор проекта</p>
                <h2 class="display-title text-4xl md:text-5xl mb-5">Даниил Иванов</h2>
                <p class="text-lg text-slate-700 leading-relaxed mb-6">
                    <?= e($SITE_CONFIG['author']['bio']) ?>
                </p>
                <div class="quote-panel rounded-[1.5rem] p-6 mb-6">
                    <p class="relative z-10 text-slate-700 leading-relaxed">
                        Контент здесь устроен как спокойный, но требовательный разговор: без мистики, без инфошума и без снисходительного тона.
                    </p>
                </div>
                <a
                    href="<?= e($SITE_CONFIG['author']['website']) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 text-[color:var(--accent-strong)] hover:opacity-80 font-semibold transition-opacity"
                >
                    Личный сайт
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <section id="audio-catalog" class="mb-14">
        <div class="flex items-end justify-between gap-6 mb-8 flex-wrap">
            <div>
                <p class="soft-kicker mb-3">Здесь впервые?</p>
                <h2 class="display-title text-4xl md:text-5xl">С чего начать</h2>
            </div>
            <p class="max-w-xl text-slate-600 leading-relaxed">
                Каждая рубрика отвечает на разное состояние: от перегруза и внутреннего шума до желания подумать глубже и честнее.
            </p>
        </div>
        <div class="theme-grid">
            <a href="/inside-the-silence/" class="theme-card block">
                <p class="soft-kicker mb-3 text-emerald-700">Когда нужен выдох</p>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Внутри тишины</h3>
                <p class="text-slate-600 leading-relaxed mb-5">Мягкий, медленный ритм. Практики, которые помогают вернуться в тело и убрать лишний шум.</p>
                <span class="font-semibold text-emerald-800">Короткие практики 8–15 минут</span>
            </a>
            <a href="/netlenka/" class="theme-card block">
                <p class="soft-kicker mb-3 text-blue-700">Когда нужен честный текст</p>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Нетленка</h3>
                <p class="text-slate-600 leading-relaxed mb-5">Блог вслух без воды. Разговорный, плотный, местами неудобный, но живой.</p>
                <span class="font-semibold text-blue-800">Коротко, по делу, без иллюзий</span>
            </a>
            <a href="/rebel-psychology/" class="theme-card block">
                <p class="soft-kicker mb-3 text-violet-700">Когда хочется думать глубже</p>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Психопогромизм</h3>
                <p class="text-slate-600 leading-relaxed mb-5">Большой разговор для тех, кто привык разбираться в системах и хочет так же разбираться в себе.</p>
                <span class="font-semibold text-violet-800">Психология для технарей</span>
            </a>
        </div>
    </section>

    <section class="mb-20">
        <div class="flex items-end justify-between gap-6 mb-8 flex-wrap">
            <div>
                <p class="soft-kicker mb-3">Свежие записи</p>
                <h2 class="display-title text-4xl md:text-5xl">Последнее в эфире</h2>
            </div>
            <p class="max-w-xl text-slate-600 leading-relaxed">
                Последние выпуски со всех лент в одном месте, чтобы можно было быстро понять, что вышло новым.
            </p>
        </div>
        <div class="flex flex-col gap-5">
            <?php foreach ($latestAudio as $audio): ?>
                <?= renderPodcastEpisode($audio) ?>
            <?php endforeach; ?>
        </div>
    </section>

    <?php require_once __DIR__ . '/includes/cta-consultation.php' ?>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
