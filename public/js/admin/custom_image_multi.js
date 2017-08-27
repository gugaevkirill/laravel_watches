$(document).ready(function() {
    var vueUploadMultipleWithEdit = new Vue({
        el: '#custom-image-multi',
        data: {
            images: customImageMultiInit.images,
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