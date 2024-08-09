<?php
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\allOfOrdersController;
use App\Http\Controllers\Admin\insure_mealController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\messageController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ProfitsController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\ChiefController;
use App\Http\Controllers\User\ContuctController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\StripController;
use App\Http\Controllers\SocialiteController;
use App\Models\Address;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

|Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/checkout',[StripController::class,'checkout']);
Route::get('/success',[StripController::class,'success'])->name('success');
Route::get('/strip',[StripController::class,'index'])->name('index');
*/

Route::get('/test', function () {
    return view('user.test');
});

Route::post('/ajax', [TrackingController::class,'index']);

Route::get('/', function () {
    return view('welcome');
});
Route::get('auth/google',[SocialiteController::class,'redirectToGoogle']);
Route::get('User/callback',[SocialiteController::class,'handleCallback']);

Route::resource('products',ProductController::class);

Route::resource('comment',CommentController::class);

Route::resource('evaluation',EvaluationController::class);

Route::resource('Meals',MealController::class);

Route::resource('insure_meal',insure_mealController::class);

Route::resource('admins',EmployeesController::class);

Route::resource('users',UserController::class);

Route::resource('checkout',CheckoutController::class);

Route::resource('orders',OrderController::class);

Route::resource('sale',SaleController::class);

Route::get('delivery',function(){

    return view('Delivery.home');
});

Route::get('active',[DeliveryController::class, 'active']);
Route::get('completed',[DeliveryController::class, 'completed']);
Route::get('pending',[DeliveryController::class, 'pending']);
Route::get('Area',[DeliveryController::class, 'Area']);

Route::resource('Admin-home',HomeController::class);

Route::get('special-meal',function(){

    return view('User.Meal-DB-API.meal');
});

Route::get('Monthly_reports',function(){
    return view('Admin/monthly_reports');
});

Route::resource('profits', ProfitsController::class);

Route::resource('messages',messageController::class);

Route::get('about',[ChiefController::class,'index'])->middleware(['auth', 'verified']);

Route::get('menu',[UserHomeController::class,'create'])->middleware(['auth', 'verified']);

Route::get('main_dish',[UserHomeController::class,'Main_dish'])->middleware(['auth', 'verified']);
Route::get('fast_food',[UserHomeController::class,'fast'])->middleware(['auth', 'verified']);
Route::get('drink',[UserHomeController::class,'drink'])->middleware(['auth', 'verified']);
Route::get('dessert',[UserHomeController::class,'dessert'])->middleware(['auth', 'verified']);
Route::get('gluten',[UserHomeController::class,'gluten'])->middleware(['auth', 'verified']);
Route::get('diabetes',[UserHomeController::class,'diabetes'])->middleware(['auth', 'verified']);
Route::get('Kidney_friendly',[UserHomeController::class,'Kidney_friendly'])->middleware(['auth', 'verified']);
Route::get('Vegetarian',[UserHomeController::class,'Vegetarian'])->middleware(['auth', 'verified']);

Route::resource('order',allOfOrdersController::class);

Route::get('payment', function () {
    return view('User.payment');
});

Route::get('Learn', function () {
    return view('User.learn_about_food');
});
// // Route::get('quick_view', function () {
// //     return view('User.quick_view');
// // });

Route::get('location', function () {
    return view('Admin.location');
});

Route::get('search_product',[SearchController::class,'index']);

Route::resource('address',AddressController::class);

Route::resource('cart',CartController::class);

Route::resource('contuct',ContuctController::class);

Route::resource('sendmail',MailerController::class);

Route::get('MarkAsRead_all',[OrderController::class,'MarkAsRead_all']);
//Route::get('sendmail',[MailerController::class,'index'])->name('sendmail');

//Route::post('sendmail',[MailerController::class,'composeEmail'])->name('sendmail');

//Route::get('mail', function () {
 //   return view('Admin.email');
//})->name('mail');

Route::get('/profile_user',function(){
    return view('profile/partials/profile_user' , ['address' => Address::limit(1)->get()->where('user_id',Auth::user()->name)]);
})->name('profile_user');

Route::get('/dashboard',[UserHomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Auth::routes(['verify' => true]);

//static::$app->make('router')->auth('verified');

require __DIR__.'/auth.php';
