# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][keepachangelog] and this project adheres to [Semantic Versioning][semver].

---

## [v1.1.0](https://github.com/LeTraceurSnork/russian-validators/releases/tag/v1.1.0)

### Added

- Представлены валидаторы БИК, КС и КС с учётом БИК, написаны соответствующие тесты

### Fixed

- Добавлены PHPDoc-блоки для классов (включая `@coversDefaultClass` для тестов)
- Namespace тестов перемещён в секцию `autoload-dev` композера

## [v1.0.1](https://github.com/LeTraceurSnork/russian-validators/releases/tag/v1.0.1)

### Fixed

- Описание пакета в `composer.json` переведено на русский язык

## [v1.0.0](https://github.com/LeTraceurSnork/russian-validators/releases/tag/v1.0.0)

### Added

- Валидаторы ИНН, ОГРН/ОГРНИП, СНИЛС, КПП; все покрыты тестами
- Класс AbstractValidator и его интерфейс для возможности расширения функциональности

[keepachangelog]:https://keepachangelog.com/en/1.0.0/

[semver]:https://semver.org/spec/v2.0.0.html

[@saligzhanov.i]:https://gitlab.spectrumdata.tech/saligzhanov.i
