$(document).on('submit', 'form.reservation-form', function() {
    $('button:submit', this).attr("disabled", true);
    
    $.ajax({
        url     : $(this).attr('action') + '/checkReservation',
        type    : $(this).attr('method'),
        dataType: 'json',
        data    : $(this).serialize(),
        success : function( data ) {
            if( data.result == 'success' ) {
                /*...*/
                return true;
            }
            else {
                /*...*/
                return false;
            }
        }
    });
    
    return true;
});