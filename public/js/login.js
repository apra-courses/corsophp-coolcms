$(function() {
    $('#login_form').submit(function(evt) {
        evt.preventDefault();
        CoolCMS.sendRequest(this, function(jsonData) {
            switch (jsonData.EXITCODE) {
                case 0:
                    window.location.replace('/admin');
                    break;
                case 1:
                    $('#error_messages').html(jsonData.ERRORMSG);
                    break;
            }        
        });
    });
});