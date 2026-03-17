<?php
// Генерация sitemap для эпизодов
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/rss.php';

header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach (getAllRssEpisodes() as $audio): ?>
    <url>
        <loc>https://daniel-ivanov-voice.ru<?= e($audio['pageUrl']) ?></loc>
        <lastmod><?= $audio['publishDate'] ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
<?php endforeach; ?>
</urlset>
