function initImage($image, params)
{
    var defaultParams = {
        showUpload: false,
        language: 'pl'
    };
    params = $.extend({}, defaultParams, params);
    $image.fileinput(params);
}

var Modal = {
    clickedButton: function(event) {
      return $(event.relatedTarget);
    },
    initializeFields: function ($modal, data) {
        this.initializeTexts($modal, data);
        this.initializeBooleans($modal, data);
        this.initializeFiles($modal, data);
        this.initializeSubmit($modal, data);
        this.initializeMethod($modal, data);
    },

    initializeTexts: function($modal, data) {
        var self = this;
        $(':text, input[type=url], textarea', $modal).each(function () {
            self.clearText($(this));
            self.setText($(this), data);
        });
    },
    initializeBooleans: function($modal, data) {
        var self = this;
        $(':checkbox', $modal).each(function () {
            self.clearBoolean($(this));
            self.setBoolean($(this), data);
        });
    },
    initializeFiles: function($modal, data) {
        var self = this;
        $(":file", $modal).each(function(){
            self.clearFile($(this));
            self.setFile($(this), data);
        });
    },
    initializeSubmit: function($modal, data) {
        var submitAction = data.submit;
        var $form = $('form', $modal);
        $form.attr('action', submitAction);
        $(".submit-form", $modal).unbind('click').click(function() {
            $form.submit();
        })
    },
    initializeMethod: function($modal, data) {
        $("[name='_method']", $modal).val(data.method);
    },
    clearText: function ($field) {
        $field.val('');
    },
    setText: function ($field, data) {
        var name = $field.attr('name');
        if (data.row && data.row[name]) {
            $field.val(data.row[name]);
        }
    },
    clearBoolean: function ($field) {
        $field.prop('checked', false);
    },
    setBoolean: function ($field, data) {
        var name = $field.attr('name');
        if (data.row && data.row[name]) {
            if (data.row[name]) {
                $field.prop('checked', true);
            }
        }
    },
    clearFile: function ($field) {
        $field.fileinput('destroy');
    },
    setFile: function ($field, data) {
        var name = $field.attr('name');
        var params = {
            showUpload: false,
            language: 'pl'
        };
        var $hiddens = $('.existing', $field.closest('.form-group'));
        if (data.row && data.row[name + '_id']) {
            params.initialPreview = ['<a href="' + data[name].big + '" data-lightbox="' + name + '">' +
            '<img style="width:auto;height:160px;" src="' + data[name].thumb + '"></a>'];
            $hiddens.each(function() {
                $(this).val(1);
            });
        }
        $field.fileinput(params);


        $field.unbind('filecleared').on('filecleared', function (event) {
            $hiddens.each(function() {
                $(this).val(0);
            });
        });

        $field.unbind('fileloaded').on('fileloaded', function (event) {
            $hiddens.each(function() {
                $(this).val(1);
            });
        });
    }

};