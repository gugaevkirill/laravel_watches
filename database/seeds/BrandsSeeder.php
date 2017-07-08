<?php

use Illuminate\Database\Seeder;
use App\Models\Catalog\Brand;

class BrandsSeeder extends Seeder
{
    private function createBrand(array $data)
    {
        factory(Brand::class)->create($data);
        echo '.';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createBrand([
            'slug' => 'arnold_son',
            'name' => 'Arnold & Son',
        ]);


        $this->createBrand([
            'slug' => 'audemars_piguet',
            'name' => 'Audemars Piguet',
        ]);

        $this->createBrand([
            'slug' => 'blancpain',
            'name' => 'Blancpain',
        ]);

        $this->createBrand([
            'slug' => 'bovet',
            'name' => 'Bovet',
        ]);

        $this->createBrand([
            'slug' => 'breguet',
            'name' => 'Breguet',
        ]);

        $this->createBrand([
            'slug' => 'bvlgary',
            'name' => 'Bvlgary',
        ]);

        $this->createBrand([
            'slug' => 'cartier',
            'name' => 'Cartier',
        ]);

        $this->createBrand([
            'slug' => 'chanel',
            'name' => 'Chanel',
        ]);

        $this->createBrand([
            'slug' => 'concord',
            'name' => 'Concord',
        ]);

        $this->createBrand([
            'slug' => 'corum',
            'name' => 'Corum',
        ]);

        $this->createBrand([
            'slug' => 'de_bethune',
            'name' => 'De Bethune',
        ]);

        $this->createBrand([
            'slug' => 'de_grisogono',
            'name' => 'De Grisogono',
        ]);

        $this->createBrand([
            'slug' => 'dewitt',
            'name' => 'DeWitt',
        ]);

        $this->createBrand([
            'slug' => 'jacob_co',
            'name' => 'Jacob & Co. Watches',
        ]);

        $this->createBrand([
            'slug' => 'jaeger_lecoultre',
            'name' => 'Jaeger LeCoultre',
        ]);

        $this->createBrand([
            'slug' => 'jaquet_droz',
            'name' => 'Jaquet Droz',
        ]);

        $this->createBrand([
            'slug' => 'louis_moinet',
            'name' => 'Louis Moinet',
        ]);

        $this->createBrand([
            'slug' => 'girrard_perregaux',
            'name' => 'Girrard Perregaux',
        ]);

        $this->createBrand([
            'slug' => 'patek_philippe',
            'name' => 'Patek Philippe',
        ]);

        $this->createBrand([
            'slug' => 'richard_mille',
            'name' => 'Richard Mille',
        ]);

        $this->createBrand([
            'slug' => 'roger_dubuis',
            'name' => 'Roger Dubuis',
        ]);

        $this->createBrand([
            'slug' => 'rolex',
            'name' => 'Rolex',
        ]);

        $this->createBrand([
            'slug' => 'thomas_prescher',
            'name' => 'Thomas Prescher',
        ]);

        $this->createBrand([
            'slug' => 'ulysse_nardin',
            'name' => 'Ulysse Nardin',
        ]);

        $this->createBrand([
            'slug' => 'urwerk',
            'name' => 'Urwerk',
        ]);

        $this->createBrand([
            'slug' => 'zenith',
            'name' => 'Zenith',
        ]);
    }
}
