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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigInteger('id',20)->autoIncrement()->unsigned();
            $table->char('title',255);//varchar
            $table->char('slug',255);//varchar
            $table->longtext('description')->nullable();
            $table->char('image',255)->nullable();//varchar
            $table->char('category',255);//varchar
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
        Schema::dropIfExists('posts');
    }
};


// SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
// START TRANSACTION;
// SET time_zone = "+00:00";

// CREATE TABLE `posts` (
//   `id` bigint(20) UNSIGNED NOT NULL,
//   `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//   `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
//   `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
//   `created_at` timestamp NULL DEFAULT NULL,
//   `updated_at` timestamp NULL DEFAULT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

// INSERT INTO `posts` (`id`, `title`, `slug`, `description`, `image`, `category`, `status`, `created_at`, `updated_at`) VALUES
// (2, 'Illo culpa dolore eo', 'Nulla dolore sapient', '<p>Nisi perspiciatis, e.</p>', '1621651621slider2.jpg', '1', 'show', '2021-05-21 21:02:01', NULL),
// (3, 'Distinctio Et itaqu', 'Labore neque facere', '<p>Autem reiciendis off.</p>', '1621651638slider3.jpg', '3', 'show', '2021-05-21 21:02:18', '2021-05-21 21:05:39'),
// (4, 'Illum dolorum accus', 'Nulla reiciendis con', '<p>Quis laboris ut est.</p>', '1621651650slider4.jpg', '2', 'show', '2021-05-21 21:02:30', '2021-05-21 21:05:42'),
// (5, 'Et nulla mollit culp', 'et-nulla-mollit-culp', '<p>Delectus, aut aut au.</p>', '1621652968logo.png', '1', 'show', '2021-05-22 02:57:03', '2021-05-22 03:09:28');

// ALTER TABLE `posts`
//   ADD PRIMARY KEY (`id`);

// ALTER TABLE `posts`
//   MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
// COMMIT;	
