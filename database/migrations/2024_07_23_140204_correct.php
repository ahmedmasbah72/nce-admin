<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class correct extends Migration // Ajoutez un suffixe unique pour le nom de la classe
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            if (!Schema::hasColumn('people', 'reference')) {
                $table->string('reference')->default(0)->nullable()->unique();
            }
            if (!Schema::hasColumn('people', 'marque')) {
                $table->string('marque');
            }
            if (!Schema::hasColumn('people', 'largeur')) {
                $table->float('largeur')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'profondeur')) {
                $table->float('profondeur')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'hauteur')) {
                $table->float('hauteur')->default(0)->nullable();
            }
            // Continuez pour les autres colonnes...
            if (!Schema::hasColumn('people', 'feux')) {
                $table->float('feux')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'tension')) {
                $table->float('tension')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'plaque')) {
                $table->float('plaque')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'volume')) {
                $table->float('volume')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'broche')) {
                $table->float('broche')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'porte')) {
                $table->float('porte')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'temperature')) {
                $table->float('temperature')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'bac')) {
                $table->float('bac')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'niveau')) {
                $table->float('niveau')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'num_pizza')) {
                $table->float('num_pizza')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'dim_plaque')) {
                $table->string('dim_plaque')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'num_cylindre')) {
                $table->float('num_cylindre')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'dim_rouleaux')) {
                $table->float('dim_rouleaux')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'model')) {
                $table->string('model')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'capacite_l')) {
                $table->float('capacite_l')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'capacité_kg')) {
                $table->float('capacité_kg')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'production')) {
                $table->float('production')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'lame')) {
                $table->float('lame')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'soud')) {
                $table->float('soud')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'prix')) {
                $table->float('prix')->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'serie')) {
                $table->float('serie')->default(0)->nullable();
            }
            // Ajout des nouveaux champs
            if (!Schema::hasColumn('people', 'initial_price')) {
                $table->decimal('initial_price', 8, 2)->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'new_price')) {
                $table->decimal('new_price', 8, 2)->default(0)->nullable();
            }
            if (!Schema::hasColumn('people', 'puissance')) {
                $table->decimal('puissance', 8, 2)->default(0)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn([
                'reference',
                'marque',
                'largeur',
                'profondeur',
                'hauteur',
                'feux',
                'tension',
                'plaque',
                'volume',
                'broche',
                'porte',
                'temperature',
                'bac',
                'niveau',
                'num_pizza',
                'dim_plaque',
                'num_cylindre',
                'dim_rouleaux',
                'model',
                'capacite_l',
                'capacité_kg',
                'production',
                'lame',
                'soud',
                'prix',
                'serie',
                'initial_price',
                'new_price',
                'puissance'
            ]);
        });
    }
}
