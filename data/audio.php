<?php
/**
 * Данные аудиозаписей
 */

$AUDIO_DATA = [
    'mindfulness/fight-with-thoughts' => [
        'id' => 'mindfulness/fight-with-thoughts',
        'title' => 'Короткая психологическая практика',
        'description' => 'Моя первая записанная практика. Не совсем техника осознанности, больше практическая демонстрация. Выложил ее на сайт, чтобы точка \'С чего я начал\', была доступна в интернете',
        'category' => 'mindfulness',
        'duration' => '09:47',
        'audioFile' => '/audio/mindfulness/Про борьбу с мыслями.mp3',
        'publishDate' => '2026-01-15',
        'tags' => ['для начинающих', 'борьба с мыслями'],
    ],
    'thoughts/friends-philosophy-alcohol' => [
        'id' => 'thoughts/friends-philosophy-alcohol',
        'title' => 'Друзья, философия, коньяк - не помогло. Что теперь?',
        'description' => 'Искал причины, по которым плеяда психологов вообще существует',
        'category' => 'thoughts',
        'duration' => '8:13',
        'audioFile' => '/audio/thoughts/Друзья, философия, коньяк - не помогло. Что теперь.mp3',
        'publishDate' => '2026-01-08',
        'tags' => ['психотерапия', 'психология', 'самопомощь'],
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
