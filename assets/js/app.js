import '../scss/app.scss';
import '../scss/base.scss';
import '../scss/_fragments/navbar.scss';
import '../scss/list.scss';
import '../scss/_fragments/form.scss';


var $ = require('jQuery');

$(document).ready(function () {
    setTimeout(function(){
        $("div.alert").fadeOut("slow", function() {
            $(this).remove();
        });
    }, 4000 ); // 4 secs
});
