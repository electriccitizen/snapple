(function ($, Drupal) {
    Drupal.behaviors.myModuleBehavior = {
        attach: function (context, settings) {

            var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
            var timeInSeconds = TimeMe.getTimeOnCurrentPageInSeconds();

            window.addEventListener("beforeunload", function(event) {
                ga(‘send’, ‘event’, [eventCategory], [eventAction], [eventLabel], [eventValue], [fieldsObject]);
                ga(‘send’, ‘event’, ‘timeonpage’, ‘Play’, ‘Product Demo Video’);
                xmlhttp=new XMLHttpRequest();
                xmlhttp.open("POST","www.google-analytics.com", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
                xmlhttp.send("v=1&tid=UA-131852001-1&cid=555&t=pageview&cd5=".timeSpentOnPage);
                console.log('fooman');
            });

            window.onbeforeunload = function (event) {
               // xmlhttp=new XMLHttpRequest();
               // xmlhttp.open("POST","ENTER_URL_HERE", true);
               // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
                alert(timeSpentOnPage)
            };

        }
    };
})(jQuery, Drupal);






