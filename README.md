<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


one user can have many roles

по полиморфому. полиморф не подходит, т.к у тебя может быть что-то одно, а тебе нужно всё, пост профиль или родительсий коментарий
если ты хочешь сделать в дочерней сущности айди нуллабле, то это повод для полиморфа или если видишь несколько пивотных таблиц например пост_комментс и видео_комментс

почему images, likeables? на самом деле название в данном контексте значение не имеет

начинаем с простых отношений, а потом в полиморф? возможно, но лучше так не делать 

решение по изменению в бд на продакшене когда мы увидили несколько дублирующихся пивотных таблиц например пост_имаджес и коммент_имаджес и т.д
как тогда действкуем fresh на проде не сделаешь

нужно ли схлопывать миграции? нет, не нужно.

если используем софт делит, не кончиться ли память? зависит от проекта вбольшенстве своём об этом не нужно беспокоиться.

размышлял по поводу просмотров(views)
разве тут не зависит от контекста?
могут ли просматривать не зарегистрированные пользователи посты? если да то это не многие ко многим(это один ко многим полиморфное) если нет, то многоие ко многим
у нас будет привязка просмотра к профилю?
ответ. В нашем случае надо, чтобы можно было посмотреть, кто просмотрел

```
php artisan make:migration add_description_in_posts_table
php artisan make:migration drop_colum_description_in_posts_table
php artisan make:migration change_title_in_posts_table
php artisan make:migration rename_title_in_posts_table
php artisan make:migration add_fk_in_posts_table
```

```
profiles
            $table->string('name');
            $table->foreignId('user_id')->index()->constrained('users');
            $table->string('phone')->unique();
            $table->string('address');
            $table->enum('gender', ['male', 'female', 'other']);
```

```
categories
$table->string('title');
```

```
posts
            $table->string('title');
            $table->text('content')->nullable();
            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->boolean('is_published')->default(true);
            $table->string('image_path')->unique();
            $table->foreignId('category_id')->index()->constrained('categories');
            $table->dateTime('published_at')->index();
```

```
comments
            $table->morphs('commentable');
            $table->text('content');
            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->boolean('status')->default(true);
            $table->foreignId('parent_id')->nullable()->index()->constrained('comments');
```

```
tags
$table->string('title');
```

```
roles
$table->string('title');
```

```
post_tag
            $table->foreignId('post_id')->index()->constrained('posts');
            $table->foreignId('tag_id')->index()->constrained('tags');
```

```
role_user
            $table->foreignId('role_id')->index()->constrained('roles');
            $table->foreignId('user_id')->index()->constrained('users');
```

```
images
$table->morphs('imageable');
```

```
likeables
            $table->morphs('likeable');
            $table->foreignIdFor(Profile::class)->index()->constrained();
```

```
viewables
            $table->morphs('viewable');
            $table->foreignIdFor(Profile::class)->index()->constrained();
```
