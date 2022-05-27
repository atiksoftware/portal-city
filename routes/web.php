<?php

use Illuminate\Support\Facades\Route;

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

// group by /admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function (): void {
	Route::get('/', function () {
		return redirect()->route('admin.posts');
	});

	Route::group(['prefix' => 'posts'], function (): void {
		Route::get('/', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.posts');
		Route::group(['prefix' => 'edit'], function (): void {
			Route::get('/', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.posts.create');
			Route::post('/', [\App\Http\Controllers\Admin\PostController::class, 'save']);
			Route::get('/{id}', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.posts.edit');
			Route::post('/{id}', [\App\Http\Controllers\Admin\PostController::class, 'save']);
		});
		Route::group(['prefix' => 'remove'], function (): void {
			Route::get('/{post:id}', [\App\Http\Controllers\Admin\PostController::class, 'remove'])->scopeBindings()->name('admin.posts.remove');
			Route::post('/{post:id}', [\App\Http\Controllers\Admin\PostController::class, 'destroy'])->scopeBindings();
		});
	});

	Route::group(['prefix' => 'businesses'], function (): void {
		Route::get('/', [\App\Http\Controllers\Admin\BusinessController::class, 'index'])->name('admin.businesses');
		Route::group(['prefix' => 'edit'], function (): void {
			Route::get('/', [\App\Http\Controllers\Admin\BusinessController::class, 'edit'])->name('admin.businesses.create');
			Route::post('/', [\App\Http\Controllers\Admin\BusinessController::class, 'save']);
			Route::get('/{id}', [\App\Http\Controllers\Admin\BusinessController::class, 'edit'])->name('admin.businesses.edit');
			Route::post('/{id}', [\App\Http\Controllers\Admin\BusinessController::class, 'save']);
		});
		Route::group(['prefix' => 'remove'], function (): void {
			Route::get('/{business:id}', [\App\Http\Controllers\Admin\BusinessController::class, 'remove'])->scopeBindings()->name('admin.businesses.remove');
			Route::post('/{business:id}', [\App\Http\Controllers\Admin\BusinessController::class, 'destroy'])->scopeBindings();
		});
	});
	Route::group(['prefix' => 'business_categories'], function (): void {
		Route::get('/', [\App\Http\Controllers\Admin\BusinessCategoryController::class, 'index'])->name('admin.business_categories');
		Route::group(['prefix' => 'edit'], function (): void {
			Route::get('/', [\App\Http\Controllers\Admin\BusinessCategoryController::class, 'edit'])->name('admin.business_categories.create');
			Route::post('/', [\App\Http\Controllers\Admin\BusinessCategoryController::class, 'save']);
			Route::get('/{id}', [\App\Http\Controllers\Admin\BusinessCategoryController::class, 'edit'])->name('admin.business_categories.edit');
			Route::post('/{id}', [\App\Http\Controllers\Admin\BusinessCategoryController::class, 'save']);
		});
		Route::group(['prefix' => 'remove'], function (): void {
			Route::get('/{category:id}', [\App\Http\Controllers\Admin\BusinessCategoryController::class, 'remove'])->scopeBindings()->name('admin.business_categories.remove');
			Route::post('/{category:id}', [\App\Http\Controllers\Admin\BusinessCategoryController::class, 'destroy'])->scopeBindings();
		});
	});

	Route::group(['prefix' => 'persons'], function (): void {
		Route::get('/', [\App\Http\Controllers\Admin\PersonController::class, 'index'])->name('admin.persons');
		Route::group(['prefix' => 'edit'], function (): void {
			Route::get('/', [\App\Http\Controllers\Admin\PersonController::class, 'edit'])->name('admin.persons.create');
			Route::post('/', [\App\Http\Controllers\Admin\PersonController::class, 'save']);
			Route::get('/{id}', [\App\Http\Controllers\Admin\PersonController::class, 'edit'])->name('admin.persons.edit');
			Route::post('/{id}', [\App\Http\Controllers\Admin\PersonController::class, 'save']);
		});
		Route::group(['prefix' => 'remove'], function (): void {
			Route::get('/{person:id}', [\App\Http\Controllers\Admin\PersonController::class, 'remove'])->scopeBindings()->name('admin.persons.remove');
			Route::post('/{person:id}', [\App\Http\Controllers\Admin\PersonController::class, 'destroy'])->scopeBindings();
		});
	});

	Route::group(['prefix' => 'users'], function (): void {
		Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
		Route::group(['prefix' => 'edit'], function (): void {
			Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.create');
			Route::post('/', [\App\Http\Controllers\Admin\UserController::class, 'save']);
			Route::get('/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
			Route::post('/{id}', [\App\Http\Controllers\Admin\UserController::class, 'save']);
		});
		Route::group(['prefix' => 'remove'], function (): void {
			Route::get('/{user:id}', [\App\Http\Controllers\Admin\UserController::class, 'remove'])->scopeBindings()->name('admin.users.remove');
			Route::post('/{user:id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->scopeBindings();
		});
	});
	Route::group(['prefix' => 'adwords'], function (): void {
		Route::get('/', [\App\Http\Controllers\Admin\AdwordController::class, 'index'])->name('admin.adwords');
		Route::group(['prefix' => 'edit'], function (): void {
			Route::get('/', [\App\Http\Controllers\Admin\AdwordController::class, 'edit'])->name('admin.adwords.create');
			Route::post('/', [\App\Http\Controllers\Admin\AdwordController::class, 'save']);
			Route::get('/{id}', [\App\Http\Controllers\Admin\AdwordController::class, 'edit'])->name('admin.adwords.edit');
			Route::post('/{id}', [\App\Http\Controllers\Admin\AdwordController::class, 'save']);
		});
		Route::group(['prefix' => 'remove'], function (): void {
			Route::get('/{adword:id}', [\App\Http\Controllers\Admin\AdwordController::class, 'remove'])->scopeBindings()->name('admin.adwords.remove');
			Route::post('/{adword:id}', [\App\Http\Controllers\Admin\AdwordController::class, 'destroy'])->scopeBindings();
		});
	});
	Route::group(['prefix' => 'settings'], function (): void {
		Route::get('/', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings');
		Route::post('/', [\App\Http\Controllers\Admin\SettingsController::class, 'save']);
	});

	// // group by /admin/category
	// Route::group(['prefix' => 'category'], function (): void {
	// 	// group by /admin/category/create
	// 	Route::get('create', function () {
	// 		return 'admin/category/create';
	// 	});
	// 	// group by /admin/category/edit
	// 	Route::get('edit', function () {
	// 		return 'admin/category/edit';
	// 	});
	// 	// group by /admin/category/delete
	// 	Route::get('delete', function () {
	// 		return 'admin/category/delete';
	// 	});
	// });
});

Route::middleware('static-cache')->get('/', [\App\Http\Controllers\App\HomeController::class, 'index'])->name('home');

Route::middleware('static-cache')->get('/kimkimdir', [\App\Http\Controllers\App\PersonController::class, 'index'])->name('persons');
Route::middleware('static-cache')->get('/kimkimdir/{person:slug}', [\App\Http\Controllers\App\PersonController::class, 'view'])->scopeBindings()->name('person');

Route::middleware('static-cache')->get('/firmalar', [\App\Http\Controllers\App\BusinessController::class, 'index'])->name('businesses');
Route::middleware('static-cache')->get('/firma/{business:slug}', [\App\Http\Controllers\App\BusinessController::class, 'view'])->scopeBindings()->name('business');
Route::middleware('static-cache')->get('/firmalar/{category:slug}', [\App\Http\Controllers\App\BusinessController::class, 'by_categories'])->name('businesses.by_categories');
Route::middleware('static-cache')->get('/firmalar/{tag:name}', [\App\Http\Controllers\App\BusinessController::class, 'by_tags'])->name('businesses.by_tags');

Route::get('/sektorler', [\App\Http\Controllers\App\BusinessCategoryController::class, 'index'])->name('business_categories');

Route::middleware('static-cache')->get('/haberler', [\App\Http\Controllers\App\PostController::class, 'index'])->name('posts');
Route::middleware('static-cache')->get('/haberler/kategori/{category:slug}', [\App\Http\Controllers\App\PostController::class, 'by_category'])->scopeBindings()->name('posts.by_category');
Route::middleware('static-cache')->get('/haberler/ilce/{district:slug}', [\App\Http\Controllers\App\PostController::class, 'by_district'])->scopeBindings()->name('posts.by_district');
Route::middleware('static-cache')->get('/haberler/yazar/{user:slug}', [\App\Http\Controllers\App\PostController::class, 'by_user'])->scopeBindings()->name('posts.by_user');
Route::middleware('static-cache')->get('/haber/{post:slug}', [\App\Http\Controllers\App\PostController::class, 'view'])->scopeBindings()->name('post');
Route::middleware('static-cache')->get('/haberler/{tag:name}', [\App\Http\Controllers\App\PostController::class, 'by_tags'])->name('posts.by_tags');

Route::group(['middleware' => 'auth'], function (): void {
	Route::get('/profile', [\App\Http\Controllers\App\ProfileController::class, 'index'])->name('profile');
	Route::post('/profile', [\App\Http\Controllers\App\ProfileController::class, 'save']);

	Route::get('/my-person', [\App\Http\Controllers\App\MyPersonController::class, 'index'])->name('my-person');
	Route::post('/my-person', [\App\Http\Controllers\App\MyPersonController::class, 'save']);

	Route::get('/my-business', [\App\Http\Controllers\App\MyBusinessController::class, 'index'])->name('my-business');
	Route::post('/my-business', [\App\Http\Controllers\App\MyBusinessController::class, 'save']);
});

Route::middleware('static-cache')->get('/sitemap', [\App\Http\Controllers\SitemapController::class, 'index']);
Route::get('/sitemap/business_pagination', [\App\Http\Controllers\SitemapController::class, 'business_pagination']);
Route::get('/sitemap/businesses/{page_id}', [\App\Http\Controllers\SitemapController::class, 'businesses']);
Route::get('/sitemap/person_pagination', [\App\Http\Controllers\SitemapController::class, 'person_pagination']);
Route::get('/sitemap/persons/{page_id}', [\App\Http\Controllers\SitemapController::class, 'persons']);
Route::get('/sitemap/post_pagination', [\App\Http\Controllers\SitemapController::class, 'post_pagination']);
Route::get('/sitemap/posts/{page_id}', [\App\Http\Controllers\SitemapController::class, 'posts']);

Route::middleware('static-cache')->get('/rss', [\App\Http\Controllers\RssController::class, 'index']);

Route::get('/my-account/html', [App\Http\Controllers\App\MyAccountController::class, 'html']);

Route::get('/thread', [App\Http\Controllers\App\ThreadController::class, 'index']);

require __DIR__ . '/auth.php';
