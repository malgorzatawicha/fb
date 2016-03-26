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

$('#imageModal').on('show.bs.modal', function (event) {
    var $modal = $(this);
    var $button = Modal.clickedButton(event);
    var data = {
        'row': $button.data('image'),
        'imageSrc': $button.data('image-src'),
        'thumbSrc': $button.data('thumb-src'),
        'submit': $button.data('submit-action')
    };

    if (data.row) {
        $modal.find('.modal-title').text('Edit image ' + data.row.name);
        data.method = 'put';
    } else {
        data.row = {
            active: true,
            watermarked: true
        };
        data.method = 'post';
    }

    Modal.initializeFields($modal, data);

});
