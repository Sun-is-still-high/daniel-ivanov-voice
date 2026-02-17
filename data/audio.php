<?php
/**
 * Данные аудиозаписей
 */

$AUDIO_DATA = [
    'inside-the-silence/fight-with-thoughts' => [
        'id' => 'inside-the-silence/fight-with-thoughts',
        'title' => 'Короткая психологическая практика',
        'description' => 'Моя первая записанная практика. Не совсем техника осознанности, больше практическая демонстрация. Выложил ее на сайт, чтобы точка \'С чего я начал\', была доступна в интернете',
        'category' => 'inside-the-silence',
        'duration' => '09:47',
        'audioFile' => '',
        'publishDate' => '2026-01-15',
        'platforms' => [],
        'embedPlayer' => '<iframe src="https://player.mave.digital?podcast=inside-the-silence&episode=1&color=rgb(95,128,245)&mute=1&date=1&download=1" style="width: 100%" height="235" scrolling="no" frameborder="no"></iframe>',
    ],
    'podcast/trailer' => [
        'id' => 'podcast/trailer',
        'title' => 'Трейлер',
        'description' => '"Психопогромизм" - это психология для технарей, которые во всем привыкли разбираться досконально. Каждый человек является экспертом своей жизни, и я это уважаю. Поэтому и создал психологический подкаст без "успешного успеха" и "Нужно просто себя полюбить". Добро пожаловать, давайте продолжим наши духовные поиски вместе.',
        'category' => 'podcast',
        'duration' => '01:16',
        'audioFile' => '/audio/podcast/Трейлер.mp3',
        'publishDate' => '2026-02-02',
        'platforms' => [],
    ],
    'podcast/pilot' => [
        'id' => 'podcast/pilot',
        'title' => 'Пилот',
        'description' => 'Пилотная серия подкаста. "Развиваем психическую устойчивость во время кризиса". Поговорим о сложном мире, в котором мы живем. Поговорим об автопилоте, на котором мы пытаемся решить наши проблемы. Рассмотрим альтернативу для автопилота.',
        'category' => 'podcast',
        'duration' => '21:17',
        'audioFile' => '/audio/podcast/Пилот.mp3',
        'publishDate' => '2026-02-10',
        'platforms' => [],
    ],
    'podcast/bio-neural-guide' => [
        'id' => 'podcast/bio-neural-guide',
        'title' => 'Руководство пользователя биологической нейросети',
        'description' => 'Как не поглупеть от нейросетей? Что делать, чтобы эффективно настроить свою биологическую нейросеть? Базовые правила ухода за своей нервной тканью и много другое вы узнаете в этом руководстве.',
        'category' => 'podcast',
        'duration' => '18:49',
        'audioFile' => '',
        'publishDate' => '2026-02-16',
        'platforms' => [],
        'embedPlayer' => '<iframe src="https://player.mave.digital?podcast=rebel-psychology&episode=3&color=rgb(95,128,245)&mute=1&date=1&download=1" style="width: 100%" height="235" scrolling="no" frameborder="no"></iframe>',
    ],
    'netlenka/friends-philosophy-alcohol' => [
        'id' => 'netlenka/friends-philosophy-alcohol',
        'title' => 'Друзья, философия, коньяк - не помогло. Что теперь?',
        'description' => 'Искал причины, по которым плеяда психологов вообще существует',
        'category' => 'netlenka',
        'duration' => '8:13',
        'audioFile' => '',
        'publishDate' => '2026-01-08',
        'platforms' => [],
        'embedPlayer' => '<iframe src="https://player.mave.digital?podcast=netlenka&episode=1&color=rgb(95,128,245)&mute=1&date=1&download=1" style="width: 100%" height="235" scrolling="no" frameborder="no"></iframe>',
    ],
];

/**
 * Получить все аудиозаписи
 */
function getAllAudio() {
    global $AUDIO_DATA;
    return $AUDIO_DATA;
}

/**
 * Получить аудиозаписи отсортированные по дате (новые первыми)
 */
function getSortedAudio() {
    global $AUDIO_DATA;
    $audio = $AUDIO_DATA;
    uasort($audio, function($a, $b) {
        return strtotime($b['publishDate']) - strtotime($a['publishDate']);
    });
    return $audio;
}

/**
 * Получить аудиозаписи по категории
 */
function getAudioByCategory($category) {
    global $AUDIO_DATA;
    $filtered = array_filter($AUDIO_DATA, function($audio) use ($category) {
        return $audio['category'] === $category;
    });
    uasort($filtered, function($a, $b) {
        return strtotime($b['publishDate']) - strtotime($a['publishDate']);
    });
    return $filtered;
}

/**
 * Получить одну аудиозапись по ID
 */
function getAudioById($id) {
    global $AUDIO_DATA;
    return $AUDIO_DATA[$id] ?? null;
}

/**
 * Получить количество записей в категории
 */
function getAudioCountByCategory($category) {
    global $AUDIO_DATA;
    return count(array_filter($AUDIO_DATA, function($audio) use ($category) {
        return $audio['category'] === $category;
    }));
}

/**
 * Получить похожие аудиозаписи (из той же категории)
 */
function getRelatedAudio($currentId, $category, $limit = 3) {
    global $AUDIO_DATA;
    $filtered = array_filter($AUDIO_DATA, function($audio) use ($currentId, $category) {
        return $audio['category'] === $category && $audio['id'] !== $currentId;
    });
    uasort($filtered, function($a, $b) {
        return strtotime($b['publishDate']) - strtotime($a['publishDate']);
    });
    return array_slice($filtered, 0, $limit);
}
