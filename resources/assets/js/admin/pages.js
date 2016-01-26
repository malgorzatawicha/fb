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

$('#createBannerModal').on('show.bs.modal', function(event) {
    var page = getDataForModal(event, 'page');
    var modal = $(this);
    initImage($("#image", modal));
    prepareSubmitButton(event, modal);
});

$('#editBannerModal').on('show.bs.modal', function (event) {
    var banner = getDataForModal(event, 'banner');
    var page = getDataForModal(event, 'page');

    var modal = $(this);
    modal.find('.modal-title').text('Edit banner ' + banner.name);

    $('.banner-name').val(banner.name);
    $('.banner-description').val(banner.description);

    initImage($("#image", modal), {
        initialPreview: '<img style="width:auto;height:160px;" src="' + banner.path + banner.filename + '">',
    });

    var active = $("#is_active", modal).val();
    if (active == 1) {
        $("#active", modal).prop('checked', true);
    }

    prepareSubmitButton(event, modal);
});
