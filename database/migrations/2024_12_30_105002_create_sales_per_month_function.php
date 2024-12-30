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
            CREATE DEFINER=`root`@`localhost` PROCEDURE `salesPerMonth`()
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER
            COMMENT \'\'
            BEGIN
                SELECT
                    DATE_FORMAT(created_at, \'%Y-%m\') AS month,
                    SUM(qty) AS total_sold
                FROM
                    transactions
                WHERE
                    created_at >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
                GROUP BY
                    DATE_FORMAT(created_at, \'%Y-%m\')
                ORDER BY
                    month;
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
        DB::statement('DROP PROCEDURE IF EXISTS `salesPerMonth`');
    }
};
