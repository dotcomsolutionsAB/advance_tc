<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;
use Exception;

class MigrateOldData extends Command
{
    protected $signature = 'migrate:old-data';
    protected $description = 'Migrate data from the old database to the new Laravel database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Old Database Credentials
        $oldDbHost = '127.0.0.1';
        $oldDbPort = '33006';
        $oldDbName = 'tc_management';
        $oldDbUsername = 'root';
        $oldDbPassword = '';

        // New Laravel Database Connection (from .env)
        $newDbConn = DB::connection()->getPdo();

        try {
            $oldConn = new PDO("mysql:host=$oldDbHost;dbname=$oldDbName", $oldDbUsername, $oldDbPassword);
            $oldConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Migrate data in the correct order
            $this->clearTables($newDbConn);
            $this->migrateMaterial($oldConn, $newDbConn);
            $this->migratePhysical($oldConn, $newDbConn);
            $this->migrateChemical($oldConn, $newDbConn);
            $this->migratePhysicalTest($oldConn, $newDbConn);
            $this->migrateProducts($oldConn, $newDbConn);
            $this->migrateCertificates($oldConn, $newDbConn);

            $oldConn = null;
            $this->info('Data migration completed successfully.');

        } catch (Exception $e) {
            $this->error('Migration failed: ' . $e->getMessage());
        }
    }

    protected function migrateMaterial($oldConn, $newDbConn)
    {
        $stmt = $oldConn->query("SELECT * FROM material");
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($materials as $material) {
            $data = [
                ':id' => $material['id'],
                ':name' => $material['name'],
                ':template' => $material['template'],
                ':temperature' => $material['temperature'],
                ':created_at' => now(),
                ':updated_at' => now()
            ];

            $insertQuery = "
                INSERT INTO material (id, name, template, temperature, created_at, updated_at)
                VALUES (:id, :name, :template, :temperature, :created_at, :updated_at)
            ";

            $newDbConn->prepare($insertQuery)->execute($data);
            $this->info("Migrated material ID: {$material['id']}");
        }
    }

    protected function migratePhysical($oldConn, $newDbConn)
    {
        // Fetch materials with physical data in JSON format
        $stmt = $oldConn->query("SELECT id, physical FROM material");
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($materials as $material) {
            $material_id = $material['id'];
            $physicalData = json_decode($material['physical'], true);
    
            // Skip if there's no physical data or if JSON is empty
            if (empty($physicalData) || !isset($physicalData['temperature']) || !isset($physicalData['pres_start'])) {
                continue;
            }
    
            // Insert each temperature, pres_start, and pres_end as individual rows
            foreach ($physicalData['temperature'] as $index => $temperature) {
                // Convert non-numeric values to NULL or default values for numeric fields
                $pressure_start = isset($physicalData['pres_start'][$index]) && is_numeric($physicalData['pres_start'][$index]) 
                    ? (float)$physicalData['pres_start'][$index] 
                    : 0.0;
                    
                $pressure_end = isset($physicalData['pres_end'][$index]) && is_numeric($physicalData['pres_end'][$index]) 
                    ? (float)$physicalData['pres_end'][$index] 
                    : 0.0;
    
                // Skip if both temperature and pressure are empty
                if (empty($temperature) && $pressure_start === 0.0 && $pressure_end === 0.0) {
                    continue;
                }
    
                // Prepare the data for insertion
                $data = [
                    ':material_id' => $material_id,
                    ':temperature' => is_numeric($temperature) ? (float)$temperature : 0.0,
                    ':pressure_start' => $pressure_start,
                    ':pressure_end' => $pressure_end,
                    ':created_at' => now(),
                    ':updated_at' => now()
                ];
    
                $insertQuery = "
                    INSERT INTO physical (material_id, temperature, pressure_start, pressure_end, created_at, updated_at)
                    VALUES (:material_id, :temperature, :pressure_start, :pressure_end, :created_at, :updated_at)
                ";
    
                try {
                    // Execute the insertion
                    $newDbConn->prepare($insertQuery)->execute($data);
                    $this->info("Migrated physical data for material ID: {$material_id} with temperature: {$temperature}");
                } catch (Exception $e) {
                    $this->error("Failed to migrate physical data for material ID: {$material_id} - " . $e->getMessage());
                }
            }
        }
    }
    


    protected function migrateChemical($oldConn, $newDbConn)
    {
        // Fetch materials with chemical data in JSON format
        $stmt = $oldConn->query("SELECT id, chemical FROM material");
        $materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($materials as $material) {
            $material_id = $material['id'];
            $chemicalData = json_decode($material['chemical'], true);
    
            // Skip if there's no chemical data or if JSON is empty
            if (empty($chemicalData) || !isset($chemicalData['chemical']) || !isset($chemicalData['start'])) {
                continue;
            }
    
            // Insert each chemical, start, and end as individual rows
            foreach ($chemicalData['chemical'] as $index => $chemical) {
                // Ensure we have numeric start and end values; default to 0.0 if invalid
                $start = isset($chemicalData['start'][$index]) && is_numeric($chemicalData['start'][$index]) 
                    ? (float)$chemicalData['start'][$index] 
                    : 0.0;
                    
                $end = isset($chemicalData['end'][$index]) && is_numeric($chemicalData['end'][$index]) 
                    ? (float)$chemicalData['end'][$index] 
                    : 0.0;
    
                // Skip if chemical name and both start and end values are empty
                if (empty($chemical) && $start === 0.0 && $end === 0.0) {
                    continue;
                }
    
                // Prepare the data for insertion
                $data = [
                    ':material_id' => $material_id,
                    ':chemical' => $chemical,
                    ':start' => $start,
                    ':end' => $end,
                    ':created_at' => now(),
                    ':updated_at' => now()
                ];
    
                $insertQuery = "
                    INSERT INTO chemical (material_id, chemical, start, end, created_at, updated_at)
                    VALUES (:material_id, :chemical, :start, :end, :created_at, :updated_at)
                ";
    
                try {
                    // Execute the insertion
                    $newDbConn->prepare($insertQuery)->execute($data);
                    $this->info("Migrated chemical data for material ID: {$material_id} with chemical: {$chemical}");
                } catch (Exception $e) {
                    $this->error("Failed to migrate chemical data for material ID: {$material_id} - " . $e->getMessage());
                }
            }
        }
    }
    



protected function migratePhysicalTest($oldConn, $newDbConn)
{
    // Fetch products with physical_test_results data in JSON format
    $stmt = $oldConn->query("SELECT id, physical_test_results FROM material");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $material_id = $product['id'];
        $testData = json_decode($product['physical_test_results'], true);

        // Skip if there's no physical test data or if JSON is empty
        if (empty($testData) || !isset($testData['name']) || !isset($testData['start']) || !isset($testData['end'])) {
            continue;
        }

        // Initialize variables for start and end values
        $elongation_start = $elongation_end = $tensile_start = $tensile_end = $yield_start = $yield_end = 0;

        // Map each test name to its corresponding start and end column
        foreach ($testData['name'] as $index => $testName) {
            $start = isset($testData['start'][$index]) ? (float)$testData['start'][$index] : 0.0;
            $end = isset($testData['end'][$index]) ? (float)$testData['end'][$index] : 0.0;

            // Assign values to the correct column based on test name
            switch (strtolower($testName)) {
                case 'tensile':
                    $tensile_start = $start;
                    $tensile_end = $end;
                    break;
                case 'elongation':
                    $elongation_start = $start;
                    $elongation_end = $end;
                    break;
                case 'yield':
                    $yield_start = $start;
                    $yield_end = $end;
                    break;
            }
        }

        // Prepare the data for insertion
        $data = [
            ':material_id' => $material_id,
            ':elongation_start' => $elongation_start,
            ':elongation_end' => $elongation_end,
            ':tensile_start' => $tensile_start,
            ':tensile_end' => $tensile_end,
            ':yield_start' => $yield_start,
            ':yield_end' => $yield_end,
            ':created_at' => now(),
            ':updated_at' => now()
        ];

        $insertQuery = "
            INSERT INTO physical_test (
                material_id, elongation_start, elongation_end, tensile_start, tensile_end,
                yield_start, yield_end, created_at, updated_at
            ) VALUES (
                :material_id, :elongation_start, :elongation_end, :tensile_start, :tensile_end,
                :yield_start, :yield_end, :created_at, :updated_at
            )
        ";

        try {
            // Execute the insertion
            $newDbConn->prepare($insertQuery)->execute($data);
            $this->info("Migrated physical test data for material ID: {$material_id}");
        } catch (Exception $e) {
            $this->error("Failed to migrate physical test data for material ID: {$material_id} - " . $e->getMessage());
        }
    }
}


protected function migrateProducts($oldConn, $newDbConn)
{
    // Fetch products from product_certificates table in the old database
    $stmt = $oldConn->query("SELECT * FROM product_certificates");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        // Get material_id using the 'type' column in the old table
        $material_id = $this->getMaterialIDByType($newDbConn, $product['type']);

        // Map old table columns to new table columns
        $data = [
            ':id' => $product['id'],  // Old product ID for reference
            ':material_id' => $material_id,
            ':alpha' => $product['alpha'],  // Same name, but changed collation
            ':name' => $product['name'],  // Added 'name' in new table
            ':print_name' => $product['printed_name'],  // Renamed from 'printed_name' to 'print_name'
            ':md_1' => $product['md1'],  // Renamed from 'md1' to 'md_1'
            ':md_2' => $product['md2'],  // Renamed from 'md2' to 'md_2'
            ':raw' => $product['raw'],  // Same name
            ':specifications' => $product['specifications'],  // Same name
            ':template' => $product['template'],  // Changed type to varchar
            ':temperature' => $product['temperature'],  // Same name
            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s')
        ];

        // Update the query to match the new table structure in `advance_tc`
        $insertQuery = "
            INSERT INTO product (id, material_id, alpha, name, print_name, md_1, md_2, raw, specifications, template, temperature, created_at, updated_at)
            VALUES (:id, :material_id, :alpha, :name, :print_name, :md_1, :md_2, :raw, :specifications, :template, :temperature, :created_at, :updated_at)
        ";

        try {
            // Execute the insertion
            $newDbConn->prepare($insertQuery)->execute($data);
            $this->info("Migrated product ID: {$product['id']}");
        } catch (Exception $e) {
            $this->error("Failed to migrate product ID: {$product['id']} - " . $e->getMessage());
        }
    }
}

// Helper function to get material_id based on 'type' from the old database
protected function getMaterialIDByType($newDbConn, $type)
{
    $stmt = $newDbConn->prepare("SELECT id FROM material WHERE id = :type LIMIT 1");
    $stmt->execute([':type' => $type]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? $result['id'] : null;
}



protected function migrateCertificates($oldConn, $newDbConn)
{
    // Fetch certificates from the old database
    $stmt = $oldConn->query("SELECT * FROM certificate");
    $certificates = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($certificates as $certificate) {
        // Retrieve the product ID based on the print name
        $product_id = $this->getProductID($newDbConn, $certificate['material']);

        // Prepare data array with proper field mappings
        $data = [
            ':id' => $certificate['id'],  // Keep old certificate ID for reference
            ':c_no' => $certificate['c_no'],
            ':product_id' => $product_id,
            ':size' => $certificate['size'],
            ':heat_no' => $certificate['hn'],  // Heat number
            ':serial' => $certificate['serial'],
            ':quantity' => (int)$certificate['quantity'],
            ':drawing_no' => $certificate['drawing_no'],
            ':customer' => $certificate['customer'],
            ':auth_signatory' => $certificate['auth_signatory'],
            ':inspect_signatory' => $certificate['inspecting'],
            ':manufacture_process' => $certificate['process_manufacture'],
            ':tcd' => $certificate['tcd'],
            ':reduction' => $certificate['reduction'],
            ':size_2' => $certificate['size2'],
            ':hardness' => $certificate['hardness'],
            ':maker_name' => $certificate['maker_name'],
            ':edited' => (int)$certificate['edited'],
            ':created_at' => date('Y-m-d H:i:s'),
            ':updated_at' => date('Y-m-d H:i:s')
        ];

        // Prepare the insert query with `notes` field excluded
        $insertQuery = "
            INSERT INTO certificate (
                id, c_no, product_id, size, heat_no, serial, quantity, drawing_no, customer,
                auth_signatory, inspect_signatory, manufacture_process, tcd, reduction,
                size_2, hardness, maker_name, edited, created_at, updated_at
            ) VALUES (
                :id, :c_no, :product_id, :size, :heat_no, :serial, :quantity, :drawing_no,
                :customer, :auth_signatory, :inspect_signatory, :manufacture_process, :tcd,
                :reduction, :size_2, :hardness, :maker_name, :edited, :created_at, :updated_at
            )
        ";

        try {
            // Execute the insertion
            $newDbConn->prepare($insertQuery)->execute($data);
            $this->info("Migrated certificate ID: {$certificate['id']}");
        } catch (Exception $e) {
            $this->error("Failed to migrate certificate ID: {$certificate['id']} - " . $e->getMessage());
        }
    }
}

// Helper function to get product_id based on 'print_name' from the old database
protected function getProductID($newDbConn, $print_name)
{
    $stmt = $newDbConn->prepare("SELECT id FROM product WHERE print_name = :print_name LIMIT 1");
    $stmt->execute([':print_name' => $print_name]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result ? (int)$result['id'] : null; // Return NULL if no match is found
}



    protected function getMaterialID($newDbConn, $materialName)
    {
        $stmt = $newDbConn->prepare("SELECT id FROM material WHERE name = :name");
        $stmt->execute([':name' => $materialName]);
        return $stmt->fetchColumn();
    }

  
    protected function clearTables($newDbConn)
{
    try {
        $newDbConn->exec("SET FOREIGN_KEY_CHECKS=0");  // Disable foreign key checks
        $newDbConn->exec("TRUNCATE TABLE material");
        $newDbConn->exec("TRUNCATE TABLE chemical");
        $newDbConn->exec("TRUNCATE TABLE physical");
        $newDbConn->exec("TRUNCATE TABLE physical_test");
        $newDbConn->exec("TRUNCATE TABLE product");
        $newDbConn->exec("TRUNCATE TABLE certificate");
        $newDbConn->exec("SET FOREIGN_KEY_CHECKS=1");  // Enable foreign key checks
        $this->info("Tables cleared successfully.");
    } catch (Exception $e) {
        $this->error("Failed to clear tables: " . $e->getMessage());
    }
}

// Call this function at the start of your migration script


}
