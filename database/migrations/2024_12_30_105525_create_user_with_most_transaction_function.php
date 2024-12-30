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
            CREATE DEFINER=`root`@`localhost` FUNCTION `userWithMostTransaction`()
            RETURNS VARCHAR(255) CHARSET utf8mb4
            LANGUAGE SQL
            DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER
            COMMENT \'\'
            BEGIN
                DECLARE nama_user VARCHAR(255);

                SELECT u.name INTO nama_user
                FROM users u
                JOIN (
                    SELECT id_user, COUNT(*) AS transaction_count
                    FROM transactions
                    GROUP BY id_user
                    ORDER BY transaction_count DESC
                    LIMIT 1
                ) AS t ON u.id = t.id_user;

                RETURN nama_user;
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
        DB::statement('DROP FUNCTION IF EXISTS `userWithMostTransaction`');
    }
};
