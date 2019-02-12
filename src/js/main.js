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

    $(document).on('click', '.btn-delete', function (event) {
        event.preventDefault();
        var url = $(this).parent().attr('action');
        deleteGuest(url);
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
    var urlAllGuests = 'http://' + window.location.hostname + window.location.pathname + 'crud/guests/alldb.php';
    //console.log(urlAllGuests);
    var source   = $('#table-template').html();
    $.ajax({
        'url': urlAllGuests,
        'method': 'GET',
        'data': {'ajax': true},
        'success': function (data) {
            //console.log(data);
            printData(JSON.parse(data), source);
        },
        'error': function (err) {
            console.log('error');
        }
    });

}

function deleteGuest(url) {
    var source   = $('#delete-template').html();
    $.ajax({
        'url': url,
        'method': 'POST',
        'data': {'ajax': true, 'request': 'delete'},
        'success': function (data) {
            printAlert(JSON.parse(data), source);
        },
        'error': function (err) {
            console.log(err);
        }
    });
}

function printAlert(data, source) {
    var wrapper = $('.alert');
    var template = Handlebars.compile(source);
    if(data.status === 'delete'){
        var context = {
            'delete': data.id
        };
    } else {
        var context = {
            'error': 'nessuna modifica effettuata'
        };
    }
    var html  = template(context);
    wrapper.append(html);
    wrapper.removeClass('display-none');
    getAll();
}