<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Pdf\Repositories\PdfLayoutRepository;

class InsertPdfProductStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PdfLayoutRepository::create(['title' => 'Estoque', 'description' => 'Cada Estoque cadastrado é demonstrado de forma separada no pedido.', 'path' => 'productstock::pdf.order']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        PdfLayoutRepository::deleteByTitle('Estoque');
    }
}
 