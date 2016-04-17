<div class="modal fade" tabindex="-1" role="dialog" id="imageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{trans('admin.gallery.projects.images.create')}}</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="image-name">{{trans('admin.gallery.projects.images.name')}} <span class="required">*</span></label>
                        <input type="text" name="name" id="image-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image-description">{{ trans('admin.gallery.projects.images.description') }}</label>
                        <textarea style="resize: vertical" name="description" id="image-description" class="form-control" rows="2" cols="80"></textarea>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="active" id="image-active-hidden" value="0">
                        <label><input type="checkbox" name="active" id="image-active" value="1">{{trans('admin.gallery.projects.images.active')}}</label>
                    </div>
                    <div class="form-group">
                        <label for="base_image">{{trans('admin.gallery.projects.images.image')}} <span class="required">*</span></label>
                        <input type="hidden" class="existing" name="image_existing" id="image-image_existing">
                        <input type="file" name="image" id="image-image">
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="watermarked" id="image-watermarked-hidden" value="0">
                        <label><input type="checkbox" name="watermarked" id="image-watermarked" value="1">{{trans('admin.gallery.projects.images.already_has_watermark')}}</label>
                    </div>
                    <div class="form-group">
                        <label for="thumb_image">{{trans('admin.gallery.projects.images.thumbnail')}}</label>
                        <input type="hidden" class="existing" name="thumb_existing" id="image-thumb_existing">
                        <input type="file" name="thumb" id="thumb_image">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('admin.close')}}</button>
                <button class="btn btn-primary submit-form"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>