<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Certificate</title>
    <style>
        body {
            font-family: 'Cambria', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            text-align: center; /* Centers text in the header and footer */
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            font-family: 'Cooper', Arial, sans-serif;
        }
        .header p {
            font-size: 8px;
            margin: 2px 0;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            font-size: 10px;
            margin: 15px 0 5px;
            text-align: center; /* Centers the section titles */
        }
        .content {
            font-size: 10px;
            margin-bottom: 10px;
            /* text-align: center; Aligns text to the middle */
            padding: 0 15px; /* Adds padding for better readability */
            float: centre;
        }
        .middle-right {
            margin: 2px 0;
        }
        .middle {
            text-align: center;
            display: inline-block;
            width: 3%; /* Adjusts width to center properly */
        }
        .right {
            text-align: right;
            display: inline-block;
            width: 2%; /* Adjust width to align next to middle */
            vertical-align: top;
        }
        .element {
            margin-top: 20px;
        }
        .element2 {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            margin: 10px 0; /* Adds spacing around the table */
        }
        table th, table td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center; /* Ensures table content is centered */
        }
        .table-container {
            text-align: center; /* Center the content inside the container */
        }
        .table-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        .signature-section {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ADVANCE FORGING</h1>
        <p>VILL: NORTH NIBRA, SALAP II NH 6 DIST: HOWRAH - 711403</p>
        <p>Manufacturing works: Plot No. C/30, Industrial Area, 1st Phase, Adityapur, Jamshedpur, Jharkhand</p>
    </div>

    <div class="col-md-12" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center; width: 100%; margin-top: 10px;">
        <!-- Middle Section -->
        <div class ="col-md-8" style="text-align: center;">
            <div class="v">
                <p style="margin: 0.2px 0;">Form III-C</p>
                <p style="margin: 0.2px 0;">[See regulation 4(g)]</p>
                <p style="margin: 0.2px 0; font-weight: bold;">Certificate of Manufacture & Test of Boiler Mountings and Fittings</p>
            </div>
        </div>
        <!-- Right Section -->
        <div class ="col-md-4" style="text-align: right;">
            <p style="margin: 0.2px 0;">Certificate No.: ABC123</p>
            <p style="margin: 0.2px 0;">Serial No. : F1 TO F50</p>
            <p style="margin: 0.2px 0;">Quantity : 50 Nos</p>
        </div>
    </div>



    <div class = "part_name">
        <p>Name of Part : <strong>80NB CARBON STEEL BLIND RAISED FACE FLANGE, FORGED TO ASTM A105 , AS PER ANSI B 16.5 , CL300 #</strong></P>
        <p style="margin: 0.2px 0;">Drawing No.: ADV/IBR/A/2296/2024</p>
        <p style="margin: 0.2px 0;">Marker's Name & Address <strong>: ADVANCE FORGING</strong></p>
        <p style="margin: 0.2px 0;">Manufacturing works : Plot No. C/30, Industrial Area, 1st Phase, Adityapur, Jamshedpur, Jharkhand</p>
        <p style="margin: 0.2px 0;">Customer Name & Address: STOCK</p>
        <p style="margin: 0.2px 0;">Design Pressure: As per IBR Reg.. 349/350 Eqn.. 91</p>
        <p style="margin: 0.2px 0;">Design temperature: As per IBR Reg.. 349/350 Eqn.. 91.</p>
    </div>
    <table>
        <thead>
            <tr>
                <th style="width:20%;">Metal Temperature (°C)</th>
                <th>250</th>
                <th>275</th>
                <th>300</th>
                <th>325</th>
                <th>350</th>
                <th>375</th>
                <th>400</th>
                <th>425</th>
                <th>450</th>
                <th>475</th>
                <th>500</th>
                <th>525</th>
                <th>550</th>
                <th>575</th>
                <th>600</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width:20%;">MAWP</td>
                <td >41.9</td>
                <td>-</td>
                <td>39.8</td>
                <td>-</td>
                <td>37.6</td>
                <td>-</td>
                <td>34.7</td>
                <td>28.8</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        </tbody>
    </table>

    <div class = "part_name">
        <p><strong>MAWP = Maximum Allowable Working Pressure in Kg./cm2
        </strong></p>
        <p style="margin: 0.2px 0;">Hydraulic Test Pressure (Kg/Cm2)<strong>: N.A.</strong></p>
        <p style="margin: 0.2px 0;">Main Dimension (in mm)(As per Annexure A) : AS PER ASME B 16.5 CL300
        </p>
        <p style="margin: 0.2px 0;">Specifications<strong>: ASTM A105</strong></p>
        <p style="margin: 0.2px 0;">Inspecting Authority Identification Marks <strong>:</strong></p>
    </div>

    <div class="table-container" style="text-align: center; margin: 20px auto; width: 80%;">
        <div class="table-title">Chemical Composition (%)</div>
            <table>
                <tr>
                    {{-- Generate column data dynamically --}}
                    @php
                        $columnsPerRow = 6; // Define the number of columns per row
                        $dataChunks = array_chunk($chemicalData, $columnsPerRow); // Break data into chunks
                    @endphp

                    @foreach ($dataChunks as $chunk)
                        <tr>
                            @foreach ($chunk as $data)
                                <td style="border: 1px solid #000; padding: 10px;">
                                    <div class="element-name" style="font-weight: bold; font-size: 12px; margin-bottom: 5px;">{{ $data[0] }}</div>
                                    <div class="element-value" style="font-size: 12px;">{{ $data[1] }}</div>
                                </td>
                            @endforeach
                            {{-- Fill remaining cells with empty placeholders if the row is not full --}}
                            @for ($i = count($chunk); $i < $columnsPerRow; $i++)
                                <td style="border: 1px solid #000; padding: 10px;">
                                    <div class="element-name" style="font-weight: bold; font-size: 12px; margin-bottom: 5px;">&nbsp;</div>
                                    <div class="element-value" style="font-size: 12px;">&nbsp;</div>
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                </tr>
            </table>
    </div>

    <!-- <div class="content">
        <p style="margin: 0.2px 0;">Physical Test Results</p>
        <p style="margin: 0.2px 0;">(i) Tensile Strength: 11 N/MM2</p>
        <p style="margin: 0.2px 0;">(ii) Transverse Bend Test: N.A.</p>
        <p style="margin: 0.2px 0;">(iii) Elongation: 12% on 50 mm GL</p>
        <p style="margin: 0.2px 0;">(iv) Yield Stress: 13 N/MM2</p>
        <p style="margin: 0.2px 0;">(v) Reduction Area: mm</p>
    </div> -->
    <div style="font-size: 10px; line-height: 1.6; text-align: left; margin-bottom: 5px;">
    <p style="margin: 0;">
        <span style="display: inline-block; width: 46%; font-weight: bold;">Physical Test Results</span>
    </p>
    <p style="margin: 0;">
        <!-- Adjust the left distance -->
        <span style="display: inline-block; width: 46%; padding-left: 10px;">(i) Tensile Strength</span>
        <span style="display: inline-block; width: 2%;">:</span>
        <span style="display: inline-block; width: 40%;">510 N/MM<sup>2</sup></span>
        <!-- Adjust the right distance -->
        <span style="display: inline-block; width: 50%; text-align: right; margin-right: 5px;">*Hardness: -2 (HBW)</span>
    </p>
</div>





    <div class="content">
        <p style="margin: 0.2px 0;">Raw Material</p>
        <p style="margin: 0.2px 0;">Process of Manufacture: pp</p>
        <p style="margin: 0.2px 0;">Size: 2</p>
        <p style="margin: 0.2px 0;">Fully killed/rimmed: jp</p>
        <p style="margin: 0.2px 0;">Test Certificate No. & Date: mj</p>
        <p style="margin: 0.2px 0;">Specification: pouy</p>
        <p style="margin: 0.2px 0;">Name of the Maker: kouytr</p>
        <p style="margin: 0.2px 0;">Heat Number: aqzdd</p>
    </div>
    
    <div style="text-align: justify; font-size: 10px; font-weight: bold; line-height: 1.6; margin: 0;">
        <p style="margin: 0.2px 0;">
            Certificate that the particulars entered herein are correct. 
        </p>
        <p style="margin: 0.2px 0;">
            The part has been designed and constructed to comply with the Indian Boiler Regulations 1950 for a maximum working pressure of ____________ kg./cm<sup>2</sup> and maximum temperature of ______ °C, and satisfactorily withstood a hydraulic test using water, kerosene, or any other suitable liquid to a pressure of ____________ kg./cm<sup>2</sup>.
        </p>
        <p style="margin: 0.2px 0;">
            This test was conducted on the __________ day of ________________ 20___ in the presence of our responsible representative whose signature is appended hereunder:
        </p>
        <p style="margin: 0.2px 0;">
            Makers Representative (Quality Control)
        </p>
    </div>

    <div class="signature-section" style="text-align: right; font-size: 10px; margin: 0; margin-bottom: 20px;">
        <div class="signature" style="margin-bottom: 0; font-weight: normal;">
            Makers
        </div>
        <div class="company-name" style="font-weight: bold; font-size: 12px;">
            ADVANCE FORGING
        </div>
    </div>

    <div class="signature-section" style="font-size: 10px; margin: 0; display: flex; justify-content: flex-start;">
        <!-- Left Side -->
        <div class="left-signature" style="text-align: left; width: 50%;">
            <div style="margin: 0;">
                <p style="margin: 0; font-weight: bold;">( Mr. S.C. CHATTERJEE )</p>
                <p style="margin: 0;">Name and Signature</p>
            </div>
            <div style="margin: 0px;">
                <p style="margin: 0;">We have satisfied ourselves and the fittings have been constructed and tested in accordance with the requirement of</p>
                <p style="margin: 0;">Indian Boiler Regulations 1950. We further certify that the particulars entered herein are correct.</p>
            </div>

            
        </div>

        <div class="signature-section" style="text-align: right; font-size: 10px; font-weight: bold; margin: 0; margin-bottom: 20px;">
            <div class="signature" style="margin-bottom: 0;">
            Name & Signature of the Inspecting Officer
            </div>
            <div class="company-name" style="font-size: 12px;">
            who witnessed the test
            </div>
        </div>
    </div>

    <div style="font-size: 10px; font-weight: bold; line-height: 1.6; text-align: left;">
        <p style="margin: 0;">Name & Signature of</p>
        <p style="margin: 0;">Competent Person</p>
        <p style="margin: 0;">who witnessed the test</p>
    </div>

    <div style="font-size: 10px; line-height: 1.6; text-align: left; margin-bottom: 10px;">
    <!-- Place and Date Section -->
    <p style="margin: 0;">
        <span style="display: inline-block; width: 50px;">Place</span>: 
        <span style="display: inline-block; width: 140px;"></span>
    </p>
    <p style="margin: 0;">
        <span style="display: inline-block; width: 50px;">Date</span>: 
        <span style="display: inline-block; width: 140px;"></span>
    </p>
</div>

    <div style="font-size: 10px; line-height: 1.6; text-align: left; margin-bottom: 10px;">
        <!-- Note Section -->
        <p style="margin: 0;">
            <span style="display: inline-block; width: 50px;">Note</span>: 
            i) Hydraulic Testing not applicable (*) for fittings & flanges
        </p>
        <p style="margin: 0;">
            <span style="display: inline-block; width: 50px;"></span>: 
            ii) Material Certificate Ref 
            <span style="font-weight: bold;">HEAT NO: A 9406</span>
        </p>
    </div>



    
</body>
</html>
