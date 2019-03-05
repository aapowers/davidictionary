// scss imports
import '../scss/app.scss';
import '../scss/base.scss';
import '../scss/list.scss';
import '../scss/_fragments/alert.scss';
import '../scss/_fragments/navbar.scss';
import '../scss/_fragments/form.scss';
// js imports
import 'bootstrap';
import autosize from 'autosize';

// require jQuery
let $ = require('jQuery');

// This removes flash alerts after 4 seconds
$(document).ready(function () {
    setTimeout(function(){
        $("div.alert").fadeOut("slow", function() {
            $(this).remove();
        });
    }, 4000 ); // 4 secs
});

// this autosizes all textareas
autosize($('textarea'));
