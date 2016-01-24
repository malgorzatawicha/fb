function initImage($image, params)
{
    var defaultParams = {
        showUpload: false,
        language: 'pl'
    };
    params = $.extend({}, defaultParams, params);
    $image.fileinput(params);
}