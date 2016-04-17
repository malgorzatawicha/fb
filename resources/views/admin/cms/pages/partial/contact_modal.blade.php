<div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="createContactModalLabel">{{trans('admin.pages.contacts.create')}}</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="contact-name">{{trans('admin.pages.contacts.name')}} <span class="required">*</span></label>
                        <input type="text" name="name" id="contact-name" class="form-control">
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="active" id="contact-active-hidden" value="0">
                        <label><input type="checkbox" name="active" id="contact-active" value="1">{{trans('admin.pages.contacts.active')}}</label>
                    </div>
                    <div class="form-group">
                        <label for="contact-body" class="col-sm-2">{{ trans('admin.pages.contacts.body') }} <span class="required">*</span></label>
                        <textarea name="body" id="contact-body" class="form-control" rows="2" cols="80"></textarea>
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