<?php

use App\Models\Client;
use App\Models\CallToAction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WhyWorkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CoverImageController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\CallToActionController;
use App\Http\Controllers\Admin\ManageUser\RoleController;
use App\Http\Controllers\Admin\ManageUser\UserController;
use App\Http\Controllers\Admin\ManageUser\PermissionController;

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home.page');
    Route::get('/about-us', 'aboutUs')->name('about-us.page');
    Route::get('/service', 'service')->name('service');
    Route::get('/service/details/{slug}', 'serviceDetails')->name('service.details');
    Route::get('/products', 'products')->name('products.page');
    Route::get('/news', 'news')->name('news.page');
    Route::get('/news/details/{slug}', 'newsDetails')->name('news.details');
    Route::get('/blogs', 'blogs')->name('blogs.page');
    Route::get('/blogs/details/{slug}', 'blogDetails')->name('blog.details');
    Route::get('/blogs/tag', 'blogTag')->name('blog.tag');
    Route::get('/contact-us', 'contactUs')->name('contact-us.page');
    Route::get('/blogs/category', 'blogCategory')->name('blog.category');

    Route::get('/news-and-blogs', 'newsAndBlogs')->name('all.blogs');
    Route::get('/powerhouse-team', 'powerhouseTeam')->name('powerhouse.team');

    Route::get('/gallery', 'gallery')->name('gallery.page');
    Route::get('/gallery/{number}', 'images')->name('gallery.all');

    Route::get('/search', 'globalSearchPage')->name('global.search.page');
    Route::get('/search/suggestions', 'globalSearchSuggestions')->name('global.search.suggestions');
    Route::post('/assistant/ask', 'askAssistant')->name('assistant.ask');

    Route::get('/blogs/search', 'searchBlogs')->name('blogs.search');
    Route::post('/contact-messege/send', 'sendContactMessage')->name('contactmessage.send');

    Route::get('/career/page', 'career')->name('career.page');
    Route::post('/job-apply','apply')->name('job.apply');


});

Route::middleware(['auth:admin', 'verified'])->group(function () {
    // support apis
    Route::get('/active-clients', [ClientController::class, 'activeClients'])->name('active.clients');


    Route::prefix('/dashboard')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'adminDashboard')->name('dashboard');
    });
    Route::prefix('/dashboard')->controller(SliderController::class)->group(function () {
        Route::get('/slider', 'index')->name('slider.index');
        Route::post('/slider/store', 'store')->name('slider.store');
        Route::get('/slider/toggle-status/{id}', 'toggleStatus')->name('slider.toggle-status');
        Route::put('/slider/update/{id}', 'update')->name('slider.update');
        Route::delete('/slider/destroy/{id}', 'destroy')->name('slider.destroy');
        Route::get('/slider-counter/toggle-status/{id}', 'counterToggleStatus')->name('slider-counter.toggle-status');
        Route::put('/slider-counter/update/{id}', 'counterUpdate')->name('slider-counter.update');
    });
    Route::prefix('/dashboard')->controller(CounterController::class)->group(function () {
        Route::get('/counter', 'index')->name('counter.index');
        Route::post('/counter/store', 'store')->name('counter.store');
        Route::get('/counter/toggle-status/{id}', 'toggleStatus')->name('counter.toggle-status');
        Route::put('/counter/update/{id}', 'update')->name('counter.update');
        Route::delete('/counter/destroy/{id}', 'destroy')->name('counter.destroy');

    });

    Route::prefix('/dashboard')->controller(CallToActionController::class)->group(function () {
        Route::get('/call-to-action', 'index')->name('action.index');
        Route::get('/call-to-action/toggle-status/{id}', 'toggleStatus')->name('action.toggle-status');
        Route::put('/call-to-action/update/{id}', 'update')->name('action.update');
    });
    Route::prefix('/dashboard')->controller(ApplicationController::class)->group(function () {
        Route::get('/application', 'index')->name('application.index');
        Route::post('/application/store', 'store')->name('application.store');
        Route::get('/application/toggle-status/{id}', 'toggleStatus')->name('application.toggle-status');
        Route::post('/application/show-url/{id}', 'showURL')->name('application.showUrl');
        Route::put('/application/update/{id}', 'update')->name('application.update');
        Route::delete('/application/destroy/{id}', 'destroy')->name('application.destroy');
    });
    Route::prefix('/dashboard')->controller(AboutUsController::class)->group(function () {
        Route::get('/about-us', 'index')->name('about-us');
        Route::get('/about-us/toggle-status/{id}', 'toggleStatus')->name('about-us.toggle-status');
        Route::get('/about-us//edit/{id}', 'edit')->name('about-us.edit');
        Route::put('/about-us/update/{id}', 'update')->name('about-us.update');
    });
    Route::prefix('/dashboard')->controller(WhyWorkController::class)->group(function () {
        Route::get('/why-work', 'index')->name('why-work.index');
        Route::post('/why-work/store', 'store')->name('why-work.store');
        Route::get('/why-work/toggle-status/{id}', 'toggleStatus')->name('why-work.toggle-status');
        Route::put('/why-work/update/{id}', 'update')->name('why-work.update');
        Route::delete('/why-work/destroy/{id}', 'destroy')->name('why-work.destroy');
        Route::get('/why-work/image/toggle-status/{id}', 'imageToggleStatus')->name('image.toggle-status');
        Route::put('/why-work/image/update/{id}', 'imageUpdate')->name('image.update');
    });
    Route::prefix('/dashboard')->controller(ServiceController::class)->group(function () {
        Route::get('/service', 'index')->name('service.index');
        Route::post('/service/store', 'store')->name('service.store');
        Route::get('/service/toggle-status/{id}', 'toggleStatus')->name('service.toggle-status');
        Route::get('/service/edit/{id}', 'edit')->name('service.edit');


        Route::get('/api/services/{service}', [ServiceController::class, 'apiServiceShow']);
        Route::put('/api/services/why-need/update/{service}', [ServiceController::class, 'apiWhyNeedUpdate'])->name('why-need.update');
        Route::delete('/api/services/{service}/needs/{serviceNeed}', [ServiceController::class, 'apiWhyNeedDestroy'])->name('why-need.destroy');


        Route::put('/service/update/{id}', 'update')->name('service.update');
        Route::delete('/service/destroy/{id}', 'destroy')->name('service.destroy');
        //    Route::put('/service/why-need/update/{id}',  'whyNeed')->name('why-need.update');

        Route::put('/service/offered-services/{service}', 'offeredService')->name('offered-services.update');
        // Route::put('/service/offered-services/update/{id}',  'offeredService')->name('offered-services.update');
        Route::post('/service/service-faq/update/{id}', 'faqUpdate')->name('service-faq.update');
        Route::put('/service/development-process/update/{id}', 'processUpdate')->name('development-process.update');
        Route::post('/service/technology/update/{id}', 'technologyUpdate')->name('technology.update');

        Route::post('/service/provided-client/store/{id}', 'storeclient')->name('provided-client.store');
        Route::post('/service/provided-client/toggle-status/{id}', 'toggleclientStatus')->name('provided-client.toggle-status');
        Route::post('/service/provided-client/update/{id}', 'updateclient')->name('provided-client.update');
        Route::post('/service/provided-client/show-url/{id}', 'showURL')->name('provided-client.showUrl');
        Route::delete('/service/provided-client/destroy/{id}', 'destroyclient')->name('provided-client.destroy');


        Route::delete('/service/benefits/{id}', 'destroyBenefit')->name('service.benefit.destroy');
        Route::delete('/service/offered-services/{id}', 'destroyOfferedServices')->name('service.offered-services.destroy');
        Route::delete('/service/development-process/{id}', 'destroyDevelopmentProcess')->name('service.development-process.destroy');
        Route::delete('/service/technology/{id}', 'destroyTechnology')->name('service.technology.destroy');
        Route::delete('/service/faq/{id}', 'destroyFaq')->name('service.faq.destroy');



    });

    Route::prefix('/dashboard')->controller(CoverImageController::class)->group(function () {
        Route::get('/cover-image', 'index')->name('cover-image');
        Route::get('/cover-images', 'loadCoverImage')->name('cover-images.index');

        Route::post('/cover_images', 'store')->name('cover_images.store');
        // New route for updating a specific cover image
        Route::post('/cover-image/update', 'updateImage')->name('cover-image.update');

    });


    Route::prefix('/dashboard')->controller(CareerController::class)->group(function () {
        Route::get('/career', 'index')->name('career.index');
        Route::post('/career/store', 'store')->name('career.store');
        Route::get('/career/toggle-status/{id}', 'toggleStatus')->name('career.toggle-status');
        Route::get('/career/edit/{id}', 'edit')->name('career.edit');

        Route::put('/career/update/{id}', 'update')->name('career.update');
        Route::delete('/career/destroy/{id}', 'destroy')->name('career.destroy');

        Route::get('/career/applications/{id}', 'getApplications')->name('career.applications');
        Route::delete('/career/job-applications/{id}/{careerId}',  'destroyApplication')->name('career.application.destroy');
    });


    Route::prefix('/dashboard')->controller(AlbumController::class)->group(function () {
        Route::get('/album', 'index')->name('album.index');
        Route::post('/album/store', 'store')->name('album.store');
        Route::get('/album/datatable', 'getDatatable')->name('album.datatable');
        Route::post('/album/image-video/store', 'storeImageVideo')->name('album.imageVideo.store');

        Route::get('/album/toggle-status/{id}', 'toggleStatus')->name('album.toggle-status');
        Route::get('/album/{id}/edit', 'edit')->name('album.edit');

        Route::get('/album/get/image-video/{id}', 'getImageVideo')->name('album.imageVideo');

        Route::delete('/album/image-video/delete/{id}', 'deleteImageVideo')->name('album.imageVideo.delete');

        Route::put('/album/update/{id}', 'update')->name('album.update');
        Route::delete('/album/destroy/{id}', 'destroy')->name('album.destroy');

    });

    Route::prefix('/dashboard')->controller(ContactController::class)->group(function () {
        Route::get('/messages', 'contactMessages')->name('contact.messages');
        Route::get('/messages/unread', 'unreadContactMessages')->name('contact.messages.unread');
        Route::get('/messages/read', 'readContactMessages')->name('contact.messages.read');

        Route::get('/api/messages', 'apiMessages')->name('api.messages');
        Route::get('/api/read/messages', 'readMessages')->name('api.read.messages');
        Route::post('/api/messages/{id}/status', 'updateStatus');
        Route::delete('/api/messages/{id}', 'destroyMessage');
    });


    Route::prefix('/dashboard/member')->controller(MemberController::class)->group(function () {
        Route::get('/', 'index')->name('member.index');
        Route::get('/get', 'get')->name('member.get');
        Route::post('/store', 'store')->name('member.store');
        Route::get('/edit/{id}', 'edit')->name('member.edit');
        Route::put('/update/{id}', 'update')->name('member.update');
        Route::delete('/delete/{id}', 'destroy')->name('member.destroy');
        Route::post('/status/{id}', 'status')->name('member.status');



        Route::get('/management-body/index', 'indexManagementBody')->name('management.body.index');
        Route::get('/management-body/get', 'getManagementBody')->name('management.body.get');
        Route::post('/management-body/store', 'storeManagementBody')->name('management.body.store');
        Route::get('/management-body/edit/{id}', 'editManagementBody')->name('management.body.edit');
        Route::put('/management-body/update/{id}', 'updateManagementBody')->name('management.body.update');
        Route::delete('/management-body/delete/{id}', 'destroyManagementBody')->name('management.body.destroy');
        Route::post('/management-body/status/{id}', 'statusManagementBody')->name('management.body.status');

    });


    Route::prefix('/dashboard')->controller(ClientController::class)->group(function () {
        Route::get('/client', 'index')->name('client');
        Route::post('/client/store', 'store')->name('client.store');
        Route::get('/client/toggle-status/{id}', 'toggleStatus')->name('client.toggle-status');
        Route::post('/client/show-url/{id}', 'showURL')->name('client.showUrl');
        Route::put('/client/update/{id}', 'update')->name('client.update');
        Route::delete('/client/destroy/{id}', 'destroy')->name('client.destroy');
    });
    Route::prefix('/dashboard')->controller(TestimonialController::class)->group(function () {
        Route::get('/testimonial', 'index')->name('testimonial');
        Route::post('/testimonial/store', 'store')->name('testimonial.store');
        Route::get('/testimonial/toggle-status/{id}', 'toggleStatus')->name('testimonial.toggle-status');
        Route::put('/testimonial/update/{id}', 'update')->name('testimonial.update');
        Route::delete('/testimonial/destroy/{id}', 'destroy')->name('testimonial.destroy');
    });
    Route::prefix('/dashboard')->controller(BlogController::class)->group(function () {
        Route::get('/blog', 'index')->name('blog.index');
        Route::post('/blog/category/store', 'storeCategory')->name('blog-category.store');
        Route::get('/blog/category/toggle-status/{id}', 'toggleCategoryStatus')->name('blog-category.toggle-status');
        Route::put('/blog/category/update/{id}', 'updateCategory')->name('blog-category.update');
        Route::delete('/blog/category/destroy/{id}', 'destroyCategory')->name('blog-category.destroy');
        Route::post('/blog/store', 'store')->name('blog.store');
        Route::get('/blog/toggle-status/{id}', 'toggleStatus')->name('blog.toggle-status');
        Route::put('/blog/update/{id}', 'update')->name('blog.update');
        Route::delete('/blog/destroy/{id}', 'destroy')->name('blog.destroy');
    });

    Route::prefix('/dashboard')->controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product.index');
        Route::post('/product/category/store', 'storeCategory')->name('product-category.store');
        Route::get('/product/category/toggle-status/{id}', 'toggleCategoryStatus')->name('product-category.toggle-status');
        Route::put('/product/category/update/{id}', 'updateCategory')->name('product-category.update');
        Route::delete('/product/category/destroy/{id}', 'destroyCategory')->name('product-category.destroy');
        Route::post('/product/store', 'store')->name('product.store');
        Route::get('/product/toggle-status/{id}', 'toggleStatus')->name('product.toggle-status');
        Route::put('/product/update/{id}', 'update')->name('product.update');
        Route::delete('/product/destroy/{id}', 'destroy')->name('product.destroy');
    });


    Route::prefix('/dashboard')->controller(FaqController::class)->group(function () {
        Route::get('/faq', 'index')->name('faq');
        Route::post('/faq/store', 'store')->name('faq.store');
        Route::get('/faq/toggle-status/{id}', 'toggleStatus')->name('faq.toggle-status');
        Route::put('/faq/update/{id}', 'update')->name('faq.update');
        Route::delete('/faq/destroy/{id}', 'destroy')->name('faq.destroy');
    });
    Route::prefix('/dashboard')->controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('contact');
        Route::post('/contact/store', 'store')->name('contact.store');
        Route::get('/contact/toggle-status/{id}', 'toggleStatus')->name('contact.toggle-status');
        Route::put('/contact/update/{id}', 'update')->name('contact.update');
        Route::delete('/contact/destroy/{id}', 'destroy')->name('contact.destroy');
    });
    Route::prefix('/dashboard')->controller(SettingController::class)->group(function () {
        Route::get('/setting', 'index')->name('settings.index');
        Route::put('/setting/update/{id}', [SettingController::class, 'update'])->name('settings.update');
    });

    Route::prefix('/dashboard/maintenance')->controller(MaintenanceController::class)->group(function () {
        Route::get('/', 'index')->name('maintenance');
        Route::get('/cache-clear', 'clearCache')->name('cache-clear');
        Route::get('/storage-link', 'storageLink')->name('storage-link');
    });

    Route::resource('/dashboard/manageuser', UserController::class);
    Route::get('/dashboard/manageuser/status/{id}', [UserController::class, 'status'])->name('status.manageuser');
    Route::resource('/dashboard/manageuserrole', RoleController::class);
    Route::get('/dashboard/manageuserrole/role/{roleId}', [RoleController::class, 'addPermissionToRole'])->name('manageuserrole.addPermissionToRole');
    Route::put('/dashboard/manageuserrole/role/{roleId}', [RoleController::class, 'givePermissionToRole'])->name('manageuserrole.givePermissionToRole');
    Route::resource('/dashboard/permission', PermissionController::class);

});

Route::controller(LoginController::class)->group(function () {
    Route::post('/admin-login', 'adminLogin')->name('admin-login');
    Route::post('/custom-logout', 'logout')->name('custom-logout');
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
