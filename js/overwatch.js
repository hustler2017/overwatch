var audio = new Audio();
audio.src = 'Sound_11500.wav';

(function($){

    var old = new Array();

    setInterval(updateTasks, 15000);

    function div(val, by){
        return (val - val % by) / by;
    }

    function timePassed(seconds){

        let timestring = '';

        let days = div(seconds, 60 * 60 * 24);
        if(days){
            timestring += days + " дней назад";
            return timestring;
        }

        let hs = div(seconds , 60 * 60);
        if(hs){
            timestring += hs + " часов назад";
            return timestring;
        }

        let mins = div(seconds , 60);
        if(mins){
            timestring += mins + " минут назад";
            return timestring;
        }

        timestring = seconds + " секунд назад";
        return timestring;
    }

    $('#sound').click(function(){
        if(player.isMuted()){
            player.unMute();
            $(this).addClass('on');
        } else {
            player.mute();
            $(this).removeClass('on');
        }
    });


    function updateTasks(){
        $.post('ajax.php',{},function(response){
            if(response instanceof Object) {
                if(response.error){
                    console.log(response.error);
                    return;
                }
                if(response.tasks){
                    let data = response.tasks;
                    let layout = '';

                    old = [];
                    $('.item').each(function(){
                        $(this).removeClass('new');
                        old.push($(this).find('a').attr('href'));
                    });

                    let newItems = false;
                    for(let i = 0; i < data.length; i++){


                        let is_new =  isNew(data[i]);
                        if( is_new ) {
                            newItems = true;
                        }

                        layout += '<div class="item ' + data[i].domain + ( is_new ? ' new' : '' ) +
                            '"><div data-timestamp="' + data[i].published +
                            '" class="time">' + timePassed(   div(Date.now() / 1000)  - data[i].published ) + '</div><a target="_blank" href="' + data[i].url +
                            '" class="title">' + data[i].title + '</a></div>';
                    }
                    if(newItems) audio.play();
                    $('.items').html(layout);
                }

            }
            updateTime();
        },'json');
    }

    function updateTime(){
        $('[data-timestamp]').each(function(){
            let ts = Number($(this).attr('data-timestamp'));
            let timeLabel = timePassed(  div(Date.now(),  1000) - ts );
            $(this).html(timeLabel);
        });
    }

    function isNew(item) {
        return old.indexOf(item.url) == -1;
    }

    $(document).ready(function(){
        updateTime();
    });

})(jQuery);


var player;
function onPlayerReady(event) {
    player.playVideo();
}
function onYouTubeIframeAPIReady() {
    player = new YT.Player('mizon', {
        height: '0',
        width: '0',
        videoId: 'Sw_pL1met_Q',
        events: {
            'onReady': onPlayerReady,
            'onStateChange': ''
        }
    });
}