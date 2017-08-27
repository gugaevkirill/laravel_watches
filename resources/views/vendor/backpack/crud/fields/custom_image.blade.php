<?php declare(strict_types=1);

use \App\Models\Catalog;

$imageUrl = '';

if (isset($field['value'])) {
    $imageUrl = $field['prefix'] . $field['value'] . $field['imgFormat'];
} elseif (isset($field['default'])) {
    $imageUrl = $field['default'];
}

?>


{{-- Extra CSS and JS for this particular field --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    @push('crud_fields_styles')
    <link href="{{ asset('vendor/backpack/cropper/dist/cropper.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('crud_fields_scripts')
    <script src="{{ asset('vendor/backpack/cropper/dist/cropper.min.js') }}"></script>
    <script src="/js/admin/custom_image.js"></script>
    @endpush
@endif


<div class="form-group col-md-12 image" data-preview="#{{ $field['name'] }}" data-aspectRatio="{{ isset($field['aspect_ratio']) ? $field['aspect_ratio'] : 0 }}" data-crop="{{ isset($field['crop']) ? $field['crop'] : false }}" @include('crud::inc.field_wrapper_attributes')>
<div>
    <label>{!! $field['label'] !!}</label>
    @include('crud::inc.field_translatable_icon')
</div>
<!-- Wrap the image or canvas element with a block element (container) -->
<div class="row">
    <div class="col-sm-6" style="margin-bottom: 20px;">
        <img id="mainImage" src="{{ $imageUrl }}">
    </div>
    @if(isset($field['crop']) && $field['crop'])
    <div class="col-sm-3">
        <div class="docs-preview clearfix">
            <div id="{{ $field['name'] }}" class="img-preview preview-lg">
                <img src="" style="display: block; min-width: 0px !important; min-height: 0px !important; max-width: none !important; max-height: none !important; margin-left: -32.875px; margin-top: -18.4922px; transform: none;">
            </div>
        </div>
    </div>
    @endif
</div>
<div class="btn-group">
    <label class="btn btn-primary btn-file">
        {{ trans('backpack::crud.choose_file') }} <input type="file" accept="image/*" id="uploadImage"  @include('crud::inc.field_attributes', ['default_class' => 'hide'])>
        <input type="hidden" id="hiddenImage" name="{{ $field['name'] }}">
    </label>
    @if(isset($field['crop']) && $field['crop'])
    <button class="btn btn-default" id="rotateLeft" type="button" style="display: none;"><i class="fa fa-rotate-left"></i></button>
    <button class="btn btn-default" id="rotateRight" type="button" style="display: none;"><i class="fa fa-rotate-right"></i></button>
    <button class="btn btn-default" id="zoomIn" type="button" style="display: none;"><i class="fa fa-search-plus"></i></button>
    <button class="btn btn-default" id="zoomOut" type="button" style="display: none;"><i class="fa fa-search-minus"></i></button>
    <button class="btn btn-warning" id="reset" type="button" style="display: none;"><i class="fa fa-times"></i></button>
    @endif
    <button class="btn btn-danger" id="remove" type="button"><i class="fa fa-trash"></i></button>
</div>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
</div>
