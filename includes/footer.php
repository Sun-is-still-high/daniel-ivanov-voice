<?php
/**
 * Подвал сайта и закрывающие теги HTML
 */
$currentYear = date('Y');
?>

<footer class="bg-slate-900 text-slate-300 mt-20">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About -->
            <div>
                <h3 class="text-xl font-bold text-white mb-4"><?= e($SITE_CONFIG['author']['name']) ?></h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    <?= e($SITE_CONFIG['author']['bio']) ?>
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Рубрики</h3>
                <ul class="space-y-2">
                    <?php foreach ($SITE_CONFIG['categories'] as $key => $category): ?>
                        <li>
                            <?php if ($category['disabled']): ?>
                                <span class="text-slate-500 cursor-not-allowed">
                                    <?= e($category['title']) ?> <span class="text-xs">(Скоро)</span>
                                </span>
                            <?php else: ?>
                                <a href="/<?= e($key) ?>/" class="text-slate-400 hover:text-white transition-colors">
                                    <?= e($category['title']) ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Social Links -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Контакты и ссылки</h3>
                <div class="space-y-2 text-sm">
                    <a href="<?= e($SITE_CONFIG['social']['telegram']) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Telegram (личный)</span>
                    </a>
                    <a href="<?= e($SITE_CONFIG['social']['telegramChannel']) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                        </svg>
                        <span>Telegram канал</span>
                    </a>
                    <a href="<?= e($SITE_CONFIG['social']['youtube']) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <span>YouTube</span>
                    </a>
                    <a href="<?= e($SITE_CONFIG['social']['vk']) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>ВКонтакте</span>
                    </a>
                    <a href="<?= e($SITE_CONFIG['social']['blog']) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span>Блог</span>
                    </a>
                    <a href="<?= e($SITE_CONFIG['social']['contacts']) ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-400 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Запись на консультации</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-slate-800 text-center text-sm text-slate-500">
            <p>&copy; <?= $currentYear ?> <?= e($SITE_CONFIG['author']['name']) ?>. Все права защищены.</p>
            <p class="mt-2">Помогло? Расскажите другу.</p>
        </div>
    </div>
</footer>

<!-- JavaScript для мобильного меню и аудиоплеера -->
<script>
// Мобильное меню
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}

// Аудиоплеер
document.querySelectorAll('.audio-player-container').forEach((container) => {
    const audioPlayer = container.querySelector('.audio-player');
    const playPauseBtn = container.querySelector('.play-pause-btn');
    const playPauseText = container.querySelector('.play-pause-text');
    const playIcon = container.querySelector('.play-icon');
    const pauseIcon = container.querySelector('.pause-icon');
    const skipBackBtn = container.querySelector('.skip-back-btn');
    const skipForwardBtn = container.querySelector('.skip-forward-btn');

    if (!audioPlayer || !playPauseBtn) return;

    // Play/Pause
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

    // Skip controls
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

</body>
</html>
