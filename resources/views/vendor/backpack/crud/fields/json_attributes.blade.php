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

<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>

    <div id="jsonattr">
        <div class="form-group col-md-12" v-for="(attr, index) in attributes">
            <label class="col-md-4 col-xs-12">
                <a href="#" @click.stop.prevent="removeAttr(index)"><i class="fa fa-trash-o"></i></a>
                &nbsp;&nbsp;@{{ attr.title_ru }}
            </label>

            <input v-if="attr.type == 'string'" type="text" v-model="attr.value" class="col-md-8 col-xs-12">
            <input v-if="attr.type == 'integer'" type="number" v-model="attr.value" class="col-md-8 col-xs-12">
            <input v-if="attr.type == 'boolean'" type="checkbox" v-model="attr.value" class="col-md-8 col-xs-12">
            <select v-if="attr.type == 'select'" v-model="attr.value" class="col-md-8 col-xs-12">
                <option :value="val.id" v-for="val in getParamBySlug(attr.slug).values">@{{ val.value_ru }}</option>
            </select>
        </div>

        <div class="form-group col-md-12" v-if="availableParams.length">
            <div class="col-xs-12" style="border-top: 1px solid lightgrey; padding-top: 15px;"></div>
            <label class="col-md-3 col-xs-12">
                Добавить новый:
            </label>

            <select v-model="tmpParamSlug" class="col-md-4 col-xs-12">
                <option :value="param.slug" v-for="param in availableParams">@{{ param.title_ru }}</option>
            </select>

            <div class="col-md-5">
                <a href="#" class="btn btn-info" @click.stop.prevent="addAttr(tmpParamSlug)">Добавить</a>
            </div>
        </div>

        <input type="hidden" name="attrs" v-model="jsonAttrs">
    </div>
</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
    <!-- no styles -->
    @endpush


    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
    <script src="/js/vue.js"></script>
    <script>
        var vueJsonAttr = new Vue({
            el: '#jsonattr',
            data: {
                attributes: JSON.parse('{!! json_encode($field['value']) !!}'),
                params: JSON.parse('{!! json_encode($field['params']) !!}'),
                tmpParamSlug: null
            },

            created: function () {
                var that = this;
                this.attributes.forEach(function (attr) {
                    param = that.getParamBySlug(attr.slug);
                    attr.title_ru = param ? param.title_ru : '???';
                    attr.type = param ? param.type : 'string';
                });
            },

            computed: {
                availableParams: function () {
                    var that = this;

                    return this.params.filter(function (param) {
                        return !that.attributes.find(function (attr) {
                            return attr.slug == param.slug;
                        });
                    });
                },

                jsonAttrs: function () {
                    var tmp = {};
                    this.attributes.forEach(function (attr) {
                        console.log([attr.slug, attr.value]);
                        tmp[attr.slug] = attr.value;
                    });

                    return JSON.stringify(tmp);
                }
            },

            methods: {
                getParamBySlug: function (needleSlug) {
                    return this.params.find(function (param) {
                        return param.slug == needleSlug;
                    })
                },

                removeAttr: function (num) {
                    console.log('Remove attr: ' + num);
                    this.attributes.splice(num, 1);
                },

                addAttr: function (slug) {
                    param = this.getParamBySlug(slug);
                    if (!param) {
                        return false;
                    }

                    console.log('Add attr: ' + slug);

                    this.attributes.push({
                        slug: slug,
                        title_ru: param.title_ru,
                        value: null,
                        type: param.type
                    });
                }
            }
        });
    </script>
    @endpush
@endif

{{-- Note: most of the times you'll want to use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load CSS/JS once, even though there are multiple instances of it. --}}