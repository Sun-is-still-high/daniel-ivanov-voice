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
 * Извлечь короткий идентификатор выпуска из внешней ссылки, например "ep-3"
 */
function rssExtractLinkSlug($url) {
    $path = parse_url((string) $url, PHP_URL_PATH);
    if (!$path) {
        return '';
    }

    return trim(basename($path), '/');
}

/**
 * Извлечь номер эпизода из Mave slug вида ep-5
 */
function rssExtractEpisodeNumber($linkSlug) {
    if (preg_match('/^ep-(\d+)$/', (string) $linkSlug, $matches)) {
        return $matches[1];
    }

    return null;
}

/**
 * Построить URL Mave embed-плеера для выпуска
 */
function buildMaveEmbedUrl($categoryKey, $linkSlug) {
    global $SITE_CONFIG;

    $podcastSlug = $SITE_CONFIG['categories'][$categoryKey]['mavePodcast'] ?? '';
    $episodeNumber = rssExtractEpisodeNumber($linkSlug);

    if ($podcastSlug === '' || $episodeNumber === null) {
        return null;
    }

    $query = http_build_query([
        'podcast' => $podcastSlug,
        'episode' => $episodeNumber,
        'color' => 'rgb(95,128,245)',
        'mute' => '1',
        'date' => '1',
        'download' => '1',
    ]);

    return 'https://player.mave.digital?' . $query;
}

/**
 * Построить slug для внутренней страницы выпуска
 */
function rssBuildEpisodeSlug($title, $fallback = '') {
    $normalizedTitle = mb_strtolower(trim((string) $title), 'UTF-8');

    if ($normalizedTitle === 'трейлер') {
        return 'trailer';
    }

    if ($normalizedTitle === 'пилот' || str_starts_with($normalizedTitle, 'пилот.')) {
        return 'pilot';
    }

    $slug = slugify($title);

    if ($slug !== '') {
        return $slug;
    }

    return slugify($fallback);
}

/**
 * Поддержать старые ручные slug для уже опубликованных выпусков
 */
function rssResolvePageSlug($categoryKey, $title, $linkSlug) {
    global $SITE_CONFIG;

    $legacySlugs = $SITE_CONFIG['categories'][$categoryKey]['legacyEpisodeSlugs'] ?? [];
    $legacySlug = array_search($linkSlug, $legacySlugs, true);

    if ($legacySlug !== false) {
        return $legacySlug;
    }

    return rssBuildEpisodeSlug($title, $linkSlug);
}

/**
 * Собрать все допустимые алиасы slug для выпуска
 */
function rssBuildEpisodeAliases($canonicalSlug, $title, $linkSlug) {
    $aliases = [];
    $titleSlug = rssBuildEpisodeSlug($title, $linkSlug);

    foreach ([$canonicalSlug, $titleSlug, $linkSlug, slugify($title)] as $candidate) {
        $candidate = trim((string) $candidate);
        if ($candidate === '' || $candidate === $canonicalSlug) {
            continue;
        }

        $aliases[$candidate] = true;
    }

    return array_keys($aliases);
}

/**
 * Получить эпизоды подкаста из RSS с файловым кэшем.
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
        $externalUrl = trim((string)$item->link);
        $linkSlug = rssExtractLinkSlug($externalUrl);
        $pageSlug = rssResolvePageSlug($categoryKey, (string) $item->title, $linkSlug);
        $image = trim((string) ($itunes->image['href'] ?? ''));
        $episodeType = trim((string) $itunes->episodeType);
        $aliases = rssBuildEpisodeAliases($pageSlug, (string) $item->title, $linkSlug);
        $embedUrl = buildMaveEmbedUrl($categoryKey, $linkSlug);

        $episodes[] = [
            'id'          => $categoryKey . '/' . $pageSlug,
            'category'    => $categoryKey,
            'slug'        => $pageSlug,
            'linkSlug'    => $linkSlug,
            'aliases'     => $aliases,
            'title'       => trim((string)$item->title),
            'description' => $description,
            'publishDate' => $date,
            'duration'    => rssFormatDuration((string)$itunes->duration),
            'audioFile'   => $audioFile,
            'image'       => $image,
            'episodeType' => $episodeType,
            'embedUrl'    => $embedUrl,
            'platforms'   => [],
            'pageUrl'     => '/' . $categoryKey . '/' . $pageSlug . '/',
            'externalUrl' => $externalUrl,
        ];
    }

    return $episodes;
}

/**
 * Получить эпизоды категории из RSS-ленты, описанной в конфиге
 */
function getRssEpisodesByCategory($categoryKey, $ttl = 60) {
    global $SITE_CONFIG;

    $category = $SITE_CONFIG['categories'][$categoryKey] ?? null;
    if (!$category || empty($category['rssUrl'])) {
        return [];
    }

    $cacheKey = $category['slug'] ?? $categoryKey;

    return fetchRssEpisodes($category['rssUrl'], $cacheKey, $categoryKey, $ttl);
}

/**
 * Найти выпуск по внутреннему slug либо по Mave slug вида ep-3
 */
function getRssEpisodeBySlug($categoryKey, $slug, $ttl = 60) {
    $episodes = getRssEpisodesByCategory($categoryKey, $ttl);

    foreach ($episodes as $episode) {
        $aliases = $episode['aliases'] ?? [];
        if (($episode['slug'] ?? '') === $slug || ($episode['linkSlug'] ?? '') === $slug || in_array($slug, $aliases, true)) {
            return $episode;
        }
    }

    return null;
}

/**
 * Получить похожие выпуски в рамках той же RSS-рубрики
 */
function getRssRelatedEpisodes($categoryKey, $currentSlug, $limit = 3, $ttl = 60) {
    $episodes = array_filter(
        getRssEpisodesByCategory($categoryKey, $ttl),
        function ($episode) use ($currentSlug) {
            return ($episode['slug'] ?? '') !== $currentSlug
                && ($episode['linkSlug'] ?? '') !== $currentSlug;
        }
    );

    return array_slice(array_values($episodes), 0, $limit);
}

/**
 * Получить все RSS-выпуски со всех активных категорий
 */
function getAllRssEpisodes($ttl = 60) {
    global $SITE_CONFIG;

    $allEpisodes = [];

    foreach ($SITE_CONFIG['categories'] as $categoryKey => $category) {
        if (!empty($category['disabled']) || empty($category['rssUrl'])) {
            continue;
        }

        $allEpisodes = array_merge($allEpisodes, getRssEpisodesByCategory($categoryKey, $ttl));
    }

    usort($allEpisodes, function ($a, $b) {
        return strtotime($b['publishDate']) - strtotime($a['publishDate']);
    });

    return $allEpisodes;
}
