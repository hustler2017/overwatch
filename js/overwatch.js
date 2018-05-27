var audio = new Audio();
audio.src = 'Sound_11500.wav';

(function($){

    setInterval(function(){
        $.post(server,{timestamp: timestamp},function(response){
            if(response instanceof Object && response.ok) {
                if(response.data){
                    console.log(response.diag);
                    timestamp = response.time;
                    audio.play();
                    $('.list .item').removeClass('new');

                    var $data = $(response.data);
                    $data.addClass('new');
                    $data.prependTo('.items');
                }

            }
        },'json');
    }, 30000);

    function div(val, by){
        return (val - val % by) / by;
    }

    function timePassed(seconds){
        var timestring = '';

        var days = div(seconds, 60 * 60 * 24);
        if(days){
            timestring += days + " дней назад";
            return timestring;
        }

        var hs = div(seconds , 60 * 60);
        if(hs){
            timestring += hs + " часов назад";
            return timestring;
        }

        var mins = div(seconds , 60);
        if(mins){
            timestring += mins + " минут назад";
            return timestring;
        }

        timestring = seconds + " секунд назад";
        return timestring;
    }

    setInterval(function(){
        $('[data-timestamp]').each(function(){
            var ts = $(this).attr('data-timestamp');
            if(ts == '') return;

            var timeLabel = timePassed(  div(Date.now(),  1000)- Math.floor(time_offset) - ts );
            $(this).html(timeLabel);

        });
    },60000);


    $('#sound').click(function(){
        if(player.isMuted()){
            player.unMute();
            $(this).addClass('on');
        } else {
            player.mute();
            $(this).removeClass('on');
        }
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