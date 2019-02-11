var $ = require("jquery");
$(document).ready(function () {
    var $showOspiteContainer = $('.show-ospite');
    if($showOspiteContainer.length > 0){
        var idOspite = $showOspiteContainer.attr('data-id');
        var url = 'http://localhost/php-boolcrud-ajax/show/id/'+idOspite;
        $.ajax({
            'url': url,
            'method': 'GET',
            'success': function (data) {
                console.log("success");
                console.log(data);
            },
            'error': function (err) {
                console.log('error');
            }
        });
    }

});