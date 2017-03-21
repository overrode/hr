/* Custom javascript */

function ajaxSuccessWorkResponse(response) {
    $('#td_project').append(response.project);
    $('#td_task').append(response.task);
    $('#td_details').append(response.details);
    $('#td_hours').append(response.hour);
    $('#td_date').append(response.date);
}

$(document).ready(function(){
    $("#calendar").click(function() {
        if() {}
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/track/getDate",
            data: '',
            success: function(response){
                $('#td_project').append(response.project);
                $('#td_task').append(response.task);
                $('#td_details').append(response.details);
                $('#td_hours').append(response.hour);
                $('#td_date').append(response.date);
            },
            error: function(err) {
                alert(err);
            },

        });
    });

    /*Calendar options*/
    $('#calendar').fullCalendar({
        weekends: false,
        defaultFormat: 'YYYY-MM-DD',
        dayClick: function(date) {
            var work_date = date.format();
        },

    });

});


