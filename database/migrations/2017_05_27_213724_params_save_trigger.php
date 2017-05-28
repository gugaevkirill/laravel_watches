<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParamsSaveTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(<<<SQL
            CREATE OR REPLACE FUNCTION before_save_product() RETURNS TRIGGER
            LANGUAGE plpgsql
            AS
            $$
            DECLARE
              param RECORD;
              tmp INTEGER;
            BEGIN
              -- Проверим наличие reqired параметров
              FOR param IN
                (SELECT params.*
                FROM params
                left join categories_params cp
                  on params.slug = cp.param_slug
                where cp.category_slug = NEW.category_slug
                  and required = true)
              LOOP
                IF NEW.attrs->param.slug IS NULL THEN
                  RAISE EXCEPTION 'Параметр % является обязательным!', param.title_ru;
                END IF;
            
                IF param.unique = true THEN
                  SELECT count(*)
                  INTO tmp FROM products
                  WHERE (products.attrs->param.slug)::jsonb <@ (NEW.attrs->param.slug)::jsonb
                    AND products.id <> NEW.id;
                  IF tmp > 0 THEN
                    RAISE EXCEPTION 'Параметр % должен иметь уникальное значение!', param.title_ru;
                  END IF;
                END IF;
              END LOOP;
            
              RETURN NEW;
            END;
            $$;
SQL
        );

        DB::statement(<<<SQL
            CREATE TRIGGER products_before_save BEFORE INSERT OR UPDATE OF attrs ON products FOR EACH ROW EXECUTE PROCEDURE before_save_product();
SQL
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TRIGGER IF EXISTS products_before_save ON products;');
        DB::statement('DROP FUNCTION IF EXISTS before_save_product();');
    }
}
