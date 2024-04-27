<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('excels', function (Blueprint $table) {
            $table->id();
            $table->text('query');
            $table->text('name');
            $table->text('site')->nullable();
            $table->text('type')->nullable();
            $table->text('subtypes')->nullable();
            $table->text('category')->nullable();
            $table->text('phone')->nullable();
            $table->text('full_adress')->nullable();
            $table->text('borough')->nullable();
            $table->text('street')->nullable();
            $table->text('city')->nullable();
            $table->text('postal_code')->nullable();
            $table->text('state')->nullable();
            $table->text('us_state')->nullable();
            $table->text('country')->nullable();
            $table->text('country_code')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('time_zone')->nullable();
            $table->text('plus_code')->nullable();
            $table->text('area_service')->nullable();
            $table->text('rating')->nullable();
            $table->text('reviews')->nullable();
            $table->text('reviews_link')->nullable();
            $table->text('reviews_tags')->nullable();
            $table->text('reviews_per_score')->nullable();
            $table->text('reviews_per_score_1')->nullable();
            $table->text('reviews_per_score_2')->nullable();
            $table->text('reviews_per_score_3')->nullable();
            $table->text('reviews_per_score_4')->nullable();
            $table->text('reviews_per_score_5')->nullable();
            $table->text('photos_count')->nullable();
            $table->text('photo')->nullable();
            $table->text('street_view')->nullable();
            $table->text('located_in')->nullable();
            $table->text('working_hours')->nullable();
            $table->text('working_hours_old_format')->nullable();
            $table->text('other_hours')->nullable();
            $table->text('popular_times')->nullable();
            $table->text('business_status')->nullable();
            $table->text('about')->nullable();
            $table->text('range')->nullable();
            $table->text('posts')->nullable();
            $table->text('logo')->nullable();
            $table->text('description')->nullable();
            $table->text('typical_time_spent')->nullable();
            $table->text('verified')->nullable();
            $table->text('owner_id')->nullable();
            $table->text('owner_title')->nullable();
            $table->text('owner_link')->nullable();
            $table->text('reservation_links')->nullable();
            $table->text('booking_appointment_link')->nullable();
            $table->text('menu_link')->nullable();
            $table->text('order_links')->nullable();
            $table->text('location_link')->nullable();
            $table->text('place_id')->nullable();
            $table->text('google_id')->nullable();
            $table->text('cid')->nullable();
            $table->text('reviews_id')->nullable();
            $table->text('located_google_id')->nullable();
            $table->text('domain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excels');
    }
};





