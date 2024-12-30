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
            CREATE DEFINER=`root`@`localhost` PROCEDURE `productBestSelling`()
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER
            COMMENT \'\'
            BEGIN
                SELECT
                    p.id,
                    p.name,
                    SUM(t.qty) AS total_sold,
                    DENSE_RANK() OVER (ORDER BY SUM(t.qty) DESC) AS ranking
                FROM
                    transactions t
                    JOIN products p ON t.id_product = p.id
                GROUP BY
                    p.id, p.name
                LIMIT 10;
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
        DB::statement('DROP PROCEDURE IF EXISTS `productBestSelling`');
    }
};
