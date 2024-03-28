<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifs', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->integer('tarif');
            $table->integer('tarif_reduit')->nullable();
            $table->boolean('editable')->default(1);
            $table->timestamps();
        });
        $category = ['public', 'étudiant', 'élève', "étudiant d'art", "comité d'entreprise"];
        DB::table('tarifs')->insert(
            [
                ['category' => $category[0], 'tarif' => 200, 'tarif_reduit' => 0, 'editable' => 0],
                ['category' => $category[1], 'tarif' => 200, 'tarif_reduit' => 50, 'editable' => 0],
                ['category' => $category[2], 'tarif' => 200, 'tarif_reduit' => 50, 'editable' => 0],
                ['category' => $category[3], 'tarif' => 200, 'tarif_reduit' => 50, 'editable' => 0],
                ['category' => $category[4], 'tarif' => 200, 'tarif_reduit' => 0, 'editable' => 0],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifs');
    }
};
