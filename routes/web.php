<?php

use App\Http\Controllers\Category\Post\IndexController as PostCategori;
use App\Http\Controllers\Category\IndexController as Category;
use App\Http\Controllers\Post\Like\StoreController as StoreLike;
use App\Http\Controllers\Post\Comment\StoreController as StoreComment;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\IndexController as PostIndex;
use App\Http\Controllers\Personal\Comment\CommentController;
use App\Http\Controllers\Personal\Comment\EditController as EditComment;
use App\Http\Controllers\Personal\Comment\UpdateController as UpdateComment;
use App\Http\Controllers\Personal\Liked\DeleteController;
use App\Http\Controllers\Personal\Liked\LikedController;
use App\Http\Controllers\Personal\Main\PersonalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\IndexController as IndexMain;
use App\Http\Controllers\Admin\Main\AdminController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Post\CreateController as CreatePost;
use App\Http\Controllers\Admin\Post\StoreController as StorePost;
use App\Http\Controllers\Admin\Post\ShowController as ShowPost;
use App\Http\Controllers\Admin\Post\EditController as EditPost;
use App\Http\Controllers\Admin\Post\UpdateController as UpdatePost;
use App\Http\Controllers\Admin\Post\DeleteController as DeletePost;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\CreateController as CreateCategory;
use App\Http\Controllers\Admin\Category\StoreController as StoreCategory;
use App\Http\Controllers\Admin\Category\ShowController as ShowCategory;
use App\Http\Controllers\Admin\Category\EditController as EditCategory;
use App\Http\Controllers\Admin\Category\UpdateController as UpdateCategory;
use App\Http\Controllers\Admin\Category\DeleteController as DeleteCategory;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\Tag\CreateController as CreateTag;
use App\Http\Controllers\Admin\Tag\StoreController as StoreTag;
use App\Http\Controllers\Admin\Tag\ShowController as ShowTag;
use App\Http\Controllers\Admin\Tag\EditController as EditTag;
use App\Http\Controllers\Admin\Tag\UpdateController as UpdateTag;
use App\Http\Controllers\Admin\Tag\DeleteController as DeleteTag;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\CreateController as CreateUser;
use App\Http\Controllers\Admin\User\StoreController as StoreUser;
use App\Http\Controllers\Admin\User\ShowController as ShowUser;
use App\Http\Controllers\Admin\User\EditController as EditUser;
use App\Http\Controllers\Admin\User\UpdateController as UpdateUser;
use App\Http\Controllers\Admin\User\DeleteController as DeleteUser;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', IndexMain::class)->name('main.index');

Route::group(['prefix' => 'posts'], function() {
    Route::get('/', PostIndex::class)->name('post.index');
    Route::get('/{post}', ShowController::class)->name('post.show');

    Route::group(['prefix' => '{post}/comments'], function() {
        Route::post('/', StoreComment::class)->name('post.comment.store');
    });
    Route::group(['prefix' => '{post}/likes'], function() {
        Route::post('/', StoreLike::class)->name('post.like.store');
    });
});

Route::group(['prefix' => 'categories'], function() {
    Route::get('/', Category::class)->name('category.index');

    Route::group(['prefix' => '{category}/posts'], function() {
        Route::get('/', PostCategori::class)->name('category.post.index');
    });
});

Route::group(['middleware' => ['auth','verified']], function() {

    Route::prefix('personal')->group(function () {
            Route::get('/', PersonalController::class)->name('personal.main');
        });
            Route::prefix('liked')->group(function () {
                    Route::get('/', LikedController::class)->name('personal.liked.index');
                    Route::delete('/{post}', DeleteController::class)->name('personal.liked.delete');
                });
            Route::prefix('comment')->group(function () {
                    Route::get('/', CommentController::class)->name('personal.comment.index');
                    Route::get('/{comment}/edit', EditComment::class)->name('personal.comment.edit');
                    Route::patch('/{comment}', UpdateComment::class)->name('personal.comment.update');
                    Route::delete('/{comment}', DeleteController::class)->name('personal.comment.delete');
                });
});

Route::group(['middleware' => ['auth', 'admin','verified']], function(){

Route::prefix('admin')->group(function () {
    Route::name('main')->group(function () {
        Route::get('/', AdminController::class);
    });

            Route::prefix('posts')->group(function () {
                Route::get('/', PostController::class)->name('admin.post.index');
                Route::get('/create', CreatePost::class)->name('admin.post.create');
                Route::post('/', StorePost::class)->name('admin.post.store');
                Route::get('/{post}', ShowPost::class)->name('admin.post.show');
                Route::get('/{post}/edit', EditPost::class)->name('admin.post.edit');
                Route::patch('/{post}', UpdatePost::class)->name('admin.post.update');
                Route::delete('/{post}', DeletePost::class)->name('admin.post.delete');
            });

            Route::prefix('categories')->group(function () {
                Route::get('/', CategoryController::class)->name('admin.category.index');
                Route::get('/create', CreateCategory::class)->name('admin.category.create');
                Route::post('/', StoreCategory::class)->name('admin.category.store');
                Route::get('/{category}', ShowCategory::class)->name('admin.category.show');
                Route::get('/{category}/edit', EditCategory::class)->name('admin.category.edit');
                Route::patch('/{category}', UpdateCategory::class)->name('admin.category.update');
                Route::delete('/{category}', DeleteCategory::class)->name('admin.category.delete');
            });

            Route::prefix('tags')->group(function () {
                Route::get('/', TagController::class)->name('admin.tag.index');
                Route::get('/create', CreateTag::class)->name('admin.tag.create');
                Route::post('/', StoreTag::class)->name('admin.tag.store');
                Route::get('/{tag}', ShowTag::class)->name('admin.tag.show');
                Route::get('/{tag}/edit', EditTag::class)->name('admin.tag.edit');
                Route::patch('/{tag}', UpdateTag::class)->name('admin.tag.update');
                Route::delete('/{tag}', DeleteTag::class)->name('admin.tag.delete');
            });

            Route::prefix('users')->group(function () {
                Route::get('/', UserController::class)->name('admin.user.index');
                Route::get('/create', CreateUser::class)->name('admin.user.create');
                Route::post('/', StoreUser::class)->name('admin.user.store');
                Route::get('/{user}', ShowUser::class)->name('admin.user.show');
                Route::get('/{user}/edit', EditUser::class)->name('admin.user.edit');
                Route::patch('/{user}', UpdateUser::class)->name('admin.user.update');
                Route::delete('/{user}', DeleteUser::class)->name('admin.user.delete');
            });
        });
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        require __DIR__ . '/auth.php';
    });
    Auth::routes(['verify' => true]);
