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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('condition_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('make_id')->nullable();
            $table->unsignedBigInteger('makemodel_id')->nullable();
            $table->unsignedBigInteger('drivetype_id')->nullable();
            $table->unsignedBigInteger('transmission_id')->nullable();
            $table->unsignedBigInteger('fueltype_id')->nullable();
            $table->unsignedBigInteger('engine_cc')->nullable();
            $table->unsignedBigInteger('engine_id')->nullable();
            $table->unsignedBigInteger('exterior_color_id')->nullable();
            $table->unsignedBigInteger('interior_color_id')->nullable();
            $table->unsignedBigInteger('offertype_id')->nullable();
            $table->unsignedBigInteger('listedby_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->integer('year')->nullable();
            $table->integer('cylinders')->nullable();
            $table->string('vin')->nullable();
            $table->longText('content')->nullable();
            $table->string('video_link')->nullable();
            $table->json('location')->nullable();
            $table->bigInteger('price')->nullable();
            $table->boolean('is_negotiated')->default(false);
            $table->timestamp('listing_expirate')->nullable();
            $table->timestamp('featured_expirate')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_certified')->default(false);
            $table->boolean('is_single_owner')->default(false);
            $table->boolean('is_well_equipped')->default(false);
            $table->boolean('no_accident')->default(false);
            $table->integer('city_mpg')->nullable();
            $table->boolean('is_city_mpg_verified')->default(false);
            $table->integer('highway_mpg')->nullable();
            $table->boolean('is_highway_mpg_verified')->default(false);
            $table->integer('doors')->nullable();
            $table->integer('passengers')->nullable();
            $table->integer('charge')->nullable();
            $table->tinyInteger('charge_type')->nullable();
            $table->integer('mileage')->nullable();
            $table->tinyInteger('mileage_type')->nullable();
            $table->boolean('is_mileage_verified')->default(false);
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
