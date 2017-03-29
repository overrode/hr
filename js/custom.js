/* Custom javascript */

$(document).ready(function () {

    $('#work_list').on('click', '.work_edit_button', function () {
        $('#form_job_entry_id').val(this.getAttribute("id"));
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
                            + "<td class='work_td'><a href='javascript:void(0)' id='" + val.id_work + " ' class='btn-danger work_edit_button'>Edit</a></td>" +
                            + "</tr>";
                        $('#work_list').append(eachrow);
                    });
                },
                error   : function(err) {alert(err);}
            });
        }
    });

    $('.numbersOnly').on('blur',function () {
            this.value = this.value.replace(/[^0-9\.]/g,'');
            if(this.value % 1 != 0)
                this.value = Number((Math.round(this.value * 4) / 4).toFixed(2))
    });

});


