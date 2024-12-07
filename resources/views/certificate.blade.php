<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            font-family: 'Cambria', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            /* font-family: 'Cooper', Arial, sans-serif; */
            font-family: 'Cooper';
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }
        .header p {
            font-family: 'Cambria';
            margin: 2px 0;
        }
        .sub-header {
            text-align: center;
            font-size: 8px;
            margin-bottom: 15px;
        }
        .content {
            font-size: 10px;
            margin: 0 10px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #7d7d7d;
            padding: 5px;
            text-align: center;
        }
        .signature-section {
            margin-top: 30px;
            text-align: center;
            font-size: 8px;
        }
        .footer {
            font-size: 6px;
            margin-top: 20px;
            text-align: center;
        }
        .certificate {
            text-align: right;
            font-size: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="header" style="margin:0px; padding:0px;">
        <h1 style="margin: 0;">ADVANCE FORGING</h1>
        <p>VILL: NORTH NIBRA, SALAP II NH 6 DIST: HOWRAH - 711403</p>
        <p>Manufacturing works: Plot No. C/30, Industrial Area, 1st Phase, Adityapur, Jamshedpur, Jharkhand</p>
    </div>

    <!-- <div class="sub-header">
        <strong>CERTIFICATE</strong><br>
        <span>(Form III-C)</span>
    </div> -->
    <div class="sub-header">
        <div style="text-align: center;">
            <strong>Form III-C</strong><br>
            <span style="font-size: 8px;">[See regulation 4(g)]</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 5px; font-size: 8px;">
            <div style="text-align: center; width: 70%;">
                <p>Certificate of Manufacture & Test of Boiler Mountings and Fittings</p>
            </div>
        </div>
    </div>

    <div class = "certificate">
        <div style="display: flex; justify-content: space-between; margin-top: 5px; font-size: 8px;">
                    <div style="width: 70%;"></div> <!-- Placeholder for spacing -->
                    <div style="width: 30%; text-align: right;">
                    <!-- <div style="text-align: right; width: 30%;"> -->
                        <p style="margin: 0;"><strong>Certificate No.:</strong> ADV/IBR/A/2296/24-25</p>
                        <p style="margin: 0;"><strong>Serial No.:</strong> F1 TO F50</p>
                    </div>
        </div>
    </div>


    @foreach ($certificates as $certificate)
        <div class="content">
            <p><strong>Certificate No.:</strong> {{ $certificate->c_no }}</p>
            <p><strong>Serial No.:</strong> {{ $certificate->serial }}</p>
            <p><strong>Quantity:</strong> {{ $certificate->quantity }} Nos</p>
            <p><strong>Name of Part:</strong> {{ $certificate->size }} {{ $certificate->material }}</p>
            <p><strong>Drawing No.:</strong> {{ $certificate->drawing_no }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Metal Temperature</th>
                    @foreach ($certificate->physical['temperature'] as $temperature)
                        <th>{{ $temperature }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>MAWP</td>
                    @foreach ($certificate->physical['pressure'] as $pressure)
                        <td>{{ $pressure }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>

        <div class="content">
            <p><strong>Raw Material Specification:</strong> {{ $certificate->raw }}</p>
            <p><strong>Authorized Signatory:</strong> {{ $certificate->auth_signatory }}</p>
        </div>

        @if (!$loop->last)
            <hr style="margin: 20px 0;">
        @endif
    @endforeach
</body>
</html>
