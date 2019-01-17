(function ($, Drupal) {
    Drupal.behaviors.myModuleBehavior = {
        attach: function (context, settings) {
                // Apply the myCustomBehaviour effect to the elements only once.
            var Tos;

            alert('now im here');
            (function(d, s, id, file) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.onload = function() {

                    var config = {
                        trackBy: 'seconds',
                        developerMode: true
                    };
                    if(TimeOnSiteTracker) {

                        Tos = new TimeOnSiteTracker(config);
                    }
                };
                js.src = file;fjs.parentNode.insertBefore(js, fjs);
            } (document, 'script', 'TimeOnSiteTracker', 'https://cdn.jsdelivr.net/gh/saleemkce/timeonsite@1.0.0/timeonsitetracker.min.js'));
        }
    };
})(jQuery, Drupal);





