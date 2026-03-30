<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    DB::statement("ALTER TABLE orders MODIFY status ENUM(
        'new',
        'processing',
         'canseled',
        'completed',
        'archived'
    ) DEFAULT 'new'");
}

public function down()
{
    DB::statement("ALTER TABLE orders MODIFY status ENUM(
        'new',
        'processing',
        'canseled',
        'completed',
        'archived'
    ) DEFAULT 'new'");
}
};
