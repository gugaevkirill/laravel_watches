<?php
/** @var array $field */
if (isset($field['value']) && is_array($field['value'])) {
    $images = $field['value'];
} else {
    $images = [];
}
?>

<!-- upload multiple input -->
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

@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    @push('crud_fields_styles')
        <link href="{{ asset('vendor/backpack/cropper/dist/cropper.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush

    @push('crud_fields_scripts')
        <script src="{{ asset('vendor/backpack/cropper/dist/cropper.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                var vueUploadMultipleWithEdit = new Vue({
                    el: '#custom-image-multi',
                    data: {
                        images: JSON.parse('{!! json_encode($images) !!}'),
                        images_to_remove: [],
                        openInCropper: null,
                        mainImage: null,
                    },
                    mounted: function () {
                        var that = this;

                        // Обработчик файлового инпута
                        var fileInput = $(this.$el).find(".custom-image-multi-input");
                        fileInput.change(function() {
                            if (!this.files.length) {
                                return;
                            }

                            for (var i = 0, file; file = this.files[i]; i++) {
                                var fileReader = new FileReader();

                                if (/^image\/\w+$/.test(file.type)) {
                                    fileReader.readAsDataURL(file);
                                    fileReader.onload = function () {
                                        that.images.push(this.result);
                                    };
                                } else {
                                    alert("Please choose an image file.");
                                }
                            }

                            fileInput.val("");
                        });
                    },
                    methods: {
                        isBase64: function (input) {
                            return _.toString(input).match('data:image/*');
                        },
                        getFullUrl: function (img) {
                            if (this.isBase64(img)) {
                                return img;
                            }

                            return "/storage/products/" + img + ".jpg";
                        },
                        hideCropper: function () {
                            $(this.$el).find('.image').addClass('hidden');
                        },
                        showCropper: function () {
                            $(this.$el).find('.image').removeClass('hidden');
                        },
//                        getBase64FromImageUrl (url) {
//                            var promise = new Promise(function(resolve, reject) {
//                                var img = new Image();
//                                img.setAttribute('crossOrigin', 'anonymous');
//                                img.onload = function () {
//                                    var canvas = document.createElement("canvas");
//                                    canvas.width =this.width;
//                                    canvas.height =this.height;
//
//                                    var ctx = canvas.getContext("2d");
//                                    ctx.drawImage(this, 0, 0);
//
//                                    var dataURL = canvas.toDataURL("image/png");
//                                    resolve(dataURL);
//
////                                alert(dataURL.replace(/^data:image\/(png|jpg);base64,/, ""));
//                                };
//                                img.src = url;
//                            });
//
//                            async function getAns () {
//                                return await promise;
//                            }
//
//                            return getAns();
//                        },
                        openCropper: function (img) {
                            var that = this;
                            this.openInCropper = img;

                            // Инициализируем Cropper в первый раз
                            if (!this.mainImage) {
                                this.mainImage = $(this.$el).find('.mainImage');

                                this.mainImage.cropper({
                                    viewMode: 2,
                                    checkOrientation: false,
                                    autoCropArea: 1,
                                    responsive: true,
                                    preview: $(this.$el).find('.img-preview'),
                                    aspectRatio: $(this).attr('data-aspectRatio')
                                }).cropper("reset", true);

                                $(this.$el).find(".rotateLeft").click(function () {
                                    that.mainImage.cropper("rotate", 90);
                                });

                                $(this.$el).find(".rotateRight").click(function () {
                                    that.mainImage.cropper("rotate", -90);
                                });

                                $(this.$el).find(".zoomIn").click(function () {
                                    that.mainImage.cropper("zoom", 0.1);
                                });

                                $(this.$el).find(".zoomOut").click(function () {
                                    that.mainImage.cropper("zoom", -0.1);
                                });

                                $(this.$el).find(".reset").click(function () {
                                    that.mainImage.cropper("reset");
                                });
                            }

//                            if (!this.isBase64(img)) {
//                                base64 = this.getBase64FromImageUrl('/storage/products/' + img + '.jpg');
//                                console.log(base64);
//                            }

                            this.mainImage.cropper("replace", img);
                            this.showCropper();
                        },
                        acceptCropper() {
                            var that = this;

                            index = _.findIndex(this.images, function (el) { return el === that.openInCropper; });
                            this.$set(this.images, index, this.mainImage.cropper('getCroppedCanvas').toDataURL());

                            // Скрыть cropper
                            this.hideCropper();
                        },
                        remove: function (img) {
                            this.images = _.remove(this.images, function (el) {
                                return el !== img;
                            });
                            this.images_to_remove.push(img);

                            if (img === this.openInCropper) {
                                this.hideCropper();
                            }
                        },
                        moveRight: function (img) {
                            var that = this,
                                index = _.findIndex(this.images, function (el) { return el === img; });

                            if (index === this.images.length) {
                                return;
                            }

                            console.log(index);

                            this.hideCropper();
                            this.$set(this.images, index, this.images[index + 1]);
                            this.$set(this.images, index + 1, img);
                        },
                        moveLeft: function (img) {
                            var that = this,
                                index = _.findIndex(this.images, function (el) { return el === img; });

                            if (index === 0) {
                                return;
                            }

                            this.hideCropper();
                            this.$set(this.images, index, this.images[index - 1]);
                            this.$set(this.images, index - 1, img);
                        },
                    }
                });
            });
        </script>
    @endpush
@endif
