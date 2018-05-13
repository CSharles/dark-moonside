$('tr').click(function () {
    $('tr').removeClass('selected');
    $(this).addClass('selected');

    selectedRow = $(this);

});

$("#otherButton").click(function () {
    var td = $(selectedRow).children('td');
    for (var i = 0; i < td.length; ++i) {
        alert(i + ': ' + td[i].innerText);
    }
});