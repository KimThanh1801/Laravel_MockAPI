<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function createTables()
    {
        // Tạo bảng addresses
        if (!Schema::hasTable('addresses')) {
            Schema::create('addresses', function (Blueprint $table) {
                $table->id();
                $table->string('street')->nullable();
                $table->string('country');
                $table->unsignedBigInteger('icon_id')->nullable();
                $table->unsignedBigInteger('monster_id');
                $table->timestamps();

                // Ràng buộc khóa ngoại
                $table->foreign('monster_id')->references('id')->on('monsters')->onDelete('cascade');
            });
            DB::statement('ALTER TABLE `addresses` 
            ADD PRIMARY KEY (`id`), 
            ADD UNIQUE KEY `addresses_monster_id_unique` (`monster_id`)');
        }

        // Tạo bảng articles
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id');
                $table->string('title');
                $table->string('slug')->default('');
                $table->text('content');
                $table->string('image')->nullable();
                $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED');
                $table->date('date');
                $table->boolean('featured')->default(false);
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                DB::statement('ALTER TABLE `articles` ADD PRIMARY KEY (`id`)');

            });
        } // Tạo bảng article_tag (bảng trung gian)
        if (!Schema::hasTable('article_tag')) {
            Schema::create('article_tag', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('article_id');
                $table->unsignedBigInteger('tag_id');
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại
                $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
                DB::statement('ALTER TABLE `article_tag` ADD PRIMARY KEY (`id`)');

            });
        }

        // 1Tạo bảng b_s trước
        if (!Schema::hasTable('b_s')) {
            Schema::create('b_s', function (Blueprint $table) {
                $table->id();
                $table->string('data', 255);
                DB::statement('ALTER TABLE `b_s` 
                ADD PRIMARY KEY (`id`)');

            });
        }

        // 2️ Tạo bảng a_s sau khi b_s đã tồn tại
        if (!Schema::hasTable('a_s')) {
            Schema::create('a_s', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('b_s_id');

                // Ràng buộc khóa ngoại
                $table->foreign('b_s_id')->references('id')->on('b_s')->onDelete('cascade');
                DB::statement('ALTER TABLE `a_s` ADD PRIMARY KEY (`id`), ADD KEY `a_s_b_s_id_index` (`b_s_id`)');

            });
        }
        // Tạo bảng bills
        if (!Schema::hasTable('bills')) {
            Schema::create('bills', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_customer')->nullable();
                $table->date('date_order')->nullable();
                $table->float('total')->nullable()->comment('Tổng tiền');
                $table->string('payment', 200)->nullable()->comment('Hình thức thanh toán');
                $table->string('note', 500)->nullable();
                $table->timestamps();

                // Ràng buộc khóa ngoại
                $table->foreign('id_customer')->references('id')->on('customers')->onDelete('set null');
                DB::statement('ALTER TABLE `bills` 
                ADD PRIMARY KEY (`id`), 
                ADD KEY `bills_ibfk_1` (`id_customer`)');

            });
        }

        // Tạo bảng bill_detail
        if (!Schema::hasTable('bill_detail')) {
            Schema::create('bill_detail', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_bill');
                $table->unsignedBigInteger('id_product');
                $table->integer('quantity')->comment('Số lượng');
                $table->double('unit_price');
                $table->timestamps();

                // Ràng buộc khóa ngoại
                $table->foreign('id_bill')->references('id')->on('bills')->onDelete('cascade');
                $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
                DB::statement('ALTER TABLE `bill_detail` 
                ADD PRIMARY KEY (`id`), 
                ADD KEY `bill_detail_ibfk_2` (`id_product`)');

            });
        }
        // Tạo bảng categories
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('parent_id')->default(0);
                $table->unsignedInteger('lft')->nullable();
                $table->unsignedInteger('rgt')->nullable();
                $table->unsignedInteger('depth')->nullable();
                $table->string('name', 255);
                $table->string('slug', 255);
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại cho parent_id
                $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
                DB::statement('ALTER TABLE `categories` 
                ADD PRIMARY KEY (`id`), 
                ADD UNIQUE KEY `categories_slug_unique` (`slug`)');

            });
        } // Tạo bảng comments
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->string('username', 255);
                $table->text('comment');
                $table->unsignedBigInteger('id_product');
                $table->timestamps();

                // Ràng buộc khóa ngoại
                $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
                DB::statement('ALTER TABLE `comments` 
                ADD PRIMARY KEY (`id`), 
                ADD KEY `comments_id_product_index` (`id_product`)');

            });
        }

        // Tạo bảng customer
        if (!Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('gender', 10);
                $table->string('email', 50)->unique();
                $table->string('address', 100);
                $table->string('phone_number', 20);
                $table->string('note', 200);
                $table->timestamps();
                DB::statement('ALTER TABLE `customer` 
                ADD PRIMARY KEY (`id`)');

            });
        }

        // Tạo bảng dummies
        if (!Schema::hasTable('dummies')) {
            Schema::create('dummies', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->text('description');
                $table->json('extras'); // Dữ liệu JSON hợp lệ
                $table->timestamps();
                DB::statement('ALTER TABLE `dummies` 
                ADD PRIMARY KEY (`id`)');

            });
        }

        // Tạo bảng failed_jobs
        if (!Schema::hasTable('failed_jobs')) {
            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->id(); // Khóa chính tự động tăng
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent(); // Mặc định lấy thời gian hiện tại
                DB::statement('ALTER TABLE `failed_jobs` 
                ADD PRIMARY KEY (`id`)');

            });
        }

        // Tạo bảng icons với ràng buộc
        if (!Schema::hasTable('icons')) {
            Schema::create('icons', function (Blueprint $table) {
                $table->id(); // Khóa chính tự động tăng
                $table->string('name', 255)->unique(); // Đảm bảo mỗi icon có tên duy nhất
                $table->string('icon', 255);
                $table->timestamps(); // Tạo created_at và updated_at
                DB::statement('ALTER TABLE `icons` 
                ADD PRIMARY KEY (`id`)');

            });
        }

        // Tạo bảng menu_items
        if (!Schema::hasTable('menu_items')) {
            Schema::create('menu_items', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('type', 20)->nullable();
                $table->string('link', 255)->nullable();
                $table->unsignedBigInteger('page_id')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->unsignedInteger('lft')->nullable();
                $table->unsignedInteger('rgt')->nullable();
                $table->unsignedInteger('depth')->nullable();
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại
                $table->foreign('parent_id')->references('id')->on('menu_items')->onDelete('cascade');
                $table->foreign('page_id')->references('id')->on('pages')->onDelete('set null');
                DB::statement('ALTER TABLE `menu_items` 
                ADD PRIMARY KEY (`id`)');

            });
        }

        // Tạo bảng migrations
        if (!Schema::hasTable('migrations')) {
            Schema::create('migrations', function (Blueprint $table) {
                $table->id();
                $table->string('migration', 191);
                $table->integer('batch');
                DB::statement('ALTER TABLE `migrations` 
                ADD PRIMARY KEY (`id`)');

            });
        }

        // Tạo bảng model_has_permissions
        if (!Schema::hasTable('model_has_permissions')) {
            Schema::create('model_has_permissions', function (Blueprint $table) {
                $table->unsignedBigInteger('permission_id');
                $table->string('model_type');
                $table->unsignedBigInteger('model_id');

                // Ràng buộc khóa chính tổng hợp
                $table->primary(['permission_id', 'model_id', 'model_type']);

                // Ràng buộc khóa ngoại
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
                DB::statement('ALTER TABLE `model_has_permissions` 
                ADD PRIMARY KEY (`permission_id`, `model_id`, `model_type`), 
                ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`, `model_type`)');

            });
        }

        // Tạo bảng model_has_roles
        if (!Schema::hasTable('model_has_roles')) {
            Schema::create('model_has_roles', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id');
                $table->string('model_type');
                $table->unsignedBigInteger('model_id');

                // Ràng buộc khóa chính tổng hợp
                $table->primary(['role_id', 'model_id', 'model_type']);

                // Ràng buộc khóa ngoại
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                DB::statement('ALTER TABLE `model_has_roles` 
                ADD PRIMARY KEY (`role_id`, `model_id`, `model_type`), 
                ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`, `model_type`)');

            });
        }
        // Tạo bảng monsters
        if (!Schema::hasTable('monsters')) {
            Schema::create('monsters', function (Blueprint $table) {
                $table->id();
                $table->string('address')->nullable();
                $table->string('browse')->nullable();
                $table->boolean('checkbox')->nullable();
                $table->text('wysiwyg')->nullable();
                $table->string('color')->nullable();
                $table->string('color_picker')->nullable();
                $table->date('date')->nullable();
                $table->date('date_picker')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->dateTime('datetime')->nullable();
                $table->dateTime('datetime_picker')->nullable();
                $table->string('email')->nullable();
                $table->integer('hidden')->nullable();
                $table->string('icon_picker')->nullable();
                $table->string('image')->nullable();
                $table->string('month')->nullable();
                $table->integer('number')->nullable();
                $table->double('float', 8, 2)->nullable();
                $table->string('password')->nullable();
                $table->string('radio')->nullable();
                $table->string('range')->nullable();
                $table->integer('select')->nullable();
                $table->string('select_from_array')->nullable();
                $table->integer('select2')->nullable();
                $table->integer('select2_from_ajax')->nullable();
                $table->string('select2_from_array')->nullable();
                $table->text('simplemde')->nullable();
                $table->text('summernote')->nullable();
                $table->text('table')->nullable();
                $table->text('textarea')->nullable();
                $table->string('text');
                $table->text('tinymce')->nullable();
                $table->string('upload')->nullable();
                $table->string('upload_multiple')->nullable();
                $table->string('url')->nullable();
                $table->text('video')->nullable();
                $table->string('week')->nullable();
                $table->text('extras')->nullable();
                $table->binary('base64_image')->nullable();
                $table->timestamps();

            });
            DB::statement('ALTER TABLE `monsters` 
            ADD PRIMARY KEY (`id`)');

        }
        // Tạo bảng monster_article
        if (!Schema::hasTable('monster_article')) {
            Schema::create('monster_article', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('monster_id');
                $table->unsignedBigInteger('article_id');
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại
                $table->foreign('monster_id')->references('id')->on('monsters')->onDelete('cascade');
                $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
                DB::statement('ALTER TABLE `monster_article` 
                ADD PRIMARY KEY (`id`)');

            });
        }
        // Tạo bảng monster_category
        if (!Schema::hasTable('monster_category')) {
            Schema::create('monster_category', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('monster_id');
                $table->unsignedBigInteger('category_id');
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại
                $table->foreign('monster_id')->references('id')->on('monsters')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                DB::statement('ALTER TABLE `monster_category` 
                ADD PRIMARY KEY (`id`)');

            });
        }
        // Tạo bảng monster_tag
        if (!Schema::hasTable('monster_tag')) {
            Schema::create('monster_tag', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('monster_id');
                $table->unsignedBigInteger('tag_id');
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại
                $table->foreign('monster_id')->references('id')->on('monsters')->onDelete('cascade');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
                DB::statement('ALTER TABLE `monster_tag` 
                ADD PRIMARY KEY (`id`)');

            });
        }
        if (!Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->unsignedBigInteger('category_id');
                $table->timestamps();
                $table->softDeletes();

                // Ràng buộc khóa ngoại
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
                DB::statement('ALTER TABLE `news` 
                ADD PRIMARY KEY (`id`)');

            });
        }
        // Tạo bảng pages
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->string('template');
                $table->string('name');
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('content')->nullable();
                $table->text('extras')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
            DB::statement('ALTER TABLE `pages` 
  ADD PRIMARY KEY (`id`)');

        }

        // Tạo bảng password_resets
        if (!Schema::hasTable('password_resets')) {
            Schema::create('password_resets', function (Blueprint $table) {
                $table->string('email')->index();
                $table->string('token');
                $table->timestamp('created_at')->default(now())->useCurrentOnUpdate();
            });
            DB::statement('ALTER TABLE `password_resets` 
  ADD KEY `password_resets_email_index` (`email`), 
  ADD KEY `password_resets_token_index` (`token`)');

        }
        // Tạo bảng permissions
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('guard_name');
                $table->timestamps();
            });
            DB::statement('ALTER TABLE `permissions` 
  ADD PRIMARY KEY (`id`)');

        }
        // Tạo bảng postalboxes
        if (!Schema::hasTable('postalboxes')) {
            Schema::create('postalboxes', function (Blueprint $table) {
                $table->id();
                $table->string('postal_name')->nullable();
                $table->unsignedBigInteger('monster_id');
                $table->timestamps();

                // Ràng buộc khóa ngoại
                $table->foreign('monster_id')->references('id')->on('monsters')->onDelete('cascade');
            });
            DB::statement('ALTER TABLE `postalboxes` 
  ADD PRIMARY KEY (`id`)');

        }

        // Tạo bảng products
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->nullable();
                $table->unsignedBigInteger('id_type')->nullable();
                $table->text('description')->nullable();
                $table->float('unit_price')->nullable();
                $table->float('promotion_price')->nullable();
                $table->string('image', 255)->nullable();
                $table->string('unit', 255)->nullable();
                $table->tinyInteger('new')->default(0);
                $table->timestamps();

                // Ràng buộc khóa ngoại
                $table->foreign('id_type')->references('id')->on('product_types')->onDelete('set null');
                DB::statement('ALTER TABLE `products` 
                ADD PRIMARY KEY (`id`), 
                ADD KEY `products_id_type_foreign` (`id_type`)');

            });
            // Tạo bảng revisions
            if (!Schema::hasTable('revisions')) {
                Schema::create('revisions', function (Blueprint $table) {
                    $table->id();
                    $table->string('revisionable_type');
                    $table->unsignedBigInteger('revisionable_id');
                    $table->unsignedBigInteger('user_id')->nullable();
                    $table->string('key');
                    $table->text('old_value')->nullable();
                    $table->text('new_value')->nullable();
                    $table->timestamps();

                    // Ràng buộc khóa ngoại
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                    DB::statement('ALTER TABLE `revisions` 
                    ADD PRIMARY KEY (`id`), 
                    ADD KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`, `revisionable_type`)');

                });
            }
        }
        // Tạo bảng roles
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('guard_name');
                $table->timestamps();
            });
            DB::statement('ALTER TABLE `roles` 
  ADD PRIMARY KEY (`id`)');

        }
        // Tạo bảng role_has_permissions
        if (!Schema::hasTable('role_has_permissions')) {
            Schema::create('role_has_permissions', function (Blueprint $table) {
                $table->unsignedBigInteger('permission_id');
                $table->unsignedBigInteger('role_id');

                // Ràng buộc khóa ngoại
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

                // Định nghĩa khóa chính
                $table->primary(['permission_id', 'role_id']);
            });
            DB::statement('ALTER TABLE `role_has_permissions` 
  ADD PRIMARY KEY (`permission_id`, `role_id`), 
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`)');

        }
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->string('name');
                $table->string('description')->nullable();
                $table->string('value')->nullable();
                $table->text('field');
                $table->boolean('active')->default(1);
                $table->timestamps();
            });
            DB::statement('ALTER TABLE `settings` 
  ADD PRIMARY KEY (`id`)');

        }
        if (!Schema::hasTable('slide')) {
            Schema::create('slide', function (Blueprint $table) {
                $table->id();
                $table->string('link', 100);
                $table->string('image', 100);
            });
            DB::statement('ALTER TABLE `slide` 
  ADD PRIMARY KEY (`id`)');

        }
        if (!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('slug', 255);
                $table->timestamps();
                $table->softDeletes();
            });
            DB::statement('ALTER TABLE `tags` 
  ADD PRIMARY KEY (`id`), 
  ADD UNIQUE KEY `tags_slug_unique` (`slug`)');

        }
        if (!Schema::hasTable('type_products')) {
            Schema::create('type_products', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->text('description');
                $table->string('image', 255);
                $table->timestamps();
            });
            DB::statement('ALTER TABLE `type_products` 
  ADD PRIMARY KEY (`id`)');

        }
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id(); // Tự động tạo khóa chính (int(10) UNSIGNED)
                $table->string('name', 255);
                $table->string('email', 255)->unique();
                $table->string('password', 255);
                $table->string('remember_token', 100)->nullable();
                $table->timestamps();
            });
            DB::statement('ALTER TABLE `users` 
  ADD PRIMARY KEY (`id`), 
  ADD UNIQUE KEY `users_email_unique` (`email`)');

        }
        if (!Schema::hasTable('wishlists')) {
            Schema::create('wishlists', function (Blueprint $table) {
                $table->id(); // Tự động tạo khóa chính (int(10) UNSIGNED)
                $table->unsignedBigInteger('id_user');
                $table->unsignedBigInteger('id_product');
                $table->integer('quantity')->default(1);
                $table->timestamps();

                // Ràng buộc khóa ngoại
                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            });
            DB::statement('ALTER TABLE `wishlists` 
  ADD PRIMARY KEY (`id`), 
  ADD KEY `wishlists_id_user_index` (`id_user`), 
  ADD KEY `wishlists_id_product_index` (`id_product`)');

        }
        return response()->json(['message' => 'Tables created successfully!']);
    }
}
