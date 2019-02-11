var $ = require("jquery");
import Handlebars from 'handlebars/dist/cjs/handlebars.js';

$(document).ready(function () {

    getAll();

    $(document).on('click', '.btn-show', function (event) {
       event.preventDefault();
       var url = $(this).attr('href');
       getGuest(url);
    });

    $(document).on('click', '.btn-show-all', function (event) {
       event.preventDefault();
       getAll();
    });

});

function printData(data, source) {
    var wrapper = $('.show-ospiti');
    wrapper.html('');
    var template = Handlebars.compile(source);
    var context = {
        'guests': []
    };

    for (var i = 0; i < data.length; i++) {
        var thisGuest = data[i];
        context.guests.push(thisGuest);
    }
    console.log(context);
    var html  = template(context);
    wrapper.append(html);
}

function getGuest(url) {
    var source   = $('#table-guest-template').html();
    $.ajax({
        'url': url,
        'method': 'GET',
        'success': function (data) {
            printData(JSON.parse(data), source);
        },
        'error': function (err) {
            console.log(err);
        }
    });
}

function getAll() {
    var urlAllGuests = 'database.php';
    var source   = $('#table-template').html();
    $.ajax({
        'url': urlAllGuests,
        'method': 'GET',
        'data': {'ajax': true},
        'success': function (data) {
            printData(JSON.parse(data), source);
        },
        'error': function (err) {
            console.log('error');
        }
    });

}