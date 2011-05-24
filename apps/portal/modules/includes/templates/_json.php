<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>JSON response</title>
<link rel="shortcut icon" href="/favicon.ico" />
<script language="JavaScript" type="text/javascript" src="<?php echo javascript_path('/sf/sf_web_debug/js/main.js') ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo stylesheet_path('/sf/sf_web_debug/css/main.css') ?>" />
</head>
<body>
json:<br>
<?php echo json_encode($sf_data->getRaw('data')); ?>
<br>
data structure:<br>
<pre>
<?php print_r($sf_data->getRaw('data')); ?>
</pre>
