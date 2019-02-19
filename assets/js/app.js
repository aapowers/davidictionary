import '../scss/app.scss';
import '../scss/base.scss';
import '../scss/navbar.scss';
import '../scss/list.scss';

var $ = require('jQuery');

$(document).ready(function () {
    setTimeout(function(){
        $("div.alert").fadeOut("slow", function() {
            $(this).remove();
        });
    }, 4000 ); // 4 secs
});
