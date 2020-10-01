<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Modules\Dashboard\Repositories\ReportRepository;

class InsertReportsRecordsProductStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ReportRepository::newByCategory(['module' => 'ProductStock', 'export' => 'ItemsExport', 'alias' => 'Items - Estoque'], 'Items');
        ReportRepository::newByCategory(['module' => 'ProductStock', 'export' => 'ProductsExport', 'alias' => 'Produtos - Estoque'], 'Produtos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ReportRepository::deleteByAlias('Items - Estoque');
        ReportRepository::deleteByAlias('Produtos - Estoque');
    }
}
