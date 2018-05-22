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



})(jQuery);