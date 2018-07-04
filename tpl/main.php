<?php
/**
 *
 *
 * $items
 * $domain
 * $time
 */
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Cache-Control" content="no-store" />
	<meta name="robots" content="nofollow" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Overwatch - сканер досок объявлений</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="mizon"></div>
<main>

    <?php if(!empty($message)): ?>
    <div class="message">
        <?= $message ?>
    </div>
    <?php endif; ?>
    <div class="list">

        <div class="items">
	        <?php foreach($items as $item): ?>
                <div class="item <?= $item['domain'] ?>">
                    <div data-timestamp="<?= $item['published']  ?>" class="time"></div>
                    <a target="_blank" href="<?= $item['url']  ?>" class="title"><?= $item['title']  ?></a>
                </div>
	        <?php endforeach; ?>
        </div>

    </div>

</main>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script src="js/overwatch.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>



</body>
</html>