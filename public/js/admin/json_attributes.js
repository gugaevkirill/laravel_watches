var categorySelect = $("select[name='category_slug']");

var vueJsonAttr = new Vue({
    el: '#jsonattr',
    data: {
        params: jsonattrsInit.params,
        values: jsonattrsInit.values,
        categories: jsonattrsInit.categories,
        locale: jsonattrsInit.locale,

        // Текущие значения
        category: categorySelect.find("option:selected").val()
    },

    created: function () {
        var that = this;

        // Подписываемся на изменение категории
        categorySelect.change(function () {
            that.category = $(this).val();
        });

        // Первоначальные значения параметрам
        jsonattrsInit.attributes.forEach(function (attr) {
            var param = that.getParamBySlug(attr.slug);

            // Меняем поведение для строк
            // Редактировать будем только значение в одной локали, а сохранять все
            if (param.type == "string") {
                param.multilangValue = attr.value;
                param.value = _.get(attr.value, that.locale);
            } else {
                param.value = attr.value;
            }
        });

        setInterval(function () {
            that.$forceUpdate();
        }, 500);
    },

    computed: {
        // Вид атрибутов в формате json для сохранения в админке
        jsonAttrs: {
            get: function () {
                var that = this;
                var result = {};

                this.params.forEach(function (param) {
                    var valueToSave = param.value;

                    switch (param.type) {
                        case 'string':
                            var tmp = {};
                            tmp[that.locale] = param.value;
                            valueToSave = _.omitBy(_.assign(param.multilangValue, tmp), _.isEmpty);

                            break;
                    }


                    // Отбрасываем пустые параметры и параметры, не принадлежащие категории
                    if (!param.hasOwnProperty('value')
                        || param.value === null
                        || _.isEqual(valueToSave, {})
                        || !that.paramInCurrentCat(param)
                    ) {
                        return false;
                    }

                    result[param.slug] = valueToSave;
                });

                return JSON.stringify(result);
            },
            cache: false
        }
    },

    methods: {
        getParamBySlug: function (needleSlug) {
            return this.params.find(function (param) {
                return param.slug == needleSlug;
            })
        },

        clearParam: function (slug) {
            console.log('Clear param: ' + slug);
            this.$set(this.getParamBySlug(slug), 'value', null);
        },

        paramInCurrentCat: function (param) {
            return param.categories.indexOf(this.category) != -1;
        }
    }
});