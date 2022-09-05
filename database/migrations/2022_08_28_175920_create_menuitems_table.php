<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->bigInteger('id',20)->autoIncrement()->unsigned();
            $table->char('title',255);
            $table->char('name',255);
            $table->char('slug',255);
            $table->char('type',255);
            $table->char('target',255);
            $table->char('menu_id',20); //bigInteger
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuitems');
    }
};


// SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
// START TRANSACTION;
// SET time_zone = "+00:00";

// CREATE TABLE `menuitems` (
//   `id` bigint(20) UNSIGNED NOT NULL,
//   `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//   `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//   `menu_id` int(11) NOT NULL,
//   `created_at` timestamp NULL DEFAULT NULL,
//   `updated_at` timestamp NULL DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

// ALTER TABLE `menuitems`
//   ADD PRIMARY KEY (`id`);

// ALTER TABLE `menuitems`
//   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
// COMMIT;	