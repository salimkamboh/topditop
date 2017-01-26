<h5>{{ trans('messages.references_scenes') }}﻿</h5>
<div class="row dropzone-parent dropzone-previews" id="dropzonePreview" data-max="{{$allowed_images}}">
    @if(isset($selected_images))
        @foreach($selected_images as $selected_image)
            <div class="col-md-6">
                <div class="single-item item-shadow">
                    <img class="img-responsive" alt="{{$selected_image->name}}"
                         src="{{$selected_image->getImageByThumb('reference_thumb')}}">
                    <div class="item-info">
                        <a href="javascript:void(0)" class="click-button replace-scene-image"
                           data-reference-id="{{$selected_image->getReferenceId()}}"
                           data-image-id="{{$selected_image->id}}">{{ trans('messages.replace_scene') }}</a>
                        <a class="click-button delete-scene-image"
                           data-reference-id="{{$selected_image->getReferenceId()}}"
                           data-image-id="{{$selected_image->id}}">{{ trans('messages.delete_scene') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="col-md-6">
        <div class="single-item empty-item item-shadow dropzone-holder"
             @if(isset($selected_images)) @if(count($selected_images) >= $allowed_images) style="display:none" @endif @endif>

            <form action="{{ route("upload_multiple_images") }}" method="post" class="dropzone"
                  enctype="multipart/form-data" id="real-dropzone">
                <div>
                    <div class="dz-message"></div>
                    <div class="fallback">
                        <input name="file" type="file" multiple/>
                    </div>
                    <i class="icon-picture"></i>
                    <div class="item-info show-info">
                        <a href="javascript:void(0)"
                           class="click-button open-uploader-dropzone">{{ trans('messages.upload_scenes') }}</a>
                    </div>
                </div>
                {{ csrf_field() }}

            </form>
        </div>
    </div>
</div>