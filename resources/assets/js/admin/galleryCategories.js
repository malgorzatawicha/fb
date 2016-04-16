$(document).ready(function(){
    $(".category-form :file").each(function(){
        var name = $(this).attr('name');

        var data = {};
        data.row = $("#category").data('category');
        data[name] = $(this).data('image');
        Modal.setFile($(this), data);
    });
});