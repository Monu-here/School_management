$table-><?php

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
        Schema::table('subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('faculity_id');
            $table->string('sub_desc'); // Change this to string
            $table->string('sub_code');
            $table->string('level')->default('Basic')->nullable();
            $table->string('credit')->default(3)->after('name')->nullable();
            $table->string('pre_requsisites')->default('None')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('faculity_id');
            $table->dropColumn('sub_desc');
            $table->dropColumn('sub_code');
            $table->dropColumn('credit');
            $table->dropColumn('level')->default('Basic');
            $table->dropColumn('pre_requsisites')->default('None');
        });
    }
};
