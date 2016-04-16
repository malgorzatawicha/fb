$(document).ready(function(){
    $(".page-form :file").each(function(){
        var name = $(this).attr('name');

        var data = {};
        data.row = $("#page").data('page');
        data[name] = $(this).data('image');
        console.log(data);
        Modal.setFile($(this), data);
    });
});

$('#bannerModal').on('show.bs.modal', function (event) {
    var $modal = $(this);
    var $button = Modal.clickedButton(event);
    var data = {
        'row': $button.data('friend'),
        'file': $button.data('file'),
        'submit': $button.data('submit-action')
    };

    if (data.row) {
        $modal.find('.modal-title').text('Edit banner ' + data.row.name);
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

$('#friendModal').on('show.bs.modal', function (event) {
    var $modal = $(this);
    var $button = Modal.clickedButton(event);
    var data = {
        'row': $button.data('image'),
        'file': $button.data('file'),
        'submit': $button.data('submit-action')
    };

    if (data.row) {
        $modal.find('.modal-title').text('Edit friend ' + data.row.name);
        data.method = 'put';
    } else {
        data.row = {
            active: true
        };
        data.method = 'post';
    }

    Modal.initializeFields($modal, data);

});

$('#createContactModal').on('show.bs.modal', function(event) {
    var page = getDataForModal(event, 'page');
    var modal = $(this);
    prepareSubmitButton(event, modal);
});

$('#editContactModal').on('show.bs.modal', function (event) {
    var contact = getDataForModal(event, 'contact');
    var page = getDataForModal(event, 'page');

    var modal = $(this);
    modal.find('.modal-title').text('Edit contact ' + contact.name);

    $('.contact-name').val(contact.name);
    $('.contact-body').val(contact.body);

    var active = $("#is_active", modal).val();
    if (active == 1) {
        $("#active", modal).prop('checked', true);
    }

    prepareSubmitButton(event, modal);
});

