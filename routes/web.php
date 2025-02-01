<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\IpdController;
use App\Http\Controllers\ReceptionistController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [Controller::class,'index'])->name('dashboard');

    Route::controller(ReceptionistController::class)->prefix('receptionist')->name('rec.')->group(function () {
      Route::get('/dashboard','index')->name('dash');
    });

    Route::middleware(['admin'])->group(function () {
        Route::controller(DoctorController::class)->prefix('doctor')->name('doc.')->group(function () {
            Route::get('/dashboard','index')->name('dash');
            Route::get('/prescription','prescription')->name('prescription');
            Route::get('/insert_prescription', 'insert_prescription')->name('insert_prescription');
            Route::get('/get_prescription', 'get_prescription')->name('get_prescr');
            Route::get('/get_print_prescription','prescr_print')->name('get_pre_print');
            Route::post('/get_sum_print' , 'get_sum_print')->name('get_sum_print');
            Route::post('/get_summary', 'summary')->name('summary');
            Route::post('/sub_summary', 'submit_summary')->name('sub_sammary');
            Route::get('/get_medicines' , 'get_medicines')->name('get_medicines');
            Route::get('/certificate','certificate')->name('certificate');
            Route::get('/casepapers','casepaper')->name('casepaper');
        });
    });

    
    Route::middleware(['Reception'])->group(function () {
        Route::controller(DoctorController::class)->prefix('doctor')->name('rec.')->group(function () {
            Route::get('/insert_prescription', 'insert_prescription')->name('insert_prescription');
            Route::get('/get_prescription', 'get_prescription')->name('get_prescr');
            Route::get('/get_print_prescription','prescr_print')->name('get_pre_print');
            Route::post('/get_sum_print' , 'get_sum_print')->name('get_sum_print');
            Route::post('/get_summary', 'summary')->name('summary');
            Route::post('/sub_summary', 'submit_summary')->name('sub_sammary');
            Route::get('/get_medicines' , 'get_medicines')->name('get_medicines');
        });
    });


    Route::middleware(['Reception'])->group(function () {
        Route::controller(ReceptionistController::class)->prefix('receptionist')->name('rec.')->group(function () {  
            //Receptionist views starts here
            Route::get('/dashboard','index')->name('dash'); // Dashboard 
            Route::get('/createpatient','view')->name('createpatient'); //patient registration//
            Route::post('/edit_patient', 'edit_patient')->name('edit_usr');
            Route::get('/get_existing_patients','check_patient')->name('get_ext_pts');
            Route::get('/opd_paitents','view_patients')->name('v_patients'); //OPD patients
            Route::get('/ipd_paitents','ipd_patients')->name('ipd_patients'); //IPD patients

            Route::get('/d_patients','discharged_patients')->name('d_patns');
            Route::get('/discharge_view', 'discharge_view')->name('discharge_view');
            Route::get('/medications','prescribe')->name('medicines');
            Route::get('/print_meds','print_medications')->name('prt_meds');

            Route::get('/investigations','investigations')->name('invest');
            Route::post('/insert_labtest', 'labtest_insert')->name('insert_test');
            Route::get('/get_tests' ,'get_tests')->name('get_tests');
            Route::get('/dlt_labtest' , 'delete_labtest')->name('dlt_labtest');

            Route::get('/reports', 'reports')->name('reports');
            Route::get('/get_reports','get_reports_range')->name('get_reports');
            Route::get('/recipts', 'recipts')->name('recipts');
            Route::get('/get_recipts_by_opd' , 'recipt_by_opdId')->name('get_rcpt_opdid');
            Route::get('/get_recipts_by_ipd' , 'recipt_by_ipdId')->name('get_rcpt_ipdid');

            Route::get('/patient/{id}', 'getPatientById')->name('patient_id');
            Route::get('/opd_cards','opd_cards')->name('opd_cards');
            Route::get('/get_cards', 'get_opd_cards')->name('get_cards');

            Route::get('/get_bills', 'get_bills')->name('get_bills');

            // These are the register and renewal routes
            Route::get('/follow-up', 'follow_up')->name('follow_up');
            Route::get('/renewal_patient', 'renewal')->name('renewal');

            //

            Route::get('/pay_bills','paybills_view')->name('paybills');
            Route::post('/pay_advence','pay_advance')->name('pay_adv_amt');
            //Receptionist views ends here

            //AJAX Calls get the service price values
            Route::get('/get_services','autocomplete')->name('get_services');
            Route::get('/get_ser_price' ,'get_service_price')->name('get_ser_price');
            Route::get('/get_medicines','get_medicines')->name('get_medicines');

            
            ////AJAX Calls get the service price values ends here
            
            Route::post('/register_patient', 'patient_insert')->name('reg_usr');//new patient creation post method //
            
            //Billing routes starts here
            Route::get('/print_opd', 'get_to_print')->name('get_to_print');
            Route::get('/print_bill_final', 'get_to_print_final')->name('get_to_print_final');
            Route::post('/add_new_bill','add_new_bill')->name('add_new_bill');
            Route::get('/get_tmp_bills','get_tmp_bills')->name('get_tmp_bills');
            Route::get('/delete_service','dlt_service')->name('dlt_service');
            Route::post('/confirm_bill','confirm_bill')->name('confirm_bill');
            Route::get('/edit_bill' , 'edit_bill')->name('edit_bill');
            Route::get('/Delete_bill' , 'delete_bill')->name('dlt_bill');
            
            Route::get('/submit_final_bill','submit_final_bill')->name('sub_opd_bill');
            // Billing routes ends here;

            Route::get('/services' , 'services')->name('services');
            Route::post('/add_service', 'add_service')->name('add_ser');
            Route::get('/delete_service_master', 'delete_service')->name('dlt_ser');



            Route::get('/medicines_services','medicines_services')->name('medicines_services');
            Route::post('/add_medicine', 'add_medicine')->name('add_medicine');
            
            
            Route::post('/add_pres' , 'add_medicines')->name('add_prescription');
            Route::get('/get_pres' , 'get_prescription')->name('get_meds');
            Route::post('/dlt_meds' , 'delete_medicines')->name('dlt_med');


            //
            Route::get('/get_bills_opd', 'get_bills_by_opd')->name('get_bills_opd');

            //certificates and case papers and prescriptions
            Route::get('/casepapers','casepaper')->name('casepaper');
            Route::get('/certificate','certificate')->name('certificate');
            Route::get('/summary','prescription')->name('prescription');


            //all papers 
            Route::get('/papers', 'ipdpapers')->name('ipd_papers');
            Route::get('/papers_by_opdid','opd_papers_by_id')->name('get_opdpaper');

            //New patients routes
            Route::get('/patients','patients')->name('patients');
            Route::get('/get_opd_records', 'get_opd_records')->name('get_opd_records');
            Route::post('/insert_records','insert_records')->name('insert_records');


            //Labtest Routes
            Route::get('/get_tests_list' , 'get_test_list')->name('get_test_list');
            Route::get('/get_lab_tests','get_lab_tests')->name('get_lab_tests');

            //Summarry routes
            Route::get('/get_ipd_patients','get_ipd_patients')->name('get_ipd_patients');


            //duplicate recipts routes
            Route::get('/recipts_clon', 'duplicate_recipts')->name('duprec');
            Route::post('/insert_clone_rec', 'insert_clone_rec')->name('insert_clone_rec');
        });

        Route::controller(IpdController::class)->prefix('receptionist')->name('ipd.')->group(function (){
            Route::get('/get_ext_pts', 'get_ext_pts')->name('get_ext_pts');
            Route::post('/reg_ipd','reg_ipd')->name('reg_ipd');
        });
    });
});
