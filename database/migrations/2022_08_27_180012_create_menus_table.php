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
        Schema::create('menus', function (Blueprint $table) {
            $table->bigInteger('id',20)->autoIncrement()->unsigned();
            $table->char('title',255);//varchar
            $table->char('location',255)->nullable();//varchar
            $table->longtext('content')->nullable();
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
        Schema::dropIfExists('menus');
    }
};



// SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
// START TRANSACTION;
// SET time_zone = "+00:00";

// CREATE TABLE `menus` (
//   `id` bigint(20) UNSIGNED NOT NULL,
//   `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//   `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//   `created_at` timestamp NULL DEFAULT NULL,
//   `updated_at` timestamp NULL DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

// ALTER TABLE `menus`
//   ADD PRIMARY KEY (`id`);

// ALTER TABLE `menus`
//   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
// COMMIT;