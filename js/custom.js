/* Custom javascript */

$(document).ready(function(){

    $("#calendar").click(function() {

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/track/getDate",
            data: '',
            success: function(response){
                alert(response);
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
            var data_da = date.format();
            //alert(data_da);
        },

    });

});


