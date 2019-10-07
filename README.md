# PHP Template Class

A simple PHP class for managing HTML page templates.


## Basic Usage

Recently refactored the whole class, this documentation is work in progress.


## Methods

### template::__construct

#### Description

    template::__construct ( string $parent [, string $path = FALSE ] [, string $format = FALSE ] ) : null

#### Parameters

**parent**
: The filename of the parent (master) template without a file extension.

**path**
: The absolute path to the directory containing template files.

**format**
: The file extension of the template files. This default value of this parameter is `.html`.

#### Examples
```php
$template = new Template('master', '../templates/', '.tpl');
```
---

### template::set

#### Description

    template::set ( string $tag, string $value [, string $child = FALSE ] ) : null

#### Parameters

#### Examples
---

### template::child

#### Description

    template::child ( string $child, string $tag ) : null

#### Parameters

#### Examples
---

### template::push

#### Description

    template::push ( bool $exit = TRUE ) : string

#### Parameters

#### Return Values

#### Examples
