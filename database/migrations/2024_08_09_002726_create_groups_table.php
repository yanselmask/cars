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
            $table->unsignedBigInteger('group_id')->nullable()
            ->after('currency_id');
        });

        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::table('listings', function (Blueprint $table) {
           $table->foreign('group_id')
                 ->references('id')
                 ->on('groups')
                 ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign('listings_group_id_foreign');
        });
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
        Schema::dropIfExists('groups');
    }
};
