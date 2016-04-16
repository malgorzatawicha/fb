<div class="modal fade" id="friendModal" tabindex="-1" role="dialog" aria-labelledby="friendModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="friendModalLabel">Create Friend</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="friend-name">Friend Name:</label>
                        <input type="text" name="name" id="friend-name" class="form-control">
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="active" id="friend-active-hidden" value="0">
                        <label><input type="checkbox" name="active" id="friend-active" value="1">Is Active</label>
                    </div>
                    <div class="form-group">
                        <label for="friend-description" class="col-sm-2">{{ trans('cms.page.friend.description') }}</label>
                        <textarea name="description" id="friend-description" class="form-control" rows="2" cols="80"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="friend-url">Url:</label>
                        <input type="url" name="url" id="friend-url" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="friend-file">Image:</label>
                        <input type="hidden" class="existing" name="file_existing" id="friend-file_existing">
                        <input type="file" name="file" id="friend-file">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary submit-form"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('cms.pages.friends.add') }}</button>
            </div>
        </div>
    </div>
</div>