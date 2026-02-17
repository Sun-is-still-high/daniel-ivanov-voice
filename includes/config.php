<?php
/**
 * Конфигурация сайта
 */

$SITE_CONFIG = [
    'title' => "Daniel's Voice",
    'description' => 'Медитации и подкасты для тех, кто устал жить на автопилоте. Психолог, который говорит на языке айтишников: без эзотерики, с конкретными инструментами. Всё бесплатно.',
    'author' => [
        'name' => 'Даниил Иванов',
        'bio' => 'Психолог, который работает с айтишниками. Сам работал в IT: 6 лет программировал на TypeScript в продуктовых и аутсорс-компаниях. Веду подкаст «Психопогромизм», потому что устал от советов в духе «просто расслабься». Говорю о психологии на языке программистов — без «прими себя», с конкретными инструментами. Подробнее обо мне и моём психологическом образовании — на личном сайте.',
        'website' => 'https://daniel-ivanov.ru/',
        'avatar' => '/images/avatar.jpg',
    ],
    'social' => [
        'telegram' => 'https://t.me/get_handshake_with_daniel_ivanov',
        'telegramChannel' => 'https://t.me/daniel_ivanov_therapy',
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
            'title' => 'Внутри тишины',
            'description' => 'Когда голова не отключается даже после работы. Короткие практики и медитации, чтобы выйти из режима «вечного дедлайна».',
            'story' => 'Оборотная сторона нашей способности планировать и анализировать — это возможность в этом режиме застрять. Постоянное нахождение в мыслях о делах, переживаниях о прошлом или беспокойстве о будущем может перерасти в форму бытового транса. Я предлагаю техники, которые позволят вам освободиться из плена, сбросить оцепенение и почувствовать, каково это — жить в настоящем.',
            'color' => 'emerald',
            'image' => null,
            'platforms' => [],
            'disabled' => false,
        ],
        'netlenka' => [
            'title' => 'Нетленка',
            'description' => 'Нетленка - это блог вслух. Про психологию без эзотерики, про психотерапию без воды, про жизнь без лишних иллюзий.',
            'story' => 'Коротко. По делу. Иногда неудобно.',
            'color' => 'blue',
            'image' => null,
            'platforms' => [],
            'disabled' => false,
        ],
        'podcast' => [
            'title' => 'Психопогромизм',
            'description' => 'Психолог побуждает айтишников к размышлениям и изменениям. Фишка в том, что у психолога коммерческий опыт разработки на TypeScript 6+ лет. Только доказательная прикладная психология, без успешного успеха.',
            'story' => 'Психопогромизм — это психология для технарей, которые во всём привыкли разбираться досконально. Я не занимаю позицию учителя — мы общаемся на равных. Каждый человек является экспертом своей жизни, и я это очень уважаю. Присоединяйтесь к дискуссии: размышляйте вместе со мной, соглашайтесь и не соглашайтесь. Без «успешного успеха» и девчачьего «нужно просто себя полюбить».',
            'color' => 'purple',
            'image' => '/images/Обложка.jpg',
            'platforms' => [
                ['name' => 'Mave', 'url' => 'https://mave.stream/rebel-psychology'],
                ['name' => 'Яндекс Музыка', 'url' => 'https://music.yandex.ru/album/40512697'],
                ['name' => 'Spotify', 'url' => 'https://open.spotify.com/show/4xzJgQsANEdKzvd9lFxxj2'],
                ['name' => 'Deezer', 'url' => 'https://deezer.com/show/1002646891'],
                ['name' => 'Castbox', 'url' => 'https://castbox.fm/channel/id7001251'],
                ['name' => 'Звук', 'url' => 'https://zvuk.com/podcast/48659120'],
                ['name' => 'Telegram', 'url' => 'https://t.me/mavestreambot/app?startapp=rebel-psychology'],
            ],
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
    'podcast' => 'Подкаст',
];
