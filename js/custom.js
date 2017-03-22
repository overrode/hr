/* Custom javascript */



$(document).ready(function(){
    /*Calendar options*/
    $('#calendar').fullCalendar({
        weekends: false,
        defaultFormat: 'YYYY-MM-DD',
        dayClick: function(date) {
            var datePicker = date.format();
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/track/getDate",
                data: {data:datePicker},
                success: function(response){
                    $('#tbody').empty();
                    $.each(response, function(index, val) {
                        var eachrow = "<tr>"
                            + "<td>" + val.project + "</td>"
                            + "<td>" + val.task + "</td>"
                            + "<td>" + val.hours + "</td>"
                            + "<td>" + val.details + "</td>"
                            + "<td>" + val.date + "</td>"
                            + "</tr>";
                        $('#tbody').append(eachrow);
                    });
                },
                error: function(err) {
                    alert(err);
                },

            });
        },

    });

});


