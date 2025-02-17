<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\MaterialModel;
use App\Models\PhysicalModel;
use App\Models\ChemicalModel;
use App\Models\PhysicalTestModel;
use App\Models\PipeDataModel;
use App\Models\DimensionalModel;

class ProductController extends Controller
{
    //
    // Create
    public function create_product(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:t_material,id', // Foreign key validation
            'alpha' => 'required|string',
            'name' => 'required|string',
            'print_name' => 'required|string',
            'md_1' => 'nullable|string',
            'md_2' => 'nullable|string',
            'raw' => 'nullable|string',
            'specifications' => 'nullable|string',
            'template' => 'nullable|string',
            'temperature' => 'nullable|string',
        ]);

        $product = ProductModel::create([
            'material_id' => $request->input('material_id'),
            'alpha' => $request->input('alpha'),
            'name' => $request->input('name'),
            'print_name' => $request->input('print_name'),
            'md_1' => $request->input('md_1', ''),
            'md_2' => $request->input('md_2', ''),
            'raw' => $request->input('raw', ''),
            'specifications' => $request->input('specifications', ''),
            'template' => $request->input('template', ''),
            'temperature' => $request->input('temperature', ''),
        ]);

        unset($product['id'], $product['created_at'], $product['updated_at']);

        return response()->json(['message' => 'Product created successfully!', 'data' => $product], 201);
    }

    // View all or single
    public function view_products(Request $request, $id = null)
    {
        if ($id) {
            $product = ProductModel::find($id);
            if (!$product) {
                return response()->json(['message' => 'Product not found.'], 404);
            }
            return response()->json($product->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $products = ProductModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($products) && $products->isNotEmpty()
            ? response()->json(['Fetch data successfully!', 'data' => $products, 'count' => count($products)], 200)
            : response()->json(['Sorry, No data Available'], 400);
    }

    // Update
    public function update_product(Request $request, $id)
    {
        $product = ProductModel::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $request->validate([
            'material_id' => 'sometimes|exists:t_material,id', // Validate only if provided
            'alpha' => 'sometimes|string',
            'name' => 'sometimes|string',
            'print_name' => 'sometimes|string',
            'md_1' => 'nullable|string',
            'md_2' => 'nullable|string',
            'raw' => 'nullable|string',
            'specifications' => 'nullable|string',
            'template' => 'nullable|string',
            'temperature' => 'nullable|string',
        ]);

        $product->update([
            'material_id' => $request->input('material_id', $product->material_id),
            'alpha' => $request->input('alpha', $product->alpha),
            'name' => $request->input('name', $product->name),
            'print_name' => $request->input('print_name', $product->print_name),
            'md_1' => $request->input('md_1', $product->md_1),
            'md_2' => $request->input('md_2', $product->md_2),
            'raw' => $request->input('raw', $product->raw),
            'specifications' => $request->input('specifications', $product->specifications),
            'template' => $request->input('template', $product->template),
            'temperature' => $request->input('temperature', $product->temperature),
        ]);

        unset($product['created_at'], $product['updated_at']);

        return response()->json(['message' => 'Product updated successfully!', 'data' => $product]);
    }

    // Delete
    public function delete_product($id)
    {
        $product = ProductModel::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully!']);
    }

    // Create
    public function create_material(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'template' => 'required|string',
            'temperature' => 'nullable|string',
        ]);

        $material = MaterialModel::create([
            'name' => $request->input('name'),
            'template' => $request->input('template'),
            'temperature' => $request->input('temperature', ''),
        ]);

        unset($material['id'], $material['created_at'], $material['updated_at']);

        return response()->json(['message' => 'Material created successfully!', 'data' => $material], 201);
    }

    // View all or single
    public function view_materials(Request $request, $id = null)
    {
        if ($id) {
            $material = MaterialModel::find($id);
            if (!$material) {
                return response()->json(['message' => 'Material not found.'], 404);
            }
            return response()->json($material->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $materials = MaterialModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($materials) && $materials->isNotEmpty()
            ? response()->json(['Fetch data successfully!', 'data' => $materials, 'count' => count($materials)], 200)
            : response()->json(['Sorry, No data Available'], 400);
    }

    // Update
    public function update_material(Request $request, $id)
    {
        $material = MaterialModel::find($id);
        if (!$material) {
            return response()->json(['message' => 'Material not found.'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string',
            'template' => 'sometimes|string',
            'temperature' => 'nullable|string',
        ]);

        $material->update([
            'name' => $request->input('name', $material->name),
            'template' => $request->input('template', $material->template),
            'temperature' => $request->input('temperature', $material->temperature),
        ]);

        unset($material['created_at'], $material['updated_at']);

        return response()->json(['message' => 'Material updated successfully!', 'data' => $material]);
    }

    // Delete
    public function delete_material($id)
    {
        $material = MaterialModel::find($id);
        if (!$material) {
            return response()->json(['message' => 'Material not found.'], 404);
        }

        $material->delete();

        return response()->json(['message' => 'Material deleted successfully!']);
    }

    // Create
    public function create_physical(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:t_material,id', // Ensure material_id exists in materials table
            'temperature' => 'required|numeric',
            'pressure_start' => 'required|numeric',
            'pressure_end' => 'required|numeric',
        ]);

        $physical = PhysicalModel::create([
            'material_id' => $request->input('material_id'),
            'temperature' => $request->input('temperature'),
            'pressure_start' => $request->input('pressure_start'),
            'pressure_end' => $request->input('pressure_end'),
        ]);

        unset($physical['id'], $physical['created_at'], $physical['updated_at']);

        return response()->json(['message' => 'Physical record created successfully!', 'data' => $physical], 201);
    }
 
    // View all or single
    public function view_physical(Request $request, $id = null)
    {
        if ($id) {
            $physical = PhysicalModel::find($id);
            if (!$physical) {
                return response()->json(['message' => 'Physical record not found.'], 404);
            }
            return response()->json($physical->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $physicals = PhysicalModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($physicals) && $physicals->isNotEmpty()
            ? response()->json(['Fetch data successfully!', 'data' => $physicals, 'count' => count($physicals)], 200)
            : response()->json(['Sorry, No data Available'], 400);
    }
 
    // Update
    public function update_physical(Request $request, $id)
    {
    $physical = PhysicalModel::find($id);
    if (!$physical) {
        return response()->json(['message' => 'Physical record not found.'], 404);
    }

    $request->validate([
        'material_id' => 'sometimes|exists:t_material,id',
        'temperature' => 'sometimes|numeric',
        'pressure_start' => 'sometimes|numeric',
        'pressure_end' => 'sometimes|numeric',
    ]);

    $physical->update([
        'material_id' => $request->input('material_id', $physical->material_id),
        'temperature' => $request->input('temperature', $physical->temperature),
        'pressure_start' => $request->input('pressure_start', $physical->pressure_start),
        'pressure_end' => $request->input('pressure_end', $physical->pressure_end),
    ]);

    unset($physical['created_at'], $physical['updated_at']);

    return response()->json(['message' => 'Physical record updated successfully!', 'data' => $physical]);
    }
 
    // Delete
    public function delete_physical($id)
    {
        $physical = PhysicalModel::find($id);
        if (!$physical) {
            return response()->json(['message' => 'Physical record not found.'], 404);
        }

        $physical->delete();

        return response()->json(['message' => 'Physical record deleted successfully!']);
    }
 
    // Create
    public function create_chemical(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:t_material,id', // Ensure material_id exists in materials table
            'chemical' => 'required|string',
            'start' => 'required|numeric',
            'end' => 'required|numeric',
        ]);

        $chemical = ChemicalModel::create([
            'material_id' => $request->input('material_id'),
            'chemical' => $request->input('chemical'),
            'start' => $request->input('start'),
            'end' => $request->input('end'),
        ]);

        unset($chemical['id'], $chemical['created_at'], $chemical['updated_at']);

        return response()->json(['message' => 'Chemical record created successfully!', 'data' => $chemical], 201);
    }

    // View all or single
    public function view_chemicals(Request $request, $id = null)
    {
        if ($id) {
            $chemical = ChemicalModel::find($id);
            if (!$chemical) {
                return response()->json(['message' => 'Chemical record not found.'], 404);
            }
            return response()->json($chemical->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $chemicals = ChemicalModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($chemicals) && $chemicals->isNotEmpty()
            ? response()->json(['Fetch data successfully!', 'data' => $chemicals, 'count' => count($chemicals)], 200)
            : response()->json(['Sorry, No data Available'], 400);
    }

    // Update
    public function update_chemical(Request $request, $id)
    {
        $chemical = ChemicalModel::find($id);
        if (!$chemical) {
            return response()->json(['message' => 'Chemical record not found.'], 404);
        }

        $request->validate([
            'material_id' => 'sometimes|exists:t_material,id',
            'chemical' => 'sometimes|string',
            'start' => 'sometimes|numeric',
            'end' => 'sometimes|numeric',
        ]);

        $chemical->update([
            'material_id' => $request->input('material_id', $chemical->material_id),
            'chemical' => $request->input('chemical', $chemical->chemical),
            'start' => $request->input('start', $chemical->start),
            'end' => $request->input('end', $chemical->end),
        ]);

        unset($chemical['created_at'], $chemical['updated_at']);

        return response()->json(['message' => 'Chemical record updated successfully!', 'data' => $chemical]);
    }

    // Delete
    public function delete_chemical($id)
    {
        $chemical = ChemicalModel::find($id);
        if (!$chemical) {
            return response()->json(['message' => 'Chemical record not found.'], 404);
        }

        $chemical->delete();

        return response()->json(['message' => 'Chemical record deleted successfully!']);
    }

    // Create
    public function create_physical_test(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:t_material,id', // Ensure material_id exists in materials table
            'elongation_start' => 'required|numeric',
            'elongation_end' => 'required|numeric',
            'tensile_start' => 'required|numeric',
            'tensile_end' => 'required|numeric',
            'yield_start' => 'required|numeric',
            'yield_end' => 'required|numeric',
        ]);

        $physicalTest = PhysicalTestModel::create([
            'material_id' => $request->input('material_id'),
            'elongation_start' => $request->input('elongation_start'),
            'elongation_end' => $request->input('elongation_end'),
            'tensile_start' => $request->input('tensile_start'),
            'tensile_end' => $request->input('tensile_end'),
            'yield_start' => $request->input('yield_start'),
            'yield_end' => $request->input('yield_end'),
        ]);

        unset($physicalTest['id'], $physicalTest['created_at'], $physicalTest['updated_at']);

        return response()->json(['message' => 'Physical Test record created successfully!', 'data' => $physicalTest], 201);
    }

    // View all or single
    public function view_physical_tests(Request $request, $id = null)
    {
        if ($id) {
            $physicalTest = PhysicalTestModel::find($id);
            if (!$physicalTest) {
                return response()->json(['message' => 'Physical Test record not found.'], 404);
            }
            return response()->json($physicalTest->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $physicalTests = PhysicalTestModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($physicalTests) && $physicalTests->isNotEmpty()
            ? response()->json(['Fetch data successfully!', 'data' => $physicalTests, 'count' => count($physicalTests)], 200)
            : response()->json(['Sorry, No data Available'], 400);
    }

    // Update
    public function update_physical_test(Request $request, $id)
    {
        $physicalTest = PhysicalTestModel::find($id);
        if (!$physicalTest) {
            return response()->json(['message' => 'Physical Test record not found.'], 404);
        }

        $request->validate([
            'material_id' => 'sometimes|exists:t_material,id',
            'elongation_start' => 'sometimes|numeric',
            'elongation_end' => 'sometimes|numeric',
            'tensile_start' => 'sometimes|numeric',
            'tensile_end' => 'sometimes|numeric',
            'yield_start' => 'sometimes|numeric',
            'yield_end' => 'sometimes|numeric',
        ]);

        $physicalTest->update([
            'material_id' => $request->input('material_id', $physicalTest->material_id),
            'elongation_start' => $request->input('elongation_start', $physicalTest->elongation_start),
            'elongation_end' => $request->input('elongation_end', $physicalTest->elongation_end),
            'tensile_start' => $request->input('tensile_start', $physicalTest->tensile_start),
            'tensile_end' => $request->input('tensile_end', $physicalTest->tensile_end),
            'yield_start' => $request->input('yield_start', $physicalTest->yield_start),
            'yield_end' => $request->input('yield_end', $physicalTest->yield_end),
        ]);

        unset($physicalTest['created_at'], $physicalTest['updated_at']);

        return response()->json(['message' => 'Physical Test record updated successfully!', 'data' => $physicalTest]);
    }

    // Delete
    public function delete_physical_test($id)
    {
        $physicalTest = PhysicalTestModel::find($id);
        if (!$physicalTest) {
            return response()->json(['message' => 'Physical Test record not found.'], 404);
        }

        $physicalTest->delete();

        return response()->json(['message' => 'Physical Test record deleted successfully!']);
    }

    // Create
    public function create_pipe_data(Request $request)
    {
        $request->validate([
            'name' => 'required|integer',
            'type' => 'required|in:reducer,tee,elbow,flange',
            'size' => 'required|string',
            'od_target_end' => 'required|string',
            'od_small_end' => 'required|string',
            'thickness' => 'required|string',
            'end_to_end_length' => 'required|string',
            'od' => 'required|string',
            'thk' => 'required|string',
            'center_to_end' => 'required|string',
            'outside_diameter' => 'required|string',
            'run' => 'required|string',
            'outlet' => 'required|string',
        ]);

        $pipe = PipeDataModel::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'size' => $request->input('size'),
            'od_target_end' => $request->input('od_target_end'),
            'od_small_end' => $request->input('od_small_end'),
            'thickness' => $request->input('thickness'),
            'end_to_end_length' => $request->input('end_to_end_length'),
            'od' => $request->input('od'),
            'thk' => $request->input('thk'),
            'center_to_end' => $request->input('center_to_end'),
            'outside_diameter' => $request->input('outside_diameter'),
            'run' => $request->input('run'),
            'outlet' => $request->input('outlet'),
        ]);

        unset($pipe['id'], $pipe['created_at'], $pipe['updated_at']);

        return response()->json(['message' => 'Pipe data created successfully!', 'data' => $pipe], 201);
    }

    // View all or single
    public function view_pipe_data($id = null)
    {
        if ($id) {
            $pipe = PipeDataModel::find($id);
            if (!$pipe) {
                return response()->json(['message' => 'Pipe data not found.'], 404);
            }
            return response()->json($pipe->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $pipes = PipeDataModel::all()->makeHidden(['id', 'created_at', 'updated_at']);

        return isset($pipes) && $pipes->isNotEmpty()
        ? response()->json(['Fetch data successfully!', 'data' => $pipes, 'count' => count($pipes)], 200)
        : response()->json(['Sorry, No data Available'], 400);
    }

    // Update
    public function update_pipe_data(Request $request, $id)
    {
        $pipe = PipeDataModel::find($id);
        if (!$pipe) {
            return response()->json(['message' => 'Pipe data not found.'], 404);
        }

        $request->validate([
            'name' => 'sometimes|integer',
            'type' => 'sometimes|in:reducer,tee,elbow,flange',
            'size' => 'sometimes|string',
            'od_target_end' => 'sometimes|string',
            'od_small_end' => 'sometimes|string',
            'thickness' => 'sometimes|string',
            'end_to_end_length' => 'sometimes|string',
            'od' => 'sometimes|string',
            'thk' => 'sometimes|string',
            'center_to_end' => 'sometimes|string',
            'outside_diameter' => 'sometimes|string',
            'run' => 'sometimes|string',
            'outlet' => 'sometimes|string',
        ]);

        $pipe->update([
            'name' => $request->input('name', $pipe->name), // Fallback to existing value
            'type' => $request->input('type', $pipe->type), // Fallback to existing value
            'size' => $request->input('size', $pipe->size),
            'od_target_end' => $request->input('od_target_end', $pipe->od_target_end),
            'od_small_end' => $request->input('od_small_end', $pipe->od_small_end),
            'thickness' => $request->input('thickness', $pipe->thickness),
            'end_to_end_length' => $request->input('end_to_end_length', $pipe->end_to_end_length),
            'od' => $request->input('od', $pipe->od),
            'thk' => $request->input('thk', $pipe->thk),
            'center_to_end' => $request->input('center_to_end', $pipe->center_to_end),
            'outside_diameter' => $request->input('outside_diameter', $pipe->outside_diameter),
            'run' => $request->input('run', $pipe->run),
            'outlet' => $request->input('outlet', $pipe->outlet),
        ]);

        unset($pipe['created_at'], $pipe['updated_at']);

        return response()->json(['message' => 'Pipe data updated successfully!', 'data' => $pipe]);
    }

    // Delete
    public function delete_pipe_data($id)
    {
        $pipe = PipeDataModel::find($id);
        if (!$pipe) {
            return response()->json(['message' => 'Pipe data not found.'], 404);
        }

        $pipe->delete();

        return response()->json(['message' => 'Pipe data deleted successfully!']);
    }

    // Create
    public function create_dimensional(Request $request)
    {
        $request->validate([
            'mtc_id' => 'required|exists:t_mtc,id',
            'mtc_items_id' => 'required|exists:t_mtc_items,id',
            'qty_checked' => 'required|string',
            'type' => 'required|in:reducer,tee,elbow,flange',
            'od_target_end' => 'required|string',
            'od_small_end' => 'required|string',
            'thickness' => 'required|string',
            'end_to_end_length' => 'required|string',
            'od' => 'required|string',
            'thk' => 'required|string',
            'center_to_end' => 'required|string',
            'outside_diameter' => 'required|string',
            'run' => 'required|string',
            'outlet' => 'required|string',
        ]);

        $dimensional = DimensionalModel::create([
            'mtc_id' => $request->input('mtc_id'),
            'mtc_items_id' => $request->input('mtc_items_id'),
            'qty_checked' => $request->input('qty_checked'),
            'type' => $request->input('type'),
            'od_target_end' => $request->input('od_target_end'),
            'od_small_end' => $request->input('od_small_end'),
            'thickness' => $request->input('thickness'),
            'end_to_end_length' => $request->input('end_to_end_length'),
            'od' => $request->input('od'),
            'thk' => $request->input('thk'),
            'center_to_end' => $request->input('center_to_end'),
            'outside_diameter' => $request->input('outside_diameter'),
            'run' => $request->input('run'),
            'outlet' => $request->input('outlet'),
        ]);

        unset($dimensional['id'], $dimensional['created_at'], $dimensional['updated_at']);

        return response()->json(['message' => 'Dimensional data created successfully!', 'data' => $dimensional], 201);
    }

    // View all or single
    public function view_dimensionals($id = null)
    {
        if ($id) {
            $dimensional = DimensionalModel::find($id);
            if (!$dimensional) {
                return response()->json(['message' => 'Dimensional data not found.'], 404);
            }
            return response()->json($dimensional->makeHidden(['id', 'created_at', 'updated_at']));
        }

        $dimensionals = DimensionalModel::all()->makeHidden(['id', 'created_at', 'updated_at']);
        
        return isset($dimensionals) && $dimensionals->isNotEmpty()
        ? response()->json(['Fetch data successfully!', 'data' => $dimensionals, 'count' => count($dimensionals)], 200)
        : response()->json(['Sorry, No data Available'], 400);
    }

    // Update
    public function update_dimensional(Request $request, $id)
    {
        $dimensional = DimensionalModel::find($id);
        if (!$dimensional) {
            return response()->json(['message' => 'Dimensional data not found.'], 404);
        }

        $request->validate([
            'mtc_id' => 'sometimes|exists:t_mtc,id',
            'mtc_items_id' => 'sometimes|exists:t_mtc_items,id',
            'qty_checked' => 'sometimes|string',
            'type' => 'sometimes|in:reducer,tee,elbow,flange',
            'od_target_end' => 'sometimes|string',
            'od_small_end' => 'sometimes|string',
            'thickness' => 'sometimes|string',
            'end_to_end_length' => 'sometimes|string',
            'od' => 'sometimes|string',
            'thk' => 'sometimes|string',
            'center_to_end' => 'sometimes|string',
            'outside_diameter' => 'sometimes|string',
            'run' => 'sometimes|string',
            'outlet' => 'sometimes|string',
        ]);

        $dimensional->update([
            'mtc_id' => $request->input('mtc_id', $dimensional->mtc_id),
            'mtc_items_id' => $request->input('mtc_items_id', $dimensional->mtc_items_id),
            'qty_checked' => $request->input('qty_checked', $dimensional->qty_checked),
            'type' => $request->input('type', $dimensional->type),
            'od_target_end' => $request->input('od_target_end', $dimensional->od_target_end),
            'od_small_end' => $request->input('od_small_end', $dimensional->od_small_end),
            'thickness' => $request->input('thickness', $dimensional->thickness),
            'end_to_end_length' => $request->input('end_to_end_length', $dimensional->end_to_end_length),
            'od' => $request->input('od', $dimensional->od),
            'thk' => $request->input('thk', $dimensional->thk),
            'center_to_end' => $request->input('center_to_end', $dimensional->center_to_end),
            'outside_diameter' => $request->input('outside_diameter', $dimensional->outside_diameter),
            'run' => $request->input('run', $dimensional->run),
            'outlet' => $request->input('outlet', $dimensional->outlet),
        ]);

        unset($dimensional['created_at'], $dimensional['updated_at']);

        return response()->json(['message' => 'Dimensional data updated successfully!', 'data' => $dimensional]);
    }

    // Delete
    public function delete_dimensional($id)
    {
        $dimensional = DimensionalModel::find($id);
        if (!$dimensional) {
            return response()->json(['message' => 'Dimensional data not found.'], 404);
        }

        $dimensional->delete();

        return response()->json(['message' => 'Dimensional data deleted successfully!']);
    }

    public function migrate_material()
    {
        die("Working");
    }
}
