<?php

namespace App\Http\Controllers;

use App\Models\admission;
use App\Models\installment;
use App\Models\ipd_clone;
use App\Models\patients;
use App\Models\patients_clone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\returnSelf;

class IpdController extends Controller
{
    //
    // public function get_ext_pts(Request $req)
    // {
    //     $phone = $req->phone;
    //     $opd_no = $req->ip_opd_no;


    //     if ($phone !== null || $opd_no !== null) {
    //         if ($phone !== null) {
    //             // Fetch patient by phone, excluding null values
    //             $patient = patients::whereNotNull('phone')->whereNotNull('phone', $phone)->first();
    //         }
    //         if ($opd_no !== null) {
    //             $get_pt_id = patients_clone::where('id',$opd_no)->withTrashed()->first();

    //             if($get_pt_id !== null){
    //                 $patient = patients::find($get_pt_id->patient_id);
    //             }
    //             else{
    //                 return response()->json(['error' => "Not_found"]);
    //             }
    //         }

    //         if ($patient) {
    //             $p_id = $patient->id;
    //             $admisssion_id =  admission::where(['patient_id' => $p_id])->onlyTrashed()->first();
    //             if (!$admisssion_id) {
    //                 return response()->json(['msg' => 'running patient', 'name' => $patient]);
    //             }
    //         } else {
    //             $p_id = "New Patient";
    //             $admisssion_id = "Not Available";
    //         }
    //         if (!$patient) {
    //             // No patient with the given phone number was found, return 404 Not Found
    //             return response()->json(['msg' => "Not_found"]);
    //         }

    //         $running_patient = $patient->admission()->whereNull('deleted_at')->first();
    //         if ($running_patient) {
    //             return response()->json(['msg' => "running patient", 'name' => $patient]);
    //         }

    //         $patient_date = patients::where('phone', $phone)->pluck('a_date')[0];

    //         $FirstAdmission = Carbon::now()->diffInMonths($patient_date);

    //         if ($FirstAdmission < 3) {
    //             return response()->json(['msg' => "All_OK", 'name' => $patient]);
    //         } else {
    //             return response()->json(['msg' => 'NOT_OK']);
    //         }

    //     }


    // }


    public function get_ext_pts(Request $req)
    {
        $phone = $req->phone;
        $opd_no = $req->ip_opd_no;

        if ($phone !== null || $opd_no !== null) {
            if ($phone !== null) {
                // Fetch patient by phone, excluding null values
                $patient = patients::whereNotNull('phone')->where('phone', $phone)->first();
            }

            if ($opd_no !== null) {
                $get_pt_id = patients_clone::where('id', $opd_no)->withTrashed()->first();

                if ($get_pt_id !== null) {
                    $patient = patients::find($get_pt_id->patient_id);
                } else {
                    return response()->json(['msg' => "Not_found"]);
                }
            }

            if ($patient) {
                $p_id = $patient->id;
                $admission_id = admission::where(['patient_id' => $p_id])->onlyTrashed()->first();
                if (!$admission_id) {
                    return response()->json(['msg' => 'running patient', 'name' => $patient]);
                }
            } else {
                $p_id = "New Patient";
                $admission_id = "Not Available";
            }

            if (!$patient) {
                // No patient with the given phone number was found, return 404 Not Found
                return response()->json(['msg' => "Not_found"]);
            }

            $running_patient = $patient->admission()->whereNull('deleted_at')->first();
            if ($running_patient) {
                return response()->json(['msg' => "running patient", 'name' => $patient]);
            }

            $patient_date = patients::where('id', $p_id)->pluck('a_date')[0];

            // $FirstAdmission = Carbon::now()->diffInMonths($patient_date);

            // if ($FirstAdmission < 3) {
            //     return response()->json(['msg' => "All_OK", 'name' => $patient]);
            // } else {
            //     return response()->json(['msg' => 'NOT_OK']);
            // }
            // Adjusted: Use Carbon to add 2 months to the patient's admission date
            $twoMonthsAfterAdmission = Carbon::parse($patient_date)->addMonths(2);

            $now = Carbon::now();

            $opd_id = patients_clone::where('patient_id',$p_id)->pluck('id')[0];

            // Adjusted: Use $twoMonthsAfterAdmission instead of $FirstAdmission
            if ($now->lessThan($twoMonthsAfterAdmission)) {
                return response()->json(['msg' => "All_OK", 'name' => $patient,'opd_id' => $opd_id]);
            } else {
                return response()->json(['msg' => 'NOT_OK']);
            }
        }
    }




    public function reg_ipd(Request $req)
    {
        // dd($req->ip_opd_no);

        $validator = Validator::make(
            $req->all(),
            [
                'ip_name' => 'required|max:255',
                // 'ip_method' => 'sometimes|nullable|in:cash,upi',
                'advamount' => 'sometimes|nullable|max:255',
                'operation_name' => 'sometimes|nullable|max:255',
                // 'operation_date' => 'sometimes|date', 
            ],
            [
                'ip_method' => 'Please select the payment mode',
                'operation_name' => 'Please enter the operation name',
                // 'operation_date' => 'Please select the operation date',
                'ip_name' => 'Please enter the name',
                // 'advamount' => 'Please Enter The Advance Amount'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $admission_data = [
                'patient_id' => $req->patient_id_ipd,
                'admission_type' => 'IPD',
                'doctor' => 'Dr. Shetty', //actual doctor's name
                'operation_name' => $req->operation_name,
                'operation_date' => $req->operation_date,
                'fees' => '0',
                'paid' => $req->advamount,
                'advance' => $req->advamount,
                'p_mode' => $req->ip_method,
                'discharge' => false, // Assuming it's not discharged initially
            ];
            // dd($admission_data);
            $opd_id = $req->ip_opd_no;
            $newAdmission = admission::create($admission_data);
            
            $ipd_clone = ipd_clone::create([
                'patient_id' => $req->patient_id_ipd,
                'opd_number' => $opd_id ,
                'admission_id' => $newAdmission->id,
                'name' => $req->ip_name,
                'admission_type' => $newAdmission->admission_type
            ]);

            if ($newAdmission && $req->advamount !== null) {
                $installments = installment::create([
                    'admission_id' => $newAdmission->id,
                    'opd_number' => $opd_id,
                    'amount' => $req->advamount,
                    'p_mode' => $req->ip_method,
                    'descr' => 'advance'
                ]);
            }
            toast($req->ip_name . ' is successfully admited', 'success')->autoClose(5000);
            return redirect()->route('rec.ipd_papers');
        }
    }
}
