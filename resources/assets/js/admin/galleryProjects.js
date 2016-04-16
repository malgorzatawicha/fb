$(document).ready(function(){

    var $projectInfo = $('#projectInfo');
    if ($projectInfo) {
        var data = {
            'row': $projectInfo.data('project'),
            'logo': $projectInfo.data('logo'),
            'submit': $projectInfo.data('submit-action')
        };
        if (data.row) {
            data.method = 'put';
        }else {
            data.row = {
                active: true
            };
            data.method = 'post';
        }
        Modal.initializeFields($('.project-form'), data);
    }
});

$('#imageModal').on('show.bs.modal', function (event) {
    var $modal = $(this);
    var $button = Modal.clickedButton(event);
    var data = {
        'row': $button.data('image'),
        'image': $button.data('image-file'),
        'thumb': $button.data('thumb-file'),
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
