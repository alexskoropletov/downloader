$(function () {
    setInterval(list, 2000);
});

function list() {
    $.get('/list', function (html) {
        $('#downloads-list').html(html);
    });
}