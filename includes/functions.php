<?php
/**
 * Вспомогательные функции
 */

/**
 * Безопасный вывод HTML
 */
function e($string) {
    if (is_array($string)) {
        return '';
    }
    return htmlspecialchars((string) $string, ENT_QUOTES, 'UTF-8');
}

/**
 * Форматирование даты на русском
 */
function formatDate($date) {
    $months = [
        1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
        5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
        9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря'
    ];

    $timestamp = strtotime($date);
    $day = date('j', $timestamp);
    $month = $months[(int)date('n', $timestamp)];
    $year = date('Y', $timestamp);

    return "$day $month $year";
}

/**
 * Склонение слова "запись"
 */
function pluralRecords($count) {
    $count = abs($count) % 100;
    $lastDigit = $count % 10;

    if ($count >= 11 && $count <= 19) {
        return 'записей';
    }
    if ($lastDigit === 1) {
        return 'запись';
    }
    if ($lastDigit >= 2 && $lastDigit <= 4) {
        return 'записи';
    }
    return 'записей';
}

/**
 * Получить полный заголовок страницы
 */
function getPageTitle($title = null) {
    global $SITE_CONFIG;
    if ($title === null || $title === $SITE_CONFIG['title']) {
        return $SITE_CONFIG['title'];
    }
    if (strpos($title, $SITE_CONFIG['title']) !== false) {
        return $title;
    }
    return $title . ' - ' . $SITE_CONFIG['title'];
}

/**
 * Отрисовка карточки аудио
 */
function renderAudioCard($audio) {
    global $CATEGORY_BADGE_COLORS, $CATEGORY_LABELS;

    $id = $audio['id'];
    $slug = e(basename($id));
    $title = e($audio['title']);
    $description = e($audio['description']);
    $category = e($audio['category']);
    $duration = e($audio['duration']);
    $audioFile = e($audio['audioFile']);
    $tags = $audio['tags'] ?? [];
    $audioUrl = "/{$category}/{$slug}.php";

    $badgeColor = $CATEGORY_BADGE_COLORS[$category] ?? '';
    $categoryLabel = $CATEGORY_LABELS[$category] ?? '';

    $tagsHtml = '';
    if (!empty($tags)) {
        $tagsHtml = '<div class="flex flex-wrap gap-2 mb-6">';
        foreach (array_slice($tags, 0, 3) as $tag) {
            $tagsHtml .= '<span class="text-xs px-3 py-1.5 bg-slate-100 text-slate-600 rounded-md">#' . e($tag) . '</span>';
        }
        $tagsHtml .= '</div>';
    }

    return <<<HTML
<article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-200" data-category="{$category}">
  <div class="p-7 md:p-8">
    <div class="flex items-start justify-between mb-4">
      <span class="text-xs font-semibold px-4 py-2 rounded-full border {$badgeColor}">
        {$categoryLabel}
      </span>
      <span class="text-sm text-slate-500 font-medium">{$duration}</span>
    </div>

    <h3 class="text-xl md:text-2xl font-bold text-slate-900 mb-3 line-clamp-2 break-words">
      <a href="{$audioUrl}" class="hover:text-slate-600 transition-colors">
        {$title}
      </a>
    </h3>

    <p class="text-slate-600 text-base leading-relaxed mb-5 line-clamp-2 break-words">
      {$description}
    </p>

    {$tagsHtml}

    <div class="flex gap-3">
      <a
        href="{$audioUrl}"
        class="flex-1 px-5 py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition-colors text-center"
      >
        Прослушать
      </a>
      <a
        href="{$audioFile}"
        download
        class="px-5 py-3 border-2 border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-700 text-sm font-medium rounded-xl transition-colors"
        aria-label="Скачать"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
      </a>
    </div>
  </div>
</article>
HTML;
}

/**
 * Отрисовка аудиоплеера
 */
function renderAudioPlayer($audio) {
    $audioFile = e($audio['audioFile']);
    $audioId = e($audio['id']);

    return <<<HTML
<div class="bg-gradient-to-r from-slate-50 to-slate-100 rounded-xl p-6 audio-player-container" data-audio-id="{$audioId}">
  <audio controls class="w-full mb-4 audio-player" preload="metadata">
    <source src="{$audioFile}" type="audio/mpeg" />
    Ваш браузер не поддерживает аудио.
  </audio>

  <div class="flex gap-3 flex-wrap">
    <button
      type="button"
      class="play-pause-btn px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-lg transition-colors flex items-center gap-2"
      aria-label="Воспроизвести / Пауза"
    >
      <svg class="play-icon w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
      </svg>
      <svg class="pause-icon w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20">
        <path d="M5.5 3.5A1.5 1.5 0 017 2h1a1.5 1.5 0 011.5 1.5v13A1.5 1.5 0 018 18H7a1.5 1.5 0 01-1.5-1.5v-13zm7 0A1.5 1.5 0 0114 2h1a1.5 1.5 0 011.5 1.5v13A1.5 1.5 0 0115 18h-1a1.5 1.5 0 01-1.5-1.5v-13z"></path>
      </svg>
      <span class="play-pause-text">Воспроизвести</span>
    </button>

    <button
      type="button"
      class="skip-back-btn px-4 py-3 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold rounded-lg transition-colors flex items-center gap-2"
      aria-label="Назад на 10 секунд"
      title="Назад на 10 секунд"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z"></path>
      </svg>
      <span class="text-sm">-10с</span>
    </button>

    <button
      type="button"
      class="skip-forward-btn px-4 py-3 bg-slate-200 hover:bg-slate-300 text-slate-900 font-semibold rounded-lg transition-colors flex items-center gap-2"
      aria-label="Вперёд на 10 секунд"
      title="Вперёд на 10 секунд"
    >
      <span class="text-sm">+10с</span>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.933 12.8a1 1 0 000-1.6L6.6 7.2A1 1 0 005 8v8a1 1 0 001.6.8l5.333-4zM19.933 12.8a1 1 0 000-1.6l-5.333-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.333-4z"></path>
      </svg>
    </button>

    <a
      href="{$audioFile}"
      download
      class="px-6 py-3 border-2 border-slate-900 hover:bg-slate-900 hover:text-white text-slate-900 font-semibold rounded-lg transition-colors flex items-center gap-2"
      aria-label="Скачать аудио"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
      </svg>
      Скачать
    </a>
  </div>
</div>
HTML;
}

/**
 * Отрисовка хлебных крошек
 */
function renderBreadcrumbs($items) {
    $html = '<nav aria-label="Breadcrumb" class="mb-8">
  <ol class="flex items-center gap-2 text-sm flex-wrap">
    <li class="flex items-center">
      <a href="/" class="flex items-center gap-1 text-slate-600 hover:text-slate-900 transition-colors" aria-label="Главная">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        <span>Главная</span>
      </a>
    </li>';

    $count = count($items);
    foreach ($items as $index => $item) {
        $isLast = $index === $count - 1;
        $label = e($item['label']);

        $html .= '<li class="flex items-center gap-2">
      <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>';

        if ($isLast || empty($item['href'])) {
            $html .= '<span class="text-slate-900 font-medium"' . ($isLast ? ' aria-current="page"' : '') . '>' . $label . '</span>';
        } else {
            $href = e($item['href']);
            $html .= '<a href="' . $href . '" class="text-slate-600 hover:text-slate-900 transition-colors">' . $label . '</a>';
        }

        $html .= '</li>';
    }

    $html .= '</ol></nav>';

    return $html;
}
