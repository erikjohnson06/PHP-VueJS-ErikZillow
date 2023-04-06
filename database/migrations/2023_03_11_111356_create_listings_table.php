<?php

use App\Models\User;

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

            $table->tinyText("address");

            $table->tinyText("city");
            $table->tinyText("zip");
            $table->tinyText("state");

            $table->unsignedFloat("price", 10);

            //$table->tinyInteger("status_id")->default(1)->comment("1=Pending,2=Approved")

            $table->foreignIdFor(User::class, 'posted_by')
                ->constrained('users')
                ->restrictOnUpdate()
                ->restrictOnDelete();

            $table->text("comments")->nullable();

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
