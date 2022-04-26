# Проект "Вычислитель отличий"
[![Actions Status](https://github.com/Maksyliator/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/Maksyliator/php-project-lvl2/actions) [![Difference calculator CI](https://github.com/Maksyliator/php-project-lvl2/actions/workflows/Difference_calculator.yml/badge.svg)](https://github.com/Maksyliator/php-project-lvl2/actions/workflows/Difference_calculator.yml) [![Maintainability](https://api.codeclimate.com/v1/badges/ad3efdd3f6bf33cb4b49/maintainability)](https://codeclimate.com/github/Maksyliator/php-project-lvl2/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/ad3efdd3f6bf33cb4b49/test_coverage)](https://codeclimate.com/github/Maksyliator/php-project-lvl2/test_coverage)

### Описание:
Вычислитель отличий – программа, определяющая разницу между двумя структурами данных. Это популярная задача,  
для решения которой существует множество онлайн-сервисов, например: [http://www.jsondiff.com/](http://www.jsondiff.com/). Подобный механизм используется  
при выводе тестов или при автоматическом отслеживании изменении в конфигурационных файлах.

Возможности утилиты:
+ Поддержка разных входных форматов: yaml и json
+ Генерация отчета в виде plain text, stylish и json

### Библиотека на packagist:
https://packagist.org/packages/maksyliator/difcalc

### Установка проекта:
```sh
$ git clone https://github.com/Maksyliator/php-project-lvl2.git
$ cd php-project-lvl2
$ make install
```



### Пример сравнения плоских файлов:
[![asciicast](https://asciinema.org/a/oL5bkXWFXB97ijVskiu4y3EMW.svg)](https://asciinema.org/a/oL5bkXWFXB97ijVskiu4y3EMW)

### Пример сравнения рекурсивной файловой структуры с использованием stylish formatter (формат по умолчанию):
[![asciicast](https://asciinema.org/a/YO6we0k2QQXs8odCT3eaGpQ7R.svg)](https://asciinema.org/a/YO6we0k2QQXs8odCT3eaGpQ7R)

### Пример сравнения рекурсивной файловой структуры с использованием stylish plain:
[![asciicast](https://asciinema.org/a/JzYfV4lPh5QtBd24FuWRPhf4G.svg)](https://asciinema.org/a/JzYfV4lPh5QtBd24FuWRPhf4G)

### Пример сравнения рекурсивной файловой структуры с использованием stylish json:
[![asciicast](https://asciinema.org/a/E6OIr4aCHkYa0Th1X6SaZbhwU.svg)](https://asciinema.org/a/E6OIr4aCHkYa0Th1X6SaZbhwU)
