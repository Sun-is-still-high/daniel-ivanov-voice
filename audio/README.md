# Аудиофайлы

Эта папка содержит все MP3 файлы для сайта.

## Структура

```
audio/
├── mindfulness/    # Медитации осознанности
├── thoughts/       # Мысли вслух
└── podcast/        # Психопогромизм
```

## Требования к аудиофайлам

### Формат
- Формат: MP3
- Битрейт: 128-192 kbps (для голосового контента)
- Sample Rate: 44.1 kHz

### Именование
Используйте kebab-case (строчные буквы, слова через дефис):
- ✅ `breathing-meditation.mp3`
- ✅ `episode-01-imposter-syndrome.mp3`
- ❌ `Breathing Meditation.mp3`
- ❌ `EPISODE_01.mp3`

### ID3 теги (метаданные)

Каждый MP3 файл должен содержать корректные ID3 теги:

```
Title: Название аудио
Artist: Даниил Иванов
Album: Название категории или подкаста
Genre: Spoken Word / Podcast / Meditation
Year: 2026
```

Для редактирования ID3 тегов можно использовать:
- [Mp3tag](https://www.mp3tag.de/) (Windows/Mac)
- [Kid3](https://kid3.kde.org/) (Linux/Mac/Windows)
- [MusicBrainz Picard](https://picard.musicbrainz.org/)

## Добавление нового аудио

1. Поместите MP3 файл в соответствующую категорию
2. Создайте JSON файл в `src/content/audio/` с тем же именем
3. Убедитесь, что путь в JSON совпадает с реальным путём к файлу

Пример:
- Файл: `public/audio/mindfulness/breathing-meditation.mp3`
- JSON: `src/content/audio/breathing-meditation.json`
- В JSON: `"audioFile": "/audio/mindfulness/breathing-meditation.mp3"`
