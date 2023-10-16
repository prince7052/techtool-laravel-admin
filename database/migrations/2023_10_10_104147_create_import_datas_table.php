<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('import_datas', function (Blueprint $table) {
            $table->id();
            $table->string('agent_id')->nullable();;
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('remark_option')->nullable();
            $table->string('recorded_call')->nullable();
            $table->integer('follow_up')->default(0)->comment('0=not available, 1=call is schelduled');
            $table->string('follow_up_date')->nullable();
            $table->integer('status')->default(0)->comment('0=not calling, 1=calling');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_datas');
    }
};
