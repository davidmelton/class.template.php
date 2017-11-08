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

### Create a global HTML template file.


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

Notice the placeholders `<!--{title}-->`, `<!--{description}-->`, and `<!--{content}-->`. You will use these later to insert your own content into the page.


### Create a home page that includes your master template.


Now you need to add some code to your `index.php` file to include the template class, the master template, and your own content.


```php
<?php

require 'classes/class.template.php';

$template = new Template;


```