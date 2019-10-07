# PHP Template Class

A simple PHP class for managing HTML templates.


## Basic Usage

Recently refactored the whole class, this documentation is a work in progress.


## Methods


### template::__construct

#### Description

    template::__construct ( string $parent [, string $path = FALSE ] [, string $format = FALSE ] ) : null

When a new instance of the **Template()** class is created, the constructor method defines the parent template, the path to the directory where the templates are located, and the file type of the templates.


#### Parameters

1. **parent**

   The filename of the parent (master) template without a file extension.

2. **path** *optional*

   The absolute path to the directory containing template files.

3. **format** *optional*

   The file extension of the template files. The default value of this parameter is `.html`.


#### Examples
```php

// set the parent template to "master.html"
$template = new Template('master');

// set the parent template
// to "../templates/master.html"
$template = new Template('master', '../templates/');

// set the parent template
// to "../templates/master.tpl"
$template = new Template('master', '../templates/', '.tpl');

```
---


### template::child

#### Description

    template::child ( string $child, string $tag ) : null

The **child()** method defines a child template's filename and the name of its placeholder tag in the parent template. The path to the child template and the child template's file type are inherited from the Template constructor method.


#### Parameters

1. **child**

   The filename of the child (embedded) template without a file extension.

2. **tag**

   The name of the child template's placeholder tag in the parent template.


#### Examples
```php

// add a child template
$template->child('login', 'login_form');

```
---


### template::set

#### Description

    template::set ( string $tag, string $value [, string $child = FALSE ] ) : null

The **set()** method assigns a value to a template placeholder tag in the parent template or in a child template.


#### Parameters

1. **tag**

   The name of a template placeholder tag.

2. **value**

   The value of a template placeholder tag.

3. **child** *optional*

   The name of the child template that contains the template placeholder tag. If not defined, the **set()** method assumes the placeholder tag is located in the parent template. 


#### Examples
```php

$template->set('h1_tag', 'This is a headline in the parent template.');

$template->set('intro', 'This is a paragraph in a child template.', 'about-us');

```
---


### template::push

#### Description

    template::push ( bool $exit = TRUE ) : string

The **push()** method compiles all the template files and placeholder tag values, then publishes the template as a string of HTML. This method will also terminate the PHP script by default unless the **exit** parameter is set to `false`.


#### Parameters

1. **exit** *optional*

   When called, the **push()** method will terminate the current PHP script unless the **exit** parameter is set to `false`.


#### Return Values

The **push()** method does not actually `return;` a value. Instead, it outputs a string of HTML directly to the PHP script in which it was called.


#### Examples
```php

// publish the template and terminate the PHP script
$template->push();

// publish the template, but do not terminate the PHP script
$template->push(false);

```
