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

function getFormErrorsAjax(data) {
    if(data.status == 'failed') {
        if(data.message.errorProject == true) {
            $('#form_project').addClass('errorClass');
            $('#label_project').html('PLease insert numbers only!');
        }
        if(data.message.errorTask == true) {
            $('#form_task').addClass('errorClass');
            $('#label_task').html('PLease insert TI-01!');
        }
        if(data.message.errorDetails == true) {
            $('#form_details').addClass('errorClass');
            $('#label_details').html('Please insert the details');
        }
        if(data.message.errorHours == true) {
            $('#form_hours').addClass('errorClass');
            $('#label_hours').html('Hours cannot be empty');
        }
    }
    if(data.status == 'success') {
        var add_edit = data.work;
        $('#success_modify_1').addClass('alert alert-success alert-dismissable');
        $('#success_modify_2').html(add_edit);
        $('#x_close').css('display', 'block');
        // if(add_edit == 'Work added!') {
        //     $('#form_project, #form_task, #form_details, #form_hours').val('');
        // }
    }
}

$(document).ready(function () {

    /*CRUD work Ajax*/
    $('#form_submit_work').submit(function(event) {
        event.preventDefault();
        var url = '/track/add';
        var dataType = 'json';
        var work = {
            project : $('#form_project').val(),
            task    : $('#form_task').val(),
            details : $('#form_details').val(),
            hours   : $('#form_hours').val(),
            date    :$('#form_date').val(),
            id_work :$('#form_job_entry_id').val()
        };
        $.post( url, work, function(data){ getFormErrorsAjax(data); }, dataType );
    });

    /*Form fill from work*/
    $('#work_list').on('click', '.work_edit_button', function () {
        $('#form_job_entry_id').val(this.getAttribute("id"));
        var allData = {
            project: $('#project_' + this.id).html(),
            task:    $('#task_' + this.id).html(),
            details: $('#details_' + this.id).html(),
            hours:   $('#hours_' + this.id).html()
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
            var oneDate = date.format('YYYY-MM-DD');
            $(".fc-state-highlight").removeClass("fc-state-highlight");
            $("td[data-date="+ oneDate +"]").addClass("fc-state-highlight");

            /*Limit date till today*/
            var myDate = new Date();
            if (date > myDate) {
                var dayWrapper = moment(myDate);
                var dateToday = dayWrapper.format("MM/DD/YYYY");
                $('#form_date').val(dateToday);
                alert("You cannot pick a future date. Today date is used " + dateToday);
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

    $('.numbersOnly').on('blur',function () {
            this.value = this.value.replace(/[^0-9\.]/g,'');
            if(this.value % 1 != 0)
                this.value = Number((Math.round(this.value * 4) / 4).toFixed(2))
    });

});


