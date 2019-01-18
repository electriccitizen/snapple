(function ($, Drupal) {
    Drupal.behaviors.myModuleBehavior = {
        attach: function (context, settings) {

            var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();

            window.addEventListener("beforeunload", function(event) {
                xmlhttp=new XMLHttpRequest();
                xmlhttp.open("POST","http://www.google-analytics.com/collect?", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("v=1&tid=UA-131852001-1&cid=555&t=pageview&cd5=" + timeSpentOnPage);
            });

        }
    };
})(jQuery, Drupal);






