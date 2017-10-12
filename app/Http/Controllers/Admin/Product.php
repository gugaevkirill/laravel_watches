<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest as StoreRequest;
use App\Http\Requests\ProductRequest as UpdateRequest;
use App\Models\Catalog;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class Product extends CrudController
{
    public function setUp()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Catalog\Product::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/product');
        $this->crud->setEntityNameStrings('product', 'products');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS

        $this->crud->addField(
            [
                'name' => 'is_reserved',
                'label' => 'В резерве?',
                'type' => 'checkbox',
            ],
            'update'
        );

        $this->crud->addField(
            [
                'name' => 'is_active',
                'label' => 'Архивный?',
                'type' => 'checkbox',
            ],
            'update'
        );

        $this->crud->addField(
            [
                'name' => 'order',
                'label' => 'Сортировка',
                'type' => 'number',
                'default' => 100
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'label' => "Бренд",
                'name' => 'brand_slug', // the db column for the foreign key
                'type' => 'select_from_array',
                'options' => Catalog\Brand::all(['name', 'slug'])
                    ->pluck('name', 'slug')
                    ->toArray(),
                'allows_null' => false,
                'allows_multiple' => false,
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'label' => "Категория",
                'name' => 'category_slug', // the db column for the foreign key
                'type' => 'select_from_array',
                'options' => Catalog\Category::getForAdminPage(),
                'allows_null' => false,
                'allows_multiple' => false,
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'name' => 'attrs',
                'label' => 'Атрибуты',
                'type' => 'json_attributes',
                'categories' => Catalog\Category::getForAdminPage(),
                'params' => Catalog\Param::getForAdminPage(),
                'values' => Catalog\ParamValue::getForAdminPage(),
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'name' => 'imagesnew',
                'label' => 'Картинки',
                'type' => 'custom_image_multi',
                'upload' => true,
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'name' => 'price_usd',
                'label' => 'Цена, usd.',
                'type' => 'number',
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'name' => 'price_rub',
                'label' => 'Цена, руб.',
                'type' => 'number',
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'name' => 'price_eur',
                'label' => 'Цена, eur.',
                'type' => 'number',
            ],
            'update/create/both'
        );

        $this->crud->addField(
            [
                'label' => "Описание",
                'name' => 'descriptionnew',
                'type' => 'textarea',
            ],
            'update/create/both'
        );

        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->removeColumns(['attrs', 'imagesnew', 'descriptionnew', 'price_rub', 'price_usd', 'price_eur']);

        $this->crud->addColumn([
            // run a function on the CRUD model and show its return value
            'label' => "Картинка", // Table column heading
            'type' => "model_function",
            'function_name' => 'getAdminImagesHtml', // the method in your Model
            'upload' => true,
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
        ])->beforeField('attrs');

        $this->crud->removeButton('delete');

        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
