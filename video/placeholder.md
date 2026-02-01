# Временное решение без видео

Если у вас пока нет видео-приветствий, есть несколько вариантов:

## Вариант 1: Скрыть видео до добавления

Отредактируйте `src/pages/category/[category].astro` и закомментируйте блок видео:

```astro
<!-- Video Introduction -->
<!--
<div class="bg-slate-900 rounded-2xl overflow-hidden shadow-2xl mb-12">
  ...
</div>
-->
```

## Вариант 2: Создать простое видео-заглушку

Используйте FFmpeg для создания простого видео с текстом:

```bash
# Создать 10-секундное видео с текстом
ffmpeg -f lavfi -i color=c=white:s=1280x720:d=10 \
  -vf "drawtext=text='Приветственное видео скоро появится':fontsize=40:fontcolor=black:x=(w-text_w)/2:y=(h-text_h)/2" \
  -c:v libx264 -preset ultrafast intro.mp4
```

## Вариант 3: Использовать статичное изображение

Создайте изображение-заглушку и используйте его вместо видео:

```astro
<!-- Image placeholder instead of video -->
<div class="bg-gradient-to-r from-emerald-500 to-blue-500 rounded-2xl overflow-hidden shadow-2xl mb-12">
  <div class="aspect-video flex items-center justify-center">
    <div class="text-center text-white p-8">
      <h3 class="text-3xl font-bold mb-4">
        {categoryInfo.title}
      </h3>
      <p class="text-xl">
        Приветственное видео скоро появится
      </p>
    </div>
  </div>
</div>
```

## Рекомендация

Для production версии сайта рекомендуется создать настоящие видео-приветствия, так как они:
- Создают личный контакт с посетителями
- Объясняют суть каждой категории
- Повышают доверие к автору
- Делают сайт более живым и привлекательным
