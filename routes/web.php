<?php

use App\Http\Controllers\AdminArea\AdminController;
use App\Http\Controllers\AdminArea\BlogController;
use App\Http\Controllers\AdminArea\CustomerController;
use App\Http\Controllers\AdminArea\CustomerMessageController;
use App\Http\Controllers\AdminArea\DoctorsController;
use App\Http\Controllers\AdminArea\EyeHospitalsController;
use App\Http\Controllers\AdminArea\EyeIssuesController;
use App\Http\Controllers\AdminArea\EyeScansController;
use App\Http\Controllers\AdminArea\GalleryController;
use App\Http\Controllers\AdminArea\NonSurgicalTreatmentsController;
use App\Http\Controllers\AdminArea\OpticCentersController;
use App\Http\Controllers\AdminArea\ProductCategoriesController;
use App\Http\Controllers\AdminArea\ProductsController;
use App\Http\Controllers\AdminArea\QuestionsAndAnswersController;
use App\Http\Controllers\AdminArea\ServiceController;
use App\Http\Controllers\AdminArea\SubscriptionController;
use App\Http\Controllers\AdminArea\SurgicalTreatmentsController;
use App\Http\Controllers\AdminArea\TeamController;
use App\Http\Controllers\AdminArea\TreatmentsController;
use App\Http\Controllers\AdminArea\WebsiteSettingsController;
use App\Http\Controllers\DoctorArea\AppointmentController;
use App\Http\Controllers\DoctorArea\AppointmentControllerroller;
use App\Http\Controllers\OCTController;
use App\Http\Controllers\PublicArea\AuthenticationController;
use App\Http\Controllers\PublicArea\CustomerAuthController;

use App\Http\Controllers\PublicArea\HomeController;
use App\Http\Controllers\PublicArea\PublicAppointmentController;
use App\Http\Controllers\PublicArea\PublicBlogController;
use App\Http\Controllers\PublicArea\PublicCustomerMessageController;
use App\Http\Controllers\PublicArea\PublicDoctorController;
use App\Http\Controllers\PublicArea\PublicEyeHospitalController;
use App\Http\Controllers\PublicArea\PublicEyeInvestigationsController;
use App\Http\Controllers\PublicArea\PublicEyeIssueController;
use App\Http\Controllers\PublicArea\PublicNonSurgicalTreatmentController;
use App\Http\Controllers\PublicArea\PublicOpticCenterController;
use App\Http\Controllers\PublicArea\PublicProductController;
use App\Http\Controllers\PublicArea\PublicpublicEyeInvestigationsController;
use App\Http\Controllers\PublicArea\PublicSubscriptionController;
use App\Http\Controllers\PublicArea\PublicSurgicalTreatmentController;
use App\Http\Controllers\PublicArea\ReviewController;
use App\Http\Controllers\PublicArea\ShopController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('AdminArea.Pages.Dashboard.index');
// });


//  Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

Route::prefix('')->group(function () {
    Route::get('/', [HomeController::class, "index"])->name('home');
    Route::get('/aboutUs', [HomeController::class, "AboutUs"])->name('aboutUs');
    Route::get('/contactUs', [HomeController::class, "ContactUs"])->name('contactUs');
});

// Route::prefix('oct-analysis')->group(function () {
//     Route::get('/', [OCTController::class, 'showUploadForm'])->name('oct.upload');
//     Route::post('/analyze', [OCTController::class, 'uploadAndPredict'])->name('oct.analyze');
// });

Route::prefix('oct-analysis')->group(function () {
    Route::get('/patients', [OCTController::class, 'showPatients'])->name('oct.patients');
    Route::get('/', [OCTController::class, 'showUploadForm'])->name('oct.upload');
    Route::post('/analyze', [OCTController::class, 'uploadAndPredict'])->name('oct.analyze');
    Route::get('/view/{id}', [OCTController::class, 'viewAnalysis'])->name('oct.view');
    Route::get('/download/{id}', [OCTController::class, 'downloadAnalysis'])->name('oct.download');
    Route::delete('/delete/{id}', [OCTController::class, 'deleteAnalysis'])->name('oct.delete');
    //  Route::delete('/mainDelete/{id}', [OCTController::class, 'deleteMainAnalysis'])->name('octMain.delete');
});;

Route::prefix('gallery')->group(function () {
    Route::get('/all', [GalleryController::class, "All"])->name('gallery.all');
    Route::post('/add', [GalleryController::class, 'Add'])->name('gallery.add');
    Route::post('/delete', [GalleryController::class, 'Delete'])->name('gallery.delete');
    Route::post('/update', [GalleryController::class, 'Update'])->name('gallery.update');

});

Route::prefix('team')->group(function () {
    Route::get('/all', [TeamController ::class, "All"])->name('team.all');
    Route::post('/add', [TeamController ::class, 'Add'])->name('team.add');
    Route::post('/delete', [TeamController ::class, 'Delete'])->name('team.delete');
    Route::post('/update', [TeamController ::class, 'Update'])->name('team.update');
});

Route::prefix('service')->group(function () {
    Route::get('/all', [ServiceController::class, "All"])->name('service.all');
    Route::post('/add', [ServiceController::class, 'Add'])->name('service.add');
    Route::post('/delete', [ServiceController::class, 'Delete'])->name('service.delete');
    Route::post('/update', [ServiceController::class, 'Update'])->name('service.update');
    Route::post('/serviceImageAdd', [ServiceController::class, 'ServiceImageAdd'])->name('Service.serviceImageAdd');
    Route::get('/viewServiceImageAll/{serviceId}', [ServiceController::class, "ViewServiceImageAll"])->name('Service.viewServiceImageAll');
    Route::post('/viewServiceImageDelete', [ServiceController::class, 'ViewServiceImageDelete'])->name('Service.viewServiceImageDelete');
    Route::get('/isPrimary/{id}', [ServiceController::class, 'IsPrimary'])->name('Service.isPrimary');

});


Route::prefix('blog')->group(function () {
    Route::get('/all', [BlogController::class, "All"])->name('blog.all');
    Route::post('/add', [BlogController::class, 'Add'])->name('blog.add');
    Route::post('/delete', [BlogController::class, 'Delete'])->name('blog.delete');
    Route::post('/update', [BlogController::class, 'Update'])->name('blog.update');
    Route::post('/blogImageAdd', [BlogController::class, 'BlogImageAdd'])->name('Blog.blogImageAdd');
    Route::get('/viewBlogImageAll/{blogId}', [BlogController::class, "ViewBlogImageAll"])->name('Blog.viewBlogImageAll');
    Route::post('/viewBlogImageDelete', [BlogController::class, 'ViewBlogImageDelete'])->name('Blog.viewBlogImageDelete');
    Route::get('/isPrimary/{id}', [BlogController::class, 'IsPrimary'])->name('Blog.isPrimary');
});
Route::prefix('settings')->group(function () {
    Route::get('/all', [WebsiteSettingsController::class, "All"])->name('settings.all');
    Route::post('/add', [WebsiteSettingsController::class, 'Add'])->name('settings.add');
    Route::post('/update', [WebsiteSettingsController::class, 'Update'])->name('settings.update');
});


Route::prefix('qa')->group(function () {
    Route::get('/all', [QuestionsAndAnswersController::class, "All"])->name('qa.all');
    Route::post('/add', [QuestionsAndAnswersController::class, 'Add'])->name('qa.add');
    Route::post('/delete', [QuestionsAndAnswersController::class, 'Delete'])->name('qa.delete');
    Route::post('/update', [QuestionsAndAnswersController::class, 'Update'])->name('qa.update');
});

Route::prefix('eyeScans')->group(function () {
    Route::get('/all', [EyeScansController::class, "All"])->name('eyeScans.all');
    Route::post('/add', [EyeScansController::class, 'Add'])->name('eyeScans.add');
    Route::post('/delete', [EyeScansController::class, 'Delete'])->name('eyeScans.delete');
    Route::post('/update', [EyeScansController::class, 'Update'])->name('eyeScans.update');
    Route::post('/eyeScanImageAdd', [EyeScansController::class, 'EyeScanImageAdd'])->name('EyeScans.eyeScanImageAdd');
    Route::get('/viewEyeScanImageAll/{eyeScanId}', [EyeScansController::class, "ViewEyeScanImageAll"])->name('EyeScans.viewEyeScanImageAll');
    Route::post('/viewEyeScanImageDelete', [EyeScansController::class, 'ViewEyeScanImageDelete'])->name('EyeScans.viewEyeScanImageDelete');
    Route::get('/isPrimary/{id}', [EyeScansController::class, 'IsPrimary'])->name('EyeScans.isPrimary');
});

Route::prefix('eyeIssues')->group(function () {
    Route::get('/all', [EyeIssuesController::class, "All"])->name('eyeIssues.all');
    Route::post('/add', [EyeIssuesController::class, 'Add'])->name('eyeIssues.add');
    Route::post('/delete', [EyeIssuesController::class, 'Delete'])->name('eyeIssues.delete');
    Route::post('/update', [EyeIssuesController::class, 'Update'])->name('eyeIssues.update');
    Route::post('/eyeIssueImageAdd', [EyeIssuesController::class, 'EyeIssueImageAdd'])->name('EyeIssues.eyeIssueImageAdd');
    Route::get('/viewEyeIssueImageAll/{eyeIssueId}', [EyeIssuesController::class, "ViewEyeIssueImageAll"])->name('EyeIssues.viewEyeIssueImageAll');
    Route::post('/viewEyeIssueImageDelete', [EyeIssuesController::class, 'ViewEyeIssueImageDelete'])->name('EyeIssues.viewEyeIssueImageDelete');
    Route::get('/isPrimary/{id}', [EyeIssuesController::class, 'IsPrimary'])->name('EyeIssues.isPrimary');
});

Route::prefix('treatments')->group(function () {
    Route::get('/all', [TreatmentsController::class, "All"])->name('treatments.all');
    Route::post('/add', [TreatmentsController::class, 'Add'])->name('treatments.add');
    Route::post('/delete', [TreatmentsController::class, 'Delete'])->name('treatments.delete');
    Route::post('/update', [TreatmentsController::class, 'Update'])->name('treatments.update');
    Route::post('/treatmentImageAdd', [TreatmentsController::class, 'TreatmentImageAdd'])->name('Treatments.treatmentImageAdd');
    Route::get('/viewTreatmentImageAll/{treatmentId}', [TreatmentsController::class, "ViewTreatmentImageAll"])->name('Treatments.viewTreatmentImageAll');
    Route::post('/viewTreatmentImageDelete', [TreatmentsController::class, 'ViewTreatmentImageDelete'])->name('Treatments.viewTreatmentImageDelete');
    Route::get('/isPrimary/{id}', [TreatmentsController::class, 'IsPrimary'])->name('Treatments.isPrimary');
});


Route::prefix('doctors')->group(function () {
    Route::get('/all', [DoctorsController::class, "All"])->name('doctors.all');
    Route::get('/add', [DoctorsController::class, 'AddPage'])->name('doctors.addPage');
    Route::post('/add', [DoctorsController::class, 'Add'])->name('doctors.add');
    Route::get('/edit/{id}', [DoctorsController::class, 'EditPage'])->name('doctors.editPage');
    Route::post('/update', [DoctorsController::class, 'Update'])->name('doctors.update');
    Route::post('/delete', [DoctorsController::class, 'Delete'])->name('doctors.delete');
    Route::get('/doctors/profile/{id}', [DoctorsController::class, 'Profile'])->name('doctors.profile');
});

Route::prefix('product-categories')->group(function () {
    Route::get('/all', [ProductCategoriesController::class, "All"])->name('productCategories.all');
    Route::post('/add', [ProductCategoriesController::class, 'Add'])->name('productCategories.add');
    Route::post('/update', [ProductCategoriesController::class, 'Update'])->name('productCategories.update');
    Route::post('/delete', [ProductCategoriesController::class, 'Delete'])->name('productCategories.delete');
});

Route::prefix('products')->group(function () {
    Route::get('/all', [ProductsController::class, "All"])->name('products.all');
    Route::post('/add', [ProductsController::class, 'Add'])->name('products.add');
    Route::post('/delete', [ProductsController::class, 'Delete'])->name('products.delete');
    Route::post('/update', [ProductsController::class, 'Update'])->name('products.update');
    Route::post('/productImageAdd', [ProductsController::class, 'ProductImageAdd'])->name('products.productImageAdd');
    Route::get('/viewProductImageAll/{productId}', [ProductsController::class, "ViewProductImageAll"])->name('products.viewProductImageAll');
    Route::post('/viewProductImageDelete', [ProductsController::class, 'ViewProductImageDelete'])->name('products.viewProductImageDelete');
    Route::get('/isPrimary/{id}', [ProductsController::class, 'IsPrimary'])->name('products.isPrimary');
});

Route::prefix('surgicaltreatments')->group(function () {
    Route::get('/all', [SurgicalTreatmentsController::class, "All"])->name('surgicaltreatments.all');
    Route::post('/add', [SurgicalTreatmentsController::class, 'Add'])->name('surgicaltreatments.add');
    Route::post('/update', [SurgicalTreatmentsController::class, 'Update'])->name('surgicaltreatments.update');
    Route::post('/delete', [SurgicalTreatmentsController::class, 'Delete'])->name('surgicaltreatments.delete');
});

Route::prefix('nonsurgicaltreatments')->group(function () {
    Route::get('/all', [NonSurgicalTreatmentsController::class, "All"])->name('nonsurgicaltreatments.all');
    Route::post('/add', [NonSurgicalTreatmentsController::class, 'Add'])->name('nonsurgicaltreatments.add');
    Route::post('/update', [NonSurgicalTreatmentsController::class, 'Update'])->name('nonsurgicaltreatments.update');
    Route::post('/delete', [NonSurgicalTreatmentsController::class, 'Delete'])->name('nonsurgicaltreatments.delete');
});


Route::prefix('eyehospitals')->group(function () {
    Route::get('/all', [EyeHospitalsController::class, 'All'])->name('eye.hospitals.all');
    Route::get('/add', [EyeHospitalsController::class, 'AddPage'])->name('eye.hospitals.addPage');
    Route::post('/add', [EyeHospitalsController::class, 'Add'])->name('eye.hospitals.add');
    Route::get('/edit/{id}', [EyeHospitalsController::class, 'EditPage'])->name('eye.hospitals.editPage');
    Route::post('/update', [EyeHospitalsController::class, 'Update'])->name('eye.hospitals.update');
    Route::post('/delete', [EyeHospitalsController::class, 'Delete'])->name('eye.hospitals.delete');
    Route::get('/view/{id}', [EyeHospitalsController::class, 'View'])->name('eye.hospitals.view');

});

Route::prefix('opticcenters')->group(function () {
    Route::get('/all', [OpticCentersController::class, 'All'])->name('optic.centers.all');
    Route::get('/add', [OpticCentersController::class, 'AddPage'])->name('optic.centers.addPage');
    Route::post('/add', [OpticCentersController::class, 'Add'])->name('optic.centers.add');
    Route::get('/edit/{id}', [OpticCentersController::class, 'EditPage'])->name('optic.centers.editPage');
    Route::post('/update', [OpticCentersController::class, 'Update'])->name('optic.centers.update');
    Route::post('/delete', [OpticCentersController::class, 'Delete'])->name('optic.centers.delete');
    Route::get('/view/{id}', [OpticCentersController::class, 'View'])->name('optic.centers.view');
});

Route::prefix('customerMessage')->group(function () {
    Route::get('/all', [CustomerMessageController::class, 'All'])->name('customerMessage.all');
    Route::post('/delete', [CustomerMessageController::class, 'Delete'])->name('customerMessage.delete');
    Route::post('/reply', [CustomerMessageController::class, 'Reply'])->name('customerMessage.reply');
});

Route::prefix('customer')->group(function () {
    Route::get('/all', [CustomerController::class, 'All'])->name('customer.all');

});

Route::prefix('subscriptions')->group(function () {
        Route::get('/all', [SubscriptionController::class, 'All'])->name('subscriptions.all');
        Route::post('/delete', [SubscriptionController::class, 'delete'])->name('subscriptions.delete');
        Route::post('/broadcast', [SubscriptionController::class, 'sendBroadcast'])->name('subscriptions.broadcast');
});

Route::prefix('appointment')->group(function () {
    // Route::get('/all', [AppointmentController::class, 'All'])->name('appointment.all');
    // Route::post('/delete', [AppointmentController::class, 'Delete'])->name('appointment.delete');
    // Route::post('/reply', [AppointmentController::class, 'Reply'])->name('appointment.reply');
    Route::get('/all', [AppointmentController::class, 'All'])->name('appointment.all');
    Route::post('/delete', [AppointmentController::class, 'Delete'])->name('appointment.delete');
    Route::post('/accept', [AppointmentController::class, 'Accept'])->name('appointment.accept');
    Route::post('/generate_meeting', [AppointmentController::class, 'GenerateMeeting'])->name('appointment.generate_meeting');
     Route::post('/complete', [AppointmentController::class, 'Complete'])->name('appointment.complete');
     Route::post('/send_sms', [AppointmentController::class, 'SendSms'])->name('appointment.send_sms');
});

//////////////////////////////////////////// Public ////////////////////////////////////////////////////


Route::prefix('Authentication')->group(function () {
    Route::get('/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'register']);
    Route::get('/verify-otp', [CustomerAuthController::class, 'showOtpForm'])->name('verify.otp');
    Route::post('/verify-otp', [CustomerAuthController::class, 'verifyOtp']);
    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'login']);
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
});

Route::prefix('Home')->group(function () {
    Route::get('/home', [HomeController::class, "index"])->name('Home.home');
    Route::get('/aboutUs', [HomeController::class, "AboutUs"])->name('Home.aboutUs');
    Route::get('/contactUs', [HomeController::class, "ContactUs"])->name('Home.contactUs');
    Route::get('/blog', [HomeController::class, "Blog"])->name('Home.blog');

});

Route::prefix('PublicAreaBlog')->group(function () {
    Route::get('/all', [PublicBlogController::class, 'All'])->name('PublicAreaBlog.all');
    Route::get('/details/{id}', [PublicBlogController::class, 'Details'])->name('PublicAreaBlog.details');
});

Route::prefix('PublicAreDoctors')->group(function () {
    Route::get('/all', [PublicDoctorController::class, 'All'])->name('PublicAreDoctors.all');
    Route::get('/search', [PublicDoctorController::class, 'Search'])->name('PublicAreDoctors.search');
    Route::get('/details{id}', [PublicDoctorController::class, 'Details'])->name('PublicAreDoctors.details');

    Route::post('/doctorReviewAdd', [ReviewController::class, "DoctorReviewAdd"])->name('review.doctorReviewAdd');
    Route::get('/doctorReviewDisplay', [ReviewController::class, "DoctorReviewDisplay"])->name('review.doctorReviewDisplay');
    Route::get('/doctorReviewAll', [ReviewController::class, "DoctorReviewAll"])->name('review.DoctorReviewAll');
    Route::post('/doctorReviewDelete', [ReviewController::class, 'DoctorReviewDelete'])->name('review.doctorReviewDelete');
});

Route::prefix('PublicAreaEyeIssues')->group(function () {
    Route::get('/all', [PublicEyeIssueController::class, 'All'])->name('PublicAreaEyeIssues.all');
    Route::get('/search', [PublicEyeIssueController::class, 'Search'])->name('PublicAreaEyeIssues.search');
    Route::get('/details/{id}', [PublicEyeIssueController::class, 'Details'])->name('PublicAreaEyeIssues.details');
});

Route::prefix('public/non-surgical-treatments')->group(function () {
    Route::get('/all', [PublicNonSurgicalTreatmentController::class, 'All'])->name('public.non-surgical-treatments.all');
    Route::get('/search', [PublicNonSurgicalTreatmentController::class, 'Search'])->name('public.non-surgical-treatments.search');
    Route::get('/show/{id}', [PublicNonSurgicalTreatmentController::class, 'Show'])->name('public.non-surgical-treatments.show');
});

Route::prefix('public/surgical-treatments')->group(function () {
    Route::get('/all', [PublicSurgicalTreatmentController::class, 'All'])->name('public.surgical-treatments.all');
    Route::get('/search', [PublicSurgicalTreatmentController::class, 'Search'])->name('public.surgical-treatments.search');
    Route::get('/details/{id}', [PublicSurgicalTreatmentController::class, 'Details'])->name('public.surgical-treatments.Details');
});

Route::prefix('public/eye-hospitals')->group(function () {
    Route::get('/all', [PublicEyeHospitalController::class, 'All'])->name('public.eye-hospitals.all');
    Route::get('/search', [PublicEyeHospitalController::class, 'Search'])->name('public.eye-hospitals.search');
    Route::get('/details/{hospitalId}', [PublicEyeHospitalController::class, 'Details'])->name('public.eye-hospitals.details');
});

Route::prefix('public/optic-centers')->group(function () {
    Route::get('/all', [PublicOpticCenterController::class, 'All'])->name('public.optic-centers.all');
    Route::get('/search', [PublicOpticCenterController::class, 'Search'])->name('public.optic-centers.search');
    Route::get('/details/{hospitalId}', [PublicOpticCenterController::class, 'Details'])->name('public.optic-centers.details');
});

Route::prefix('publicEyeInvestigations')->group(function () {
    Route::get('/all', [PublicEyeInvestigationsController::class, 'All'])->name('publicEyeInvestigations.all');
    Route::get('/search', [PublicEyeInvestigationsController::class, 'Search'])->name('publicEyeInvestigations.search');
    Route::get('/details/{eyeScanId}', [PublicEyeInvestigationsController::class, 'Details'])->name('publicEyeInvestigations.details');
});

Route::prefix('Shop')->group(function () {
    Route::get('/all', [ShopController::class, "All"])->name('Shop.all');

});

Route::prefix('PublicAreaCustomerMessage')->group(function () {
   Route::post('/add', [PublicCustomerMessageController::class, 'Add'])->name('PublicAreaCustomerMessage.add');

});

Route::prefix('PublicAreaSubscription')->group(function () {
   Route::post('/add', [PublicSubscriptionController::class, 'Add'])->name('publicAreaSubscription.add');

});

Route::prefix('PublicAreaAppointment')->group(function () {
    Route::get('/appointment', [PublicAppointmentController::class, "Appointment"])->name('PublicAreaAppointment.appointment');
      Route::post('/appointmentsearch', [PublicAppointmentController::class, "appointmentsearch"])->name('PublicAreaAppointment.appointmentsearch');
//    Route::post('/add', [PublicSubscriptionController::class, 'Add'])->name('publicAreaSubscription.add');
    Route::get('/details{id}', [PublicAppointmentController::class, 'Details'])->name('PublicAreaAppointment.details');


    Route::post('/book', [PublicAppointmentController::class, 'BookAppointment'])->name('PublicAreaAppointment.book');
});

Route::prefix('Review')->group(function () {
    Route::get('/all', [ReviewController::class, "All"])->name('review.all');
    Route::post('/add', [ReviewController::class, "Add"])->name('review.add');
    Route::post('/update', [ReviewController::class, 'update'])->name('reviews.update');
    Route::post('/delete', [ReviewController::class, 'Delete'])->name('review.delete');



//    Route::post('/add', [PublicSubscriptionController::class, 'Add'])->name('publicAreaSubscription.add');

});

Route::get('/public/products', [PublicProductController::class, 'index'])->name('public.products.index');
Route::get('/public/products/{productId}', [PublicProductController::class, 'show'])->name('public.products.show');

//////////////////////////////////////////// Doctor ////////////////////////////////////////////////////


Route::prefix('Home')->group(function () {
    Route::get('/Dashboard', [HomeController::class, "index"])->name('Dashboard.index');
    Route::get('/aboutUs', [HomeController::class, "AboutUs"])->name('Home.aboutUs');
    Route::get('/contactUs', [HomeController::class, "ContactUs"])->name('Home.contactUs');

});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [App\Http\Controllers\AdminArea\AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\AdminArea\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AdminArea\AuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [App\Http\Controllers\AdminArea\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/', [App\Http\Controllers\AdminArea\AdminController::class, 'index'])->name('admin.index');
        // Add other admin routes here
    });
});

// Doctor Routes
Route::prefix('doctor')->group(function () {
    Route::get('login', [App\Http\Controllers\DoctorArea\AuthController::class, 'showLoginForm'])->name('doctor.login');
    Route::post('login', [App\Http\Controllers\DoctorArea\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\DoctorArea\AuthController::class, 'logout'])->name('doctor.logout');

    Route::middleware(['auth:doctor'])->group(function () {
        Route::get('dashboard', [App\Http\Controllers\DoctorArea\DoctorController::class, 'dashboard'])->name('doctor.dashboard');
        Route::get('/', [App\Http\Controllers\DoctorArea\DoctorController::class, 'index'])->name('doctor.index');
        // Add other doctor routes here
    });
});
