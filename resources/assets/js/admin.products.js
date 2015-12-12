/** modals */

function getDataForModal(event, data) {
    var button = $(event.relatedTarget);
    return button.data(data);
}

$('#createImageModal').on('show.bs.modal', function(event) {
    var product = getDataForModal(event, 'product');
    var modal = $(this);
    $("#image", modal).fileinput({
        showUpload: false
    });
    $("#mobile-image", modal).fileinput({
        showUpload: false
    });
});
$('#editImageModal').on('show.bs.modal', function (event) {
    var image = getDataForModal(event, 'image');
    var product = getDataForModal(event, 'product');

    var modal = $(this);
    modal.find('.modal-title').text('Edit image ' + image.image_name);

    for (var i in image) {
        modal.find('.' + i).text(image[i]);
    }

    $("#image", modal).fileinput({
        initialPreview: '<img src="' + image.image_path +'/thumbnails/thumb-' + image.image_name + '.' + image.image_extension + '">',
        showUpload: false
    });
    $("#mobile-image", modal).fileinput({
        initialPreview: '<img src="' + image.image_path +'/thumbnails/thumb-' + image.image_name + '.' + image.image_extension + '">',
        showUpload: false
    });
})