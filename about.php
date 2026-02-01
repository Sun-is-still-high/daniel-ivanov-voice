<?php
/**
 * Страница "О проекте"
 */

$pageTitle = 'О проекте';
$pageDescription = "Информация о проекте Daniel's Voice и его создателе Даниил Иванов";

require_once __DIR__ . '/includes/header.php';
?>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <article class="max-w-4xl mx-auto">
        <!-- О проекте -->
        <section class="mb-20">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-8">
                Как появился этот сайт
            </h1>

            <div class="prose prose-lg prose-slate max-w-none">
                <p class="text-xl text-slate-700 leading-relaxed mb-6">
                    Я просто устал от приложений с подписками, регистрациями, всплывающими окнами и ежемесячными списаниями.
                </p>

                <p class="text-lg text-slate-600 leading-relaxed mb-6">
                    Конечно же, я сам пользователь и слушатель различных управляемых медитаций и техник осознанности. Однако приложения, которые я использовал, меня не очень устраивали. Какие-то платные: «Ну вот, ещё одна подписка, которую я забуду отменить». Какие-то — с очень навязчивыми модальными окнами в духе «Давайте выберем цели на этот месяц!», «А вот что в нашем приложении нового!». А я зашёл, чтобы просто был таймер со звуками леса.
                </p>

                <p class="text-lg text-slate-600 leading-relaxed mb-8">
                    <?= e($SITE_CONFIG['title']) ?> — сайт без подобной ерунды. Тут нет прикрученной аналитики, платного контента, модальных окон и email-рассылок.
                </p>

                <p class="text-lg text-slate-600 leading-relaxed mb-6">
                    Если вы профессионал, который работает на износ — это для вас.
                    Если вы вместо чтения статей предпочитаете слушать контент, пока занимаетесь своими делами — мне есть что вам предложить.
                    Если вы ищете ненавязчивый способ увеличить свои внутренние ресурсы — вы пришли по адресу.
                </p>

                <p class="text-lg text-slate-600 leading-relaxed mb-8">
                    Кстати, мои медитации также доступны на <a href="<?= e($SITE_CONFIG['social']['insightTimer']) ?>" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-700 underline">Insight Timer</a> — если вам удобнее слушать там.
                </p>
            </div>

            <div class="bg-gradient-to-br from-slate-50 to-blue-50 border-2 border-slate-200 rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-4">Почему всё бесплатно?</h2>
                <div class="space-y-4 text-slate-700">
                    <p class="leading-relaxed">
                        Я зарабатываю на индивидуальной терапии. Давайте будем считать, что вместо денежного вознаграждения, этот сайт усиливает мой личный бренд.
                    </p>
                    <p class="leading-relaxed font-medium">
                        Если материалы помогли — расскажите о них другу. Это лучшая благодарность.
                    </p>
                </div>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Вам тут не будет интересно, если:</h2>
                <ul class="space-y-3 text-slate-700 mb-6">
                    <li class="flex items-start gap-3">
                        <span class="text-red-500 font-bold mt-1">✗</span>
                        <span>Вы ищете быстрое исцеление за 5 минут</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-red-500 font-bold mt-1">✗</span>
                        <span>Вам нужна эзотерика, чакры и энергии</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-red-500 font-bold mt-1">✗</span>
                        <span>Вы хотите, чтобы кто-то решил ваши проблемы за вас</span>
                    </li>
                </ul>

                <h2 class="text-2xl font-bold text-slate-900 mb-6">Надеюсь, вам понравится, если:</h2>
                <ul class="space-y-3 text-slate-700">
                    <li class="flex items-start gap-3">
                        <span class="text-green-600 font-bold mt-1">✓</span>
                        <span>Вы готовы попробовать новое, даже когда сомневаетесь</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-green-600 font-bold mt-1">✓</span>
                        <span>Вам нужны инструменты, а не магия</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-green-600 font-bold mt-1">✓</span>
                        <span>Вы хотите понимать, КАК это работает</span>
                    </li>
                </ul>
            </div>

            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Категории материалов</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-emerald-800 mb-2">Медитации</h3>
                        <p class="text-slate-600"><?= e($SITE_CONFIG['categories']['mindfulness']['description']) ?></p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-800 mb-2">Мысли вслух</h3>
                        <p class="text-slate-600"><?= e($SITE_CONFIG['categories']['thoughts']['description']) ?></p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-purple-800 mb-2">Подкаст</h3>
                        <p class="text-slate-600"><?= e($SITE_CONFIG['categories']['podcast']['description']) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Об авторе -->
        <section class="mb-20">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-8">
                Об авторе
            </h2>

            <div class="flex flex-col md:flex-row gap-8 items-start mb-8">
                <div class="flex-shrink-0">
                    <img
                        src="<?= e($SITE_CONFIG['author']['avatar']) ?>"
                        alt="<?= e($SITE_CONFIG['author']['name']) ?>"
                        class="w-48 md:w-56 rounded-2xl object-cover shadow-2xl"
                    />
                </div>
                <div class="flex-1 prose prose-lg prose-slate max-w-none">
                    <p class="text-lg text-slate-700 leading-relaxed mb-6">
                        <strong><?= e($SITE_CONFIG['author']['name']) ?></strong> — <?= e($SITE_CONFIG['author']['bio']) ?>
                    </p>

                    <p class="text-lg text-slate-600 leading-relaxed mb-6">
                        Знаю, что такое code review в 23:00 и импостер-синдром на каждой планёрке.
                    </p>

                    <p class="text-lg text-slate-600 leading-relaxed mb-8">
                        Использую майндфулнесс не потому, что модно, а потому, что это эффективно.
                        Не использую эзотерику. Только то, что проверено исследованиями и мне удаётся применять в практике.
                    </p>

                    <a
                        href="<?= e($SITE_CONFIG['author']['website']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-lg"
                    >
                        Посетить личный сайт
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-slate-50 to-slate-100 border border-slate-200 rounded-2xl p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Связаться со мной</h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    <a
                        href="<?= e($SITE_CONFIG['social']['telegram']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 px-4 py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-colors"
                    >
                        <span class="text-slate-700">Telegram (личный)</span>
                    </a>
                    <a
                        href="<?= e($SITE_CONFIG['social']['telegramChannel']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 px-4 py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-colors"
                    >
                        <span class="text-slate-700">Telegram канал</span>
                    </a>
                    <a
                        href="<?= e($SITE_CONFIG['social']['youtube']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 px-4 py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-colors"
                    >
                        <span class="text-slate-700">YouTube</span>
                    </a>
                    <a
                        href="<?= e($SITE_CONFIG['social']['vk']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 px-4 py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-colors"
                    >
                        <span class="text-slate-700">ВКонтакте</span>
                    </a>
                    <a
                        href="<?= e($SITE_CONFIG['social']['blog']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 px-4 py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-colors"
                    >
                        <span class="text-slate-700">Блог</span>
                    </a>
                    <a
                        href="mailto:<?= e($SITE_CONFIG['social']['email']) ?>"
                        class="flex items-center gap-3 px-4 py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-colors"
                    >
                        <span class="text-slate-700">Email</span>
                    </a>
                    <a
                        href="<?= e($SITE_CONFIG['social']['insightTimer']) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center gap-3 px-4 py-3 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-colors"
                    >
                        <span class="text-slate-700">Insight Timer</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Техническая информация -->
        <section>
            <h2 class="text-2xl font-bold text-slate-900 mb-6">
                О сайте
            </h2>
            <div class="prose prose-slate max-w-none">
                <p class="text-slate-600 leading-relaxed mb-4">
                    Сайт создан с использованием современных веб-технологий для обеспечения быстрой загрузки
                    и удобства использования. Все аудиофайлы содержат корректные метаданные и доступны для
                    скачивания в формате MP3.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Материалы регулярно обновляются. Подпишитесь на мой Telegram-канал, чтобы не пропустить новые выпуски.
                </p>
            </div>
        </section>
    </article>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
