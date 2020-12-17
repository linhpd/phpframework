// Vanilla Javascript

function jumpTo(path, confirmMessage) {
    var answer = confirm(confirmMessage);
    if (answer == 1) {
        location.href = path;
    }
}

$(document).ready(function() {
    $('#inputfile').change(function(){
        var file_data = $('#inputfile').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        $.ajax({
            url: "pro-img-disk.php",
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
                console.log(data);
            }
        });
    });
});