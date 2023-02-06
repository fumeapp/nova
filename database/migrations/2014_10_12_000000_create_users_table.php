<?php

use App\Models\Image;
use App\Models\Item;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function __construct()
    {
        DB::getDoctrineSchemaManager()
            ->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'string');
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('avatar', 1000)->nullable();
            $table->json('payload');
            $table->timestamps();
        });

        Schema::create('providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(User::class)->constrained();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->json('payload');
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('title');
            $table->string('description');
            $table->string('location', 3000)->nullable();
            $table->timestamps();
        });

        Schema::Create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Item::class)->nullable();
            $table->point('coordinate');
            $table->string('payload', 3000);
            $table->string('place_id');
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Item::class)->nullable();
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('item_tag', function (Blueprint $table) {
            $table->foreignIdFor(Item::class)->constrained();
            $table->foreignIdFor(Tag::class)->constrained();
            $table->timestamps();
        });

        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Image::class)->constrained();
            $table->string('name');
            $table->decimal('confidence', 14, 2);
            $table->json('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
