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
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('cle', 32)->nullable();
            $table->unsignedInteger('organisation_id');
            $table->string('e_mail', 200);
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('telephone_fixe', 255)->nullable();
            $table->string('service', 255)->nullable();
            $table->string('fonction', 255)->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
