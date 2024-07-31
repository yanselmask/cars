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
        Schema::table('listings', function (Blueprint $table) {
            $table->foreign('condition_id')
                  ->references('id')
                ->on('conditions')
                ->nullOnDelete();
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->nullOnDelete();
            $table->foreign('make_id')
                ->references('id')
                ->on('makes')
                ->nullOnDelete();
            $table->foreign('makemodel_id')
                ->references('id')
                ->on('make_models')
                ->nullOnDelete();
            $table->foreign('drivetype_id')
                ->references('id')
                ->on('drive_types')
                ->nullOnDelete();
            $table->foreign('transmission_id')
                ->references('id')
                ->on('transmissions')
                ->nullOnDelete();
            $table->foreign('fueltype_id')
                ->references('id')
                ->on('fuel_types')
                ->nullOnDelete();
            $table->foreign('engine_id')
                ->references('id')
                ->on('engines')
                ->nullOnDelete();
            $table->foreign('exterior_color_id')
                ->references('id')
                ->on('colors')
                ->nullOnDelete();
            $table->foreign('interior_color_id')
                ->references('id')
                ->on('colors')
                ->nullOnDelete();
            $table->foreign('offertype_id')
                ->references('id')
                ->on('offer_types')
                ->nullOnDelete();
            $table->foreign('listedby_id')
                ->references('id')
                ->on('listed_bies')
                ->nullOnDelete();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });

        Schema::table('front_section_page', function (Blueprint $table) {
            $table->foreign('front_section_id')
                ->references('id')
                ->on('front_sections')
                ->nullOnDelete();
            $table->foreign('page_id')
                ->references('id')
                ->on('pages')
                ->nullOnDelete();
        });

        Schema::table('feature_listing', function (Blueprint $table) {
            $table->foreign('listing_id')
                ->references('id')
                ->on('listings')
                ->nullOnDelete();
            $table->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\Condition::class,'condition_id');
            $table->dropConstrainedForeignIdFor(\App\Models\Make::class,'make_id');
            $table->dropConstrainedForeignIdFor(\App\Models\MakeModel::class,'makemodel_id');
            $table->dropConstrainedForeignIdFor(\App\Models\DriveType::class,'drivetype_id');
            $table->dropConstrainedForeignIdFor(\App\Models\Transmission::class,'transmission_id');
            $table->dropConstrainedForeignIdFor(\App\Models\FuelType::class,'fueltype_id');
            $table->dropConstrainedForeignIdFor(\App\Models\Engine::class,'engine_id');
            $table->dropConstrainedForeignIdFor(\App\Models\Color::class,'exterior_color_id');
            $table->dropConstrainedForeignIdFor(\App\Models\Color::class,'interior_color_id');
            $table->dropConstrainedForeignIdFor(\App\Models\OfferType::class,'offertype_id');
            $table->dropConstrainedForeignIdFor(\App\Models\ListedBy::class,'listedby_id');
            $table->dropConstrainedForeignIdFor(\App\Models\User::class,'user_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\Category::class,'parent_id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\Category::class,'category_id');
            $table->dropConstrainedForeignIdFor(\App\Models\User::class,'user_id');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\User::class,'user_id');
        });

        Schema::table('front_section_page', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(\App\Models\FrontSection::class,'front_section_id');
            $table->dropConstrainedForeignIdFor(\App\Models\Page::class,'page_id');
        });
    }
};
