# Russian Validators

## Описание

Пакет предназначен для валидации различных идентификаторов, принятых в РФ - СНИЛС, ИНН, ОГРН/ОГРНИП и КПП, поскольку
"международные" валидаторы (напр., из пакета Symfony) не учитывают их отдельно от VAT и прочих международных
аналогов

В описании каждого класса валидатора приведена ссылка на Википедию и, по возможности, на соответствующий закон
Правительства, поясняющий, почему тот или иной идентификатор валидируется именно так

## Установка с помощью composer

```
composer install letraceursnork/russian-validators
```

## Требования

Пакет требует всего двух пунктов:

1. PHP 8.0+
2. Установленную и подключенную библиотеку `BCMath` (`ext-bcmath`)

## Пример использования

```php
use LTS\RussianValidators\InnValidator;
//use LTS\RussianValidators\KppValidator;
//use LTS\RussianValidators\OgrnipValidator;
//use LTS\RussianValidators\OgrnValidator;
//use LTS\RussianValidators\SnilsValidator;

$value = '<SOME_INN>';
$validator = new InnValidator(); // или любой другой класс валидатора из перечисленных выше

$validator->setPurifyPattern('[-+\/\*\\_\.,\s]'); // установить $pattern для функции preg_replace. Все символы, попадающие под $pattern будут удалены из строки перед валидацией. Позволяет очистить строку от разделителей - $pattern по-умолчанию `[-+\/\*\\_\.,\s]`

$is_valid  = $validator->validate($value); // true|false

$validator->throwErrorOnInvalid(); // При неудачной валидации не возвращает false, а выбрасывает исключение типа InvalidArgumentException
try {
    $is_valid = $validator->validate($value); // true, если валидация успешна
} catch(InvalidArgumentException $exception) {
    // Обработка исключения
}
```
