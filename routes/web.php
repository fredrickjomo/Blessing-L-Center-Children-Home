<?php

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

Route::get('/', function () {
    $user=\App\User::where('id',Auth::id())->first();
    return view('home',compact('user'));
});



Auth::routes();



Route::middleware(['auth'])->group(function(){ //routes to be accessed once a user logs in

//user profile routes
    Route::get('/check-my-profile','UsersController@index');
    Route::get('/edit-my-profile/{id}','UsersController@edit');
    Route::post('/update-profile/{email}','UsersController@update');

    //user children routes
    Route::resource('children','ChildrenController');
    Route::get('/view-all-children','ChildrenController@index')->name('children');

    Route::group(['middleware'=>'AdminMiddleware'],function (){//routes accessed by an admin only
        //admin routes
        Route::resource('Admin','AdminController');
        //children routes
        Route::get('Admin/children/index','AdminController@viewChild')->name('Admin.viewChild');
        Route::get('Admin/children/add','AdminController@addChild')->name('Admin.addChild');
        Route::get('Admin/children/edit/update','AdminController@editChild')->name('Admin.editChild');
        Route::get('admin/child-delete/{id}','ChildrenController@destroy');

       // Route::get('Admin/children/delete/','AdminController@deleteChild')->name('Admin.deleteChild');

        //staff routes for admin
        Route::resource('staff','StaffController');
        Route::get('Admin/staff/viewStaff','AdminController@viewStaff')->name('Admin.viewStaff');
        Route::get('Admin/staff/add','AdminController@addStaff')->name('Admin.addStaff');
        Route::get('/edit-staff-information/{id}','StaffController@edit');
        Route::post('/update-staff-information/{id}','StaffController@update');
        Route::get('/remove-staff/{id}','StaffController@destroy');

        //sponsorship routes for admin
        Route::get('/active-sponsorships','SponsorshipController@active')->name('active');
        Route::get('/inactive-sponsorships','SponsorshipController@inactive')->name('inactive');
        Route::get('/basic-plan-I-sponsorships','SponsorshipController@basic_plan')->name('basic_plan');
        Route::get('/basic-plan-II-sponsorships','SponsorshipController@basic_plan_II')->name('basic_plan_II');
        Route::get('/annual-plan-sponsorships','SponsorshipController@annual_plan')->name('annual_plan');
        Route::get('/sponsored-children','SponsorshipController@sponsored')->name('sponsored-children');
        Route::get('/terminate-sponsorships','SponsorshipController@terminate')->name('terminate');
        Route::get('/cancelledSponsorships','SponsorshipController@cancelled')->name('cancelled');
        Route::get('/terminateSponsorship/{sponsor_id}','SponsorshipController@terminateSponsorship');
        Route::get('/sponsorships/bank','SponsorshipController@bank_sponsorships')->name('bank-sponsorships');
        Route::get('/deleteApplication/{id}','SponsorshipController@destroy');

        //payments routes
        Route::get('/update-sponsorship-payments','SponsorshipPaymentController@index');
        Route::get('/child/get/{id}','SponsorshipPaymentController@getChild');
        Route::get('/plan/get/{id}','SponsorshipPaymentController@getPlan');
        Route::post('update-payment','SponsorshipPaymentController@store')->name('sponsorship_payment');
        Route::get('/payment/get/{pay}','SponsorshipPaymentController@payment');
        Route::match([
            'get','post'],'current-sponsorship-payments',[ //combining both post and get requests for search functionality
                'as'=>'view_payment',
                'uses'=>'SponsorshipPaymentController@show'
            ]

        );
        Route::get('payments/view-receipts/{id}','SponsorshipPaymentController@receipt');
        //generating report routes
        Route::get('/generate_report/{id}','SponsorshipPaymentController@generate_reports');
        Route::get('/downloading_receipt/{id}','SponsorshipPaymentController@download_receipt')->name('download_receipt');

        // admin event routes
        Route::get('admin/add_event','CharityEventsController@add_event')->name('add_event');
        Route::post('/save-event','CharityEventsController@store');
        Route::get('admin/view_events','CharityEventsController@show')->name('view_events');
        Route::get('/remove-event/{id}','CharityEventsController@destroy');
        Route::get('/edit-event-information/{id}','CharityEventsController@edit');
        Route::post('/update-event-information/{id}','CharityEventsController@update');

        //admin project routes
        Route::get('admin/add-project','ProjectsController@index')->name('add_project');
        Route::post('admin/save-project','ProjectsController@store');
        Route::get('/admin/view-projects','ProjectsController@show')->name('view_projects');
        Route::get('/remove-projects/{id}','ProjectsController@destroy');
        Route::get('/edit-projects-information/{id}','ProjectsController@edit');
        Route::post('/update-project-information/{id}','ProjectsController@update');

        //admin search routes
       // Route::get('/','SponsorshipPaymentController@search');

    });

    //change password route
    Route::get('/changePassword','HomeController@showChangePasswordForm');
    Route::get('/404/PageNotFound','HomeController@pageNotFound')->name('pageNotFound');
    Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

    Route::get('verify/token/{token}','Verification@verify')->name('auth.verify');
    Route::get('/verify/resend','VerificationController@resend')->name('auth.verify.resend');


});



Route::get('/home', 'HomeController@index')->name('home');
Route::get('Sponsor/index','SponsorshipController@store');
Route::resource('Contact_Us','ContactsController');
Route::resource('AboutUs','About_UsController');
Route::resource('Sponsor','SponsorshipController');
Route::get('donations/donate_financially','DonationsController@donate_financially');
Route::resource('donations','DonationsController');
Route::get('charity-events','CharityEventsController@index')->name('charity_events');
Route::get('/charity-events/read-more/{id}','CharityEventsController@display_event');
Route::get('/support-with-equipment','CharityEventAssistanceController@equipment');
Route::get('adoption-services','AdoptionController@index')->name('adoption');
//projects routes
Route::get('/projects','ProjectsController@display_projects')->name('projects');
Route::get('/support/project/{id}','ProjectsController@support_project');
Route::get('/support/project/bank-support/{id}','ProjectsController@bank_support');
//staff route
Route::get('/our-staff','StaffController@index')->name('our_staff');
//children route
Route::get('/our-children','ChildrenController@our_children')->name('our_children');


//search child route
Route::match([
    'get','post'],'search-child',[ //combining both post and get requests for search functionality
        'as'=>'/search-child',
        'uses'=>'ChildrenController@search_child'
    ]

);
Route::match(['get','post'],'search_child',[
    'as'=>'search_child',
    'uses'=>'ChildrenController@adminSearch'
]);
//Route::post('/search-child','ChildrenController@search_child');

//payment routes
Route::get('/donate-via-paypal','PaymentsController@paypal')->name('paypal');
Route::post('/donate-via-visa','PaymentsController@visaCard')->name('visa-card');
Route::get('/visa-card-payment/process/{amount}','PaymentsController@visacardProcess')->name('visacardProcess');
Route::get('/enter-amount','PaymentsController@enter_amount');

//paypal routes
Route::get('paypal/express-checkout','PaypalController@expressCheckout')->name('expressCheckout');
Route::get('paypal/express-checkout-success','PaypalController@expressCheckoutSuccess');
Route::post('paypal/notify','PaypalController@notify');




//payment routes
Route::group(['middleware' => 'auth'], function () {


    Route::get('/braintree/token','BraintreeTokenController@token');


});
Route::group(['middleware'=>'sponsoring_plans'],function (){
    Route::get('/plans', 'PlansController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'PlansController@show')->name('plans.show');
    Route::post('/subscribe', 'SubscriptionsController@store')->name('subscribe');
    Route::get('/subscriptions','SubscriptionsController@index');
    Route::post('/subscription/cancel','SubscriptionsController@cancel');
    Route::post('/subscription/resume','SubscriptionsController@resume');
    //check my applications
    Route::get('check-my-Applications','SubscriptionsController@checkApplications');
    //Bank routes
    Route::get('/pay-through-bank/{slug}','SubscriptionsController@bank_payment');
    Route::post('/upload-bank-slip/receipt','ReceiptController@store')->name('upload_receipt');
});

//braintree webhook--for notification to the application of a variety of events that happpens within it
Route::post(
    'braintree/webhooks',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);