# PHP Template Class

A simple PHP class for managing web page templates.

## Basic Usage

To demonstrate how the class works, create a folder for your project using a file structure similar to the following:

```text
.
└── html				# Document root folder
    ├── index.php			# Home page
    ├── classes				# PHP classes folder
    │   └── class.template.php		# This template class file
    ├── templates			# HTML templates folder
    │   └── master.php			# A global HTML template
    └── ...
```

### Your Global Template

First, create a basic HTML template called `master.php`. This file contains the markup for common elements that will appear on every page of your web site like a `<header>` and a `<footer>`.

```html
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<title><!--{title}--></title>
		<meta name="description" content="<!--{description}-->">
	</head>

	<body>
		<header>
			<h1>Example Website</h1>
		</header>
		
		<main>
		<!--{content}-->
		</main>
		
		<footer>
			<p>Copyright Information</p>
		</footer>
	</body>
</html>
```

Notice the placeholders `<!--{title}-->`, `<!--{description}-->`, and `<!--{content}-->`. You will use these later to insert your own content into your home page.

### Your Home Page

Now you need to add some code to your `index.php` file to include the template class, the master template, and your own content.

```php
<?php

require_once 'classes/class.template.php';

$template = new Template('master', 'templates/');

$template->publish();
```

The [`require_once`](http://php.net/manual/en/function.require-once.php) function includes the `class.template.php` file from the `classes` folder. With the class now included, a new instance of the `Template` object is stored in the `$template` variable.

`Template` accepts two arguments. The first argument is the name of your global template file. In this case "master" refers to `master.php` which you created earlier. The second argument is the path to your templates directory. This will tell `Template` where to find all of your web page templates.

The `publish()` method of the `Template` object will output the contents of the `master.php` template to your browser. If you open `index.php` in your browser and view the source code of the page you should see the following HTML code from `master.php`.

```html
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<title></title>
		<meta name="description" content="">
	</head>
	<body>
		<header>
			<h1>Example Website</h1>
		</header>
		
		<main>
		
		</main>
		
		<footer>
			<p>Copyright Information</p>
		</footer>
	</body>
</html>
```

> **Q:** Where did those template placeholders go?

> **A:** The Template class removes any unused placeholders from the final output. Don't worry, once you define what goes into those placeholders they will reappear.

### Using Placeholders

Return to the `index.php` file and add three new lines of code to put content into your template placeholders.

```php
<?php

require_once 'classes/class.template.php';

$template = new Template('master', 'templates/');

$template->set('title', 'Example Website Title');
$template->set('description', 'This is the description of the Example Website.');
$template->set('content', '<p>Here is some page content.</p>'); // you can include html tags

$template->publish();
```

The `set()` method of `Template` accepts two arguments. The first argument is the name of the placeholder that you want to modify. The second argumant is the content that you want to put into the placeholder.

If you open `index.php` again in your browser and view the source code of the page you should see the following HTML code:

```html

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
		<title>Example Website Title</title>
		<meta name="description" content="This is the description of the Example Website.">
	</head>
	<body>
		<header>
			<h1>Example Website</h1>
		</header>
		
		<main>
		<p>Here is some page content.</p>
		</main>
		
		<footer>
			<p>Copyright Information</p>
		</footer>
	</body>
</html>
```