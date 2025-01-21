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
        Schema::create('produits', function (Blueprint $table) {
            $table->id('id_produit');
            $table->string('nom_produit');
            $table->unsignedBigInteger('id_categorie');
            $table->text('description_produit');
            $table->integer('prix_produit');
            $table->integer('quantite')->default(0); // Ajout de la colonne quantité
            $table->timestamps();
            $table->foreign('id_categorie')->references('id_categorie')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
