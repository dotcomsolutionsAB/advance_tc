<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CertificateModel;
use App\Models\PhysicalRecordModel;
use App\Models\ChemicalRecordModel;

class CertificateController extends Controller
{
    //
    public function create_certificate(Request $request)
    {
        // Validation for required fields
        $request->validate([
            'c_no' => 'required|string',
            'product_id' => 'required|integer|exists:t_product,id', // Assuming a foreign key relationship
            'size' => 'nullable|string',
            'heat_no' => 'nullable|string',
            'serial' => 'nullable|string',
            'quantity' => 'required|integer',
            'drawing_no' => 'nullable|string',
            'customer' => 'nullable|string',
            'auth_signatory' => 'nullable|string',
            'inspect_signatory' => 'nullable|string',
            'manufacture_process' => 'nullable|string',
            'tcd' => 'nullable|string',
            'reduction' => 'nullable|string',
            'size_2' => 'nullable|string',
            'notes' => 'nullable|string',
            'hardness' => 'nullable|string',
            'maker_name' => 'nullable|string',
            'edited' => 'nullable|boolean',
        ]);

        // Create a new certificate
        $certificate = CertificateModel::create([
            'c_no' => $request->input('c_no'),
            'product_id' => $request->input('product_id'),
            'size' => $request->input('size', ''),
            'heat_no' => $request->input('heat_no', ''),
            'serial' => $request->input('serial', ''),
            'quantity' => $request->input('quantity', 0),
            'drawing_no' => $request->input('drawing_no', ''),
            'customer' => $request->input('customer', ''),
            'auth_signatory' => $request->input('auth_signatory', ''),
            'inspect_signatory' => $request->input('inspect_signatory', ''),
            'manufacture_process' => $request->input('manufacture_process', ''),
            'tcd' => $request->input('tcd', ''),
            'reduction' => $request->input('reduction', ''),
            'size_2' => $request->input('size_2', ''),
            'notes' => $request->input('notes'),
            'hardness' => $request->input('hardness', ''),
            'maker_name' => $request->input('maker_name', ''),
            'edited' => $request->input('edited', false),
        ]);

        unset($certificate['id'], $certificate['created_at'], $certificate['updated_at']);

        return response()->json(['message' => 'Certificate created successfully!', 'data' => $certificate], 201);
    }

    // View all or a single certificate
    public function view_certificate(Request $request, $id = null)
    {
        if ($id) {
            // Fetch single certificate by ID
            $certificate = CertificateModel::find($id);
            if (!$certificate) {
                return response()->json(['message' => 'Certificate not found.'], 404);
            }

            return response()->json(['message' => 'Certificate fetched successfully!', 'data' => $certificate->makeHidden(['id', 'created_at', 'updated_at'])]);
        }

        // Fetch all certificates
        $certificates = CertificateModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($certificates) && $certificates->isNotEmpty()
            ? response()->json(['Fetch data successfully!', 'data' => $certificates, 'count' => count($certificates)], 200)
            : response()->json(['Sorry, No data Available'], 400);
    }

    public function update_certificate(Request $request, $id)
    {
        // Find the certificate by ID
        $certificate = CertificateModel::find($id);
        if (!$certificate) {
            return response()->json(['message' => 'Certificate not found.'], 404);
        }

        // Validation for fields
        $request->validate([
            'c_no' => 'sometimes|string|unique:certificates,c_no,' . $id,
            'product_id' => 'sometimes|integer|exists:products,id',
            'size' => 'nullable|string',
            'heat_no' => 'nullable|string',
            'serial' => 'nullable|string',
            'quantity' => 'sometimes|integer',
            'drawing_no' => 'nullable|string',
            'customer' => 'nullable|string',
            'auth_signatory' => 'nullable|string',
            'inspect_signatory' => 'nullable|string',
            'manufacture_process' => 'nullable|string',
            'tcd' => 'nullable|string',
            'reduction' => 'nullable|string',
            'size_2' => 'nullable|string',
            'notes' => 'nullable|string',
            'hardness' => 'nullable|string',
            'maker_name' => 'nullable|string',
            'edited' => 'nullable|boolean',
        ]);

        // Update the certificate with new values
        $certificate->update([
            'c_no' => $request->input('c_no', $certificate->c_no),
            'product_id' => $request->input('product_id', $certificate->product_id),
            'size' => $request->input('size', $certificate->size),
            'heat_no' => $request->input('heat_no', $certificate->heat_no),
            'serial' => $request->input('serial', $certificate->serial),
            'quantity' => $request->input('quantity', $certificate->quantity),
            'drawing_no' => $request->input('drawing_no', $certificate->drawing_no),
            'customer' => $request->input('customer', $certificate->customer),
            'auth_signatory' => $request->input('auth_signatory', $certificate->auth_signatory),
            'inspect_signatory' => $request->input('inspect_signatory', $certificate->inspect_signatory),
            'manufacture_process' => $request->input('manufacture_process', $certificate->manufacture_process),
            'tcd' => $request->input('tcd', $certificate->tcd),
            'reduction' => $request->input('reduction', $certificate->reduction),
            'size_2' => $request->input('size_2', $certificate->size_2),
            'notes' => $request->input('notes', $certificate->notes),
            'hardness' => $request->input('hardness', $certificate->hardness),
            'maker_name' => $request->input('maker_name', $certificate->maker_name),
            'edited' => $request->input('edited', $certificate->edited),
        ]);

        unset($certificate['created_at'], $certificate['updated_at']);

        return response()->json(['message' => 'Certificate updated successfully!', 'data' => $certificate]);
    }

    // Delete a certificate
    public function delete_certificate($id)
    {
        // Find certificate by ID
        $certificate = CertificateModel::find($id);
        if (!$certificate) {
            return response()->json(['message' => 'Certificate not found.'], 404);
        }

        // Delete the certificate
        $certificate->delete();

        return response()->json(['message' => 'Certificate deleted successfully!']);
    }

    // Create
    public function make_physical(Request $request)
    {
        $request->validate([
            'tc_id' => 'required||exists:t_certificate,id',
            'mtc_id' => 'required|exists:t_mtc,id',
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

        unset($record['id'], $record['created_at'], $record['updated_at']);

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

        $record = PhysicalRecordModel::all()->makeHidden(['id', 'created_at', 'updated_at']);
        
        return isset($record) && $record->isNotEmpty()
        ? response()->json(['Fetch data successfully!', 'data' => $record, 'count' => count($record)], 200)
        : response()->json(['Sorry, No data Available'], 400); 
    }

    // Update
    public function update_physical(Request $request, $id)
    {
        $record = PhysicalRecordModel::find($id);
        if (!$record) {
            return response()->json(['message' => 'Physical record not found.'], 404);
        }

        $request->validate([
            'tc_id' => 'sometimes|integer|exists:t_certificate,id',
            'mtc_id' => 'sometimes|integer|exists:t_mtc,id',
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

        unset($record['created_at'], $record['updated_at']);

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
            'tc_id' => 'required|exists:t_certificate,id',
            'mtc_id' => 'required|exists:t_mtc,id',
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

        unset($record['id'], $record['created_at'], $record['updated_at']);

        return response()->json(['message' => 'Chemical record created successfully!', 'data' => $record], 201);
    }

    // View all or single
    public function view_chemical(Request $request, $id = null)
    {
        if ($id) {
            $records = ChemicalRecordModel::find($id);
            if (!$records) {
                return response()->json(['message' => 'Chemical record not found.'], 404);
            }
            return response()->json($records->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $records = ChemicalRecordModel::all()->makeHidden(['id', 'created_at', 'updated_at']);
        
        return isset($records) && $records->isNotEmpty()
        ? response()->json(['Fetch data successfully!', 'data' => $records, 'count' => count($records)], 200)
        : response()->json(['Sorry, No data Available'], 400); 
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
