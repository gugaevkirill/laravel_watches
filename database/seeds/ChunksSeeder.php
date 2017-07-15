<?php

use Illuminate\Database\Seeder;
use App\Models\Content\Chunk;

class ChunksSeeder extends Seeder
{
    /**
     * @param array $data
     */
    private function createChunk(array $data)
    {
        Chunk::create($data);
        echo '.';
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createChunk([
            'slug' => 'phone1',
            'title' => 'Городской телефон',
            'content' => [
                'ru' => '+7 (495) 972-65-40',
            ],
        ]);

        $this->createChunk([
            'slug' => 'phone1href',
            'title' => 'Href на городской телефон',
            'content' => [
                'ru' => 'tel:+74959726540',
            ],
        ]);

        $this->createChunk([
            'slug' => 'phone2',
            'title' => 'WhatsApp телефон',
            'content' => [
                'ru' => '+7 (985) 157-25-00',
            ],
        ]);

        $this->createChunk([
            'slug' => 'phone2href',
            'title' => 'Href на WhatsApp телефон',
            'content' => [
                'ru' => 'tel:+79851572500',
            ],
        ]);

        $this->createChunk([
            'slug' => 'email',
            'title' => 'Email',
            'content' => [
                'ru' => 'info@elitebazaar.ru',
            ],
        ]);

        $this->createChunk([
            'slug' => 'title',
            'title' => 'Title',
            'content' => [
                'ru' => 'Элитный ломбард швейцарских часов',
            ],
        ]);

        $this->createChunk([
            'slug' => 'address',
            'title' => 'Адрес',
            'content' => [
                'ru' => 'г. Москва, ул. Кутузовский проспект, д. 7/4, к1',
            ],
        ]);

        $this->createChunk([
            'slug' => 'social-box',
            'title' => 'Ссылки на соц. сети',
            'content' => [
                'ru' => '<a href="http://vk.com"><i class="fa fa-vk"></i></a><a href="http://facebook.com/"><i class="fa fa-facebook"></i></a>',
            ],
        ]);

        $this->createChunk([
            'slug' => 'copyright',
            'title' => 'Копирайт',
            'content' => [
                'ru' => 'TODO: написать копирайт',
            ],
        ]);

        $this->createChunk([
            'slug' => 'footer-description',
            'title' => 'Футер - текст про нас',
            'content' => [
                'ru' => 'Тут будет какой то очень занимательный текст',
            ],
        ]);

        $this->createChunk([
            'slug' => 'working-hours',
            'title' => 'Часы работы',
            'content' => [
                'ru' => '<b>Пн-Пт:</b> 10.00 - 21.00',
            ],
        ]);

        $this->createChunk([
            'slug' => 'map-lat',
            'title' => 'Google map Latitude',
            'content' => [
                'ru' => '55.7488404',
            ],
        ]);

        $this->createChunk([
            'slug' => 'map-lng',
            'title' => 'Google map Longitude',
            'content' => [
                'ru' => '37.5639504',
            ],
        ]);

    }
}
