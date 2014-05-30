<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><? echo $site_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Open Parser - Galaxy Parser for all Starfleet Commander and Stardrift Empires Universes">
    <meta name="author" content="Matt Hirschfelt">
    <!-- Le styles -->
    <link href="./assets/css/<?php echo $bootstrap ?>.css" rel="stylesheet">
	<?php if ($is_uni === 'null'){ echo'
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>';} ?>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="./assets/ico/favicon.ico">
	

  </head>
  <body>