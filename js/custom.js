/* Custom javascript */

$(document).ready(function () {

     /* UPDATE WORK */
     $('#work_list').on("click", '.btn-danger', function() {
         $('#form_job_entry_id').val(this.getAttribute("id"));
     });

    $('.work_class').on('click', '.work_td', function () {
        console.log(this);
        var allData = {
            project: $('#project_' + this.id).html(),
            task: $('#task_' + this.id).html(),
            details: $('#details_' + this.id).html(),
            hours: $('#hours_' + this.id).html(),
        };
        $('#form_project').val(allData.project);
        $('#form_task').val(allData.task);
        $('#form_details').val(allData.details);
        $('#form_hours').val(allData.hours);
    });

    /**
     *  Calendar options
     */
    $('#calendar').fullCalendar({
        selectable: true,
        weekends: false,
        dayClick: function (date) {
            var datePicker = date.format('MM/DD/YYYY');
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
                            + "<td class='work_td'><a href='javascript:void(0)' id='" + val.id_work + " ' class='btn-danger'>Edit</a></td>" +
                            + "</tr>";
                        $('#work_list').append(eachrow);
                    });
                },
                error   : function(err) {alert(err);}
            });
        }
    });
});


