$(document).ready(function(){
    var logoId = $("#logo-id").val();
    var params = {};
    if (logoId) {
        params = {
            initialPreview: '<img style="width:auto;height:160px;" src="/admin/image/' + logoId + '/160/160' + '">'
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

$('#imageModal').on('show.bs.modal', function (event) {
    var image = getDataForModal(event, 'image');
    var project = getDataForModal(event, 'project');

    var modal = $(this);

    $("#active", modal).prop('checked', true);

    var baseImageParams = {};
    var thumbImageParams = {};
    if (image) {
        modal.find('.modal-title').text('Edit image ' + image.name);
        $('#image-name').val(image.name);
        $('.image-description').val(image.description);

        if ($("#is_active", modal).val() == 0) {
            $("#active", modal).prop('checked', false);
        }
        baseImageParams = {
            initialPreview: '<img style="width:auto;height:160px;" src="/admin/image/' + image.image_id + '/213/160' + '">',
        };
        thumbImageParams = {
            initialPreview: '<img style="width:auto;height:160px;" src="/admin/image/' + image.thumb_id + '/160/160' + '">',
        };
    }

    initImage($("#base_image", modal), baseImageParams);
    initImage($("#thumb_image", modal), thumbImageParams);

    prepareSubmitButton(event, modal);
});
