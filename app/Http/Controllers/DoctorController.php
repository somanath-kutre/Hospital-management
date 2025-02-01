<?php

namespace App\Http\Controllers;

use App\Models\admission;
use App\Models\patients;
use App\Models\prescription;
use App\Models\prescriptions;
use App\Models\summary;
use App\Models\summaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    //
    public function index()
    {
        return view('pages.doctor.dashboard');
    }

    public function casepaper()
    {
        $data = patients::join('admission', 'patients.id', '=', 'admission.patient_id')
            ->select('patients.name AS patient_name','patients.id as pid', 'patients.address AS address','patients.phone AS phone', 'patients.age AS p_age', 'patients.gender AS gender', 'admission.id AS aid', 'admission.Fees AS fess', 'admission.paid AS paid', 'admission.created_at AS admission_date', 'admission.admission_type AS type', 'admission.id AS aid')
            ->whereNull('admission.deleted_at')
            // ->where('admission.admission_type', '=', 'OPD')
            ->get();
        foreach ($data as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d/m/Y');
        }
        return view('pages.doctor.casepaper', ['data' => $data]);
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
            ->whereNull('admission.deleted_at')
            ->where('admission.admission_type', '=', 'IPD')
            ->get();

        $check_prescription = admission::join('prescription', 'admission.id', '=', 'prescription.admission_id')
            ->select('prescription.admission_id')
            ->whereNull('admission.deleted_at')
            ->get();

        $check_summary = admission::join('summary', 'admission.id', '=', 'summary.admission_id')
            ->select('summary.admission_id')
            ->whereNull('admission.deleted_at')
            ->get();

        foreach ($data as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d/m/Y');
        }

        foreach ($ipd as $record) {
            $record->admission_date = Carbon::parse($record->admission_date)->format('d/m/Y');
        }
        return view('pages.doctor.prescription', ['data' => $data, 'available' => $check_prescription, 'ipd_available' => $check_summary, 'ipd' => $ipd]);
    }

    public function insert_prescription(Request $req)
    {
        $data = $req->all();
        $id = $data['id'];

        // Check if a record with the specified 'admission_id' exists
        $existingPrescription = prescription::where('admission_id', $id)->first();

        if ($existingPrescription) {
            // If the record exists, update it
            $existingPrescription->update([
                'prescription' => $data['medicines']
            ]);
        } else {
            // If the record doesn't exist, create a new one
            $pres = [
                'admission_id' => $data['id'],
                'prescription' => $data['medicines']
            ];
            $insert = prescription::create($pres);
            if ($insert) {
                $medicines = prescription::where('admission_id', $id)->get();
                return response()->json(['list' => $medicines]);
            } else {
                return response()->json(['list' => 'No insertion']);
            }
        }
    }

    public function get_prescription(Request $req)
    {
        $data = $req->all();
        $id = $data['id'];
        $patient_details = patients::join('admission', 'admission.patient_id', '=', 'patients.id')->where('admission.id', $id)->select('patients.name', 'patients.age', 'admission.doctor', 'patients.address')->first();


        $medicines = prescription::where('admission_id', $id)->get();
        if ($medicines->isEmpty()) {
            return response()->json(['msg' => 'failed', 'patient' => $patient_details]);
        }
        return response()->json(['list' => $medicines, 'msg' => "success", 'patient' => $patient_details]);
    }
    public function prescr_print(Request $req)
    {
        $id = $req->id;
        $prescription = prescription::where('admission_id', $id)->select('prescription')->get();
        $patient_details = patients::join('admission', 'admission.patient_id', '=', 'patients.id')->where('admission.id', $id)->select('patients.name', 'patients.age', 'admission.doctor', 'patients.address')->first();

        if ($prescription->isEmpty()) {
            return response()->json(['msg' => "failed", 'id' => $id, 'patient_details' => $patient_details]);
        }

        return response()->json(['msg' => 'success', 'tablets' => $prescription, 'id' => $id, 'patient_details' => $patient_details]);
    }

    public function summary(Request $req)
    {
        $id = $req->id;
        $old_summary = summary::where('admission_id', $id)->get();
        if (!($old_summary->isEmpty())) {
            return response()->json(['msg' => "Sucessfull", 'summary' => $old_summary]);
        }
        $get_summary = summaster::pluck('summary')[0];
        return response()->json(['msg' => "failed", 'id' => $id, 'summary' => $get_summary]);
    }

    public function submit_summary(Request $req)
    {
        $data = $req->all();
        $id = $data['id'];
        $existingSummary = summary::where('admission_id', $id)->first();

        if ($existingSummary) {
            // If the record exists, update it
            $existingSummary->update([
                'summary' => $data['summary']
            ]);
        } else {
            // If the record doesn't exist, create a new one
            $summ = [
                'admission_id' => $data['id'],
                'summary' => $data['summary']
            ];
            $insert = summary::create($summ);
            if ($insert) {
                $summary = summary::where('admission_id', $id)->get();
                return response()->json(['list' => $summary]);
            } else {
                return response()->json(['list' => 'No insertion']);
            }
        }
    }

    public function get_sum_print(Request $req)
    {
        $id = $req->id;
        $summary = summary::where('admission_id', $id)->select('summary')->get();

        $patient_details = patients::join('admission', 'admission.patient_id', '=', 'patients.id')
        ->join('ipd_clone','ipd_clone.patient_id','=','patients.id')
        // ->whereNull('ipd_clone.deleted_at')
        ->where('admission.id', $id)
        ->select('ipd_clone.id AS ipd_no','patients.name','ipd_clone.opd_number', 'patients.age', 'admission.doctor', 'patients.address', 'admission.created_at', 'admission.updated_at','admission.id AS aid')
        ->latest('ipd_clone.id')
        ->first();

        // $patient_details['created_at'] = Carbon::parse($patient_details['created_at'])->diffForHumans();

        // foreach ($patient_details as $record) {
        //     $record->created_at = Carbon::parse($record->created_at)->format('d/m/Y');
        //     $record->updated_at = Carbon::parse($record->updated_at)->format('d/m/Y H:i:s');
        // }

        if ($summary->isEmpty()) {
            return response()->json(['msg' => "failed", 'id' => $id, 'patient_details' => $patient_details]);
        }

        $admi_date = Carbon::parse($patient_details['created_at'])->format('d/m/Y');
        $dis_date = Carbon::parse($patient_details['updated_at'])->format('d/m/Y');
        return response()->json(['msg' => 'success', 'summary' => $summary, 'id' => $id, 'patient_details' => $patient_details, 'admdate' => $admi_date, 'dis_date' => $dis_date]);
    }

    public function get_medicines(Request $req)
    {
        $term = $req->input('term');
        $suggestions = DB::table('medicines_master')
            ->where('brand_name', 'LIKE', '%' . $term . '%')
            ->where('molecule', 'LIKE', '%' . $term . '%')
            ->pluck('brand_name');
        return response()->json($suggestions);
    }

    public function certificate()
    {
        return view('pages.doctor.certificate');
    }
}
