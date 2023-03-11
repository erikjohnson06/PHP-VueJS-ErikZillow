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

            $table->unsignedTinyInteger("beds");
            $table->unsignedTinyInteger("baths");
            $table->unsignedSmallInteger("area");

            $table->tinyText("address_1");
            $table->tinyText("address_2");
            $table->tinyText("city");
            $table->tinyText("zip");

            $table->unsignedFloat("price", 10);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');

        //Schema::table('listings', function (Blueprint $table) {
        //    $table->dropColumn('beds');
        //});

        //Schema::dropColumns('listings', ['beds', 'baths','area','address_1','address_2','city','zip', 'price']);
    }
};
