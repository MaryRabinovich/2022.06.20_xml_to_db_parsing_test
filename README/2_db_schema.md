# Архитектура БД

## Анализ выгрузки

Файл представляет собой автомобильный каталог с офферами.

Все офферы снабжены однотипными наборами внутренных тегов, 
без внутренних свойств (проверяется поиском по знаку равенства).
Все внутренние теги офферов либо пустые, либо содержат значение,
дальнейшая вложенность отсутствует.

Внутренние теги офферов:

id, year, run, 
mark, model, generation, generation_id, 
color, transmission, body-type, engine-type, gear-type

## Нормализованная схема БД

Таблицы вида "id (автоинкрементный ключ), name (строка)":
colors, transmissions, body_types, engine_types, gear_types, marks.

Таблица models: 
id (автоинкрементный ключ), 
mark_id (внешний ключ), 
name (unique строка)

Таблица generations: 
id (берётся из выгрузки, int primary key), 
model_id (внешний ключ), 
name (строка)

Таблица cars:
id (берётся из выгрузки, int primary key),
год выпуска,
пробег,
color_id (здесь и ниже - внешние ключи),
transmission_id,
body_type_id,
engine_type_id,
gear_type_id,
generation_id