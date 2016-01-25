$(document).ready(function(){
    var path = $("#logo-path").val();
    var filename = $("#logo-filename").val();
    var params = {};
    if (path && filename) {
        params = {
            initialPreview: '<img style="width:auto;height:160px;" src="' + path + filename + '">'
        }
    }
    initImage($("#logo"), params);

    var active = $("#is_active").val();
    if (active == 1) {
        $("#active").prop('checked', true);
    }

});
