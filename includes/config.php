<?php
/**
 * Конфигурация сайта
 */

$SITE_CONFIG = [
    'title' => "Daniel's Voice",
    'description' => 'Подкасты, медитации и аудиопрактики для тех, кто устал жить на автопилоте. Психология для айтишников и системно мыслящих людей: без эзотерики, с ясным языком и прикладными инструментами.',
    'author' => [
        'name' => 'Даниил Иванов',
        'bio' => 'Психолог и психотерапевт, который работает с айтишниками и не только. Сам шесть лет работал в IT и программировал на TypeScript, поэтому говорит о психологии с технарями на одном языке: без эзотерики, без «прими себя», с уважением к мышлению, фактам и реальной жизни.',
        'website' => 'https://daniel-ivanov.ru/',
        'avatar' => '/images/avatar.jpg',
    ],
    'social' => [
        'telegram' => 'https://t.me/get_handshake_with_daniel_ivanov',
        'telegramChannel' => 'https://t.me/+Z1YC7eulzBozN2Vi',
        'youtube' => 'https://www.youtube.com/@daniel_ivanov_therapy',
        'rutube' => 'https://rutube.ru/channel/47943864/',
        'vk' => 'https://vk.com/daniel_ivanov_therapy',
        'vkVideo' => 'https://vkvideo.ru/@club234820338',
        'dzen' => 'https://dzen.ru/daniel_ivanov_therapy',
        'blog' => 'https://daniel-ivanov.ru/blog',
        'contacts' => 'https://daniel-ivanov.ru/contacts',
        'email' => 'therapy@daniel-ivanov.ru',
        'insightTimer' => 'https://insig.ht/2P6YsAhgp0b',
        'podcastMave' => 'https://mave.stream/rebel-psychology',
    ],
    'categories' => [
        'inside-the-silence' => [
            'mavePodcast' => 'inside-the-silence',
            'title' => 'Внутри тишины',
            'description' => 'Медитации и короткие аудиопрактики для тех моментов, когда голова не выключается после работы, внутренний шум не отпускает, а телу и вниманию нужен выдох.',
            'story' => 'У привычки всё анализировать есть и обратная сторона: можно застрять в мыслях, тревоге и бесконечном внутреннем диалоге. «Внутри тишины» — это бережные практики, которые помогают чуть приглушить шум, вернуться в тело, заметить опору и снова почувствовать настоящее, а не только собственную перегрузку.',
            'color' => 'emerald',
            'image' => '/images/Обложка Внутри тишины.jpeg',
            'legacyEpisodeSlugs' => [
                'fight-with-thoughts' => 'ep-1',
            ],
            'platforms' => [],
            'rssUrl' => 'https://cloud.mave.digital/69743',
            'disabled' => false,
        ],
        'netlenka' => [
            'mavePodcast' => 'netlenka',
            'title' => 'Нетленка',
            'description' => 'Аудиоблог о психологии, психотерапии и жизни без эзотерики, без воды и без лишних иллюзий. Короткие, плотные и честные тексты вслух.',
            'story' => 'Коротко. По делу. Иногда неудобно. «Нетленка» нужна для тех случаев, когда не хочется утешительного тумана и красивых формулировок, а нужен точный поворот мысли и более честный взгляд на себя и жизнь.',
            'color' => 'blue',
            'image' => '/images/Обложка Нетленка.jpeg',
            'legacyEpisodeSlugs' => [
                'friends-philosophy-alcohol' => 'ep-1',
            ],
            'platforms' => [],
            'rssUrl' => 'https://cloud.mave.digital/69739',
            'disabled' => false,
        ],
        'podcast' => [
            'slug' => 'rebel-psychology',
            'mavePodcast' => 'rebel-psychology',
            'title' => 'Психопогромизм',
            'description' => 'Подкаст о психологии для айтишников и системно мыслящих людей. Выгорание, стресс, терапия, самоотношение и прикладная психология без эзотерики и без позы «гуру».',
            'story' => '«Психопогромизм» — это большой разговор о психологии для технарей, которые привыкли разбираться в системах и хотят так же внимательно разбираться в себе. Здесь никто не говорит сверху вниз: мы думаем на равных, спорим, уточняем и ищем не красивое утешение, а более честное понимание того, что с нами происходит.',
            'color' => 'purple',
            'image' => '/images/Обложка.jpg',
            'legacyEpisodeSlugs' => [
                'trailer' => 'ep-1',
                'pilot' => 'ep-2',
                'bio-neural-guide' => 'ep-3',
            ],
            'platforms' => [
                ['name' => 'Mave', 'url' => 'https://mave.stream/rebel-psychology'],
                ['name' => 'Яндекс Музыка', 'url' => 'https://music.yandex.ru/album/40512697'],
                ['name' => 'Spotify', 'url' => 'https://open.spotify.com/show/4xzJgQsANEdKzvd9lFxxj2'],
                ['name' => 'Deezer', 'url' => 'https://deezer.com/show/1002646891'],
                ['name' => 'Castbox', 'url' => 'https://castbox.fm/channel/id7001251'],
                ['name' => 'Звук', 'url' => 'https://zvuk.com/podcast/48659120'],
                ['name' => 'Telegram', 'url' => 'https://t.me/mavestreambot/app?startapp=rebel-psychology'],
            ],
            'rssUrl' => 'https://cloud.mave.digital/69212',
            'disabled' => false,
        ],
    ],
];

// Цветовые классы для категорий
$CATEGORY_COLORS = [
    'emerald' => 'from-emerald-500 to-emerald-600',
    'blue' => 'from-blue-500 to-blue-600',
    'purple' => 'from-purple-500 to-purple-600',
];

$CATEGORY_BADGE_COLORS = [
    'inside-the-silence' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
    'netlenka' => 'bg-blue-100 text-blue-800 border-blue-200',
    'podcast' => 'bg-purple-100 text-purple-800 border-purple-200',
];

$CATEGORY_LABELS = [
    'inside-the-silence' => 'Внутри тишины',
    'netlenka' => 'Нетленка',
    'podcast' => 'Психопогромизм',
];
