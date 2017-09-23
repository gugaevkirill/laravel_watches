<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Catalog;

class ProductArchive extends Product
{
    public function setUp()
    {
        parent::setUp();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Catalog\ProductArchived::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/archive');
        $this->crud->setEntityNameStrings('archived product', 'archived products');
    }
}
