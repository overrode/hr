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
                    $('#adina').each(response, function(){
                        console.log(response);
                    })
                },
                error: function(err) {
                    alert(err);
                },

            });
        },

    });

});


