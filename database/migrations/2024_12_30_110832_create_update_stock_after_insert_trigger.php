<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE TRIGGER update_stock_after_insert
            AFTER INSERT ON transactions
            FOR EACH ROW
            BEGIN
                UPDATE products
                SET stock = stock - NEW.qty
                WHERE id = NEW.id_product;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TRIGGER IF EXISTS update_stock_after_insert');
    }
};
