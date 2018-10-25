// Dichiara un "namespace" di funzioni
var CoolCMS = {};

// Dichiarazione funzione per inviare richieste ajax al server
CoolCMS.sendRequest = function(sender, handleResultCallback) {
    var $sender = $(sender);
    var action = $sender.attr('action');
    var formData = new FormData($sender[0]);
    
    // Utilizza funzione ajax di jQuery
    $.ajax({
        url: action,
        type: 'post',
        header: {
            "X-Requested-With": "XMLHttpRequest" 
        },
        data: formData,        
        contentType: false,
        processData: false,            
        success: function(data) {                
            var jsonData = JSON.parse(data);
            handleResultCallback(jsonData);                        
        }
    });

};
    