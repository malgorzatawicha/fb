$(document).ready(function(){

    initImage($("#favicon"), {
        initialPreview: '<img src="/favicon.ico">'
    });

    var banner_path = $("#banner-path").val();
    var banner_filename = $("#banner-filename").val();
    var params = {};
    if (banner_path && banner_filename) {
        params = {
            initialPreview: '<img style="width:auto;height:160px;" src="' + banner_path + banner_filename + '">'
        }
    }
    initImage($("#banner"), params);
});
