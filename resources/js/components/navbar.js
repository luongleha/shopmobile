import {addOrdinalNumber, addOrdinalNumberSearch, delay} from "./main";

let curPage;
let _ = require('lodash');
$(document).ready(function () {
    let store = [];
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
});