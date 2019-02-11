var $ = require("jquery");
var url = 'http://localhost/php-boolcrud-ajax/show';
$(document).ready(function () {
    //$('#updated-form').submit();

    $.ajax({
        'url': url,
        'method': 'POST',
        'data': {
            'id' : 55
        },
        'success': function (data) {
            console.log("success");
            console.log(data);
        },
        'error': function (err) {
            console.log('error');
        }
    });
});