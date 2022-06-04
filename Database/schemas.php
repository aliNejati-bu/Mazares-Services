<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("user_email")->unique();
    $blueprint->string("password")->nullable();
    $blueprint->string("phone")->nullable()->unique();
    /*
     * user type for present type of user account
     * 0: common
     * 1: silver
     * 2: gold
     */
    $blueprint->enum("user_type", [0, 1, 2])->default(0);
    $blueprint->boolean("is_phone_verified")->default(false);
    $blueprint->boolean("is_email_verified")->default(false);
    $blueprint->boolean("is_super_admin")->default(false);
    $blueprint->boolean("is_admin")->default(false);
    $blueprint->string("name");
    $blueprint->timestamps();;
});

Capsule::schema()->create('phone_codes', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("code");
    $blueprint->dateTime("expire_at");
    $blueprint->boolean("is_usesd");
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->boolean("is_available")->default(true);
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});

Capsule::schema()->create('email_links', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("slug")->unique();
    $blueprint->dateTime('expire_at');
    $blueprint->boolean('is_used');
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});


Capsule::schema()->create('news', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("slug")->unique();
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->string("title");
    $blueprint->text("content");
    $blueprint->timestamps();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");

});

Capsule::schema()->create('roles', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("role_name");
    $blueprint->timestamps();
});

Capsule::schema()->create("role_user", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->bigInteger("role_id")->unsigned();
    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
    $blueprint->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
});

Capsule::schema()->create("permissions", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("permission_name");
    $blueprint->string("persian_name");
    $blueprint->timestamps();
});

Capsule::schema()->create("permission_role", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->bigInteger("permission_id")->unsigned();
    $blueprint->bigInteger("role_id")->unsigned();
    $blueprint->foreign("permission_id")->references("id")->on("permissions")->onDelete("cascade");
    $blueprint->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
});


Capsule::schema()->create("user_session_activities", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->text("token");
    $blueprint->timestamps();

    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
});


Capsule::schema()->create("apps", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("packagename")->unique();
    $blueprint->string("app_name");
    $blueprint->timestamps();
});

Capsule::schema()->create("app_user", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->bigInteger("user_id")->unsigned();
    $blueprint->bigInteger("app_id")->unsigned();

    $blueprint->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
    $blueprint->foreign("app_id")->references("id")->on("apps")->onDelete("cascade");
});

Capsule::schema()->create("invites", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->bigInteger("app_id")->unsigned();
    $blueprint->timestamps();

    $blueprint->foreign("app_id")->references("id")->on("apps")->onDelete("cascade");
});


Capsule::schema()->create("configs", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->string("config_name");
    $blueprint->bigInteger("app_id")->unsigned();
    $blueprint->foreign("app_id")->references("id")->on("apps")->onDelete("cascade");

    $blueprint->timestamps();
});

Capsule::schema()->create("values", function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();
    $blueprint->bigInteger("app_id")->unsigned();
    $blueprint->foreign("app_id")->references("id")->on("apps")->onDelete("cascade");
    $blueprint->bigInteger("config_id")->unsigned()->nullable();
    $blueprint->foreign("config_id")->references("id")->on("configs")->onDelete("cascade");
    $blueprint->string("name");
    $blueprint->string("value");
    $blueprint->timestamps();
});

Capsule::schema()->create('get_values', function (\Illuminate\Database\Schema\Blueprint $blueprint) {
    $blueprint->id();

    $blueprint->bigInteger("app_id")->unsigned()->nullable();
    $blueprint->foreign("app_id")->references("id")->on("apps")->nullOnDelete();

    $blueprint->bigInteger("config_id")->unsigned()->nullable();
    $blueprint->foreign("config_id")->references("id")->on("configs")->nullOnDelete();

    $blueprint->bigInteger("value_id")->unsigned()->nullable();
    $blueprint->foreign("value_id")->references("id")->on("values")->nullOnDelete();


    $blueprint->string("getter_ip");

    $blueprint->timestamps();
});



// TODO: تنظیم محدودیت های دیتا بیسی روی داده ها