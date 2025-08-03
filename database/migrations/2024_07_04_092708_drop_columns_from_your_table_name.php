<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsFromYourTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'age']); // Remplacez 'column1' et 'column2' par les noms des colonnes à supprimer
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
            // Ajoutez les colonnes à nouveau avec les définitions appropriées
            $table->string('prenom'); // Assurez-vous de correspondre au type de données et aux paramètres d'origine
            $table->string('age'); // Assurez-vous de correspondre au type de données et aux paramètres d'origine
        });
    }
}
