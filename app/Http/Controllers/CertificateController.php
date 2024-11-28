<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhysicalRecordModel;
use App\Models\ChemicalRecordModel;

class CertificateController extends Controller
{
    //
    // Create
    public function make_physical(Request $request)
    {
        $request->validate([
            'tc_id' => 'required|integer',
            'mtc_id' => 'required|integer',
            'heat_no' => 'required|string',
            'label' => 'required|string',
            'value' => 'required|numeric',
        ]);

        $record = PhysicalRecordModel::create([
            'tc_id' => $request->input('tc_id'),
            'mtc_id' => $request->input('mtc_id'),
            'heat_no' => $request->input('heat_no'),
            'label' => $request->input('label'),
            'value' => $request->input('value'),
        ]);

        return response()->json(['message' => 'Physical record created successfully!', 'data' => $record], 201);
    }

    // View all or single
    public function view_physical(Request $request, $id = null)
    {
        if ($id) {
            $record = PhysicalRecordModel::find($id);
            if (!$record) {
                return response()->json(['message' => 'Physical record not found.'], 404);
            }
            return response()->json($record->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $records = PhysicalRecord::all()->makeHidden(['id', 'created_at', 'updated_at']);
        return response()->json($records);
    }

    // Update
    public function update_physical(Request $request, $id)
    {
        $record = PhysicalRecordModel::find($id);
        if (!$record) {
            return response()->json(['message' => 'Physical record not found.'], 404);
        }

        $request->validate([
            'tc_id' => 'sometimes|integer',
            'mtc_id' => 'sometimes|integer',
            'heat_no' => 'sometimes|string',
            'label' => 'sometimes|string',
            'value' => 'sometimes|numeric',
        ]);

        $record->update([
            'tc_id' => $request->input('tc_id', $record->tc_id),
            'mtc_id' => $request->input('mtc_id', $record->mtc_id),
            'heat_no' => $request->input('heat_no', $record->heat_no),
            'label' => $request->input('label', $record->label),
            'value' => $request->input('value', $record->value),
        ]);

        return response()->json(['message' => 'Physical record updated successfully!', 'data' => $record]);
    }

    // Delete
    public function delete_physical($id)
    {
        $record = PhysicalRecordModel::find($id);
        if (!$record) {
            return response()->json(['message' => 'Physical record not found.'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Physical record deleted successfully!']);
    }

    // Create
    public function make_chemical(Request $request)
    {
        $request->validate([
            'tc_id' => 'required|integer',
            'mtc_id' => 'required|integer',
            'heat_no' => 'required|string',
            'label' => 'required|string',
            'value' => 'required|numeric',
        ]);

        $record = ChemicalRecordModel::create([
            'tc_id' => $request->input('tc_id'),
            'mtc_id' => $request->input('mtc_id'),
            'heat_no' => $request->input('heat_no'),
            'label' => $request->input('label'),
            'value' => $request->input('value'),
        ]);

        return response()->json(['message' => 'Chemical record created successfully!', 'data' => $record], 201);
    }

    // View all or single
    public function view_chemical(Request $request, $id = null)
    {
        if ($id) {
            $record = ChemicalRecordModel::find($id);
            if (!$record) {
                return response()->json(['message' => 'Chemical record not found.'], 404);
            }
            return response()->json($record->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $records = ChemicalRecord::all()->makeHidden(['id', 'created_at', 'updated_at']);
        return response()->json($records);
    }

    // Update
    public function update_chemical(Request $request, $id)
    {
        $record = ChemicalRecordModel::find($id);
        if (!$record) {
            return response()->json(['message' => 'Chemical record not found.'], 404);
        }

        $request->validate([
            'tc_id' => 'sometimes|integer',
            'mtc_id' => 'sometimes|integer',
            'heat_no' => 'sometimes|string',
            'label' => 'sometimes|string',
            'value' => 'sometimes|numeric',
        ]);

        $record->update([
            'tc_id' => $request->input('tc_id', $record->tc_id),
            'mtc_id' => $request->input('mtc_id', $record->mtc_id),
            'heat_no' => $request->input('heat_no', $record->heat_no),
            'label' => $request->input('label', $record->label),
            'value' => $request->input('value', $record->value),
        ]);

        return response()->json(['message' => 'Chemical record updated successfully!', 'data' => $record]);
    }

     // Delete
    public function delete_chemical($id)
    {
        $record = ChemicalRecordModel::find($id);
        if (!$record) {
            return response()->json(['message' => 'Chemical record not found.'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'Chemical record deleted successfully!']);
    }
}
