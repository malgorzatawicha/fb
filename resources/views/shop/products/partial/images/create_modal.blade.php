<div class="modal fade" id="createImageModal" tabindex="-1" role="dialog" aria-labelledby="createImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editImageModalLabel">Create Image</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group">
                        <label for="image-name">Image Name:</label>
                        <input type="text" name="image_name" id="image-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mobile-image-name">Mobile Image Name:</label>
                        <input type="text" name="mobile_image_name" id="mobile-image-name" class="form-control">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="active" value="0"/> Is Active
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_featured" value="0"/> Is Featured
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="image">Primary Image:</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div class="form-group">
                        <label for="mobile-image">Mobile Image:</label>
                        <input type="file" name="mobile_image" id="mobile-image">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary submit-form"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('shop.product_image.add') }}</button>
            </div>
        </div>
    </div>
</div>