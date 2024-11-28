<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MTCModel;
use App\Models\MTCItemsModel;
use App\Models\CounterModels;

class MTCController extends Controller
{
    //
    // Create
    public function create_mtc(Request $request)
    {
        $request->validate([
            'customer' => 'required|integer',
            'order_no' => 'required|string',
            'order_date' => 'required|date',
            'inspection_authority' => 'required|string',
            'qap_no' => 'required|string',
            'place_of_inspection' => 'required|string',
            'qap_clause' => 'required|string',
            'certificate_no' => 'required|string',
            'certificate_date' => 'required|date',
            'edition' => 'required|string',
        ]);

        $record = MTCModel::create([
            'customer' => $request->input('customer'),
            'order_no' => $request->input('order_no'),
            'order_date' => $request->input('order_date'),
            'inspection_authority' => $request->input('inspection_authority'),
            'qap_no' => $request->input('qap_no'),
            'place_of_inspection' => $request->input('place_of_inspection'),
            'qap_clause' => $request->input('qap_clause'),
            'certificate_no' => $request->input('certificate_no'),
            'certificate_date' => $request->input('certificate_date'),
            'edition' => $request->input('edition'),
        ]);

        return response()->json(['message' => 'MTC record created successfully!', 'data' => $record], 201);
    }

    // View all or single
    public function view_mtc(Request $request, $id = null)
    {
        if ($id) {
            $record = MTCModel::find($id);
            if (!$record) {
                return response()->json(['message' => 'MTC record not found.'], 404);
            }
            return response()->json($record->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $records = MTCModel::all()->makeHidden(['id', 'created_at', 'updated_at']);
        return response()->json($records);
    }

    // Update
    public function update_mtc(Request $request, $id)
    {
        $record = MTCModel::find($id);
        if (!$record) {
            return response()->json(['message' => 'MTC record not found.'], 404);
        }

        $request->validate([
            'customer' => 'sometimes|integer',
            'order_no' => 'sometimes|string',
            'order_date' => 'sometimes|date',
            'inspection_authority' => 'sometimes|string',
            'qap_no' => 'sometimes|string',
            'place_of_inspection' => 'sometimes|string',
            'qap_clause' => 'sometimes|string',
            'certificate_no' => 'sometimes|string',
            'certificate_date' => 'sometimes|date',
            'edition' => 'sometimes|string',
        ]);

        $record->update([
            'customer' => $request->input('customer', $record->customer),
            'order_no' => $request->input('order_no', $record->order_no),
            'order_date' => $request->input('order_date', $record->order_date),
            'inspection_authority' => $request->input('inspection_authority', $record->inspection_authority),
            'qap_no' => $request->input('qap_no', $record->qap_no),
            'place_of_inspection' => $request->input('place_of_inspection', $record->place_of_inspection),
            'qap_clause' => $request->input('qap_clause', $record->qap_clause),
            'certificate_no' => $request->input('certificate_no', $record->certificate_no),
            'certificate_date' => $request->input('certificate_date', $record->certificate_date),
            'edition' => $request->input('edition', $record->edition),
        ]);

        return response()->json(['message' => 'MTC record updated successfully!', 'data' => $record]);
    }

    // Delete
    public function delete_mtc($id)
    {
        $record = MTCModel::find($id);
        if (!$record) {
            return response()->json(['message' => 'MTC record not found.'], 404);
        }

        $record->delete();

        return response()->json(['message' => 'MTC record deleted successfully!']);
    }

    // Create
    public function create_mtc_item(Request $request)
    {
        $request->validate([
            'mtc_id' => 'required|integer',
            'product' => 'required|string',
            'material_code' => 'required|string',
            'quantity' => 'required|integer',
            'heat_no' => 'required|string',
        ]);

        $item = MTCItemsModel::create([
            'mtc_id' => $request->input('mtc_id'),
            'product' => $request->input('product'),
            'material_code' => $request->input('material_code'),
            'quantity' => $request->input('quantity'),
            'heat_no' => $request->input('heat_no'),
        ]);

        return response()->json(['message' => 'Item created successfully!', 'data' => $item], 201);
    }

    // View all or single
    public function view_mtc_items(Request $request, $id = null)
    {
        if ($id) {
            $item = MTCItemsModel::find($id);
            if (!$item) {
                return response()->json(['message' => 'Item not found.'], 404);
            }
            return response()->json($item->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $items = MTCItemsModel::all()->makeHidden(['id', 'created_at', 'updated_at']);
        return response()->json($items);
    }

    // Update
    public function update_mtc_item(Request $request, $id)
    {
        $item = MTCItemsModel::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found.'], 404);
        }

        $request->validate([
            'mtc_id' => 'sometimes|integer',
            'product' => 'sometimes|string',
            'material_code' => 'sometimes|string',
            'quantity' => 'sometimes|integer',
            'heat_no' => 'sometimes|string',
        ]);

        $item->update([
            'mtc_id' => $request->input('mtc_id', $item->mtc_id),
            'product' => $request->input('product', $item->product),
            'material_code' => $request->input('material_code', $item->material_code),
            'quantity' => $request->input('quantity', $item->quantity),
            'heat_no' => $request->input('heat_no', $item->heat_no),
        ]);

        return response()->json(['message' => 'Item updated successfully!', 'data' => $item]);
    }

    // Delete
    public function delete_mtc_item($id)
    {
        $item = MTCItemsModel::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found.'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully!']);
    }

    // Create
    public function create_counter(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'series' => 'required|string',
            'value' => 'required|string',
            'prefix' => 'nullable|string',
            'suffix' => 'nullable|string',
        ]);

        $counter = CounterModel::create([
            'key' => $request->input('key'),
            'series' => $request->input('series'),
            'value' => $request->input('value'),
            'prefix' => $request->input('prefix', ''),
            'suffix' => $request->input('suffix', ''),
        ]);

        return response()->json(['message' => 'Counter created successfully!', 'data' => $counter], 201);
    }

    // View all or single
    public function view_counter(Request $request, $id = null)
    {
        if ($id) {
            $counter = CounterModel::find($id);
            if (!$counter) {
                return response()->json(['message' => 'Counter not found.'], 404);
            }
            return response()->json($counter->makeHidden(['created_at', 'updated_at']));
        }

        $counters = CounterModel::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($counters);
    }

    // Update
    public function update_counter(Request $request, $id)
    {
        $counter = CounterModel::find($id);
        if (!$counter) {
            return response()->json(['message' => 'Counter not found.'], 404);
        }

        $request->validate([
            'key' => 'sometimes|string',
            'series' => 'sometimes|string',
            'value' => 'sometimes|string',
            'prefix' => 'nullable|string',
            'suffix' => 'nullable|string',
        ]);

        $counter->update([
            'key' => $request->input('key', $counter->key),
            'series' => $request->input('series', $counter->series),
            'value' => $request->input('value', $counter->value),
            'prefix' => $request->input('prefix', $counter->prefix),
            'suffix' => $request->input('suffix', $counter->suffix),
        ]);

        return response()->json(['message' => 'Counter updated successfully!', 'data' => $counter]);
    }

    // Delete
    public function delete_counter($id)
    {
        $counter = CounterModel::find($id);
        if (!$counter) {
            return response()->json(['message' => 'Counter not found.'], 404);
        }

        $counter->delete();

        return response()->json(['message' => 'Counter deleted successfully!']);
    }
}
