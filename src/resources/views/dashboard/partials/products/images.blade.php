<h5>{{ trans('messages.product_image') }}</h5>

<div class="row">
    <div class="col-md-12 dropzone-parent dropzone-previews" id="dropzonePreview">

        @if(isset($selected_images))
            @foreach($selected_images as $selected_image)
                <div class="single-item item-shadow">
                    <img class="img-responsive full-width" alt="{{$selected_image->name}}"
                         src="{{$selected_image->getImageByThumb('gallery_2')}}">
                    <div class="item-info">
                        <a href="javascript:void(0)" class="click-button replace-scene-image"
                           data-product-id="{{$selected_image->getProductId()}}"
                           data-image-id="{{$selected_image->id}}">{{ trans('messages.replace_image') }}</a>
                        <a class="click-button delete-scene-image"
                           data-product-id="{{$selected_image->getProductId()}}"
                           data-image-id="{{$selected_image->id}}">{{ trans('messages.delete_image') }}</a>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="single-item empty-item item-shadow dropzone-holder" @if(isset($selected_images)) @if(count($selected_images) > 0) style="display:none" @endif @endif>
            <form action="{{ route("upload_multiple_images") }}" method="post" class="dropzone"
                  enctype="multipart/form-data" id="real-dropzone">
                <div>
                    <div class="dz-message"></div>
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                    <i class="icon-picture"></i>
                    <div class="item-info show-info">
                        <a href="javascript:void(0)" class="click-button open-uploader-dropzone">{{ trans('messages.upload_product_image') }}</a>
                    </div>
                </div>
                {{ csrf_field() }}

            </form>
        </div>

    </div>
</div>