<div class="modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="editImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editImageModalLabel">Edit Image</h4>
            </div>
            <div class="modal-body">
                <form class='form' action="{{route('admin.products.images.update', ['product' => $product->slug, 'image' => $image->id])}}" method="POST" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    {{ method_field('PATCH') }}
                    <div>
                        <ul>
                            <li><h4>Image Name:   <span class="image_name"></span>.<span class="image_extension"></span></h4></li>
                            <li><h4>Image Path:   <span class="image_path"></span> </h4> </li>
                            <li><h4>Mobile Name:   <span class="mobile_image_name"></span>.<span class="mobile_extension"></span></h4> </li>
                            <li><h4>Mobile Path:   <span class="mobile_image_path"></span></h4></li>

                        </ul>
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
                <button class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('shop.product_image.add') }}</button>
            </div>
        </div>
    </div>
</div>