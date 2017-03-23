/* Custom javascript */

$(document).ready(function () {
    /**
     *  UPDATE WORK
     */
    $('#tbody').on('click', '.work', function () {
        var allData = {
            project: $('#project_td').html(),
            task   : $('#task_td').html(),
            details: $('#details_td').html(),
            hours  : $('#hours_td').html()
        };
        $('#form_project').val(allData.project);
        $('#form_task')   .val(allData.task);
        $('#form_details').val(allData.details);
        $('#form_hours')  .val(allData.hours);
    });

    /**
     *  Calendar options
     */
    $('#calendar').fullCalendar({
        selectable   : true,
        weekends     : false,
        defaultFormat: 'YYYY-MM-DD',
        dayClick     : function (date) {
            $('#form_project, #form_task, #form_details, #form_hours').val('');
            var datePicker = date.format();
            $('#form_date').val(datePicker);
            /* GET WORK AJAX*/
            $.ajax({
                type    : "POST",
                dataType: "json",
                url     : "/track/getDate",
                data    : {data: datePicker},
                success : function(response) {
                    $('#tbody').empty();
                    $.each(response, function (index, val) {
                        var eachrow = "<tr>"
                            + "<td id='project_td'>" + val.project + "</td>"
                            + "<td id='task_td'>" + val.task + "</td>"
                            + "<td id='hours_td'>" + val.hours + "</td>"
                            + "<td id='details_td'>" + val.details + "</td>"
                            + "<td class='btn btn-danger work' id='edit_work_"+val.id_work+"'>Edit</td>" +
                            + "</tr>";
                        $('#tbody').append(eachrow);
                    });
                },
                error   : function(err) {alert(err);}
            });
        }
    });


});


