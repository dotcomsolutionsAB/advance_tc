<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TestCertificateController extends Controller
{
    //
    public function generateCertificate($ids = null)
    {
        // // Split the IDs and fetch data for each
        // $idArray = explode(',', $ids);
        // Use static values for testing
        // $idArray = [1]; // Replace these with the IDs you want to test
        // $certificates = DB::table('t_certificate')->whereIn('id', $idArray)->get();

        // // Decode any JSON data in the database fields
        // $certificates->transform(function ($certificate) {
        //     $certificate->physical = json_decode($certificate->physical, true);
        //     $certificate->chemical = json_decode($certificate->chemical, true);
        //     $certificate->lines = json_decode($certificate->lines, true);
        //     return $certificate;
        // });

         // Static data for testing
        //  $certificates = collect([
        //     (object)[
        //         'id' => 1,
        //         'c_no' => 'CERT-001',
        //         'serial' => 'SER-123',
        //         'quantity' => 5,
        //         'size' => '20mm',
        //         'material' => 'Steel',
        //         'drawing_no' => 'DRAW-001',
        //         'md1' => '100',
        //         'md2' => '200',
        //         'tensile' => '450',
        //         'elongation' => '12',
        //         'yield' => '350',
        //         'raw' => 'Raw Material 1',
        //         'hn' => 'HN-001',
        //         'auth_signatory' => 'John Doe',
        //         'inspecting' => 'Inspector Smith',
        //         'physical' => [
        //             'pressure' => [10, 20, 30, 40],
        //             'temperature' => [100, 200, 300, 400],
        //         ],
        //         'chemical' => [
        //             'chemical' => ['C', 'Mn', 'Si', 'P', 'S', 'Ni', 'Cr', 'Mo', 'Cu', 'Co', 'Al', 'V'],
        //             'value' => [0.12, 1.5, 0.3, 0.025, 0.015, 0.5, 0.7, 0.1, 0.3, 0.05, 0.02, 0.01],
        //         ],
        //         'lines' => [
        //             'Test passed successfully.',
        //             'Meets all dimensional criteria.',
        //             'Verified with reference standards.',
        //             'Approved for further processing.',
        //         ],
        //     ]
        // ]);

        $certificates = collect([
            (object)[
                'id' => 1,
                'c_no' => 'CERT-001',
                'serial' => 'SER-123',
                'quantity' => 5,
                'size' => '20mm',
                'material' => 'Steel',
                'drawing_no' => 'DRAW-001',
                'md1' => '100',
                'md2' => '200',
                'tensile' => '450',
                'elongation' => '12',
                'yield' => '350',
                'raw' => 'Raw Material 1',
                'fk' => 'Fully Killed',
                'sp' => 'Specification A',
                'sp2' => 'Additional Specifications',
                'hn' => 'HN-001',
                'auth_signatory' => 'John Doe',
                'inspecting' => 'Inspector Smith',
                'physical' => [
                    'pressure' => [10, 20, 30, 40],
                    'temperature' => [100, 200, 300, 400],
                ],
                'chemical' => [
                    'chemical' => ['C', 'Mn', 'Si', 'P', 'S', 'Ni', 'Cr', 'Mo', 'Cu', 'Co', 'Al', 'V'],
                    'value' => [0.12, 1.5, 0.3, 0.025, 0.015, 0.5, 0.7, 0.1, 0.3, 0.05, 0.02, 0.01],
                ],
                'lines' => [
                    'Test passed successfully.',
                    'Meets all dimensional criteria.',
                    'Verified with reference standards.',
                    'Approved for further processing.',
                ],
            ],
            (object)[
                'id' => 2,
                'c_no' => 'CERT-002',
                'serial' => 'SER-456',
                'quantity' => 10,
                'size' => '30mm',
                'material' => 'Aluminum',
                'drawing_no' => 'DRAW-002',
                'md1' => '150',
                'md2' => '300',
                'tensile' => '400',
                'elongation' => '15',
                'yield' => '300',
                'raw' => 'Raw Material 2',
                'fk' => 'Semi Killed',
                'sp' => 'Specification B',
                'sp2' => 'Additional Specifications B',
                'hn' => 'HN-002',
                'auth_signatory' => 'Jane Doe',
                'inspecting' => 'Inspector Johnson',
                'physical' => [
                    'pressure' => [15, 25, 35, 45],
                    'temperature' => [150, 250, 350, 450],
                ],
                'chemical' => [
                    'chemical' => ['C', 'Mn', 'Si', 'P', 'S', 'Ni', 'Cr', 'Mo', 'Cu', 'Co', 'Al', 'V'],
                    'value' => [0.1, 1.4, 0.25, 0.02, 0.01, 0.45, 0.65, 0.09, 0.25, 0.045, 0.018, 0.008],
                ],
                'lines' => [
                    'Test passed successfully.',
                    'Meets all dimensional criteria.',
                    'Verified with reference standards.',
                    'Approved for further processing.',
                ],
            ],
        ]);

        // // Load the Blade view as HTML
        // $mpdf = new Mpdf();

        // $html = view('certificate', ['certificates' => $certificates])->render();

        // $mpdf->WriteHTML($html);

        // // Initialize mPDF
        // $mpdf = new Mpdf([
        //     'format' => 'A4',
        //     'margin_left' => 10,
        //     'margin_right' => 10,
        //     'margin_top' => 8,
        //     'margin_bottom' => 10,
        // ]);

        // // Write the HTML to the PDF
        // $mpdf->WriteHTML($html);

        // // Output the PDF inline (or save it if needed)
        // $name = "certificate_" . time() . ".pdf";
        // return $mpdf->Output($name, 'I');

        // Render the Blade template into HTML
        $html = View::make('2_cer', compact('certificates'))->render();

        // Initialize Mpdf
        $mpdf = new Mpdf([
            'format' => 'A4',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
        ]);

        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output PDF inline
        $mpdf->Output('certificate.pdf', 'I');
    }
}
