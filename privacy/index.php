<?php
/**
 * Политика конфиденциальности
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../data/audio.php';

$pageTitle = 'Политика конфиденциальности';
$pageDescription = 'Политика конфиденциальности сайта Daniel\'s Voice. Информация об обработке персональных данных в соответствии с 152-ФЗ.';

require_once __DIR__ . '/../includes/header.php';
?>

<main class="container mx-auto px-6 md:px-8 py-16 md:py-24">
    <div class="max-w-3xl mx-auto">

        <?= renderBreadcrumbs([['label' => 'Политика конфиденциальности']]) ?>

        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Политика конфиденциальности</h1>
        <p class="text-slate-500 mb-12">Последнее обновление: 16 февраля 2026 г.</p>

        <div class="prose prose-slate max-w-none space-y-10 text-slate-700 leading-relaxed">

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">1. Оператор персональных данных</h2>
                <p>Оператором персональных данных является индивидуальный предприниматель Иванов Даниил Александрович (далее — «Оператор», «мы»).</p>
                <p class="mt-2">Сайт: <strong>daniel-ivanov-voice.ru</strong><br>
                Email: <a href="mailto:<?= e($SITE_CONFIG['social']['email']) ?>" class="text-blue-600 hover:underline"><?= e($SITE_CONFIG['social']['email']) ?></a></p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">2. Какие данные мы собираем</h2>
                <p>Мы не собираем личные данные (имя, email, телефон) напрямую. При посещении сайта автоматически собираются следующие технические данные:</p>
                <ul class="list-disc pl-6 mt-3 space-y-1">
                    <li>IP-адрес в анонимизированном виде</li>
                    <li>Данные браузера и устройства (тип, версия, ОС)</li>
                    <li>Страницы, которые вы посетили, и время визита</li>
                    <li>Источник перехода на сайт (реферер)</li>
                    <li>Файлы cookie, необходимые для работы аналитики</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">3. Цели обработки данных</h2>
                <p>Данные используются исключительно для:</p>
                <ul class="list-disc pl-6 mt-3 space-y-1">
                    <li>Анализа посещаемости сайта и улучшения его содержимого</li>
                    <li>Обеспечения корректной работы сайта</li>
                </ul>
                <p class="mt-3">Мы не используем данные для рекламы, профилирования или передачи третьим лицам в коммерческих целях.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">4. Правовое основание обработки</h2>
                <p>Обработка данных осуществляется на основании:</p>
                <ul class="list-disc pl-6 mt-3 space-y-1">
                    <li>Согласия субъекта персональных данных (ст. 6, ч. 1, п. 1 Федерального закона № 152-ФЗ)</li>
                    <li>Законного интереса оператора в обеспечении работы и улучшении сайта</li>
                </ul>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">5. Аналитика и файлы cookie</h2>
                <p>Сайт использует <strong>Яндекс Метрику</strong> — сервис веб-аналитики ООО «Яндекс» (Россия). Данные аналитики хранятся на серверах, расположенных на территории Российской Федерации, что соответствует требованиям Федерального закона № 152-ФЗ о локализации персональных данных.</p>
                <p class="mt-3">Вы можете отказаться от сбора аналитических данных, установив расширение браузера <a href="https://yandex.ru/support/metrica/general/opt-out.html" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline">Яндекс Метрика: отключение сбора данных</a> или настроив блокировку cookie в браузере.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">6. Хранение данных</h2>
                <p>Технические данные, собираемые Яндекс Метрикой, хранятся в соответствии с политикой хранения данных сервиса Яндекс Метрика. Мы не храним персональные данные на собственных серверах дольше, чем это необходимо для целей обработки.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">7. Передача данных третьим лицам</h2>
                <p>Данные не передаются третьим лицам, за исключением:</p>
                <ul class="list-disc pl-6 mt-3 space-y-1">
                    <li><strong>ООО «Яндекс»</strong> — в части аналитики (Яндекс Метрика), в рамках их собственной политики конфиденциальности</li>
                    <li><strong>ООО «Мейв»</strong> — встроенный аудиоплеер Mave Digital для воспроизведения подкаста</li>
                </ul>
                <p class="mt-3">Данные не передаются за пределы Российской Федерации.</p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">8. Ваши права</h2>
                <p>В соответствии с Федеральным законом № 152-ФЗ вы имеете право:</p>
                <ul class="list-disc pl-6 mt-3 space-y-1">
                    <li>Получить информацию об обработке ваших персональных данных</li>
                    <li>Потребовать уточнения, блокирования или уничтожения данных</li>
                    <li>Отозвать согласие на обработку персональных данных</li>
                    <li>Обжаловать действия оператора в Роскомнадзоре</li>
                </ul>
                <p class="mt-3">Для реализации прав обратитесь по email: <a href="mailto:<?= e($SITE_CONFIG['social']['email']) ?>" class="text-blue-600 hover:underline"><?= e($SITE_CONFIG['social']['email']) ?></a></p>
            </section>

            <section>
                <h2 class="text-xl font-bold text-slate-900 mb-3">9. Изменения политики</h2>
                <p>Мы оставляем за собой право изменять настоящую политику. Актуальная версия всегда доступна на этой странице. Дата последнего обновления указана в начале документа.</p>
            </section>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
