# Daniel's Voice

Сайт с подкастом, медитациями и аудиозаписями.

## Как добавить новый выпуск подкаста

### Шаг 1. Получить iframe-код из Mave

После публикации выпуска на Mave, скопировать код плеера. Он выглядит так:

```html
<iframe src="https://player.mave.digital?podcast=rebel-psychology&episode=N&color=rgb(95,128,245)&mute=1&date=1&download=1" style="width: 100%" height="235" scrolling="no" frameborder="no"></iframe>
```

Где `N` — номер эпизода (1 = трейлер, 2 = пилот, 3 = третий выпуск и т.д.).

### Шаг 2. Придумать slug

Slug — это короткое латинское имя для URL. Примеры:

| Название выпуска | Slug |
|---|---|
| Трейлер | `trailer` |
| Пилот | `pilot` |
| Руководство пользователя биологической нейросети | `bio-neural-guide` |

Правила: только латиница, цифры и дефисы. Без пробелов и спецсимволов.

### Шаг 3. Добавить данные в `data/audio.php`

Открыть файл `data/audio.php` и добавить новый блок в массив `$AUDIO_DATA`.

Вставлять **после последнего эпизода подкаста** (после блока `'podcast/...'`), но **перед** блоком `'thoughts/...'`.

```php
'podcast/SLUG' => [
    'id' => 'podcast/SLUG',
    'title' => 'Название выпуска',
    'description' => 'Описание выпуска.',
    'category' => 'podcast',
    'duration' => 'MM:SS',
    'audioFile' => '',
    'publishDate' => 'ГГГГ-ММ-ДД',
    'platforms' => [],
    'embedPlayer' => '<iframe src="https://player.mave.digital?podcast=rebel-psychology&episode=N&color=rgb(95,128,245)&mute=1&date=1&download=1" style="width: 100%" height="235" scrolling="no" frameborder="no"></iframe>',
],
```

Что заменить:

- `SLUG` — slug из шага 2 (в двух местах: ключ массива и поле `id`)
- `Название выпуска` — заголовок
- `Описание выпуска` — краткое описание
- `MM:SS` — длительность (например `18:49`)
- `ГГГГ-ММ-ДД` — дата публикации (например `2026-02-16`)
- `episode=N` — номер эпизода в iframe

### Шаг 4. Создать страницу эпизода

1. Создать папку `podcast/SLUG/`
2. Скопировать в неё файл `podcast/bio-neural-guide/index.php`
3. Открыть скопированный файл и поменять **две вещи**:

**Строка 3** — комментарий (необязательно, для удобства):
```php
 * Эпизод: Название выпуска
```

**Строка 10** — ID эпизода (обязательно):
```php
$audioId = 'podcast/SLUG';
```

Всё остальное подтягивается автоматически из данных в `audio.php`.

### Шаг 5. Проверить

- `/podcast/` — новый выпуск должен появиться первым в списке
- `/podcast/SLUG/` — страница эпизода с mave-плеером

## Структура проекта

```
data/audio.php           — данные всех аудиозаписей
includes/config.php      — конфигурация сайта, ссылки на платформы
includes/functions.php   — функции отрисовки (карточки, плеер, хлебные крошки)
includes/header.php      — шапка сайта
includes/footer.php      — подвал сайта
podcast/                 — страницы подкаста
  index.php              — список всех выпусков
  trailer/index.php      — страница трейлера
  pilot/index.php        — страница пилота
  bio-neural-guide/      — страница третьего выпуска
mindfulness/             — страницы медитаций
thoughts/                — страницы "мыслей вслух"
```
