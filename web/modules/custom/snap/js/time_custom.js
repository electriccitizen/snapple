
(function ($) {
    Drupal.behaviors.page_load_progress = {
        attach: function (context, settings) {
            window.onbeforeunload = close_event_function;
            function close_event_function() {
                var timeInSeconds = TimeMe.getTimeOnCurrentPageInSeconds();
                console.log('see ya:' + timeInSeconds);
                xmlhttp=new XMLHttpRequest();
                xmlhttp.open("POST","http://www.google-analytics.com/collect?", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("v=1&tid=UA-131852001-1&cid=555&t=pageview&cd6=foomanchu&metric1=" + timeInSeconds +"&cd5=" + timeInSeconds +"&cd7=" + timeInSeconds + "&cd8="+ timeInSeconds);
            }
        }
    };
}(jQuery));








