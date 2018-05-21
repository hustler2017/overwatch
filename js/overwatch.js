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
                    $('ul.list li').removeClass('new');

                    var $data = $(response.data);
                    $data.addClass('new');
                    $data.prependTo('ul.list');
                }

            }
        },'json');
    }, 30000);



})(jQuery);