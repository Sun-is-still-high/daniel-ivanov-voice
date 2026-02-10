<?php
// Генерация sitemap для эпизодов
require_once __DIR__ . '/data/audio.php';

header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach (getAllAudio() as $audio): ?>
    <url>
        <loc>https://daniel-ivanov-voice.ru/<?= $audio['category'] ?>/<?= basename($audio['id']) ?>/</loc>
        <lastmod><?= $audio['publishDate'] ?></lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
<?php endforeach; ?>
</urlset>