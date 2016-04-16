$(document).ready(function(){

    $(".site-form :file").each(function(){
        var name = $(this).attr('name');

        var data = {};
        data.row = $("#site").data('site');
        data[name] = $(this).data('image');
        Modal.setFile($(this), data);
    });
});
