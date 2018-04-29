<?php





if(isset($_REQUEST['update'])){

    switch($_REQUEST['update']){
        case 'weblancer-page1':
	        $c = file_get_contents('https://www.weblancer.net/jobs/');
	        $c = iconv ('windows-1251', 'utf-8', $c);
            break;
        case 'weblancer-page2':
	        $c = file_get_contents('https://www.weblancer.net/jobs/?page=2');
	        $c = iconv ('windows-1251', 'utf-8', $c);
	        break;
	    case 'weblancer-page3':
		    $c = file_get_contents('https://www.weblancer.net/jobs/?page=3');
		    $c = iconv ('windows-1251', 'utf-8', $c);
		    break;
    }

    echo $c;
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <style>
        ul{
            list-style: none;
        }
        li{
            display: block;
            border-radius: 3px;
            padding: 4px;
            background-color: #f99b3a;
            transition: all 10s ease;
            color: black;
            margin-bottom: 1px;
        }
        li a{
            text-decoration: none;
            color: black;
            font-weight:500;
            font-size:15px;
            font-family: "Segoe UI";
        }
        li.new{
            background-color: rgba(34, 156, 156, 0.21176470588235294);
            transition: all 15s ease;
        }
        .cols{
            display: flex;
        }
        .cols > *{
            flex-grow: 1;
            border-radius: 10px;
            border: 1px solid #1876b8;
            margin: 10px;
            overflow: hidden;
        }
        .weblancer .content{
            height: 500px;
            overflow-y: scroll;
        }
        .head{
            height: 30px;
            color: white;
            background-color: #1876b8;
            text-align: center;
            padding-top: 4px;
        }
    </style>
</head>
<body>

<div class="cols">
    <div class="weblancer">
        <div class="head">
            WebLancer
        </div>
        <div class="content">
            <ul class="list">

            </ul>
        </div>
    </div>
    <div class="freelancehunt">
        <div class="head">
            freelancehunt
        </div>
        <div class="content">
            <ul class="list">

            </ul>
        </div>
    </div>

</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>
<script>

    var items = [];

    var quiue = {
        step: 0,
        links: [
            {url: 'weblancer-page1', handler: 'weblancer'},
            {url: 'weblancer-page2', handler: 'weblancer'},
            {url: 'weblancer-page3', handler: 'weblancer'},


    ]};

    var audio = new Audio();
    audio.src = 'Sound_18678.mp3';





    function weblancerHandler(url)
    {
        $.post('index.php',{update:url},function(response){

            var page = document.createElement('div');
            page.innerHTML = response;
            var cols = $(page).find('h2 > a.text-bold.show_visited');
            var $list = $('.weblancer .list');
            var hasNewItems = false;
            $.each(cols, function(index, elem){

                var link = $(elem).attr('href');
                var link = 'https://www.weblancer.net'+link;
                $(elem).attr('href', link);
                $(elem).attr('target',"_blank");
                var sNum = link.substr(-7,6);
                var id = Number(sNum);

                if(items[id] === undefined) {
                    var desc = $(elem).closest('.row').find('p.text_field').html();
                    var time_ago = $(elem).closest('.row').find('span.time_ago').html();
                    var li = document.createElement('li');
                    li.appendChild(elem);
                    $(li).append("<div class=\"time_ago\">"+time_ago+"</div>");
                    $(li).append("<div class=\"desc\">"+desc+"</div>");
                    $(li).addClass('new');
                    $(li).prependTo($list);
                    items[id] = li;
                    hasNewItems = true;
                }
            });

            if(hasNewItems){
                audio.play();
            }

            page.innerHTML = '';
        });
    }

    function checkUpdate(param)
    {
        $.each(items, function(ind, elem){
            $(elem).closest('li').removeClass('new');
        });

        switch(param.handler)
        {
            case 'weblancer':
                weblancerHandler(param.url);
                break;
        }


    }


    function update(){
        if(quiue.step >= quiue.links.length)
            quiue.step = 0;
        checkUpdate(quiue.links[quiue.step++]);
    }

    $(document).ready(function(){
        setInterval(update,10000);
        //setTimeout(update,10);
    });
</script>
</body>
</html>