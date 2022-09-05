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
        Schema::create('categories', function (Blueprint $table) {
            $table->bigInteger('id',20)->autoIncrement()->unsigned();
            $table->char('title',255);//varchar
            $table->char('slug',255);//varchar
            $table->char('status',255);//varchar
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
        Schema::dropIfExists('categories');
    }
};

// SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
// START TRANSACTION;
// SET time_zone = "+00:00";

// CREATE TABLE `categories` (
//   `id` bigint(20) UNSIGNED NOT NULL,
//   `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `created_at` timestamp NULL DEFAULT NULL,
//   `updated_at` timestamp NULL DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

// INSERT INTO `categories` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
// (1, 'about us', 'about-us', 'show', '2021-05-21 07:11:51', NULL),
// (2, 'projects', 'projects', 'show', '2021-05-21 07:16:38', NULL),
// (3, 'get involved', 'get-involved', 'show', '2021-05-21 07:19:49', NULL),
// (4, 'news & events', 'news-events', 'show', '2021-05-21 07:20:17', NULL);

// ALTER TABLE `categories`
//   ADD PRIMARY KEY (`id`);

// ALTER TABLE `categories`
//   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
// COMMIT;	
