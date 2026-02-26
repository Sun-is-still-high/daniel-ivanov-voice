<?php
/**
 * Загрузка и кэширование RSS-ленты подкаста
 */

/**
 * Конвертировать длительность из RSS в формат MM:SS или H:MM:SS
 * RSS может отдавать: секунды ("1234"), MM:SS ("20:34"), HH:MM:SS ("1:20:34")
 */
function rssFormatDuration($raw) {
    if (empty($raw)) return '';

    if (is_numeric($raw)) {
        $s = (int)$raw;
        $h = intdiv($s, 3600);
        $m = intdiv($s % 3600, 60);
        $s = $s % 60;
        return $h > 0
            ? sprintf('%d:%02d:%02d', $h, $m, $s)
            : sprintf('%02d:%02d', $m, $s);
    }

    return $raw; // уже в текстовом формате
}

/**
 * Получить эпизоды подкаста из RSS с файловым кэшем.
 * Возвращает массив эпизодов, совместимый с форматом $AUDIO_DATA,
 * плюс ключ 'externalUrl' с прямой ссылкой на эпизод.
 *
 * @param string $rssUrl    URL RSS-ленты
 * @param string $cacheKey  Ключ для файла кэша (напр. 'rebel-psychology')
 * @param int    $ttl       Время жизни кэша в минутах (по умолчанию 60)
 * @return array
 */
function fetchRssEpisodes($rssUrl, $cacheKey, $categoryKey = 'podcast', $ttl = 60) {
    $cacheDir  = __DIR__ . '/../cache';
    $cacheFile = $cacheDir . '/rss_' . preg_replace('/[^a-z0-9_-]/i', '_', $cacheKey) . '.xml';

    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }

    $cacheValid = file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $ttl * 60;

    if (!$cacheValid) {
        $ctx     = stream_context_create(['http' => ['timeout' => 5, 'user_agent' => 'PHP RSS fetcher']]);
        $content = @file_get_contents($rssUrl, false, $ctx);
        if ($content !== false) {
            file_put_contents($cacheFile, $content);
        }
    }

    if (!file_exists($cacheFile)) {
        return [];
    }

    $xml = @simplexml_load_file($cacheFile);
    if (!$xml || !isset($xml->channel->item)) {
        return [];
    }

    $episodes = [];

    foreach ($xml->channel->item as $item) {
        $itunes    = $item->children('itunes', true);
        $enclosure = $item->enclosure;

        $pubDate = (string)$item->pubDate;
        $date    = $pubDate ? date('Y-m-d', strtotime($pubDate)) : date('Y-m-d');

        $description = trim(strip_tags(
            (string)($itunes->summary ?: $item->description)
        ));

        $audioFile = $enclosure ? (string)$enclosure['url'] : '';

        $episodes[] = [
            'id'          => '', // не используется при наличии externalUrl
            'category'    => $categoryKey,
            'title'       => trim((string)$item->title),
            'description' => $description,
            'publishDate' => $date,
            'duration'    => rssFormatDuration((string)$itunes->duration),
            'audioFile'   => $audioFile,
            'platforms'   => [],
            'externalUrl' => trim((string)$item->link),
        ];
    }

    return $episodes;
}
