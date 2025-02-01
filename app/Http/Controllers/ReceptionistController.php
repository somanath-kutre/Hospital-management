<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\admission;
use App\Models\billing;
use App\Models\cloned_recipts;
use App\Models\installment;
use App\Models\ipd_clone;
use App\Models\labtest;
use App\Models\medication;
use App\Models\medicines_master;
use App\Models\opd_records;
use App\Models\patients;
use App\Models\patients_clone;
use App\Models\records_master;
use App\Models\services;
use App\Models\temporary;
use App\Rules\AmountNotGreaterThanFeesRule;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use GuzzleHttp\RedirectMiddleware;
use Illuminate\Support\Facades\DB;
use TCPDF;

class ReceptionistController extends Controller
{
    //
    public function index()
    {
        $patients = patients::count();
        $opd_count = patients::join('patients_clone', 'patients_clone.patient_id', '=', 'patients.id')
            // ->where('admission.admission_type', 'OPD')
            // ->withTrashed()
            ->count();

        $ipd_count = patients::join('ipd_clone', 'ipd_clone.patient_id', '=', 'patients.id')
            // ->where('admission.admission_type', 'IPD')
            ->count();

        $currentDate = Carbon::now()->toDateString();

        $total_payment = installment::whereDate('created_at', $currentDate)->sum('amount');

        $cash = installment::where('p_mode', 'cash')->whereDate('created_at', $currentDate)->sum('amount');

        $upi = installment::whereDate('created_at', $currentDate)->where('p_mode', 'upi')->sum('amount');
        // $total_payment = admission::select('')->get();

        return view('pages.receptionist.dashboard', ['tot_patients' => $patients, 'opd_counts' => $opd_count, 'ipd_counts' => $ipd_count, 'total_cash' => $total_payment, 'tot_cash' => $cash, 'upi' => $upi]);
    }
    public function view()
    {
        return view('pages.receptionist.create_ptnt');
    }

    public function view_patients()
    {
        $data = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->where('admission.admission_type', '=', 'OPD')
            ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.discount AS discount')
            ->whereNull('admission.deleted_at')
            ->orderByDesc('admission_date')
            ->paginate(10);
        $all_data = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            // ->where('admission.admission_type', '=', 'OPD')
            ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.discount AS discount')
            ->whereNull('admission.deleted_at')
            ->orderByDesc('admission_date')
            ->get();
        foreach ($data as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d-m-Y');
        }
        return view('pages.receptionist.all_patients', ['list' => $data, 'all_data' => $all_data]);
    }

    public function ipd_patients(){
        $data = DB::table('patients')
        ->join('admission', 'patients.id', '=', 'admission.patient_id')
        ->where('admission.admission_type', '=', 'IPD')
        ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.discount AS discount')
        ->whereNull('admission.deleted_at')
        ->orderByDesc('admission_date')
        ->paginate(10);

        $all_data = DB::table('patients')
        ->join('admission', 'patients.id', '=', 'admission.patient_id')
        // ->where('admission.admission_type', '=', 'OPD')
        ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.discount AS discount')
        ->whereNull('admission.deleted_at')
        ->orderByDesc('admission_date')
        ->get();

        foreach ($data as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d-m-Y');
        }
        return view('pages.receptionist.ipd_patients', ['list' => $data,'all_data' => $all_data]);
    }

    public function discharge_view()
    {
        $patients = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.updated_at AS discharge_date', 'admission.discount AS dis_amt')
            ->whereNotNull('admission.deleted_at')
            ->orderByDesc('discharge_date')
            ->paginate(10);


        $patients_clone = patients_clone::join('admission', 'patients_clone.patient_id', '=', 'admission.patient_id')
            ->select('patients_clone.name AS patient_name', 'patients_clone.id AS opd_no','patients_clone.phone AS phone', 'patients_clone.age AS p_age', 'patients_clone.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fees', 'admission.paid AS paid', 'admission.updated_at AS discharge_date', 'admission.discount AS dis_amt')
            ->whereNotNull('admission.deleted_at')
            ->orderByDesc('discharge_date')
            ->paginate(10);


            foreach($patients_clone as $cloned_records){
                $cloned_records->discharge_date = Carbon::parse($cloned_records->discharge_date)->format('d-m-Y');
            }

        foreach ($patients as $record) {
            // $record->admission_date = Carbon::parse($record->admission_date)->format('d-m-Y');
            $record->discharge_date = Carbon::parse($record->discharge_date)->diffForHumans();
        }

        return view('pages.receptionist.patients_discharge', ['patients' => $patients, 'patients_clone' => $patients_clone]);
    }

    public function get_bills_by_opd(Request $req){
        $opd_id = $req->opd_id;

        $patients_clone = patients_clone::join('admission', 'patients_clone.patient_id', '=', 'admission.patient_id')
        ->select('patients_clone.name AS patient_name', 'patients_clone.id AS opd_no','patients_clone.phone AS phone', 'patients_clone.age AS p_age', 'patients_clone.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fees', 'admission.paid AS paid', 'admission.updated_at AS discharge_date', 'admission.discount AS dis_amt')
        ->where('patients_clone.id',$opd_id)
        ->withTrashed('patients_clone')
        ->whereNotNull('admission.deleted_at')
        ->orderByDesc('discharge_date')
        ->get();

       
        foreach($patients_clone as $cloned_records){
            $cloned_records->discharge_date = Carbon::parse($cloned_records->discharge_date)->format('d-m-Y');
        }

        if( $patients_clone->isEmpty()){
            return response()->json(['msg' => 'Error']);
        }
        return response()->json(['msg' => 'success', 'data' => $patients_clone]);
    }

    public function discharged_patients(Request $req)
    {
        $id = $req->input('d_patns');
        $discharge = admission::find($id);
        $discharge->delete();
        $feesUpdate = $discharge->save();

        $dis_ipd_clone = ipd_clone::where('admission_id', $id)->whereNull('deleted_at');
        if ($dis_ipd_clone) {
            $dis_ipd_clone->delete();
        }


        $patients = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.updated_at AS admission_date')
            ->whereNotNull('admission.deleted_at')
            ->orderByDesc('admission_date')
            ->paginate(5);

        foreach ($patients as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d-m-Y');
        }
        alert("deleted");
        // return view('pages.receptionist.patients_discharge', ['patients' => $patients]);
        // return redirect()->route('rec.discharge_view');
        return redirect()->back();
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        $suggestions = DB::table('services')
            ->where('service_name', 'LIKE', '%' . $term . '%')
            ->pluck('service_name');
        return response()->json($suggestions);
    }

    public function get_service_price(Request $req)
    {
        $service = $req->description;
        $service_bill = services::where('service_name', $service)->pluck('price');
        return response()->json($service_bill);
    }

    public function patient_insert(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make(
            $req->all(),
            [
                'name' => 'required|max:255',
                'household' =>  'required|max:255',
                'phone' => 'sometimes|nullable|unique:patients,phone|regex:/^[6-9]\d{9}$/',
                'gender' => 'required|in:Male,Female',
                // 'p_method' => 'sometimes|in:cash,upi',
                'address' => 'required|max:255',
                'age' => 'required|max:255',
                'descr' => 'required|in:Consultation,Follow UP',
                'amount' => 'sometimes|max:255',
            ],
            [
                'phone.regex' => 'The phone number must be a valid Indian mobile number.',
                'gender' => 'Please select the gender',
                'descr' => 'Please select the description',
                'p_method' => 'Please select the payment mode',
                'phone.unique' => 'Already Registered'
            ]
        );
        if ($req->filled('amount')) {
            $validator->addRules(['p_method' => 'required|in:cash,upi']);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // $pt_insert = patients::create($req->all());
            $date_admission = now()->format('Y-m-d H:i:s');
            $patient_record = $req->all();
            $patient_record['a_date'] = $date_admission;

            $newPatient = patients::create($patient_record);


            $savedPatientId = $newPatient->id;
            $savedPatientname = $newPatient->name;



            $amount = $req->amount;
            if ($amount === null) {
                $amount  = 0;
            }

            $admissionData = [
                'patient_id' => $savedPatientId,
                'admission_type' => 'OPD',
                'doctor' => 'Dr. Shetty', //actual doctor's name
                'refer_doc' => $req->refer_doc,
                'operation_name' => NULL,
                'operation_date' => NULL,
                'fees' => $req->amount,
                'discount' => NULL,
                'paid' => $req->amount,
                'advance' => 0,
                'p_mode' => $req->p_method,
                'discharge' => false, // Assuming it's not discharged initially
            ];

            $newAdmission = admission::create($admissionData);

            if ($newAdmission) {
                $clone_data = [
                    'patient_id' => $savedPatientId,
                    'admission_id' => $newAdmission->id,
                    'name' => $newPatient->name,
                    'household' => $newPatient->household,
                    'phone' => $newPatient->phone,
                    'age' => $newPatient->age,
                    'gender' => $newPatient->gender,
                    'address' => $newPatient->address,
                    'a_date' => $newPatient->a_date,
                ];
                $clone_patient = patients_clone::create($clone_data);
            }



            $savedAdmissionId = $newAdmission->id;
            $billData = [
                'admission_id' => $savedAdmissionId,
                'description' => $req->descr,
                'category' => 'hospital',
                'amount' => $amount,
                'admission_type' => 'OPD',
                'qty' => '1'
            ];

            $newBIll = billing::create($billData);

            $installment = [
                'opd_number' => $clone_patient->id,
                'admission_id' => $savedAdmissionId,
                'amount' => $req->amount,
                'p_mode' => $req->p_method,
                'descr' => $req->descr,
            ];
            if ($req->amount !== null && $req->amount !== '0') {
                installment::create($installment);
                cloned_recipts::create($installment);
            }
            // $insert_installment = installment::create($intallment);


            toast($savedPatientname . ' is successfully Registered', 'success')->autoClose(5000);
            return redirect()->route('rec.ipd_papers');
        }
    }

    public function edit_patient(Request $req)
    {
        // Validate the request
        $validator = Validator::make(
            $req->all(),
            [
                'edt_p_name' => 'required|max:255',
                // 'edt_household' => 'required|max:255',
                'edt_phone' => 'sometimes|nullable|regex:/^[6-9]\d{9}$/|unique:patients,phone,' . $req->edt_patient_id,
                'edt_gender' => 'required|in:Male,Female',
                'edt_address' => 'required|max:255',
                'edt_age' => 'required|max:255',
            ],
            [
                'edt_p_name.required' => 'Name field is required',
                // 'edt_household.required' => 'Household field is required',
                'edt_age.required' => 'please enter age',
                'edt_phone.regex' => 'The phone number must be a valid Indian mobile number.',
                'edt_gender.required' => 'Please select the gender',
                'edt_gender.in' => 'Please select the gender',
                'edt_phone.unique' => 'The phone number has already been taken.',
                'edt_address.required' => 'Address is required',
            ]
        );

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve the patient based on the provided ID
        $patient = patients::find($req->edt_patient_id);
        $patient_clone = patients_clone::where('patient_id', $req->edt_patient_id)->withTrashed()->get();
        $ipd_clone = ipd_clone::where('patient_id', $req->edt_patient_id)->withTrashed()->get();

        if ($patient) {
            // Update patient details
            $patient->update([
                'name' => $req->edt_p_name,
                'household' => $req->edt_household,
                'phone' => $req->edt_phone,
                'gender' => $req->edt_gender,
                'address' => $req->edt_address,
                'age' => $req->edt_age,
            ]);
        }
        if ($patient_clone) {
            foreach ($patient_clone as $clone) {
                $clone->update([
                    'name' => $req->edt_p_name,
                    'household' => $req->edt_household,
                    'phone' => $req->edt_phone,
                    'gender' => $req->edt_gender,
                    'address' => $req->edt_address,
                    'age' => $req->edt_age,
                ]);
            }
        }
        if ($ipd_clone) {
            foreach ($ipd_clone as $ipd) {
                $ipd->update([
                    'name' => $req->edt_p_name,
                    'household' => $req->edt_household,
                    'phone' => $req->edt_phone,
                    'gender' => $req->edt_gender,
                    'address' => $req->edt_address,
                    'age' => $req->edt_age,
                ]);
            }
        }


        toast($patient->name . ' is successfully Updated', 'success')->autoClose(5000);
        // Redirect or perform any other action after successful update
        return redirect()->back(); // Change 'your.route.name' to the actual route you want to redirect to.
    }

    public function pay_advance(Request $req)
    {
        $id = $req->id;
        $amount = $req->amount;
        $p_method = $req->p_method;
        $descr = 'Advance';

        $sub_bill = admission::find($id);

        if ($sub_bill) {
            $admissionData = admission::select('fees', 'paid')->find($id);
            if ($admissionData) {
                $fees = $admissionData->fees;
                $paid = $admissionData->paid;
                $adv = $admissionData->advance;
            }
        }

        $sub_bill->paid = $amount + $sub_bill->paid;
        $sub_bill->advance = $amount + $sub_bill->advance;
        $update_bill = $sub_bill->save(); //Updating the amount in the admission table

        $opd_details = ipd_clone::where('admission_id', $sub_bill->id)->first();
        $opd_id = $opd_details->opd_number;
        $installments = installment::create([
            'admission_id' => $id,
            'opd_number' => $opd_id,
            'amount' => $amount,
            'p_mode' => $p_method,
            'descr' =>  $descr
        ]);

        if ($update_bill && $installments) {
            return response()->json(['msg' => 'Advance Payment Success Full']);
        } else {
            return response()->json(['msg' => 'Advance Payment Failed']);
        }
    }

    public function check_patient(Request $req)
    {
        $phone = $req->phone;
        $ptn_id = $req->ptn_id;
        $opd_no = $req->opd_id_no;
        $recipt_id = $req->recipt_id;

        if ($phone !== null || $ptn_id !== null || $opd_no !== null || $recipt_id !== null) {

            if ($phone !== null) {
                // Fetch patient by phone, excluding null values
                $patient = patients::whereNotNull('phone')->where('phone', $phone)->first();
            }
            if ($ptn_id !== null) {
                // Fetch patient by ID
                $patient = patients::where('id', $ptn_id)->first();
            }

            if ($opd_no !== null) {
                $get_pt_id = patients_clone::where('id', $opd_no)->withTrashed()->first();

                if ($get_pt_id !== null) {
                    $patient = patients::find($get_pt_id->patient_id);
                } else {
                    return response()->json(['error' => "Not_found"]);
                }
            }

            if ($recipt_id !== null) {
                $adm_id = installment::where('id', $recipt_id)->first();
                if ($adm_id !== null) {
                    $pt_id_by_recipt = admission::where('id', $adm_id->admission_id)->withTrashed()->first();
                    $patient = patients::where('id', $pt_id_by_recipt->patient_id)->first();
                } else {
                    return response()->json(['error' => "Not_found"]);
                }
            }
            if ($patient) {
                $p_id = $patient->id;
                $admisssion_id =  admission::where(['patient_id' => $p_id])->onlyTrashed()->first();
                $opd_details = patients_clone::where('patient_id', $p_id)->first();
                $admission_details = admission::where('patient_id', $p_id)->withTrashed()->latest()->first();
                if (!$admisssion_id) {
                    return response()->json(['msg' => 'running patient', 'opd_details' => $opd_details, 'name' => $patient, 'admission_deatails' => $admission_details]);
                }
            } else {
                $p_id = "New Patient";
                $admisssion_id = "Not Available";
            }

            if (!$patient) {
                // No patient with the given phone number was found, return 404 Not Found
                return response()->json(['error' => "Not_found"]);
            }

            $running_patient = $patient->admission()->whereNull('deleted_at')->oldest('created_at')->first();
            if ($running_patient) {
                return response()->json(['msg' => "running patient", 'name' => $patient, 'opd_details' => $opd_details, 'admission_deatails' => $admission_details]);
            }

            $patient_date = patients::where('id', $p_id)->pluck('a_date')[0];

            // Adjusted: Use Carbon to add 2 months to the patient's admission date
            $twoMonthsAfterAdmission = Carbon::parse($patient_date)->addMonths(2);

            $now = Carbon::now();

            // Adjusted: Use $twoMonthsAfterAdmission instead of $FirstAdmission
            if ($now->lessThan($twoMonthsAfterAdmission)) {
                // Within the first 2 months, it's a follow-up
                return response()->json(['msg' => "Follow-up admission allowed", 'name' => $patient, 'a_id' => $admisssion_id, 'validity' => $twoMonthsAfterAdmission, 'opd_details' => $opd_details, 'admission_deatails' => $admission_details]);
            } else {
                // After 2 months, require a new admission
                return response()->json(['msg' => "New admission required", 'name' => $patient, 'a_id' => $admisssion_id, 'validity' => $twoMonthsAfterAdmission, 'opd_details' => $opd_details, 'admission_deatails' => $admission_details]);
            }
        }
    }

    public function follow_up(Request $req)
    {
        $values = $req->all();
        $id = $req->id;
        $name = $req->name;
        $patient_id = admission::where('id', $id)->onlyTrashed()->pluck('patient_id')[0];

        $admissionData = [
            'patient_id' => $patient_id,
            'admission_type' => 'OPD',
            'doctor' => 'Dr. Shetty', //actual doctor's name
            'refer_doc' => $req->refer_doc,
            'operation_name' => '',
            'operation_date' => NULL,
            'fees' => $req->amount,
            'paid' => $req->amount,
            'advance' => NULL,
            'p_mode' => $req->p_mode,
            'discharge' => false, // Assuming it's not discharged initially
        ];

        $newAdmission = admission::create($admissionData);
        $new_date = now()->format('Y-m-d H:i:s');

        // if ($newAdmission) {
        //     $alter_old_Admission = patients::where('id', $patient_id)->first();

        //     if ($alter_old_Admission) {
        //         $alter_old_Admission->update(['a_date' => $new_date]);

               
        //     }
        // }

        $savedAdmissionId = $newAdmission->id;
        $billData = [
            'admission_id' => $savedAdmissionId,
            'description' => $req->descr,
            'category' => 'hospital',
            'amount' => $req->amount,
            'admission_type' => 'OPD',
            'qty' => '1'
        ];

        $newBIll = billing::create($billData);

        $opd_details =  patients_clone::where('patient_id', $patient_id)->first();
        $opd_id = $opd_details->id;
        $installment = [
            'admission_id' => $savedAdmissionId,
            'opd_number' => $opd_id,
            'descr' => $req->descr,
            'amount' => $req->amount,
            'p_mode' => $req->p_mode
        ];

        if ($req->amount !== null && $req->amount !== '0') {
            installment::create($installment);
            cloned_recipts::create($installment);
        }

        toast($name . ' is successfully Registered', 'success')->autoClose(5000);
        return response()->json(['msg' => 'success']);
    }

    public function renewal(Request $req)
    {
        $values = $req->all();
        $id = $req->id;
        $name = $req->name;
        $patient_id = admission::where('id', $id)->onlyTrashed()->pluck('patient_id')[0];

        $admissionData = [
            'patient_id' => $patient_id,
            'admission_type' => 'OPD',
            'doctor' => 'Dr. Shetty', //actual doctor's name
            'refer_doc' => $req->refer_doc,
            'operation_name' => '',
            'operation_date' => NULL,
            'fees' => $req->amount,
            'paid' => $req->amount,
            'advance' => NULL,
            'p_mode' => $req->p_mode,
            'discharge' => false, // Assuming it's not discharged initially
        ];

        $newAdmission = admission::create($admissionData);
        $new_date = now()->format('Y-m-d H:i:s');

        if ($newAdmission) {
            $alter_old_Admission = patients::where('id', $patient_id)->first();

            if ($alter_old_Admission) {
                $update_date = $alter_old_Admission->update(['a_date' => $new_date]);
            }

            if ($update_date) {
                $patients_records = patients::where('id', $patient_id)->get();
                $dlt_at_clone = patients_clone::where('patient_id', $patient_id)->delete();
            }
            $clone_patient_data = [
                'patient_id' => $patient_id,
                'admission_id' => $newAdmission->id,
                'name' => $alter_old_Admission->name,
                'household' => $alter_old_Admission->household,
                'phone' => $alter_old_Admission->phone,
                'age' => $alter_old_Admission->age,
                'gender' => $alter_old_Admission->gender,
                'address' => $alter_old_Admission->address,
                'a_date' => $alter_old_Admission->a_date,
            ];
            $dlt_at_clone = patients_clone::create($clone_patient_data);
        }
        $savedAdmissionId = $newAdmission->id;
        $billData = [
            'admission_id' => $savedAdmissionId,
            'description' => $req->descr,
            'category' => 'hospital',
            'amount' => $req->amount,
            'admission_type' => 'OPD',
            'qty' => '1'
        ];
        $newBIll = billing::create($billData);
        $opd_id = $dlt_at_clone->id;
        $installment = [
            'admission_id' => $savedAdmissionId,
            'opd_number' => $opd_id,
            'descr' => $req->descr,
            'amount' => $req->amount,
            'p_mode' => $req->p_mode
        ];
        if ($req->amount !== null && $req->amount !== '0') {
            installment::create($installment);
            cloned_recipts::create($installment);
        }
        toast($name . ' is successfully Registered', 'success')->autoClose(5000);
        return response()->json(['msg' => 'success']);
    }
    public function add_new_bill(Request $req)
    {
        $id = $req->admission_id;
        $check_bill = temporary::where(['description' => $req->description, 'admission_id' => $id])->exists();
        $newQty = $req->qty;
        $description = $req->description;
        // $record = temporary::where('description', $description)->first();

        if ($check_bill) {
            $insert_bill = temporary::where(['description' => $description, 'admission_id' => $id])->first();

            // Calculate updated quantity
            $updatedQty = $insert_bill->qty + $newQty;
            // Update the record
            $insert_bill->update(['qty' => $updatedQty]);
            $bill_id = $insert_bill->admission_id;
            $get_bills = temporary::where('admission_id', $bill_id)->get();
            return response()->json(['msg' => "updated the qty", 'bills' => $get_bills]);
            // You can also use $record->qty += $newQty; $record->save(); if needed
        } else {
            $insert_bill = temporary::create($req->all());
            if ($insert_bill) {
                $msg = "new";
            }
            $bill_id = $insert_bill->admission_id;
            $get_bills = temporary::where('admission_id', $bill_id)->get();
            return response()->json(['msg' => $msg, 'bills' => $get_bills]);
        }
    }

    public function dlt_service(Request $req)
    {
        $id = $req->all();
        $list = temporary::find($req->id);

        if ($list) {
            $delete = temporary::where('id', $req->id)->delete();
            if ($delete) {
                $temp_bills = temporary::where('admission_id', $req->a_id)->get();
                return response()->json(['msg' => "deleted", 'bills' => $temp_bills]);
            } else {
                $temp_bills = temporary::where('admission_id', $req->a_id)->get();
                return response()->json(['msg' => "Unable to delete", 'bills' => $temp_bills]);
            }
        }
    }


    public function get_tmp_bills(Request $req)
    {
        $temp_bills = temporary::where('admission_id', $req->admission_id)->get();
        $type = admission::where('id', $req->admission_id)->pluck('admission_type')[0];
        return response()->json(['temp_bills' => $temp_bills, 'type' => $type]);
    }

    public function confirm_bill(Request $req)
    {
        $temp_bills = temporary::where('admission_id', $req->admission_id)->get();
        $check_tmp_bills = temporary::where('admission_id', $req->admission_id)->exists();
        $billingData = [];

        foreach ($temp_bills as $temp_bill) {
            $existingBill = billing::where(['description' => $temp_bill->description, 'admission_id' => $req->admission_id])->first();
            if ($existingBill) {
                // Update the quantity for the existing billing record
                $existingBill->qty += $temp_bill->qty;
                $existingBill->save();
            } else {
                // Add data for new billing record
                $billingData[] = [
                    'admission_id' => $temp_bill->admission_id,
                    'description' => $temp_bill->description,
                    'category' => $temp_bill->category,
                    'amount' => $temp_bill->amount,
                    'admission_type' => $temp_bill->admission_type,
                    'qty' => $temp_bill->qty

                ];
            }
        }
        // Insert new billing records if any
        if (!empty($billingData)) {
            $insert_in_billing = billing::insert($billingData);
        }
        // Always fetch the billing records after updating
        $get_from_billing = billing::where(['admission_id' => $req->admission_id, 'description' => "OPD Consultation"])->get();

        //Deleting all the bills from temproray table after bill submission
        temporary::where('admission_id', $req->admission_id)->delete();
        //updating total fees in admission table after bill submissions
        $sum = billing::where('admission_id', $req->admission_id)
            ->selectRaw('SUM(amount * qty) as total_sum')
            ->value('total_sum');
        $admission = admission::find($req->admission_id);
        $admission->fees = $sum;
        $feesUpdate = $admission->save();
        // return redirect()->route('rec.paybills');
        return response()->json(['msg' => 'Inserted in the billing', 'bills' => $get_from_billing, "check_bills" => $check_tmp_bills, 'Updated_fees' => $sum]);
    }

    public function paybills_view(Request $req)
    {
        $id = $req->input('btn_pay_adv');
        $patientData = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->where('admission.id', $id)
            ->select('admission.id', 'patients.name', 'patients.address', 'patients.age', 'patients.phone')
            ->get();

        $billData = DB::table('admission')
            ->join('billing', 'admission.id', '=', 'billing.admission_id')
            ->where('admission.id', $id)
            ->select('billing.description', 'billing.amount', 'billing.qty', 'billing.amount')
            ->get();

        $paid = admission::where('id', $id)->pluck('paid')[0];
        $dis_amt = admission::where('id', $id)->pluck('discount')[0];
        return view('pages.receptionist.pay_bills', ['id' => $id, 'bill' => $billData, 'patient_data' => $patientData, 'paid' => $paid, 'dis_amt' => $dis_amt]);
    }

    public function submit_final_bill(Request $req)
    {
        // dd($req->all());
        $id = $req->admission_id;
        $p_method = $req->input('p_method');
        $descr = $req->input('descr');
        $amount = $req->input('bill_pay');
        $discount = $req->input('d_amount');

        $sub_bill = admission::find($id);

        if ($sub_bill) {
            $admissionData = admission::select('fees', 'paid')->find($id);
            if ($admissionData) {
                $fees = $admissionData->fees;
                $paid = $admissionData->paid;
                $remainingBalance = $fees - $paid;

                $validator = Validator::make(
                    $req->all(),
                    [
                        'bill_pay' => ['required', 'numeric', 'not_in:0', new AmountNotGreaterThanFeesRule($remainingBalance)],
                        'p_method' => 'required|in:cash,upi',
                        'descr' => 'required|max:255'
                    ],
                    [
                        'p_method' => 'Please select the payment mode',
                        'bill_pay.required' => 'Please enter a valid amount',
                        'bill_pay.numeric' => 'The amount must be a number',
                        'bill_pay.not_in' => 'Amount should be grater than 0 ',
                        'descr' => 'Please enter the description'
                    ]
                );
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            }


            $sub_bill->paid = $amount + $sub_bill->paid;
            $sub_bill->discount = $discount + $sub_bill->discount;
            $update_bill = $sub_bill->save(); //Updating the amount in the admission table


            // $opd_details = patients_clone::where('admission_id', $id)->first();
            // if($opd_details != ''){
            //     $opd_id = patients_clone::where('admission_id', $id)->pluck('id')[0];
            // }
            // $ipd_details = ipd_clone::where('admission_id', $id)->first();
            // if($ipd_details != ''){
            //     $opd_id = ipd_clone::where('admission_id', $id)->pluck('opd_number')[0];
            // }


            $patient_id = admission::where('id', $id)->pluck('patient_id')[0];
            if ($patient_id != '') {
                $opd_id = patients_clone::whereNull('deleted_at')->where('patient_id', $patient_id)->pluck('id')[0];
            }
            $ipd_details = ipd_clone::where('admission_id', $id)->first();
            if ($ipd_details != '') {
                $opd_id = ipd_clone::whereNull('deleted_at')->where('patient_id', $patient_id)->pluck('opd_number')[0];
            }

            $installments = installment::create([
                'admission_id' => $id,
                'opd_number' => $opd_id,
                'amount' => $amount,
                'p_mode' => $p_method,
                'descr' =>  $descr
            ]);

            if ($installments) {
                $discharge = admission::find($id);
                $discharge->delete();
                $feesUpdate = $discharge->save();

                $dis_ipd_clone = ipd_clone::where('admission_id', $id)->whereNull('deleted_at');
                if ($dis_ipd_clone) {
                    $dis_ipd_clone->delete();
                }
            }


            if ($update_bill) {
                alert('Rs. ' . $amount . ' is successfully paid by ' . $p_method)->autoClose(5000);
                return redirect()->route('rec.recipts');
            } else {
                return redirect()->back();
            }
        }
    }

    public function get_to_print(Request $req)
    {
        $id = $req->id;
        $patientData = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->where('admission.id', $id)
            ->select('patients.name', 'patients.address', 'admission.created_at', 'admission.updated_at', 'admission.id AS aid', 'admission.fees as total_bill', 'admission.paid AS paid_amount', 'admission.discount AS discount', 'admission.advance AS advance', 'admission.admission_type')
            ->get();

        foreach ($patientData as $record) {
            $record->created_at = Carbon::parse($record->created_at)->format('d/m/Y');
            $record->updated_at = Carbon::parse($record->updated_at)->format('d/m/Y');
        }

        $admission_date = Carbon::parse();

        $billData = DB::table('admission')
            ->join('billing', 'admission.id', '=', 'billing.admission_id')
            ->where('admission.id', $id)
            ->select('billing.description', 'billing.id', 'billing.amount', 'billing.qty', 'billing.category AS cat', 'admission.paid', 'admission.discount AS discount', 'billing.admission_type', 'admission.advance', DB::raw('(billing.amount * billing.qty) AS total_amt'),)
            ->get();

        foreach ($billData as $bills) {
            if ($bills->amount == null) {
                $bills->amount = 0;
            }
            if ($bills->total_amt == null) {
                $bills->total_amt = 0;
            }
        }

        $cat_count = billing::where('admission_id', $id)->where('category', 'inj_iv')->count();

        $total_amt = admission::where('id', $id)->withTrashed()->pluck('fees')[0];

        $dis_amt = admission::where('id', $id)->withTrashed()->pluck('discount')[0];

        $adv_amt = admission::where('id', $id)->withTrashed()->pluck('advance')[0];


        $paid = admission::where('id', $id)->withTrashed()->pluck('fees')[0];
        if ($paid === null || $paid === 0) {
            $paid_in_words = 'No Payment Done ';
        } else {
            $paid_in_words =  getIndianCurrency($paid);
        }

        return response()->json(['id' => $id, 'patient_data' => $patientData, 'bill' => $billData, 'total_amt' => $total_amt, 'dis_amount' => $dis_amt, 'paid' => $paid, 'paid_in_words' => $paid_in_words, 'cat_count' => $cat_count, 'advance' => $adv_amt]);
    }


    public function get_to_print_final(Request $req)
    {
        $id = $req->id;
        $patientData = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->where('admission.id', $id)
            ->select('patients.name', 'patients.address', 'admission.created_at', 'admission.updated_at', 'admission.id AS aid', 'admission.fees as total_bill', 'admission.paid AS paid_amount', 'admission.discount AS discount', 'admission.advance AS advance')
            ->get();

        foreach ($patientData as $record) {
            $record->created_at = Carbon::parse($record->created_at)->format('d/m/Y');
            $record->updated_at = Carbon::parse($record->updated_at)->format('d/m/Y');
        }

        $admission_date = Carbon::parse();

        $billData = DB::table('admission')
            ->join('billing', 'admission.id', '=', 'billing.admission_id')
            ->where('admission.id', $id)
            ->select('billing.description', 'billing.id', 'billing.amount', 'billing.qty', 'billing.category AS cat', 'admission.paid', 'admission.discount AS discount', 'admission.advance', DB::raw('(billing.amount * billing.qty) AS total_amt'),)
            ->get();

        foreach ($billData as $bills) {
            if ($bills->amount == null) {
                $bills->amount = 0;
            }
            if ($bills->total_amt == null) {
                $bills->total_amt = 0;
            }
        }

        $cat_count = billing::where('admission_id', $id)->where('category', 'inj_iv')->count();

        $total_amt = admission::where('id', $id)->withTrashed()->pluck('fees')[0];


        $dis_amt = admission::where('id', $id)->withTrashed()->pluck('discount')[0];

        $adv_amt = admission::where('id', $id)->withTrashed()->pluck('advance')[0];

        $net_amt = $total_amt - $dis_amt;


        // $paid = admission::where('id', $id)->withTrashed()->pluck('fees')[0];
        $paid = $total_amt - $dis_amt - $adv_amt;

        if ($net_amt === null || $net_amt === 0) {
            $paid_in_words = 'No Payment Done ';
        } else {
            $paid_in_words =  getIndianCurrency($net_amt);
        }

        return response()->json(['id' => $id, 'patient_data' => $patientData, 'bill' => $billData, 'total_amt' => $total_amt, 'dis_amount' => $dis_amt, 'paid' => $paid, 'paid_in_words' => $paid_in_words, 'cat_count' => $cat_count, 'advance' => $adv_amt, 'net_amt' => $net_amt]);
    }

    public function medicines_services()
    {
        $medicines = medicines_master::orderBy('brand_name', 'asc')->paginate(10);
        return view('pages.receptionist.medicines', ['data' => $medicines]);
    }

    public function get_medicines(Request $request)
    {
        $term = $request->input('term');
        $molecule = $request->input('molecule');
        $category = $request->input('category');
        $dosage = $request->input('dose');

        if ($term != '') {
            $suggestions = DB::table('medicines_master')
                ->where('brand_name', 'LIKE', '%' . $term . '%')
                ->pluck('brand_name');
            return response()->json($suggestions);
        }
        if ($molecule != '') {
            $suggestions = DB::table('medicines_master')
                ->where('molecule', 'LIKE', '%' . $molecule . '%')
                ->pluck('molecule');
            return response()->json($suggestions);
        }
        if ($category != '') {
            $suggestions = DB::table('medicines_master')
                ->where('category', 'LIKE', '%' . $category . '%')
                ->distinct()
                ->pluck('category');
            return response()->json($suggestions);
        }
        if ($dosage != '') {
            $suggestions = DB::table('medicines_master')
                ->where('dosage_form', 'LIKE', '%' . $dosage . '%')
                ->distinct()
                ->pluck('dosage_form');
            return response()->json($suggestions);
        }
    }

    public function get_test_list(Request $request)
    {
        $term = $request->input('term');
        if ($term != '') {
            $suggestions = DB::table('investigation_master')
                ->where('name', 'LIKE', '%' . $term . '%')
                ->pluck('name');
            return response()->json($suggestions);
        }
    }

    public function add_medicine(Request $req)
    {
        // dd($req->all());
        $brand_name  = $req->input('b_name');

        $medicine = [
            'brand_name' => $req->b_name,
            'molecule' => $req->molecule,
            'dosage_form' => $req->category,
            'category' => $req->dosage,

        ];

        $validator = Validator::make(
            $req->all(),
            [
                'b_name' => 'required',
                'molecule' => 'required',
                'category' => 'required',
                'dosage' => 'required'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $insert_med = medicines_master::insert($medicine);
            if ($insert_med) {
                toast($brand_name . ' is successfully Registered', 'success')->autoClose(5000);
                return redirect()->back();
            }
        }
    }

    public function services()
    {
        $services = services::orderBy('service_name', 'asc')->get();
        $services_list = services::orderBy('service_name', 'asc')->get();

        return view('pages.receptionist.services', ['services' => $services, 'service_list' => $services_list]);
    }

    public function add_service(Request $req)
    {
        $service_name = $req->service_name;
        $price = $req->price;
        // dd($service_name);

        $services_list = [
            'service_name' => $service_name,
            'price' => $price
        ];

        $validator = Validator::make(
            $req->all(),
            [
                'service_name' => 'required',
                'price' => 'required',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $check_service = services::where('service_name', $service_name)->first();

        if ($check_service) {
            if ($check_service->price == $price) {
                alert()->warning($check_service->service_name, 'No changes in price');
                return redirect()->back()->withInput();
            };
            if ($check_service->price != $price) {
                $check_service->update(['price' => $price]);
                alert()->success($check_service->service_name, 'Price has been updated');
                return redirect()->back()->withInput();
            };
        }
        $insert = services::create($services_list);
        toast($service_name . ' is added', 'success')->autoClose(5000);
        return redirect()->back();
    }

    public function delete_service(Request $req)
    {
        $id = $req->id;
        $delete = services::where('id', $id)->delete();
        if (!($delete)) {
            return response()->json(['msg' => 'error']);
        }
        return response()->json(['msg' => 'success']);
    }


    public function prescription()
    {
        $data = patients::join('admission', 'patients.id', '=', 'admission.patient_id')
            ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.id AS aid')
            ->whereNull('admission.deleted_at')
            ->where('admission.admission_type', '=', 'OPD')
            ->get();

        $ipd = patients::join('admission', 'patients.id', '=', 'admission.patient_id')
            ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.id AS aid')
            // ->whereNull('admission.deleted_at')
            ->where('admission.admission_type', '=', 'IPD')
            ->orderByDesc('admission.created_at')
            ->paginate(10);

        $check_prescription = admission::join('prescription', 'admission.id', '=', 'prescription.admission_id')
            ->select('prescription.admission_id')
            ->whereNull('admission.deleted_at')
            ->get();

        $check_summary = admission::join('summary', 'admission.id', '=', 'summary.admission_id')
            ->select('summary.admission_id')
            // ->whereNull('admission.deleted_at')
            ->withTrashed()
            ->get();

        foreach ($data as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d/m/Y');
        }

        foreach ($ipd as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d/m/Y');
        }
        return view('pages.receptionist.prescription', ['data' => $data, 'available' => $check_prescription, 'ipd_available' => $check_summary, 'ipd' => $ipd]);
    }
    public function casepaper()
    {
        $data = patients::join('admission', 'patients.id', '=', 'admission.patient_id')
            ->select('patients.name AS patient_name', 'patients.id as pid', 'patients.address AS address', 'patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.id AS aid')
            ->whereNull('admission.deleted_at')
            // ->where('admission.admission_type', '=', 'OPD')
            ->get();
        foreach ($data as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d/m/Y');
        }
        return view('pages.receptionist.casepaper', ['data' => $data]);
    }

    public function certificate()
    {
        return view('pages.receptionist.certificate');
    }

    public function ipdpapers()
    {
        $data = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->join('patients_clone', 'patients.id', '=', 'patients_clone.patient_id')
            ->join('ipd_clone', 'patients.id', '=', 'ipd_clone.patient_id')
            // ->where('admission.admission_type', '=', 'OPD')
            ->select('patients_clone.id AS opd_no', 'ipd_clone.id AS ipd_no', 'patients.name AS patient_name', 'patients.phone AS phone', 'patients.household AS household',  'patients.address AS address', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.operation_name AS op_name', 'admission.operation_date AS op_date', 'admission.created_at AS admission_time', 'admission.refer_doc AS referal')
            ->whereNull('admission.deleted_at')
            ->whereNull('patients_clone.deleted_at')
            ->whereNull('ipd_clone.deleted_at')
            ->where('admission.admission_type', 'IPD')
            ->orderByDesc('admission_date')
            ->get();


        foreach ($data as $records) {
            $records->admission_time = Carbon::parse($records->admission_time)->format('g:i A');
            $records->admission_date = Carbon::parse($records->admission_date)->format('d-m-Y');
            if ($records->op_date !== null) {
                $records->formatted_op_date = Carbon::parse($records->op_date)->format('d-m-Y');
            } else {
                $records->formatted_op_date = null; // or any default value you prefer
            }
            if ($records->referal == null) {
                $records->referal = '';
            }
        }

        $data_opd = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->join('patients_clone', 'patients.id', '=', 'patients_clone.patient_id')
            // ->where('admission.admission_type', '=', 'OPD')
            ->select('patients.id AS p_id', 'patients_clone.id AS opd_no', 'patients.name AS patient_name', 'patients.household AS household', 'patients.phone AS phone', 'patients.household	 AS household',  'patients.address AS address', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.operation_name AS op_name', 'admission.operation_date AS op_date', 'admission.created_at AS admission_time', 'admission.refer_doc AS referal')
            ->whereNull('admission.deleted_at')
            ->whereNull('patients_clone.deleted_at')
            ->where('admission.admission_type', 'OPD')
            ->orderByDesc('admission_date')
            ->get();



        foreach ($data_opd as $record) {
            $record->admission_time = Carbon::parse($record->admission_time)->format('g:i A');
            $record->admission_date = Carbon::parse($record->admission_date)->format('d-m-Y');
            $record->op_date = Carbon::parse($record->op_date)->format('d-m-Y');
            if ($record->referal == null) {
                $record->referal = '';
            }
        }
        return view('pages.receptionist.ipd_papers', ['list' => $data, 'opd_data' => $data_opd]);
    }

    public function opd_papers_by_id(Request $req)
    {
        $data_opd = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->join('patients_clone', 'patients.id', '=', 'patients_clone.patient_id')
            ->where('patients_clone.id', '=', $req->opd_id)
            ->where('admission.admission_type', '=', 'OPD')
            ->select('patients.id AS p_id', 'patients_clone.id AS opd_no', 'patients.name AS patient_name', 'patients.household AS household', 'patients.phone AS phone', 'patients.household	 AS household',  'patients.address AS address', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.operation_name AS op_name', 'admission.operation_date AS op_date', 'admission.created_at AS admission_time', 'admission.refer_doc AS referal')
            // ->whereNull('admission.deleted_at')
            ->whereNull('patients_clone.deleted_at')
            ->where('admission.admission_type', 'OPD')
            ->get();
        if (count($data_opd) === 0) {
            return response()->json(['msg' => 'error']);
        }
        return response()->json(['msg' => 'success', 'data' => $data_opd]);
    }

    public function print_medications(Request $req)
    {
        $id = $req->btn_pay_adv;

        $patient_data = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            ->join('patients_clone', 'patients.id', '=', 'patients_clone.patient_id')
            ->whereNull('patients_clone.deleted_at')
            ->where('admission.id', '=', $id)
            ->select('patients_clone.id AS opd_no', 'patients.name AS patient_name', 'patients.phone AS phone', 'patients.household AS household',  'patients.address AS address', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.operation_name AS op_name', 'admission.operation_date AS op_date', 'admission.created_at AS admission_time')
            ->get();
        foreach ($patient_data as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d-m-Y');
        }


        $medicines = medication::where('admission_id', $id)->get();

        return view('pages.receptionist.pritn_meds', ['id' => $id, 'medicines' => $medicines, 'patient_data' => $patient_data]);
    }

    public function prescribe()
    {
        $data = DB::table('patients')
            ->join('admission', 'patients.id', '=', 'admission.patient_id')
            // ->where('admission.admission_type', '=', 'OPD')
            ->select('patients.name AS patient_name', 'patients.phone AS phone', 'patients.household AS household',  'patients.address AS address', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.operation_name AS op_name', 'admission.operation_date AS op_date', 'admission.created_at AS admission_time', 'admission.id')
            // ->whereNull('admission.deleted_at')
            // ->where('admission.admission_type', 'IPD')
            // ->withTrashed()
            ->orderByDesc('admission_date')
            ->paginate(10);

        foreach ($data as $record) {
            $record->admission_time = Carbon::parse($record->admission_time)->format('H : i');
            $record->admission_date = Carbon::parse($record->admission_date)->format('d-m-Y');
            $record->op_date = Carbon::parse($record->op_date)->format('d-m-Y');
        }

        return view('pages.receptionist.medication', ['data' => $data]);
    }

    public function add_medicines(Request $req)
    {
        $meds = $req->all();
        $insert_meds = medication::create($meds);
        $old_meds = medication::where('admission_id', $req->admission_id)->get();


        $med_name = $req->medicine;
        $find_medicine = medicines_master::where('brand_name', $med_name)->first();
        if ($find_medicine != null) {
            return response()->json(['msg' => 'We got it', 'list' => $meds, 'old_meds' => $old_meds, 'med_name' => $find_medicine]);
        }
        $medicine = [
            'brand_name' => $med_name,
        ];
        $insert_new_medicine = medicines_master::insert($medicine);
        return response()->json(['msg' => 'New Medicine Added', 'list' => $meds, 'old_meds' => $old_meds, 'med_name' => $find_medicine]);
    }

    public function get_prescription(Request $req)
    {
        $all_meds = medication::where('admission_id', $req->admission_id)->get();
        if ($all_meds->isEmpty()) {
            return response()->json(['msg' => 'error']);
        }
        return response()->json(['all_meds' => $all_meds, 'msg' => 'sucess']);
    }

    public function delete_medicines(Request $req)
    {
        $id = $req->id;
        $delete = medication::where('id', $id)->delete();
        $all_meds = medication::where('admission_id', $req->admission_id)->get();
        return response()->json(['id' => $id, 'meds' => $all_meds]);
    }

    public function reports()
    {
        $currentDate = Carbon::now()->toDateString();
        // $result = patients::join('admission', 'patients.id', '=', 'admission.patient_id')
        //     ->join('installment', 'admission.id', '=', 'installment.admission_id')
        //     ->join('patients_clone','patients_clone.admission_id','=','admission.id')
        //     // ->withTrashed() 
        //     // ->where('admission.admission_type', '=', 'opd')
        //     ->whereDate('installment.created_at', $currentDate)
        //     ->select('patients.name', 'admission.id', 'installment.amount', 'installment.descr')
        //     ->get();

        $result = patients_clone::withTrashed()
            ->join('installment', 'installment.opd_number', '=', 'patients_clone.id')
            ->join('admission', 'admission.id', '=', 'installment.admission_id')
            ->select('patients_clone.name', 'installment.opd_number', 'installment.amount', 'installment.descr', 'admission.admission_type')
            ->whereDate('installment.created_at', $currentDate)
            ->orderBy('installment.id')
            ->get();


        // $result = patients_clone::withTrashed()
        //     ->join('admission', 'patients_clone.patient_id', '=', 'admission.patient_id')
        //     ->join('installment', 'admission.id', '=', 'installment.admission_id')
        //     // ->whereNull('admission.deleted_at')
        //     ->where('admission.admission_type', '=', 'opd')
        //     ->where('admission.id','=','paitents_clone.admission_id')
        //     ->whereDate('installment.created_at', $currentDate)
        //     ->select('patients_clone.name', 'patients_clone.id', 'installment.amount', 'installment.descr')
        //     ->get();



        return view('pages.receptionist.reports', ['data' => $result]);
    }

    public function get_reports_range(Request $req)
    {
        $fdate = Carbon::parse($req->f_date)->startOfDay();
        $tdate = Carbon::parse($req->t_date)->endOfDay();

        if ($fdate->greaterThan($tdate)) {
            // Handle the error, for example, return a response or redirect back with an error message
            return response()->json(['msg' => 'error']);
        }

        $bills = patients_clone::withTrashed()
            ->join('installment', 'installment.opd_number', '=', 'patients_clone.id')
            ->join('admission', 'admission.id', '=', 'installment.admission_id')
            ->withTrashed()
            ->where(DB::raw('DATE(installment.created_at)'), '>=', $fdate->toDateString())
            ->where(DB::raw('DATE(installment.created_at)'), '<=', $tdate->toDateString())
            ->select('patients_clone.name', 'installment.opd_number', 'installment.amount', 'installment.descr', 'installment.id AS recipt_no', 'installment.created_at AS recipt_date')
            ->orderBy('installment.id')
            ->get();
        foreach ($bills as $record) {
            $record->recipt_date = Carbon::parse($record->recipt_date)->format('d-m-Y');
        }

        $fdateFormatted = $fdate->format('d-m-y');
        $tdateFormatted = $tdate->format('d-m-y');
        if ($bills->isEmpty()) {
            return response()->json(['msg' => 'nobills', 'fdate' => $fdateFormatted, 'tdate' => $tdateFormatted]);
        }
        $totalAmount = $bills->sum('amount');
        return response()->json(['msg' => 'success', 'result' => $bills, 'fdate' => $fdateFormatted, 'tdate' => $tdateFormatted, 'totalAmount' => $totalAmount]);
    }

    public function recipts()
    {
        $patient_data = patients::join('admission', 'patients.id', '=', 'admission.patient_id')
            // ->join('installment', 'installment.admission_id', '=', 'admission.id')
            ->select('patients.name', 'admission.id', 'admission.created_at AS date', 'admission.admission_type')
            ->orderByDesc('admission.id')
            //->withTrashed()
            ->paginate(10);

        $patient_data_new = patients_clone::withTrashed()
            ->join('installment', 'installment.opd_number', '=', 'patients_clone.id')
            ->distinct()
            ->select('patients_clone.name', 'installment.opd_number')
            ->orderByDesc('installment.id')
            ->paginate(10);

        // foreach ($patient_data as $record) {
        //     $record->date = Carbon::parse($record->date)->format('d-m-Y');
        // }
        return view('pages.receptionist.recipts', ['data' => $patient_data_new]);
    }

    public function recipt_by_opdId(Request $req)
    {
        $find_patient = patients_clone::where('id', $req->opd_id)->withTrashed()->first();
        if ($find_patient !== null) {
            $patient_id = $find_patient->patient_id;

            // $patient_data = patients_clone::join('admission', 'patients_clone.patient_id', '=', 'admission.patient_id')
            //     ->join('installment', 'installment.admission_id', '=', 'admission.id')
            //     ->where('admission.patient_id', $patient_id)
            //     ->select('patients_clone.name', 'admission.id', 'admission.created_at AS date', 'admission.admission_type')
            //     ->orderByDesc('admission.created_at')
            //     ->get();
            $opd_id = $find_patient->id;
            $patient_data = patients_clone::withTrashed()
                ->where('id', $opd_id)
                ->select('name', 'id as opd_number')
                ->get();

            // foreach ($patient_data as $record) {
            //     $record->date = Carbon::parse($record->date)->format('d-m-Y');
            // }
            return response()->json(['patient_data' => $patient_data, 'msg' => 'success', 'data' => $find_patient]);
        }
        return response()->json(['msg' => 'error']);
    }

    // public function recipt_by_ipdId(Request $req)
    // {
    //     $find_patient = ipd_clone::where('id', $req->ipd_id)->withTrashed()->first();
    //     if ($find_patient !== null) {
    //         $patient_id = $find_patient->patient_id;

    //         $patient_data = ipd_clone::leftJoin('admission', 'ipd_clone.patient_id', '=', 'admission.patient_id')
    //         ->leftJoin('installment', 'installment.admission_id', '=', 'admission.id')
    //         ->where('admission.patient_id', $patient_id)
    //         ->select(['ipd_clone.name', 'admission.id', 'admission.created_at AS date', DB::raw("'IPD' as admission_type")])
    //         ->orderByDesc('admission.created_at')
    //         // Optionally, you can add a condition to filter by 'IPD' admission_type if needed
    //         // ->where('admission.admission_type', '=', 'IPD')
    //         ->withTrashed('admission')
    //         ->get();

    //         foreach ($patient_data as $record) {
    //             $record->date = Carbon::parse($record->date)->format('d-m-Y');
    //         }
    //         return response()->json(['patient_data' => $patient_data, 'msg' => 'success', 'data' => $find_patient]);
    //     }
    //     return response()->json(['msg' => 'error']);
    // }

    public function get_bills(Request $req)
    {

        $id = $req->id;
        // $bills = admission::join('installment', 'admission.id', '=', 'installment.admission_id')
        //     ->join('patients', 'patients.id', '=', 'admission.patient_id')
        //     ->where('admission.id', $id)
        //     ->select('patients.id AS p_id', 'installment.id AS i_id', 'admission.id AS a_id', 'installment.descr', 'installment.amount', 'installment.p_mode', 'installment.created_at AS date', 'patients.name', 'installment.amount AS amt_in_words')
        //     ->withTrashed()
        //     ->get();

        $bills = patients_clone::join('installment', 'patients_clone.id', '=', 'installment.opd_number')
            // ->join('patients', 'patients.id', '=', 'admission.patient_id')
            ->join('admission', 'admission.id', '=', 'installment.admission_id')
            ->where('installment.opd_number', $id)
            ->select('patients_clone.patient_id AS p_id', 'installment.opd_number', 'installment.id AS i_id', 'installment.admission_id AS a_id', 'installment.descr', 'installment.amount', 'installment.p_mode', 'installment.created_at AS date', 'patients_clone.name', 'installment.amount AS amt_in_words', 'admission.admission_type')
            ->withTrashed()
            ->get();

            $get_cloned_recipts =  patients_clone::join('cloned_recipts', 'patients_clone.id', '=', 'cloned_recipts.opd_number')
            // ->join('patients', 'patients.id', '=', 'admission.patient_id')
            ->join('admission', 'admission.id', '=', 'cloned_recipts.admission_id')
            ->where('cloned_recipts.opd_number', $id)
            ->select('patients_clone.patient_id AS p_id', 'cloned_recipts.opd_number', 'cloned_recipts.id AS i_id', 'cloned_recipts.admission_id AS a_id', 'cloned_recipts.descr', 'cloned_recipts.amount', 'cloned_recipts.p_mode', 'cloned_recipts.created_at AS date', 'patients_clone.name', 'cloned_recipts.amount AS amt_in_words', 'admission.admission_type')
            ->withTrashed()
            ->get();


            foreach ($get_cloned_recipts as $clone_record) {
                $clone_record->date = Carbon::parse($clone_record->date)->format('d-m-Y');
            }
    
            foreach ($get_cloned_recipts as $clone_record) {
                $clone_record->amt_in_words =  getIndianCurrency($clone_record->amt_in_words);
            }


        foreach ($bills as $record) {
            $record->date = Carbon::parse($record->date)->format('d-m-Y');
        }

        foreach ($bills as $record) {
            $record->amt_in_words =  getIndianCurrency($record->amt_in_words);
        }
        return response()->json(['id' => $id, 'bills' => $bills, 'cloned_recipts' => $get_cloned_recipts]);
    }

    public function opd_cards(Request $req)
    {
        // $patient_list = patients::join('patients_clone','patients_clone.patient_id','=','patients.id')
        // ->select('patients.name','patients.id')
        // ->get();

        $patient_list = patients::join('patients_clone', 'patients.id', '=', 'patients_clone.patient_id')
            ->whereNull('patients_clone.deleted_at')
            ->select('patients.id', 'patients.phone', 'patients.name', 'patients.age', 'patients.gender', 'patients.address', 'patients.a_date')
            ->orderByDesc('patients.id')
            ->paginate(10);
        return view('pages.receptionist.opd_cards', ['patients' => $patient_list]);
    }
    public function getPatientById($patientId)
    {
        
        $patient_list = patients::join('patients_clone', 'patients.id', '=', 'patients_clone.patient_id')
        ->whereNull('patients_clone.deleted_at')
        ->where('patients.id', $patientId) // Find by patient ID
        ->select('patients.id', 'patients.phone', 'patients.name', 'patients.age', 'patients.gender', 'patients.address', 'patients.a_date')
        ->orderByDesc('patients.id')
        ->paginate(10);

    return view('pages.receptionist.opd_cards', ['patients' => $patient_list]);
    }


    public function get_opd_cards(Request $req)
    {
        $patient_id = $req->patn_id;
        $opd_cards = patients_clone::where('patient_id', $patient_id)->withTrashed()->orderByDesc('created_at')->get();

        foreach ($opd_cards as $records) {
            $records->created_on = Carbon::parse($records->created_at)->format('d-m-Y');
            $records->validity_date = Carbon::parse($records->a_date)->addMonths(2)->format('d-m-Y');
            if ($records->deleted_at === null) {
                $records->valid_till = Carbon::parse($records->a_date)->addMonths(2);
                $records->validity = Carbon::parse($records->valid_till)->format('d-m-Y');
            } else {
                $records->valid_till = 'Expired';
                $records->validity = 'Expired';
            }
        }
        return response()->json(['id' => $patient_id, 'opd_cards' => $opd_cards]);
    }

    public function investigations(Request $req)
    {
        $invest_patients = patients_clone::whereNull('deleted_at')->orderByDesc('created_at')->paginate(10);
        return view('pages.receptionist.investigations', ['patients' => $invest_patients]);
    }

    public function labtest_insert(Request $req)
    {
        $labTests = $req->test;
        $patient_details = patients_clone::where('id', $labTests['opd_id'])->get();
        if ($labTests === null) {
            return response()->json(['msg' => 'no tests', 'pateint_details' => $patient_details]);
        }
        // $currentDate = Carbon::now()->toDateString();
        $insert_test = labtest::insert($labTests);
        $results = labtest::where('opd_id', $labTests['opd_id'])->get();
        return response()->json(['msg' => 'SuccessFull', 'tests' => $results, 'pateint_details' => $patient_details]);
    }
    public function get_tests(Request $req)
    {
        $results = labtest::where('opd_id', $req->opd_id)->get();
        $patient_details = patients_clone::where('id', $req->opd_id)->get();
        if ($results->isEmpty()) {
            return response()->json(['msg' => 'not test found', 'pateint_details' => $patient_details]);
        } else {
            return response()->json(['msg' => $results, 'pateint_details' => $patient_details]);
        }
    }

    public function delete_labtest(Request $req)
    {
        $id = $req->id;

        $opd_id = labtest::where('id', $id)->value('opd_id');

        if (!$opd_id) {
            return response()->json(['msg' => 'No test found']);
        }

        $delete_labtest = labtest::where('id', $id)->delete();

        if ($delete_labtest) {
            $results = labtest::where('opd_id', $opd_id)->get();
            $patient_details = patients_clone::where('id', $opd_id)->get();
            return response()->json(['msg' => $results, 'pateint_details' => $patient_details]);
        } else {
            $patient_details = patients_clone::where('id', $opd_id)->get();
            return response()->json(['msg' => 'Failed to delete test', 'pateint_details' => $patient_details]);
        }
    }

    public function edit_bill(Request $req)
    {
        $id = $req->id;
        $qty = $req->qty;
        $admission_id = $req->a_id;

        $find_bill = billing::where('id', $id)->first();
        if ($find_bill) {
            $update_bill = $find_bill->update(['qty' => $qty]);
            if ($update_bill) {
                $patientData = DB::table('patients')
                    ->join('admission', 'patients.id', '=', 'admission.patient_id')
                    ->where('admission.id', $admission_id)
                    ->select('patients.name', 'patients.address', 'admission.created_at', 'admission.updated_at', 'admission.id AS aid', 'admission.fees as total_bill', 'admission.paid AS paid_amount', 'admission.discount AS discount', 'admission.advance AS advance')
                    ->get();

                foreach ($patientData as $record) {
                    $record->created_at = Carbon::parse($record->created_at)->format('d/m/Y');
                    $record->updated_at = Carbon::parse($record->updated_at)->format('d/m/Y');
                }

                $billData = DB::table('admission')
                    ->join('billing', 'admission.id', '=', 'billing.admission_id')
                    ->where('admission.id', $admission_id)
                    ->select('billing.description', 'billing.id', 'billing.amount', 'billing.qty', 'billing.category AS cat', 'billing.admission_type', 'admission.paid', 'admission.discount AS discount', 'admission.advance', DB::raw('(billing.amount * billing.qty) AS total_amt'),)
                    ->get();


                $admissionDetails = admission::where('id', $admission_id)->first();
                if ($admissionDetails != '') {
                    $sum = billing::where('admission_id', $admission_id)
                        ->selectRaw('SUM(amount * qty) as total_sum')
                        ->value('total_sum');
                    $updateFees = $admissionDetails->update(['fees' => $sum]);
                }


                foreach ($billData as $bills) {
                    if ($bills->amount == null) {
                        $bills->amount = 0;
                    }
                    if ($bills->total_amt == null) {
                        $bills->total_amt = 0;
                    }
                }
                $cat_count = billing::where('admission_id', $admission_id)->where('category', 'inj_iv')->count();

                $total_amt = admission::where('id', $admission_id)->withTrashed()->pluck('fees')[0];

                $dis_amt = admission::where('id', $admission_id)->withTrashed()->pluck('discount')[0];

                $adv_amt = admission::where('id', $admission_id)->withTrashed()->pluck('advance')[0];


                $paid = admission::where('id', $admission_id)->withTrashed()->pluck('paid')[0];
                if ($paid === null || $paid === 0) {
                    $paid_in_words = 'No Payment Done ';
                } else {
                    $paid_in_words =  getIndianCurrency($paid);
                }
                return response()->json(['msg' => 'success', 'id' => $id, 'patient_data' => $patientData, 'bill' => $billData, 'total_amt' => $total_amt, 'dis_amount' => $dis_amt, 'paid' => $paid, 'paid_in_words' => $paid_in_words, 'cat_count' => $cat_count, 'advance' => $adv_amt]);
            } else {
                return response()->json(['msg' => 'failed']);
            }
        }
    }

    public function delete_bill(Request $req)
    {
        $id = $req->id;
        $admission_id = $req->admission_id;
        $delete_bill = billing::where('id', $id)->delete();
        if ($delete_bill) {
            $patientData = DB::table('patients')
                ->join('admission', 'patients.id', '=', 'admission.patient_id')
                ->where('admission.id', $admission_id)
                ->select('patients.name', 'patients.address', 'admission.created_at', 'admission.updated_at', 'admission.id AS aid', 'admission.fees as total_bill', 'admission.paid AS paid_amount', 'admission.discount AS discount', 'admission.advance AS advance')
                ->get();

            foreach ($patientData as $record) {
                $record->created_at = Carbon::parse($record->created_at)->format('d/m/Y');
                $record->updated_at = Carbon::parse($record->updated_at)->format('d/m/Y');
            }

            $billData = DB::table('admission')
                ->join('billing', 'admission.id', '=', 'billing.admission_id')
                ->where('admission.id', $admission_id)
                ->select('billing.description', 'billing.id', 'billing.amount', 'billing.qty', 'billing.category AS cat', 'admission.paid', 'admission.discount AS discount', 'billing.admission_type', 'admission.advance', DB::raw('(billing.amount * billing.qty) AS total_amt'),)
                ->get();


            $admissionDetails = admission::where('id', $admission_id)->first();
            if ($admissionDetails != '') {
                $sum = billing::where('admission_id', $admission_id)
                    ->selectRaw('SUM(amount * qty) as total_sum')
                    ->value('total_sum');
                $updateFees = $admissionDetails->update(['fees' => $sum]);
            }


            foreach ($billData as $bills) {
                if ($bills->amount == null) {
                    $bills->amount = 0;
                }
                if ($bills->total_amt == null) {
                    $bills->total_amt = 0;
                }
            }
            $cat_count = billing::where('admission_id', $admission_id)->where('category', 'inj_iv')->count();

            $total_amt = admission::where('id', $admission_id)->withTrashed()->pluck('fees')[0];

            $dis_amt = admission::where('id', $admission_id)->withTrashed()->pluck('discount')[0];

            $adv_amt = admission::where('id', $admission_id)->withTrashed()->pluck('advance')[0];


            $paid = admission::where('id', $admission_id)->withTrashed()->pluck('paid')[0];
            if ($paid === null || $paid === 0) {
                $paid_in_words = 'No Payment Done ';
            } else {
                $paid_in_words =  getIndianCurrency($paid);
            }
            return response()->json(['msg' => 'success', 'id' => $id, 'patient_data' => $patientData, 'bill' => $billData, 'total_amt' => $total_amt, 'dis_amount' => $dis_amt, 'paid' => $paid, 'paid_in_words' => $paid_in_words, 'cat_count' => $cat_count, 'advance' => $adv_amt]);
        }
        return response()->json(['msg' => 'failed']);
    }

    public function patients()
    {
        $all_data = DB::table('patients_clone')
            ->join('admission', 'patients_clone.patient_id', '=', 'admission.patient_id')
            // ->where('admission.admission_type', '=', 'OPD')
            ->select('admission.patient_id', 'patients_clone.id AS opd_number', 'patients_clone.name AS patient_name', 'patients_clone.phone AS phone', 'patients_clone.age AS p_age', 'patients_clone.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.discount AS discount')
            ->whereNull('admission.deleted_at')
            ->whereNull('patients_clone.deleted_at')
            ->orderByDesc('admission.created_at')
            ->get();

        $data = patients_clone::orderByDesc('id')->get();

        return view('pages.receptionist.patients', ['all_data' => $data, 'admission_data' => $all_data]);
    }

    public function get_opd_records(Request $req)
    {
        $patient_id = $req->id;

        $find_records = opd_records::where('patient_id', $patient_id)->first();
        if ($find_records == null) {
            $get_master = records_master::get();
            return response()->json(['msg' => 'new', 'data' => $get_master]);
        }

        return response()->json(['msg' => 'existing', 'id' => $patient_id, 'data' => $find_records]);
    }

    public function insert_records(Request $req)
    {
        $id = $req->patient_id;
        $data = $req->opd_details;
        $complete_data = $req->all();
        $find_patient = opd_records::where('patient_id', $id)->first();
        if (!$find_patient) {
            $create_record = opd_records::create($complete_data);
            if ($create_record) {
                return response()->json(['msg' => 'Inserted Successfully']);
            } else {
                return response()->json(['msg' => 'Error']);
            }
        }
        $find_record = opd_records::where('patient_id', $id)->first();
        $update_record = $find_record->update(['opd_details' => $data]);
        if ($update_record) {
            return response()->json(['msg' => 'Updated the record']);
        } else {
            return response()->json(['msg' => 'Error']);
        }
    }

    public function get_lab_tests(Request $req)
    {
        $results = labtest::where('opd_id', $req->opd_id)->get();
        $patient_details = patients_clone::where('id', $req->opd_id)->get();
        if ($results->isEmpty()) {
            return response()->json(['msg' => 'not test found', 'pateint_details' => $patient_details]);
        } else {
            return response()->json(['msg' => $results, 'pateint_details' => $patient_details]);
        }
    }

    public function get_ipd_patients(Request $req)
    {
        $opd_id = $req->opd_id;
        $ipd_id = $req->ipd_id;

        if ($opd_id != null) {
            $find_ipd = ipd_clone::where('opd_number', $opd_id)->withTrashed()->latest()->first();
            if ($find_ipd != null) {
                $find_ipd->adm_date = Carbon::parse($find_ipd->created_at)->format('d/m/Y');
                return response()->json(['msg' => 'Sucessfull', 'ipd_list' => $find_ipd]);
            }
            return response()->json(['msg' => 'error']);
        }
        if ($ipd_id != null) {
            $find_ipd = ipd_clone::where('id', $ipd_id)->withTrashed()->latest()->first();
            if ($find_ipd != null) {
                $find_ipd->adm_date = Carbon::parse($find_ipd->created_at)->format('d/m/Y');
                return response()->json(['msg' => 'Sucessfull', 'ipd_list' => $find_ipd]);
            }
            return response()->json(['msg' => 'error']);
        }
    }

    public function duplicate_recipts()
    {
        return view('pages.receptionist.recipt_cloned');
    }

  

    public function insert_clone_rec(Request $req){
        $insert_clone_recipt = cloned_recipts::create($req->all());
        if($insert_clone_recipt) {
            $get_cloned_recipts =  patients_clone::join('cloned_recipts', 'patients_clone.id', '=', 'cloned_recipts.opd_number')
            // ->join('patients', 'patients.id', '=', 'admission.patient_id')
            ->join('admission', 'admission.id', '=', 'cloned_recipts.admission_id')
            ->where('cloned_recipts.opd_number', $req->opd_number)
            ->select('patients_clone.patient_id AS p_id', 'cloned_recipts.opd_number', 'cloned_recipts.id AS i_id', 'cloned_recipts.admission_id AS a_id', 'cloned_recipts.descr', 'cloned_recipts.amount', 'cloned_recipts.p_mode', 'cloned_recipts.created_at AS date', 'patients_clone.name', 'cloned_recipts.amount AS amt_in_words', 'admission.admission_type')
            ->withTrashed()
            ->get();
            foreach ($get_cloned_recipts as $clone_record) {
                $clone_record->date = Carbon::parse($clone_record->date)->format('d-m-Y');
            }
            foreach ($get_cloned_recipts as $clone_record) {
                $clone_record->amt_in_words =  getIndianCurrency($clone_record->amt_in_words);
            }
            return response()->json(['msg' => 'success', 'recipts' => $get_cloned_recipts]);
        }
        return response()->json(['msg' => 'error']);
    }
}
