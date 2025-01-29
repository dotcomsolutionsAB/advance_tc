<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MTCModel;
use App\Models\MTCItemsModel;
use App\Models\CounterModel;
use App\Models\LpiModel;
use App\Models\MPEModel;

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

        unset($record['id'], $record['created_at'], $record['updated_at']);

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

        return isset($records) && $records->isNotEmpty()
        ? response()->json(['Fetch data successfully!', 'data' => $records, 'count' => count($records)], 200)
        : response()->json(['Sorry, No data Available'], 400); 
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

        unset($record['id'], $record['created_at'], $record['updated_at']);

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

        unset($item['id'], $item['created_at'], $item['updated_at']);

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

        return isset($items) && $items->isNotEmpty()
        ? response()->json(['Fetch data successfully!', 'data' => $items, 'count' => count($items)], 200)
        : response()->json(['Sorry, No data Available'], 400); 
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

        unset($item['created_at'], $item['updated_at']);

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

        unset($counter['id'], $counter['created_at'], $counter['updated_at']);

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

        return isset($counters) && $counters->isNotEmpty()
        ? response()->json(['Fetch data successfully!', 'data' => $counters, 'count' => count($counters)], 200)
        : response()->json(['Sorry, No data Available'], 400); 
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
        
        unset($counter['created_at'], $counter['updated_at']);

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

    // Create
    public function create_lpi(Request $request)
    {
        $request->validate([
            'mtc_id' => 'required|integer',
            'title' => 'required|string',
            'type' => 'required|string',
            'batch_no' => 'required|string',
            'mfg_date' => 'required|date',
            'expiry_date' => 'required|date',
        ]);

        $lpi = LpiModel::create([
            'mtc_id' => $request->input('mtc_id'),
            'title' => $request->input('title'),
            'type' => $request->input('type'),
            'batch_no' => $request->input('batch_no'),
            'mfg_date' => $request->input('mfg_date'),
            'expiry_date' => $request->input('expiry_date'),
        ]);

        unset($lpi['id'], $lpi['created_at'], $lpi['updated_at']);

        return response()->json(['message' => 'LPI created successfully!', 'data' => $lpi], 201);
    }

    // View all or single
    public function view_lpis(Request $request, $id = null)
    {
        if ($id) {
            $lpi = LpiModel::find($id);
            if (!$lpi) {
                return response()->json(['message' => 'LPI not found.'], 404);
            }
            return response()->json($lpi->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $lpis = LpiModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($lpis) && $lpis->isNotEmpty()
            ? response()->json(['Fetch data successfully!', 'data' => $lpis, 'count' => count($lpis)], 200)
            : response()->json(['Sorry, No data Available'], 400);
    }

    // Update
    public function update_lpi(Request $request, $id)
    {
        $lpi = LpiModel::find($id);
        if (!$lpi) {
            return response()->json(['message' => 'LPI not found.'], 404);
        }

        $request->validate([
            'mtc_id' => 'sometimes|integer',
            'title' => 'sometimes|string',
            'type' => 'sometimes|string',
            'batch_no' => 'sometimes|string',
            'mfg_date' => 'sometimes|date',
            'expiry_date' => 'sometimes|date',
        ]);

        $lpi->update([
            'mtc_id' => $request->input('mtc_id', $lpi->mtc_id),
            'title' => $request->input('title', $lpi->title),
            'type' => $request->input('type', $lpi->type),
            'batch_no' => $request->input('batch_no', $lpi->batch_no),
            'mfg_date' => $request->input('mfg_date', $lpi->mfg_date),
            'expiry_date' => $request->input('expiry_date', $lpi->expiry_date),
        ]);

        unset($lpi['created_at'], $lpi['updated_at']);

        return response()->json(['message' => 'LPI updated successfully!', 'data' => $lpi]);
    }

    // Delete
    public function delete_lpi($id)
    {
        $lpi = LpiModel::find($id);
        if (!$lpi) {
            return response()->json(['message' => 'LPI not found.'], 404);
        }

        $lpi->delete();

        return response()->json(['message' => 'LPI deleted successfully!']);
    }

     // Create
     public function create_mpe(Request $request)
     {
         $request->validate([
             'mtc_id' => 'required|integer|exists:t_mtc,id',
             'testing_equipment' => 'required|string',
             'magnetic_particle' => 'required|string',
             'wet_dry' => 'required|string',
             'color' => 'required|string',
             'magnetizing_process' => 'required|string',
         ]);
 
         $mpe = MPEModel::create([
             'mtc_id' => $request->input('mtc_id'),
             'testing_equipment' => $request->input('testing_equipment'),
             'magnetic_particle' => $request->input('magnetic_particle'),
             'wet_dry' => $request->input('wet_dry'),
             'color' => $request->input('color'),
             'magnetizing_process' => $request->input('magnetizing_process'),
         ]);
 
         unset($mpe['id'], $mpe['created_at'], $mpe['updated_at']);
 
         return response()->json(['message' => 'MPE created successfully!', 'data' => $mpe], 201);
     }
 
     // View all or single
     public function view_mpes(Request $request, $id = null)
     {
         if ($id) {
             $mpe = MPEModel::find($id);
             if (!$mpe) {
                 return response()->json(['message' => 'MPE not found.'], 404);
             }
             return response()->json($mpe->makeHidden(['id', 'created_at', 'updated_at']));
         }
 
         $mpes = MPEModel::all()->makeHidden(['id', 'created_at', 'updated_at']);
 
         return isset($mpes) && $mpes->isNotEmpty()
             ? response()->json(['Fetch data successfully!', 'data' => $mpes, 'count' => count($mpes)], 200)
             : response()->json(['Sorry, No data Available'], 400);
     }
 
     // Update
     public function update_mpe(Request $request, $id)
     {
         $mpe = MPEModel::find($id);
         if (!$mpe) {
             return response()->json(['message' => 'MPE not found.'], 404);
         }
 
         $request->validate([
             'mtc_id' => 'sometimes|integer|exists:t_mtc,id',
             'testing_equipment' => 'sometimes|string',
             'magnetic_particle' => 'sometimes|string',
             'wet_dry' => 'sometimes|string',
             'color' => 'sometimes|string',
             'magnetizing_process' => 'sometimes|string',
         ]);
 
         $mpe->update([
             'mtc_id' => $request->input('mtc_id', $mpe->mtc_id),
             'testing_equipment' => $request->input('testing_equipment', $mpe->testing_equipment),
             'magnetic_particle' => $request->input('magnetic_particle', $mpe->magnetic_particle),
             'wet_dry' => $request->input('wet_dry', $mpe->wet_dry),
             'color' => $request->input('color', $mpe->color),
             'magnetizing_process' => $request->input('magnetizing_process', $mpe->magnetizing_process),
         ]);
 
         unset($mpe['created_at'], $mpe['updated_at']);
 
         return response()->json(['message' => 'MPE updated successfully!', 'data' => $mpe]);
     }
 
     // Delete
     public function delete_mpe($id)
     {
        $mpe = MPEModel::find($id);
        if (!$mpe) {
            return response()->json(['message' => 'MPE not found.'], 404);
        }
 
        $mpe->delete();

        return response()->json(['message' => 'MPE deleted successfully!']);
     }
}
