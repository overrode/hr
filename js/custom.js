/* Custom javascript */

function getWorkAjax(response){
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
}

$(document).ready(function () {

    /*CRUD work Ajax*/
    $('#form_submit_work').submit(function(event) {
        event.preventDefault();
        var url = '/track/add';
        var data = {
            project : $('#form_project').val(),
            task    : $('#form_task').val(),
            details : $('#form_details').val(),
            hours   : $('#form_hours').val(),
            date    :$('#form_date').val()
        };
        var dataType = 'json';
        $.post( url,
                data,
                function(success){
                    console.log( success );
                },
                dataType
        ).fail(function(error) {
                console.log(error);
            });
    });

    /*Form fill from work*/
    $('#work_list').on('click', '.work_edit_button', function () {
        $('#form_job_entry_id').val(this.getAttribute("id"));
        var allData = {
            project: $('#project_' + this.id).html(),
            task:    $('#task_' + this.id).html(),
            details: $('#details_' + this.id).html(),
            hours:   $('#hours_' + this.id).html(),
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
        dayClick: function (date) {
            /*Highlight selected date*/
            $(".fc-state-highlight").removeClass("fc-state-highlight");
            $("td[data-date="+date.format('YYYY-MM-DD')+"]").addClass("fc-state-highlight");

            /*Limit date till today*/
            var myDate = new Date();
            var daysToAdd = 0;
            myDate.setDate(myDate.getDate() + daysToAdd);
            if (date > myDate) {
                var moment = $('#calendar').fullCalendar('getDate');
                var dateToday =  moment.format('MM/DD/YYYY');
                $('#form_date').val(dateToday);
                alert("You cannot pick a future date. Today date is used " + dateToday)
                $("td[data-date="+date.format('YYYY-MM-DD')+"]").removeClass("fc-state-highlight");
            }

            /*Format date*/
            var datePicker = date.format('MM/DD/YYYY');
            if(!dateToday) {
                $('#form_date').val(datePicker);
            }

            /* GET WORK by date AJAX*/
            $.ajax({
                type    : "POST",
                dataType: "json",
                url     : "/track/getDate",
                data    : {data: datePicker},
                success : function(response) { getWorkAjax(response); },
                error   : function(err) {alert(err);}
            });

        }
    });
});


