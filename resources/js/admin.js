require('./bootstrap')
import Inputmask from 'inputmask'
const select2 = require('select2')
require('jquery-ui/ui/widgets/sortable.js');

$('#serviceCreateAdditional').select2();
$('#serviceCreateSubs').select2();

var selector = document.getElementById("phone")
if (selector)
{
    var im = new Inputmask("+48 (999) 999-999")
    im.mask(selector)
}

// Sort
$("#serviceTable").sortable({
    "axis": "y",
    "opacity": 0.9,
    "stop": function () {
        // console.log($('#serviceTable').sortable('toArray'))
        $.ajax({
            "type": 'GET',
            "url": 'service/positions/update',
            "data": {
                "positions": $('#serviceTable').sortable('toArray'),
            },
            error: function () {
                alert('Ошибка!');
            },
        });
    },
});



