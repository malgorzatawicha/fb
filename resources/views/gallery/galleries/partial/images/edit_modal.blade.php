<div class="modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="editImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editImageModalLabel">Edit Image</h4>
            </div>
            <div class="modal-body">
                <form class='form' action="" method="POST" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group">
                        <label for="image-name">Image Name:</label>
                        <input type="text" name="image_name" id="image-name" class="form-control image-name">
                    </div>
                    <div class="form-group">
                        <label for="mobile-name">Mobile Image Name:</label>
                        <input type="text" name="mobile_name" id="mobile-name" class="form-control mobile-name">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_active" value="0" class="is_active"/> Is Active
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="image">Primary Image:</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Image:</label>
                        <input type="file" name="mobile" id="mobile">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary submit-form"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('gallery.gallery_image.edit') }}</button>
            </div>
        </div>
    </div>
</div>