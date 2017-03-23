/* Custom javascript */

$(document).ready(function () {

     /* UPDATE WORK */

    $('#work_list').on('click', '.work_edit', function () {
        var allData = {
            project: $('#project_' + this.id).html(),
            task   : $('#task_' + this.id).html(),
            details: $('#details_' + this.id).html(),
            hours  : $('#hours_' + this.id).html()
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
            /* GET WORK by date AJAX*/
            $.ajax({
                type    : "POST",
                dataType: "json",
                url     : "/track/getDate",
                data    : {data: datePicker},
                success : function(response) {
                    $('#work_list').empty();
                    $.each(response, function (index, val) {
                        var eachrow = "<tr>"
                            + "<td class='work_td' id='project_"+val.id_work+"'>" + val.project + "</td>"
                            + "<td class='work_td' id='task_"+val.id_work+"'>" + val.task + "</td>"
                            + "<td class='work_td' id='hours_"+val.id_work+"'>" + val.hours + "</td>"
                            + "<td class='work_td' id='details_"+val.id_work+"'>" + val.details + "</td>"
                            + "<td class='btn btn-danger work_edit' id='"+val.id_work+"'>Edit</td>" +
                            + "</tr>";
                        $('#work_list').append(eachrow);
                    });
                },
                error   : function(err) {alert(err);}
            });
        }
    });


});


