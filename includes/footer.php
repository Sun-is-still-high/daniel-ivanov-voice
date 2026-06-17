<?php
$currentYear = date('Y');
$footerTheme = $pageTheme ?? 'site';

$footerContent = [
    'site' => [
        'kicker' => 'Daniel\'s Voice',
        'lead' => 'Сайт с медитациями, подкастами и честным разговором о психологии, выгорании и внутреннем шуме без эзотерики.',
        'note' => 'Открытый архив, к которому можно возвращаться за выдохом, ясностью и более точным языком для себя.',
    ],
    'home' => [
        'kicker' => 'Библиотека голоса',
        'lead' => 'Главная собирает все маршруты сайта: выдох, честный текст и большой разговор о психологии для технарей.',
        'note' => 'Выбирайте не по формату, а по состоянию, в котором вы сейчас находитесь.',
    ],
    'about' => [
        'kicker' => 'О проекте',
        'lead' => 'Этот сайт задуман как пространство без воронок, подписок и маркетинговой суеты вокруг психологии.',
        'note' => 'Пусть в конце страницы остаётся не давление, а ощущение ясности и уважения к вашему вниманию.',
    ],
    'netlenka' => [
        'kicker' => 'Нетленка',
        'lead' => 'Короткие тексты вслух о психологии и жизни, где важнее точность и честность, чем терапевтический декор.',
        'note' => 'Если нужен другой режим разговора, внизу есть остальные линии проекта.',
    ],
    'podcast' => [
        'kicker' => 'Психопогромизм',
        'lead' => 'Подкаст о психологии для тех, кто привык думать системно и не любит, когда с ним говорят сверху вниз.',
        'note' => 'Большой разговор не заканчивается на одном выпуске: можно уйти в другие режимы сайта.',
    ],
    'inside-the-silence' => [
        'kicker' => 'Внутри тишины',
        'lead' => 'Практики и медитации для моментов, когда внутренний шум, тревога или усталость стали слишком плотными и нужен выдох.',
        'note' => 'Если вам сейчас нужен другой ритм, рядом остаются и более разговорные разделы проекта.',
    ],
];

$footer = $footerContent[$footerTheme] ?? $footerContent['site'];
?>

<footer class="mt-20 text-[color:var(--ink-2)]">
    <div class="container mx-auto px-6 md:px-8">
        <div class="footer-shell rounded-[8px] p-8 md:p-10">
            <div class="relative z-10 grid gap-10 md:grid-cols-[1.15fr_0.85fr_0.85fr]">
                <div class="footer-card">
                    <p class="footer-kicker mb-3"><?= e($footer['kicker']) ?></p>
                    <h3 class="site-logo text-xl mb-4"><?= e($SITE_CONFIG['title']) ?></h3>
                    <p class="text-sm text-[color:var(--ink-2)] leading-relaxed mb-4"><?= e($footer['lead']) ?></p>
                    <p class="text-sm text-[color:var(--ink-3)] leading-relaxed"><?= e($footer['note']) ?></p>
                </div>

                <div class="footer-card">
                    <h3 class="text-lg font-semibold text-[color:var(--ink)] mb-4">Разделы сайта</h3>
                    <ul class="space-y-2">
                        <?php foreach ($SITE_CONFIG['categories'] as $key => $category): ?>
                            <li>
                                <?php if ($category['disabled']): ?>
                                    <span class="text-[color:var(--ink-4)]"><?= e($category['title']) ?> <span class="text-xs">(Скоро)</span></span>
                                <?php else: ?>
                                    <a href="/<?= e($key) ?>/" class="footer-link text-[color:var(--ink-2)] transition-colors"><?= e($category['title']) ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                        <li><a href="/about/" class="footer-link text-[color:var(--ink-2)] transition-colors">О проекте</a></li>
                    </ul>
                </div>

                <div class="footer-card">
                    <h3 class="text-lg font-semibold text-[color:var(--ink)] mb-4">Контакты и площадки</h3>
                    <div class="space-y-2 text-sm">
                        <a href="<?= e($SITE_CONFIG['social']['telegram']) ?>" target="_blank" rel="noopener noreferrer" class="footer-link block text-[color:var(--ink-2)] transition-colors">Telegram</a>
                        <a href="<?= e($SITE_CONFIG['social']['telegramChannel']) ?>" target="_blank" rel="noopener noreferrer" class="footer-link block text-[color:var(--ink-2)] transition-colors">Telegram-канал</a>
                        <a href="<?= e($SITE_CONFIG['social']['youtube']) ?>" target="_blank" rel="noopener noreferrer" class="footer-link block text-[color:var(--ink-2)] transition-colors">YouTube</a>
                        <a href="<?= e($SITE_CONFIG['social']['blog']) ?>" target="_blank" rel="noopener noreferrer" class="footer-link block text-[color:var(--ink-2)] transition-colors">Блог</a>
                        <a href="<?= e($SITE_CONFIG['social']['contacts']) ?>" target="_blank" rel="noopener noreferrer" class="footer-link block text-[color:var(--ink-2)] transition-colors">Запись на консультацию</a>
                    </div>
                </div>
            </div>

            <div class="relative z-10 mt-10 pt-8 border-t border-[color:var(--line)] text-sm text-[color:var(--ink-3)] flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <p>&copy; <?= $currentYear ?> <?= e($SITE_CONFIG['author']['name']) ?>.</p>
                <a href="/privacy/" class="footer-link underline underline-offset-2 text-[color:var(--ink-2)] transition-colors">Политика конфиденциальности</a>
            </div>
        </div>
    </div>
</footer>

<script>
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}

document.querySelectorAll('.audio-player-container').forEach((container) => {
    const audioPlayer = container.querySelector('.audio-player');
    const playPauseBtn = container.querySelector('.play-pause-btn');
    const playPauseText = container.querySelector('.play-pause-text');
    const playIcon = container.querySelector('.play-icon');
    const pauseIcon = container.querySelector('.pause-icon');
    const skipBackBtn = container.querySelector('.skip-back-btn');
    const skipForwardBtn = container.querySelector('.skip-forward-btn');

    if (!audioPlayer || !playPauseBtn) return;

    playPauseBtn.addEventListener('click', () => {
        if (audioPlayer.paused) {
            audioPlayer.play();
        } else {
            audioPlayer.pause();
        }
    });

    audioPlayer.addEventListener('play', () => {
        if (playIcon) playIcon.classList.add('hidden');
        if (pauseIcon) pauseIcon.classList.remove('hidden');
        if (playPauseText) playPauseText.textContent = 'Пауза';
    });

    audioPlayer.addEventListener('pause', () => {
        if (playIcon) playIcon.classList.remove('hidden');
        if (pauseIcon) pauseIcon.classList.add('hidden');
        if (playPauseText) playPauseText.textContent = 'Воспроизвести';
    });

    if (skipBackBtn) {
        skipBackBtn.addEventListener('click', () => {
            audioPlayer.currentTime = Math.max(0, audioPlayer.currentTime - 10);
        });
    }

    if (skipForwardBtn) {
        skipForwardBtn.addEventListener('click', () => {
            audioPlayer.currentTime = Math.min(audioPlayer.duration, audioPlayer.currentTime + 10);
        });
    }
});
</script>

<div id="cookie-banner" class="fixed bottom-0 left-0 right-0 z-50 border-t px-4 py-4 md:px-8" style="display:none">
    <div class="container mx-auto flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <p class="text-sm text-[color:var(--ink-2)] leading-relaxed">
            Сайт использует cookie и Яндекс Метрику, чтобы понимать посещаемость и улучшать содержимое без навязчивого трекинга.
            <a href="/privacy/" class="text-[color:var(--ink)] underline underline-offset-2 hover:text-[color:var(--accent)] whitespace-nowrap">Подробнее</a>
        </p>
        <button id="cookie-accept" type="button" class="btn-accent flex-shrink-0 px-5 py-2 text-sm rounded-[2px] transition-colors">
            Принять
        </button>
    </div>
</div>

<script>
(function() {
    var banner = document.getElementById('cookie-banner');
    var btn = document.getElementById('cookie-accept');
    if (!banner || !btn) return;

    if (!localStorage.getItem('cookie_accepted')) {
        banner.style.display = 'block';
    }

    btn.addEventListener('click', function() {
        localStorage.setItem('cookie_accepted', '1');
        banner.style.display = 'none';
    });
})();
</script>

</body>
</html>
