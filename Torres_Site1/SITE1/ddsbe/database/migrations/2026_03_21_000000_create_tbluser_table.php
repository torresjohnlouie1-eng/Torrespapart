
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbluserTable extends Migration
{
    public function up()
    {
        Schema::create('users1', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('gender', ['Male', 'Female']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users1');
    }
}