/** modals */

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
    var modal = $(this);
    $("#image", modal).fileinput({
        showUpload: false,
        language: 'pl'
    });
    $("#mobile", modal).fileinput({
        showUpload: false,
        language: 'pl'
    });
    prepareSubmitButton(event, modal);
});
$('#editImageModal').on('show.bs.modal', function (event) {
    var image = getDataForModal(event, 'image');

    var modal = $(this);
    modal.find('.modal-title').text('Edit image ' + image.image_name);

    $('.image-name').val(image.image_name);
    $('.mobile-name').val(image.mobile_name);
    if (image.is_active == 1) {
        $('.is_active', modal).prop('checked', true);
    }

    if (image.is_featured == 1) {
        $('.is_featured', modal).prop('checked', true);
    }

    $("#image", modal).fileinput({
        initialPreview: '<img style="width:auto;height:160px;" src="' + image.image_path + image.image_filename + '">',
        showUpload: false,
        language: 'pl'
    });
    $("#mobile", modal).fileinput({
        initialPreview: '<img style="width:auto;height:160px;" src="' + image.mobile_path + image.mobile_filename+ '">',
        showUpload: false,
        language: 'pl'
    });

    prepareSubmitButton(event, modal);
});