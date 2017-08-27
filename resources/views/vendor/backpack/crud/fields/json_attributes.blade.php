<?php
    // Текущий выбранный язык
    /** @var \Backpack\CRUD\CrudPanel $crud */
    $locale = $crud->request->get('locale') ?? \App\Repositories\LangRepository::DEFAULT_LOCALE;

    // Преобразуем объект к массиву
    $tmp = [];
    if (isset($field['value'])) {
        foreach ($field['value'] as $key => $val) {
            $tmp[] = ['slug' => $key, 'value' => $val];
        }
    }
    $field['value'] = $tmp;
?>

<!-- Значения по-умолчанию для компонента JsonAttrs -->
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    @push('crud_fields_scripts')
    <script>
        var jsonattrsInit = {
            params: JSON.parse('{!! json_encode($field['params']) !!}'),
            values: JSON.parse('{!! json_encode($field['values']) !!}'),
            categories: JSON.parse('{!! json_encode($field['categories']) !!}'),
            attributes: JSON.parse('{!! json_encode($field['value']) !!}'),
            locale: '{{ $locale }}',
        };
    </script>
    <script src="/js/admin/jsonattrs.js"></script>
    @endpush
@endif

<div @include('crud::inc.field_wrapper_attributes') id="json-attrs-block">
    <label>{!! $field['label'] !!}</label>

    <div id="jsonattr">
        <div :class="['form-group', 'col-md-12', (!param.required || param.value) ? '' : 'has-error']" v-for="param in params" v-if="paramInCurrentCat(param)">
            <label class="col-md-4 col-xs-12">
                @{{ param.title }}
                <i class="fa fa-copyright" v-if="param.unique" data-toggle="tooltip" data-placement="bottom" title="Уникальный"></i>
            </label>

            <input  v-if="param.type == 'string'"  type="text"     v-model="param.value" class="col-md-7 col-xs-11">
            <input  v-if="param.type == 'integer'" type="number"   v-model="param.value" class="col-md-7 col-xs-11">
            <input  v-if="param.type == 'boolean'" type="checkbox" v-model="param.value" class="col-md-7 col-xs-11">
            <select v-if="param.type == 'select'"  v-model="param.value" class="col-md-7 col-xs-11">
                <option :value="val.id" v-for="val in values" v-if="val.param_slug==param.slug">@{{ val.value }}</option>
            </select>

            <a href="" @click.stop.prevent="clearParam(param.slug)" class="col-xs-1" v-if="param.type != 'boolean' && param.value">
                <i class="fa fa-close text-muted" data-toggle="tooltip" data-placement="right" title="Очистить"></i>
            </a>
        </div>

        <input type="hidden" name="attrs" v-model="jsonAttrs">
    </div>
</div>