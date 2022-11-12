<?php


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\ProfileController;
use Illuminate\Routing\Router;
use Symfony\Component\HttpKernel\Profiler\Profile;

use App\Http\Controllers\UserController;


use App\Http\Controllers\MidtransController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\OrdersinController;
use App\Models\Product;
use App\Models\transaction_detail;

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

Auth::routes();

// Halaman Admin

Route::get('/index', function () {
    return view('master.index');
});


// Halaman Admin middleware
Route::middleware(['auth', 'admin'])->group(function () {


    // Route::get('/userCRUD', function () {
    //     return view('admin.useradminCRUD');
    // });
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });
    // Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/index', function () {
        return view('master.index');
    });
    Route::resource('product', ProductController::class);
    Route::resource('category', ProductCategoryController::class);
    Route::resource('userCRUD', UserController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('ordersin', OrdersinController::class);
    Route::get('/historya', [OrdersController::class, 'history']);
    Route::get('proses/{proses}', [OrdersinController::class, 'proses'])->name('proses');
});


// Route::get('/profile/profinsi/{id}', [ProfileController::class, 'kota'])->name('profile.profinsi');

Route::resource('profile', ProfileController::class);

        // Route::get('dashboard', function () {
        //     return view('admin.dashboard');
        // });

        // Route::get('dashboard', function () {
        //     return view('admin.dashboard');
        // });
        Route::resource('dashboard', DashboardController::class);

    
        // Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        // Route::resource('product', ProductController::class);
        // Route::resource('category', ProductCategoryController::class);
        // Route::resource('userCRUD', UserController::class);
        // Route::resource('orders', OrdersController::class);
        // Route::resource('ordersin', OrdersinController::class);
        // Route::get('/historya', [OrdersController::class, 'history']);
// });




// ================================== PEMBATAS (JANGAN DIHAPUS)=====================================================

//Halaman User
Route::get('/', function () {
    $cartnumb = transaction_detail::count();
    $product = Product::all();
    return view('users.home', compact('cartnumb','product'));
});

Route::get('/home', [HomeController::class, 'index'])->name('user.index'); //jangan dimasukkan middleware


Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/profile/profinsi/{id}', [ProfileController::class, 'kota'])->name('profile.profinsi');

    Route::get('/user', function () {
        return view('users.home');
    });

    Route::get('/user', [HomeController::class, 'index'])->name('user.index');
    // Route::get('/home', [HomeController::class, 'index'])->name('user.index');

    Route::get('/store', [ProductController::class, 'index2'])->name('store');

    Route::get('/detailproduct/{id}', [ProductController::class, 'detailproduct'])->name('product.detailproduct');

    // Route::get('/ordersin', function () {
    //     return view('admin.ordersin');
    // });

    Route::get('/addtocard', [CartController::class, 'addtocard']);
    Route::get('/cart', [CartController::class, 'index']);

    Route::get('/about', function () {
        return view('users.about');
    });


    Route::get('/contact', function () {
        return view('users.contact');
    });

    Route::get('/checkout', function () {
        return view('users.checkout');
    });

Route::get('/about', function () {
    $cartnumb = transaction_detail::count();
    return view('users.about', compact('cartnumb')); //jangan dimasukkan middleware
});
Route::get('/store', [ProductController::class, 'index2'])->name('store'); //jangan dimasukkan middleware


});
// Route::post('/cartpay', [CartController::class, 'index']);
//Halaman user middleware

// Route::get('/cartcount', [CartController::class, 'cartcount']);
Route::middleware(['auth', 'user'])->group(function () {
    
        Route::resource('profile', ProfileController::class);
        
        Route::get('/user', [HomeController::class, 'index'])->name('user.index');
        
        Route::get('/detailproduct/{id}', [ProductController::class, 'detailproduct'])->name('product.detailproduct'); 
    
        Route::get('/cart', [CartController::class, 'index2'])->name('cart.index2');
        Route::get('/cartpay', [CartController::class, 'index'])->name('cart.index');
        Route::get('/cartcount', [CartController::class, 'cartcount'])->name('cart.cartcount');
        Route::get('/updatetoken', [CartController::class, 'updatetoken'])->name('cart.index');
        Route::get('/updatestatus', [CartController::class, 'updatestatus'])->name('cart.index');
        
        Route::get('/cart/{id}', [CartController::class, 'destroy'])->name('destroy');
        
        // Route::resource('/cart', CartController::class);
        
        // Route::get('/ordersin', function () {
            //     return view('admin.ordersin');
            // });
            
        Route::get('/addtocard', [CartController::class, 'addtocard']);
        
        
        Route::get('/contact', function () {
            return view('users.contact');
        });
        
        Route::get('/checkout', function () {
            return view('users.checkout');
        });
        
        // Route::get('/history', function () {
        //     $cartnumb = transaction_detail::count();
        //     return view('users.history', compact('cartnumb'));
        // });

        Route::resource('/history', HistoryController::class);
        
        Route::get('/thankyou', function () {
            return view('users.thankyou');
        });
        
        Route::post('/getkabupaten', [ProfileController::class, 'getkabupaten'])->name('getkabupaten');
        Route::get('/profile/profinsi/{id}', [ProfileController::class, 'kota'])->name('profile.profinsi');
      
    
    });
