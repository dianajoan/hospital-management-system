<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis;
use App\Models\MedicalRecord;

class DiagnosisController extends Controller
{
    public function index()
    {
        $diagnosis = Diagnosis::all();
        return view('backend.diagnosis.index', compact('diagnosis'));
    }

    public function create()
    {
        $medicals=MedicalRecord::get();
        $diagnosis=Diagnosis::get();
        return view('backend.diagnosis.create')
            ->with('medicals',$medicals)
            ->with('diagnosis',$diagnosis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'name' => 'required|unique:diagnoses',
            'icd_code' => 'required',
            // Add validation for other fields if necessary
        ]);

        Diagnosis::create($request->all());

        return redirect()->route('diagnosis.index')
            ->with('success', 'Diagnosis created successfully.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        return view('backend.diagnosis.show', compact('diagnosis'));
    }

    public function edit($id)
    {
        $diagnosis=Diagnosis::findOrFail($id);
        $medicals=MedicalRecord::get();
        return view('backend.diagnosis.edit')
            ->with('diagnosis',$diagnosis)
            ->with('medicals',$medicals);
    }

    public function update(Request $request, Diagnosis $diagnosis)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'name' => 'required|unique:diagnoses',
            'icd_code' => 'required',
            // Add validation for other fields if necessary
        ]);

        $diagnosis->update($request->all());

        return redirect()->route('diagnosis.index')
            ->with('success', 'Diagnosis updated successfully');
    }

    public function destroy(Diagnosis $diagnosis)
    {
        $diagnosis->delete();

        return redirect()->route('diagnosis.index')
            ->with('success', 'Diagnosis deleted successfully');
    }
}
