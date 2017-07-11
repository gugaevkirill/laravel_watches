<?php
    // Преобразуем объект к массиву
    $tmp = [];
    if (isset($field['value'])) {
        foreach ($field['value'] as $key => $val) {
            $tmp[] = ['slug' => $key, 'value' => $val];
        }
    }
    $field['value'] = $tmp;
?>

<div @include('crud::inc.field_wrapper_attributes') id="json-attrs-block">
    <label>{!! $field['label'] !!}</label>

    <div id="jsonattr">
        <div :class="['form-group', 'col-md-12', (!param.required || param.value) ? '' : 'has-error']" v-for="param in params" v-if="paramInCurrentCat(param)">
            <label class="col-md-4 col-xs-12">
                @{{ param.title_ru }}
                <i class="fa fa-copyright" v-if="param.unique" data-toggle="tooltip" data-placement="bottom" title="Уникальный"></i>
            </label>

            <input  v-if="param.type == 'string'"  type="text"     v-model="param.value" class="col-md-7 col-xs-11">
            <input  v-if="param.type == 'integer'" type="number"   v-model="param.value" class="col-md-7 col-xs-11">
            <input  v-if="param.type == 'boolean'" type="checkbox" v-model="param.value" class="col-md-7 col-xs-11">
            <select v-if="param.type == 'select'"  v-model="param.value" class="col-md-7 col-xs-11">
                <option :value="val.id" v-for="val in values" v-if="val.param_slug==param.slug">@{{ val.value_ru }}</option>
            </select>

            <a href="" @click.stop.prevent="clearParam(param.slug)" class="col-xs-1" v-if="param.type != 'boolean' && param.value">
                <i class="fa fa-close text-muted" data-toggle="tooltip" data-placement="right" title="Очистить"></i>
            </a>
        </div>

        <input type="hidden" name="attrs" v-model="jsonAttrs">
    </div>
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    @push('crud_fields_scripts')
    <script>
        var categorySelect = $("select[name='category_slug']");

        var vueJsonAttr = new Vue({
            el: '#jsonattr',
            data: {
                params: JSON.parse('{!! json_encode($field['params']) !!}'),
                values: JSON.parse('{!! json_encode($field['values']) !!}'),
                categories: JSON.parse('{!! json_encode($field['categories']) !!}'),

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
                var attributes = JSON.parse('{!! json_encode($field['value']) !!}');
                attributes.forEach(function (attr) {
                    var param = that.getParamBySlug(attr.slug);
                    param.value = attr.value;
                });

                setInterval(function () {
                    that.$forceUpdate();
                }, 500);
            },

            computed: {
                // Вид атрибутов в формате json для сохранения в админке
                jsonAttrs: {
                    get:function () {
                        var that = this;
                        var tmp = {};

                        this.params.forEach(function (param) {
                            if (param.value === null && param.type == 'boolean') {
                                param.value = false;
                            }

                            // Отбрасываем пустые параметры и параметры, не принадлежащие категории
                            if (!param.hasOwnProperty('value')
                                || param.value === null
                                || !that.paramInCurrentCat(param)
                            ) {
                                return false;
                            }

                            tmp[param.slug] = param.value;
                        });

                        return JSON.stringify(tmp);
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
    </script>
    @endpush
@endif