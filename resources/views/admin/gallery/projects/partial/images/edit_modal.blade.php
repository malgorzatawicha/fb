<div class="modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="editImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editImageModalLabel">Edit Image</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group">
                        <label for="image-name">Image Name:</label>
                        <input type="text" name="name" id="image-name" class="form-control">
                    </div>
                    <div class="checkbox">
                        <input type="hidden" id="is_active" value="0">
                        <input type="hidden" name="active" value="0">
                        <label><input type="checkbox" name="active" id="active" value="1">Is Active</label>
                    </div>
                    <div class="form-group">
                        <label for="image-description" class="col-sm-2">{{ trans('cms.page.banner.description') }}</label>
                        <textarea name="description" id="image-description" class="form-control" rows="2" cols="80"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="base_image">Base Image (800x400):</label>
                        <input type="file" name="base_image" id="base_image">
                    </div>
                    <div class="form-group">
                        <label for="big_image">Big Image (2000x1000):</label>
                        <input type="file" name="big_image" id="big_image">
                    </div>
                    <div class="form-group">
                        <label for="mobile_image">Mobile Image (?):</label>
                        <input type="file" name="mobile_image" id="mobile_image">
                    </div>
                    <div class="form-group">
                        <label for="thumb_image">Thumb Image (150x150):</label>
                        <input type="file" name="thumb_image" id="thumb_image">
                    </div>
                    <div class="form-group">
                        <label for="mobile_thumb_image">Mobile Thumb Image (?):</label>
                        <input type="file" name="mobile_thumb_image" id="mobile_thumb_image">
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