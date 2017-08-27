<?php declare(strict_types=1);
/** @var array $field */
if (isset($field['value']) && is_array($field['value'])) {
    $images = $field['value'];
} else {
    $images = [];
}
?>

@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    @push('crud_fields_styles')
    <link href="{{ asset('vendor/backpack/cropper/dist/cropper.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('crud_fields_scripts')
    <script src="/js/admin/custom_image_multi.js"></script>
    <script src="{{ asset('vendor/backpack/cropper/dist/cropper.min.js') }}"></script>
    @endpush

    <script>
        var customImageMultiInit = {
            images: JSON.parse('{!! json_encode($images) !!}')
        }
    </script>
@endif

<div @include('crud::inc.field_wrapper_attributes') >
    <div id="custom-image-multi">
        <label>{!! $field['label'] !!}</label>

        <ul class="well well-sm images-container" v-if="images.length">
            <li v-for="image, i in images">
                <img :src="getFullUrl(image)" @click.stop="openCropper(image)" class="cursor-pointer" v-if="isBase64(image)">
                <img :src="getFullUrl(image)" v-else>
                <i class="fa fa-trash clear-button" @click.stop="remove(image)"></i>
                <i class="fa fa-arrow-right right-button rlb" @click.stop="moveRight(image)" v-if="i < images.length - 1"></i>
                <i class="fa fa-arrow-left left-button rlb" @click.stop="moveLeft(image)" v-if="i > 0"></i>
            </li>
        </ul>

        {{-- Редактор фотографий --}}
        <div class="form-group col-md-12 image hidden" data-aspectRatio="{{ isset($field['aspect_ratio']) ? $field['aspect_ratio'] : 0 }}" @include('crud::inc.field_wrapper_attributes')>
            <div class="row">
                <div class="col-sm-6" style="margin-bottom: 20px;">
                    <img class="mainImage" src="">
                </div>

                <div class="col-sm-3">
                    <div class="docs-preview clearfix">
                        <div class="img-preview preview-lg">
                            <img src="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-group">
                <button class="btn btn-success accept" type="button" @click.stop="acceptCropper()"><i class="fa fa-check-circle"></i> Применить</button>
                <button class="btn btn-default rotateLeft" type="button" ><i class="fa fa-rotate-left"></i></button>
                <button class="btn btn-default rotateRight" type="button"><i class="fa fa-rotate-right"></i></button>
                <button class="btn btn-default zoomIn" type="button"><i class="fa fa-search-plus"></i></button>
                <button class="btn btn-default zoomOut" type="button"><i class="fa fa-search-minus"></i></button>
                <button class="btn btn-warning reset" type="button"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <!-- Инпут на добавление картинок -->
        <input name="{{ $field['name'] }}[]" type="hidden" :value="image" v-for="image in images">
        <input name="{{ $field['name'] }}" type="hidden" value="" v-if="images.length == 0">

        <!-- Инпут на удаление картинок -->
        <input name="clean_{{ $field['name'] }}[]" type="hidden" :value="image" v-for="image in images_to_remove" v-if="!isBase64(image)">

        <input
                type="file"
                accept="image/*"
                class="custom-image-multi-input"
                @include('crud::inc.field_attributes')
                multiple
        >

        {{-- HINT --}}
        @if (isset($field['hint']))
            <p class="help-block">{!! $field['hint'] !!}</p>
        @endif
    </div>
</div>
