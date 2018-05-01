var audio = new Audio();
audio.src = 'Sound_18678.mp3';

(function($){

    var items = [];
    var quiue = [
        'https://www.weblancer.net/jobs/',
        'https://www.weblancer.net/jobs/?page=2',
        'https://www.weblancer.net/jobs/?page=3'
    ];
    var current = 0;
    var classname = 'weblancer';

    var container = null;
    //var server = 'http://localhost';
    var server = 'http://overwatch.onequiz.ru';

    function next()
    {
        if(current >= quiue.length)
            current = 0;

        if(quiue[current] === undefined)
            return false;

        return quiue[current++];
    }


    function update(list)
    {
        var newItems = false;
        $.each(list, function(index, el){
            if(items[el.id] === undefined){
                items[el.id] = $("<li class='"+classname+" new' data-id='"+el.id+"'><div class='title'><a href='"+
                    el.href+"' target='_blank'>"+el.title+"</a></div><div class='description'>"+
                    el.description+"</div><div class='time'>"+
                    el.time+"</div></li>");
                items[el.id].prependTo(container);
                newItems = true;
            }
        });

        if(newItems) audio.play();
    }

    $.fn.overwatchWeblancer = function(){

        container = this;

        setInterval(function(){

            var url = next();
            if(url === false)
                return;


            $.each(items, function(index, el){
                $(el).removeClass('new');
            });

            $.post(server,{update:classname, url: url},function(response){
                if(response instanceof Object && response.ok) {
                    update(response.list);
                }
            },'json');


        },15000);



    }
})(jQuery);


(function($){

    var items = [];
    var quiue = [
        'https://freelancehunt.com/projects',
    ];
    var current = 0;
    var classname = 'freelancehunt';

    var container = null;
    //var server = 'http://localhost';
    var server = 'http://overwatch.onequiz.ru';

    function next()
    {
        if(current >= quiue.length)
            current = 0;

        if(quiue[current] === undefined)
            return false;

        return quiue[current++];
    }


    function update(list)
    {
        var newItems = false;
        $.each(list, function(index, el){
            if(items[el.id] === undefined){
                items[el.id] = $("<li class='"+classname+" new' data-id='"+el.id+"'><div class='title'><a href='"+
                    el.href+"' target='_blank'>"+el.title+"</a></div><div class='description'>"+
                    el.description+"</div><div class='time'>"+
                    el.time+"</div></li>");
                items[el.id].prependTo(container);
                newItems = true;
            }
        });

        if(newItems) audio.play();
    }

    $.fn.overwatchFreelancehunt = function(){

        container = this;

        setInterval(function(){

            var url = next();
            if(url === false)
                return;

            $.each(items, function(index, el){
                $(el).removeClass('new');
            });

            $.post(server,{update:classname, url: url},function(response){
                if(response instanceof Object && response.ok) {
                    update(response.list);
                }
            },'json');


        },18000);



    }
})(jQuery);




(function($){

    var items = [];
    var quiue = [
        'https://freelansim.ru/tasks?categories=web_all_inclusive%2Cweb_design%2Cweb_html%2Cweb_programming%2Cweb_prototyping%2Cweb_test%2Cweb_other%2Cmobile_ios%2Cmobile_android%2Cmobile_wp%2Cmobile_bada%2Cmobile_blackberry%2Cmobile_design%2Cmobile_programming%2Cmobile_prototyping%2Cmobile_test%2Cmobile_other%2Capp_all_inclusive%2Capp_scripts%2Capp_bots%2Capp_plugins%2Capp_utilites%2Capp_design%2Capp_programming%2Capp_prototyping%2Capp_1c_dev%2Capp_test%2Capp_other%2Ccontent_copywriting%2Ccontent_rewriting%2Ccontent_article%2Ccontent_reviews%2Ccontent_news%2Ccontent_translations%2Ccontent_press_releases%2Ccontent_documentation%2Ccontent_correction%2Ccontent_scenarios%2Ccontent_coursework%2Ccontent_naming%2Ccontent_specification%2Ccontent_management%2Ccontent_blog_post%2Ccontent_other%2Cadmin_network%2Cadmin_servers%2Cadmin_databases%2Cadmin_design%2Cadmin_testing%2Cadmin_other%2Cdesign_graphics%2Cdesign_logos%2Cdesign_icons%2Cdesign_illustrations%2Cdesign_banners%2Cdesign_prints%2Cdesign_modeling%2Cdesign_animation%2Cdesign_presentations%2Cdesign_photo%2Cdesign_video%2Cdesign_audio%2Cdesign_interfaces%2Cdesign_flash_flex%2Cdesign_interiors%2Cdesign_fonts%2Cdesign_other%2Cprinting_all_inclusive%2Cprinting_design%2Cprinting_makeup%2Cprinting_packaging_design%2Cprinting_corporate_identity%2Cprinting_outdoor_advertising%2Cprinting_other%2Cengineering_development_electronics%2Cengineering_programming_electronics%2Cengineering_drawings_diagrams%2Cengineering_architecture%2Cengineering_other%2Cadvertising_seo%2Cadvertising_context%2Cadvertising_smo%2Cadvertising_smm%2Cadvertising_sem%2Cadvertising_other%2Cother_consulting%2Cother_audit_analysis%2Cother_jurisprudence%2Cother_other',
    ];
    var current = 0;
    var classname = 'freelansim';

    var container = null;
    //var server = 'http://localhost';
    var server = 'http://overwatch.onequiz.ru';

    function next()
    {
        if(current >= quiue.length)
            current = 0;

        if(quiue[current] === undefined)
            return false;

        return quiue[current++];
    }


    function update(list)
    {
        var newItems = false;
        $.each(list, function(index, el){
            if(items[el.id] === undefined){
                items[el.id] = $("<li class='"+classname+" new' data-id='"+el.id+"'><div class='title'><a href='"+
                    el.href+"' target='_blank'>"+el.title+"</a></div><div class='description'>"+
                    el.description+"</div><div class='time'>"+
                    el.time+"</div></li>");
                items[el.id].prependTo(container);
                newItems = true;
            }
        });

        if(newItems) audio.play();
    }

    $.fn.overwatchFreelansim = function(){

        container = this;

        setInterval(function(){

            var url = next();
            if(url === false)
                return;

            $.each(items, function(index, el){
                $(el).removeClass('new');
            });

            $.post(server,{update:classname, url: url},function(response){
                if(response instanceof Object && response.ok) {
                    update(response.list);
                }
            },'json');


        },30000);



    }
})(jQuery);



(function($){

    var items = [];
    var quiue = [
        'https://www.fl.ru/projects/',
    ];
    var current = 0;
    var classname = 'fl';

    var container = null;
    //var server = 'http://localhost';
    var server = 'http://overwatch.onequiz.ru';

    function next()
    {
        if(current >= quiue.length)
            current = 0;

        if(quiue[current] === undefined)
            return false;

        return quiue[current++];
    }


    function update(list)
    {
        var newItems = false;
        $.each(list, function(index, el){
            if(items[el.id] === undefined){
                items[el.id] = $("<li class='"+classname+" new' data-id='"+el.id+"'><div class='title'><a href='"+
                    el.href+"' target='_blank'>"+el.title+"</a></div><div class='description'>"+
                    el.description+"</div><div class='time'>"+
                    el.time+"</div></li>");
                items[el.id].prependTo(container);
                newItems = true;
            }
        });

        if(newItems) audio.play();
    }

    $.fn.overwatchFL = function(){

        container = this;

        setInterval(function(){

            var url = next();
            if(url === false)
                return;

            $.each(items, function(index, el){
                $(el).removeClass('new');
            });

            $.post(server,{update:classname, url: url},function(response){
                if(response instanceof Object && response.ok) {
                    update(response.list);
                }
            },'json');



        },100000);


    }
})(jQuery);



(function($){

    var items = [];
    var quiue = [
        'https://freelance.ru/projects/',
    ];
    var current = 0;
    var classname = 'freelanceru';

    var container = null;
    //var server = 'http://localhost';
    var server = 'http://overwatch.onequiz.ru';

    function next()
    {
        if(current >= quiue.length)
            current = 0;

        if(quiue[current] === undefined)
            return false;

        return quiue[current++];
    }


    function update(list)
    {
        var newItems = false;
        $.each(list, function(index, el){
            if(items[el.id] === undefined){
                items[el.id] = $("<li class='"+classname+" new' data-id='"+el.id+"'><div class='title'><a href='"+
                    el.href+"' target='_blank'>"+el.title+"</a></div><div class='description'>"+
                    el.description+"</div><div class='time'>"+
                    el.time+"</div></li>");
                items[el.id].prependTo(container);
                newItems = true;
            }
        });

        if(newItems) audio.play();
    }

    $.fn.overwatchFreelanceru = function(){

        container = this;

        setInterval(function(){

            var url = next();
            if(url === false)
                return;

            $.each(items, function(index, el){
                $(el).removeClass('new');
            });

            $.post(server,{update:classname, url: url},function(response){
                if(response instanceof Object && response.ok) {
                    update(response.list);
                }
            },'json');



        },25000);


    }
})(jQuery);