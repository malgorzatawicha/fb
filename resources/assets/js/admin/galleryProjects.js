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

function getDataForModal(event, data) {
    var button = $(event.relatedTarget);
    return button.data(data);
}

function prepareSubmitButton(event, modal)
{
    var submitAction = getDataForModal(event, 'submit-action');
    var $form = $('form', modal);
    $form.attr('action', submitAction);
    $(".submit-form", modal).click(function() {
        $form.submit();
    })
}

$('#createImageModal').on('show.bs.modal', function(event) {
    var project = getDataForModal(event, 'project');
    var modal = $(this);
    initImage($("#base_image", modal));
    initImage($("#big_image", modal));
    initImage($("#mobile_image", modal));
    initImage($("#thumb_image", modal));
    initImage($("#mobile_thumb_image", modal));
    prepareSubmitButton(event, modal);
});

$('#editImageModal').on('show.bs.modal', function (event) {
    var image = getDataForModal(event, 'image');
    var project = getDataForModal(event, 'project');

    var modal = $(this);
    modal.find('.modal-title').text('Edit image ' + image.name);

    $('.image-name').val(image.name);
    $('.image-description').val(image.description);

    initImage($("#base_image", modal), {
        initialPreview: '<img style="width:auto;height:160px;" src="' + image.base_path + image.base_filename + '">',
    });

    initImage($("#big_image", modal), {
        initialPreview: '<img style="width:auto;height:160px;" src="' + image.big_path + image.big_filename + '">',
    });

    initImage($("#mobile_image", modal), {
        initialPreview: '<img style="width:auto;height:160px;" src="' + image.mobile_path + image.mobile_filename + '">',
    });

    initImage($("#thumb_image", modal), {
        initialPreview: '<img style="width:auto;height:160px;" src="' + image.thumb_path + image.thumb_filename + '">',
    });

    initImage($("#mobile_thumb_image", modal), {
        initialPreview: '<img style="width:auto;height:160px;" src="' + image.mobile_thumb_path + image.mobile_thumb_filename + '">',
    });


    var active = $("#is_active", modal).val();
    if (active == 1) {
        $("#active", modal).prop('checked', true);
    }

    prepareSubmitButton(event, modal);
});
