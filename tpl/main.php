<?php
/**
 * Created by Averin Ilya.
 * Date: 22.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
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
	<title>Bootstrap 101 Template</title>

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

	<div class="humster">
		<img src="http://www.neizvestniy-geniy.ru/images/works/photo/2012/05/615491_1.gif" alt="танцующий хомяк">
        <div id="sound" class="sound on"></div>
	</div>


    <div class="list">
        <div class="header">

            <div class="rialto weblancer">
                <a target="_blank" href="https://www.weblancer.net/">Weblancer.net</a>
            </div>

            <div class="rialto freelancim">
                <a target="_blank" href="https://freelansim.ru/">freelancim.ru</a>
            </div>

            <div class="rialto freelancehunt">
                <a target="_blank" href="https://freelancehunt.com/">freelancehunt.ru</a>
            </div>

            <div class="rialto freelance">
                <a target="_blank" href="https://freelance.ru/">freelance.ru</a>
            </div>

            <div class="rialto fl">
                <a target="_blank" href="https://www.fl.ru/">fl.ru</a>
            </div>

        </div>

        <div class="items">
			<?= $items ?>
        </div>

    </div>

</main>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script>
    var server = "<?= $domain ?>";
    var timestamp = <?= $time ?>;
    var time_offset = Date.now() / 1000 - timestamp;
</script>

<script src="js/overwatch.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>



</body>
</html>