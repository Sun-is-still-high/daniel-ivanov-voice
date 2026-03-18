<?php
/**
 * РЎС‚СЂР°РЅРёС†Р° "Рћ РїСЂРѕРµРєС‚Рµ"
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

$pageTitle = 'О проекте';
$pageDescription = "Информация о проекте Daniel's Voice и его создателе Данииле Иванове";
$pageImage = $SITE_CONFIG['author']['avatar'];
$pageTheme = 'about';

require_once __DIR__ . '/../includes/header.php';

$aboutPageSchema = [
    "@context" => "https://schema.org",
    "@graph" => [
        [
            "@type" => "AboutPage",
            "name" => "О проекте",
            "description" => "Информация о проекте Daniel's Voice и его создателе Данииле Иванове",
            "author" => [
                "@type" => "Person",
                "name" => $SITE_CONFIG['author']['name'],
                "description" => $SITE_CONFIG['author']['bio'],
                "url" => $SITE_CONFIG['author']['website'],
                "jobTitle" => "Психолог, психотерапевт",
                "memberOf" => "АКПН",
                "sameAs" => [
                    $SITE_CONFIG['social']['telegram'],
                    $SITE_CONFIG['social']['telegramChannel'],
                    $SITE_CONFIG['social']['youtube'],
                    $SITE_CONFIG['social']['vk'],
                    $SITE_CONFIG['author']['website'],
                ]
            ]
        ]
    ]
];
?>

<script type="application/ld+json">
<?= json_encode($aboutPageSchema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <article class="max-w-6xl mx-auto">
        <section class="hero-panel rounded-[2rem] px-8 py-10 md:px-14 md:py-16 mb-14">
            <div class="relative z-10 grid gap-10 lg:grid-cols-[1.15fr_0.85fr]">
                <div>
                    <span class="eyebrow mb-6">
                        <span class="accent-dot"></span>
                        О проекте
                    </span>
                    <h1 class="display-title text-5xl md:text-7xl text-slate-900 mb-6">
                        Сайт, который не отнимает у человека внимание
                    </h1>
                    <p class="text-xl md:text-2xl text-slate-700 leading-relaxed max-w-3xl">
                        Daniel's Voice вырос из раздражения на подписки, навязчивые сценарии и «заботу», которая больше похожа на маркетинг.
                    </p>
                </div>
                <div class="glass-panel rounded-[1.75rem] p-6 md:p-8">
                    <p class="soft-kicker mb-4">Принцип проекта</p>
                    <div class="space-y-4 text-slate-700 leading-relaxed">
                        <p>Открыл страницу, нажал play, получил материал. Без регистрации, без захвата почты, без лишних препятствий.</p>
                        <p>Это сайт-приглашение в разговор, а не продуктовая воронка.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid lg:grid-cols-[1.15fr_0.85fr] gap-8 mb-14">
            <div class="section-shell rounded-[2rem] p-8 md:p-10">
                <p class="soft-kicker mb-4">Зачем он появился</p>
                <div class="space-y-5 text-lg text-slate-700 leading-relaxed">
                    <p>Я просто устал от приложений с подписками, регистрациями, всплывающими окнами и бесконечными попытками продать «новый уровень осознанности».</p>
                    <p>При этом сами медитации и подкасты как формат мне нужны и близки. Поэтому проект сделан максимально прямо: пришёл, включил, послушал, ушёл с чем-то полезным.</p>
                    <p><?= e($SITE_CONFIG['title']) ?> — это библиотека голоса, где важнее содержание, чем механики удержания.</p>
                </div>
            </div>
            <div class="quote-panel rounded-[2rem] p-8 md:p-10 self-start">
                <p class="relative z-10 text-xl text-slate-700 leading-relaxed">
                    Здесь не обещают волшебного исцеления. Здесь дают опору, язык для размышления и несколько хороших способов вернуться к себе.
                </p>
            </div>
        </section>

        <section class="grid md:grid-cols-2 gap-6 mb-14">
            <div class="theme-card">
                <p class="soft-kicker mb-3">Вам подойдёт</p>
                <ul class="space-y-3 text-slate-700 leading-relaxed">
                    <li>Если вам нужны инструменты, а не магия.</li>
                    <li>Если вы готовы размышлять и проверять идеи на практике.</li>
                    <li>Если вам ближе спокойный, взрослый, не сюсюкающий тон.</li>
                </ul>
            </div>
            <div class="theme-card">
                <p class="soft-kicker mb-3">Вам не подойдёт</p>
                <ul class="space-y-3 text-slate-700 leading-relaxed">
                    <li>Если вы ищете быстрые чудеса за 5 минут.</li>
                    <li>Если вам нужна эзотерика, энергии и готовые ответы.</li>
                    <li>Если хочется, чтобы кто-то «починил» жизнь вместо вас.</li>
                </ul>
            </div>
        </section>

        <section class="section-shell rounded-[2rem] p-8 md:p-10 mb-14">
            <div class="flex items-end justify-between gap-6 mb-8 flex-wrap">
                <div>
                    <p class="soft-kicker mb-3">Три линии проекта</p>
                    <h2 class="display-title text-4xl md:text-5xl">Один сайт, три состояния</h2>
                </div>
                <p class="max-w-2xl text-slate-600 leading-relaxed">
                    Главная задача была не собрать всё в одну ленту, а дать каждому подкасту собственный характер и собственный вход.
                </p>
            </div>
            <div class="theme-grid">
                <a href="/inside-the-silence/" class="theme-card block">
                    <p class="soft-kicker mb-3 text-emerald-700">Тихий режим</p>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Внутри тишины</h3>
                    <p class="text-slate-600 leading-relaxed">Практики и медитации для перегруженной головы и возвращения в настоящее.</p>
                </a>
                <a href="/netlenka/" class="theme-card block">
                    <p class="soft-kicker mb-3 text-blue-700">Честный режим</p>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Нетленка</h3>
                    <p class="text-slate-600 leading-relaxed">Блог вслух. Короткие, плотные тексты о психологии, терапии и жизни без красивых ширм.</p>
                </a>
                <a href="/rebel-psychology/" class="theme-card block">
                    <p class="soft-kicker mb-3 text-violet-700">Интеллектуальный режим</p>
                    <h3 class="text-2xl font-bold text-slate-900 mb-3">Психопогромизм</h3>
                    <p class="text-slate-600 leading-relaxed">Подкаст для технарей и системно мыслящих людей, которым нужен разговор на равных.</p>
                </a>
            </div>
        </section>

        <section class="section-shell rounded-[2rem] p-8 md:p-10 mb-14">
            <div class="grid md:grid-cols-[0.55fr_1fr] gap-8 items-start">
                <div>
                    <img
                        src="<?= e($SITE_CONFIG['author']['avatar']) ?>"
                        alt="<?= e($SITE_CONFIG['author']['name']) ?> — психолог, психотерапевт"
                        class="w-full max-w-xs rounded-[2rem] object-cover shadow-2xl"
                    />
                </div>
                <div>
                    <p class="soft-kicker mb-3">Об авторе</p>
                    <h2 class="display-title text-4xl md:text-5xl mb-5">Даниил Иванов</h2>
                    <p class="text-lg text-slate-700 leading-relaxed mb-6">
                        <strong><?= e($SITE_CONFIG['author']['name']) ?></strong> — <?= e($SITE_CONFIG['author']['bio']) ?>
                    </p>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <a href="<?= e($SITE_CONFIG['social']['telegram']) ?>" target="_blank" rel="noopener noreferrer" class="theme-card block">Telegram</a>
                        <a href="<?= e($SITE_CONFIG['social']['telegramChannel']) ?>" target="_blank" rel="noopener noreferrer" class="theme-card block">Telegram-канал</a>
                        <a href="<?= e($SITE_CONFIG['social']['youtube']) ?>" target="_blank" rel="noopener noreferrer" class="theme-card block">YouTube</a>
                        <a href="<?= e($SITE_CONFIG['social']['blog']) ?>" target="_blank" rel="noopener noreferrer" class="theme-card block">Блог</a>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once __DIR__ . '/../includes/cta-consultation.php' ?>
    </article>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
