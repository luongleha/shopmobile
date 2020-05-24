import {main_url} from './config';

$(document).ready(function() {
    let store;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});

export function addOrdinalNumber(className) {
    $(className).find('tr').each(function (index,cell) {
        let perPage = $('#perPage').val();
        let currentPage = $('#currentPage').val();
        $(this).find('td')[0].innerHTML = (perPage * (currentPage - 1)) + index + 1;
    });
}

export function addOrdinalNumberSearch(className) {
    $(className).find('tr').each(function (index,cell) {
        let perPage = $('#perPage').val();
        let currentPage = $('#currentPage').val();
        $(this).find('td')[0].innerHTML = index + 1;
    });
}

export function delay(callback, ms) {
    let timer = 0;
    return function() {
        let context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}
