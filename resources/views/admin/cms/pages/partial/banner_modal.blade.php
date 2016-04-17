<div class="modal fade" id="bannerModal" tabindex="-1" role="dialog" aria-labelledby="bannerModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="bannerModalLabel">{{trans('admin.pages.banners.create')}}</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form" enctype="multipart/form-data">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="banner-name">{{trans('admin.pages.banners.name')}} <span class="required">*</span></label>
                        <input type="text" name="name" id="banner-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="banner-description">{{ trans('admin.pages.banners.description') }}</label>
                        <textarea style="resize: vertical" name="description" id="banner-description" class="form-control" rows="2" cols="80"></textarea>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="active" id="banner-active-hidden" value="0">
                        <label><input type="checkbox" name="active" id="banner-active" value="1">{{trans('admin.pages.banners.active')}}</label>
                    </div>
                    <div class="checkbox">
                        <input type="hidden" name="watermarked" id="banner-watermarked-hidden" value="0">
                        <label><input type="checkbox" name="watermarked" id="banner-watermarked" value="1">{{trans('admin.pages.banners.already_has_watermark')}}</label>
                    </div>
                    <div class="form-group">
                        <label for="banner-file">{{trans('admin.pages.banners.image')}} <span class="required">*</span></label>
                        <input type="hidden" class="existing" name="file_existing" id="banner-file_existing">
                        <input type="file" name="file" id="banner-file">
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