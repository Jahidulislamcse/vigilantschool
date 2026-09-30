<?php

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
        // 1. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('group')->default('general'); // general, contact, social, branding
            $table->string('type')->default('text'); // text, textarea, image, boolean
            $table->timestamps();
        });

        // 2. Sliders Table
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('btn_text_1')->nullable();
            $table->string('btn_url_1')->nullable();
            $table->string('btn_text_2')->nullable();
            $table->string('btn_url_2')->nullable();
            $table->string('image');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 3. Facilities Table
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('icon')->default('fa-bus-alt');
            $table->string('color_theme')->default('primary');
            $table->text('short_description');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. About Sections Table
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tagline')->nullable();
            $table->text('description_1');
            $table->text('description_2')->nullable();
            $table->string('founder_name')->nullable();
            $table->string('founder_role')->nullable();
            $table->string('founder_photo')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();
            $table->string('cta_image')->nullable();
            $table->timestamps();
        });

        // 5. Teachers Table
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 6. Classes Table
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('age_range')->default('3-5 Years');
            $table->string('time_schedule')->default('9-10 AM');
            $table->string('capacity')->default('30 Kids');
            $table->string('fee')->default('$99');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 7. Appointments Table
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('guardian_name');
            $table->string('guardian_email');
            $table->string('guardian_phone')->nullable();
            $table->string('child_name');
            $table->string('child_age');
            $table->foreignId('class_id')->nullable()->constrained('classes')->nullOnDelete();
            $table->text('message')->nullable();
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // 8. Testimonials Table
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('profession');
            $table->string('avatar')->nullable();
            $table->text('content');
            $table->integer('rating')->default(5);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 9. Contacts Table
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->text('admin_reply')->nullable();
            $table->timestamps();
        });

        // 10. Newsletters Table
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 11. Galleries Table
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->string('category')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('newsletters');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('about_sections');
        Schema::dropIfExists('facilities');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('settings');
    }
};
