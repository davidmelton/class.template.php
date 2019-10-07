# PHP Template Class

A simple PHP class for managing HTML page templates.

## Basic Usage

Recently refactored the whole class, this documentation is work in progress.


## Methods


### template::__construct

#### Desctiption

    template::__construct ( string $parent [, string $path = FALSE ] [, string $format = FALSE ] ) : null



#### Parameters

#### Return Values

#### Examples


### template::set

#### Desctiption

    template::set ( string $tag, string $value [, string $child = FALSE ] ) : null



#### Parameters

#### Return Values

#### Examples


### template::child

#### Desctiption

    template::child ( string $child, string $tag ) : null



#### Parameters

#### Return Values

#### Examples


### template::push

#### Desctiption

    template::push ( bool $exit = TRUE ) : string



#### Parameters

#### Return Values

#### Examples
