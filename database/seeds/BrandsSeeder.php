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
            'image' => 'img/brands/arnold_and_son.png'
        ]);


        $this->createBrand([
            'slug' => 'audemars_piguet',
            'name' => 'Audemars Piguet',
            'image' => 'img/brands/audemars_piguet.png'
        ]);

        $this->createBrand([
            'slug' => 'blancpain',
            'name' => 'Blancpain',
            'image' => 'img/brands/blancpain.png'
        ]);

        $this->createBrand([
            'slug' => 'bovet',
            'name' => 'Bovet',
            'image' => 'img/brands/bovet.png'
        ]);

        $this->createBrand([
            'slug' => 'breguet',
            'name' => 'Breguet',
            'image' => 'img/brands/breguet.png'
        ]);

        $this->createBrand([
            'slug' => 'bvlgary',
            'name' => 'Bvlgary',
            'image' => 'img/brands/bvlgari.png'
        ]);

        $this->createBrand([
            'slug' => 'cartier',
            'name' => 'Cartier',
            'image' => 'img/brands/cartier.png'
        ]);

        $this->createBrand([
            'slug' => 'chanel',
            'name' => 'Chanel',
            'image' => 'img/brands/chanel.png'
        ]);

        $this->createBrand([
            'slug' => 'concord',
            'name' => 'Concord',
            'image' => 'img/brands/concord.png'
        ]);

        $this->createBrand([
            'slug' => 'corum',
            'name' => 'Corum',
            'image' => 'img/brands/corum.png',
        ]);

        $this->createBrand([
            'slug' => 'de_bethune',
            'name' => 'De Bethune',
            'image' => 'img/brands/de-bethune.jpg'
        ]);

        $this->createBrand([
            'slug' => 'de_grisogono',
            'name' => 'De Grisogono',
            'image' => 'img/brands/deGrisogono.png'
        ]);

        $this->createBrand([
            'slug' => 'dewitt',
            'name' => 'DeWitt',
            'image' => 'img/brands/dewitt.png'
        ]);

        $this->createBrand([
            'slug' => 'jacob_co',
            'name' => 'Jacob & Co. Watches',
            'image' => ''
        ]);

        $this->createBrand([
            'slug' => 'jaeger_lecoultre',
            'name' => 'Jaeger LeCoultre',
            'image' => 'img/brands/jaeger_lecoultre.jpeg'
        ]);

        $this->createBrand([
            'slug' => 'jaquet_droz',
            'name' => 'Jaquet Droz',
            'image' => 'img/brands/jaquet_droz.jpg'
        ]);

        $this->createBrand([
            'slug' => 'louis_moinet',
            'name' => 'Louis Moinet',
            'image' => 'img/brands/louis_moinet.jpg'
        ]);

        $this->createBrand([
            'slug' => 'girrard_perregaux',
            'name' => 'Girrard Perregaux',
            'image' => 'img/brands/girrard_perregaux.png'
        ]);

        $this->createBrand([
            'slug' => 'patek_philippe',
            'name' => 'Patek Philippe',
            'image' => 'img/brands/patek_philippe.png'
        ]);

        $this->createBrand([
            'slug' => 'richard_mille',
            'name' => 'Richard Mille',
            'image' => 'img/brands/richard_mille.png'
        ]);

        $this->createBrand([
            'slug' => 'roger_dubuis',
            'name' => 'Roger Dubuis',
            'image' => 'img/brands/roger_dubuis.png'
        ]);

        $this->createBrand([
            'slug' => 'rolex',
            'name' => 'Rolex',
            'image' => 'img/brands/rolex.png'
        ]);

        $this->createBrand([
            'slug' => 'thomas_prescher',
            'name' => 'Thomas Prescher',
            'image' => 'img/brands/thomas_prescher.jpg'
        ]);

        $this->createBrand([
            'slug' => 'ulysse_nardin',
            'name' => 'Ulysse Nardin',
            'image' => 'img/brands/ulysse_nardin.png'
        ]);

        $this->createBrand([
            'slug' => 'urwerk',
            'name' => 'Urwerk',
            'image' => 'img/brands/urwerk.png'
        ]);

        $this->createBrand([
            'slug' => 'zenith',
            'name' => 'Zenith',
            'image' => 'img/brands/zenith.png'
        ]);
    }
}
