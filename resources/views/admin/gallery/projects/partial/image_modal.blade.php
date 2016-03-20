<div class="modal fade" tabindex="-1" role="dialog" id="imageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create image</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group">
                        <label for="image-name">Image Name:</label>
                        <input type="text" name="name" id="image-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image-description" class="col-sm-2">{{ trans('cms.page.banner.description') }}</label>
                        <textarea name="description" id="image-description" class="form-control" rows="2" cols="80"></textarea>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" id="is_active" value="0">
                        <input type="hidden" name="active" value="0">
                        <label><input type="checkbox" name="active" id="active" value="1">Is Active</label>
                    </div>
                    <div class="form-group">
                        <label for="base_image">Image (4:3):</label>
                        <input type="file" name="image" id="base_image">
                    </div>
                    <div class="checkbox">
                        <input type="hidden" id="is_watermarked" value="0">
                        <input type="hidden" name="watermarked" value="0">
                        <label><input type="checkbox" name="watermarked" id="watermarked" value="1">Is Watermarked</label>
                    </div>
                    <div class="form-group">
                        <label for="thumb_image">Image (square):</label>
                        <input type="file" name="thumb" id="thumb_image">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary submit-form"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('cms.pages.banners.add') }}</button>
            </div>
        </div>
    </div>
</div>