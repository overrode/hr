/* Custom javascript */

$(document).ready(function () {
    /*Calendar options*/
    $('#calendar').fullCalendar({
        selectable: true,
        weekends: false,
        dayClick: function (date) {
            var datePicker = date.format('MM/DD/YYYY');
            $('#form_date').val(datePicker);
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/track/getDate",
                data: {data: datePicker},
                success: function (response) {
                    $('#tbody').empty();
                    $.each(response, function (index, val) {
                        var eachrow = "<tr>"
                            + "<td>" + val.project + "</td>"
                            + "<td>" + val.task + "</td>"
                            + "<td>" + val.hours + "</td>"
                            + "<td>" + val.details + "</td>"
                            + "<td class='btn btn-danger'>Edit</td>" +
                            + "</tr>";
                        $('#tbody').append(eachrow);
                    });
                },
                error: function (err) {
                    alert(err);
                },
            });
        },
    });
});


