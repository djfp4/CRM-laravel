<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\DetailControlController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\PropertiesControLler;
use App\Http\Controllers\LocationControLler;
use App\Http\Controllers\ModelControLler;
use App\Http\Controllers\SalesControLler;
use App\Http\Controllers\ClientControLler;
use App\Http\Controllers\MonitoringDetailController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentDetailController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AsignController;
use App\Http\Controllers\ReportController;


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
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('fullcalender', [CalendarController::class, 'index']);
Route::post('fullcalenderAjax', [CalendarController::class, 'ajax']);

Auth::routes();


Route::group(['middleware' => ['auth']], function(){
    Route::resource( 'roles', RolController::class);
    Route::resource( 'usuarios', UsuarioController::class);
    Route::resource( 'coachs', CoachControLler::class);
    Route::resource( 'controls', ControlControLler::class);
    Route::resource( 'detailControls', DetailControlControLler::class);
    Route::resource( 'data', DataControLler::class);
    Route::resource( 'models', ModelControLler::class);
    Route::resource( 'locations', LocationControLler::class);
    Route::resource( 'propiedad', PropertiesControLler::class);
    Route::resource( 'ventas', SalesControLler::class);    
    Route::resource( 'cliente', ClientController::class);
    Route::resource( 'seguimiento_d', MonitoringDetailController::class);    
    Route::resource( 'seguimiento', MonitoringController::class);  
    Route::resource( 'curso', CourseController::class);  
    Route::resource( 'modulo', ModuleController::class);  
    Route::resource( 'leccion', LessonController::class);
    Route::resource( 'pago', PaymentController::class);
    Route::resource( 'pago_detalle', PaymentDetailController::class);
    Route::resource( 'calendario', CalendarController::class); 
    Route::resource( 'credito', CreditController::class);  
    Route::resource( 'asistencia', AttendanceController::class);  
    Route::resource( 'nota', RatingController::class);  
    Route::resource( 'grupo', GroupController::class);  
    Route::resource( 'horario', ScheduleController::class); 
    Route::resource( 'alumno', StudentController::class); 
    Route::resource( 'asignar', AsignController::class); 
    Route::resource( 'reporte', ReportController::class); 
});

