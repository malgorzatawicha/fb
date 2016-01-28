<div class="modal fade" id="editBannerModal" tabindex="-1" role="dialog" aria-labelledby="editContactModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editContactModalLabel">Edit Contact</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="form-group">
                        <label for="contact-name">Contact Name:</label>
                        <input type="text" name="name" id="contact-name" class="form-control">
                    </div>
                    <div class="checkbox">
                        <input type="hidden" id="is_active" value="0">
                        <input type="hidden" name="active" value="0">
                        <label><input type="checkbox" name="active" id="active" value="1">Is Active</label>
                    </div>
                    <div class="form-group">
                        <label for="contact-body" class="col-sm-2">{{ trans('cms.page.contact.body') }}</label>
                        <textarea name="body" id="contact-body" class="form-control" rows="2" cols="80"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary submit-form"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('shop.product_image.edit') }}</button>
            </div>
        </div>
    </div>
</div>