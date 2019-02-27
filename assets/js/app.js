import '../scss/app.scss';
import '../scss/base.scss';
import '../scss/list.scss';
import '../scss/_fragments/navbar.scss';
import '../scss/_fragments/form.scss';


let $ = require('jQuery');

// This removes flash alerts after 4 seconds
$(document).ready(function () {
    setTimeout(function(){
        $("div.alert").fadeOut("slow", function() {
            $(this).remove();
        });
    }, 4000 ); // 4 secs
});