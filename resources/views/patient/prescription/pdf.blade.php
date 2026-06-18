<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Prescription - {{ $prescription->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 8.5in;
            margin: 0 auto;
            padding: 40px;
            background: white;
        }

        .header {
            border-bottom: 3px solid #0066cc;
            margin-bottom: 30px;
            padding-bottom: 20px;
        }

        .hospital-name {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 5px;
        }

        .hospital-info {
            font-size: 12px;
            color: #666;
        }

        .patient-doctor-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 40px;
        }

        .section {
            flex: 1;
        }

        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            color: #0066cc;
        }

        .section-content {
            font-size: 13px;
            line-height: 1.8;
        }

        .medicines-section {
            margin-bottom: 30px;
        }

        .medicines-title {
            font-size: 16px;
            font-weight: bold;
            color: #0066cc;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0066cc;
        }

        .medicine-item {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #0066cc;
        }

        .medicine-name {
            font-weight: bold;
            font-size: 14px;
            color: #000;
            margin-bottom: 8px;
        }

        .medicine-detail {
            font-size: 12px;
            margin-bottom: 4px;
            color: #555;
        }

        .notes-section {
            margin-bottom: 30px;
            padding: 15px;
            background: #f0f7ff;
            border-left: 4px solid #0066cc;
        }

        .notes-title {
            font-weight: bold;
            font-size: 14px;
            color: #0066cc;
            margin-bottom: 8px;
        }

        .notes-content {
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            white-space: pre-wrap;
        }

        .footer {
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .doctor-signature {
            text-align: center;
        }

        .signature-line {
            margin-top: 30px;
            width: 200px;
            height: 1px;
            background: #000;
        }

        .doctor-name {
            font-size: 12px;
            margin-top: 5px;
            font-weight: bold;
        }

        .issued-date {
            font-size: 12px;
            color: #666;
        }

        .prescription-id {
            font-size: 11px;
            color: #999;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 100%;
                margin: 0;
                padding: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="hospital-name">RX - PRESCRIPTION</div>
            <div class="hospital-info">Health Portal Hospital System</div>
            <div class="prescription-id">Prescription #{{ $prescription->id }} | Issued:
                {{ $prescription->issued_at?->format('M d, Y H:i') ?? 'Draft' }}</div>
        </div>

        <!-- Patient & Doctor Section -->
        <div class="patient-doctor-section">
            <div class="section">
                <div class="section-title">PATIENT INFORMATION</div>
                <div class="section-content">
                    <strong>{{ $prescription->patient->name }}</strong><br>
                    Email: {{ $prescription->patient->email }}<br>
                    @if ($prescription->patient->phone)
                        Phone: {{ $prescription->patient->phone }}<br>
                    @endif
                </div>
            </div>

            <div class="section">
                <div class="section-title">DOCTOR INFORMATION</div>
                <div class="section-content">
                    <strong>Dr. {{ $prescription->doctor->name }}</strong><br>
                    @if ($prescription->doctor->doctor)
                        Specialization:
                        {{ $prescription->doctor->doctor->specialist ?? ($prescription->doctor->doctor->qualification ?? 'N/A') }}<br>
                    @endif
                </div>
            </div>

            <div class="section">
                <div class="section-title">APPOINTMENT</div>
                <div class="section-content">
                    Date: {{ $prescription->appointmentBooking->schedule->schedule_date->format('M d, Y') }}<br>
                    Time: {{ $prescription->appointmentBooking->schedule->start_time }} -
                    {{ $prescription->appointmentBooking->schedule->end_time }}<br>
                </div>
            </div>
        </div>

        <!-- Medicines -->
        @if ($prescription->medicines && count($prescription->medicines) > 0)
            <div class="medicines-section">
                <div class="medicines-title">PRESCRIBED MEDICINES</div>
                @foreach ($prescription->medicines as $medicine)
                    <div class="medicine-item">
                        <div class="medicine-name">{{ $medicine['name'] }}</div>
                        <div class="medicine-detail"><strong>Dosage:</strong> {{ $medicine['dosage'] }}</div>
                        <div class="medicine-detail"><strong>Frequency:</strong> {{ $medicine['frequency'] }}</div>
                        <div class="medicine-detail"><strong>Duration:</strong> {{ $medicine['duration'] }}</div>
                        @if ($medicine['notes'])
                            <div class="medicine-detail"><strong>Notes:</strong> {{ $medicine['notes'] }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Doctor Notes -->
        @if ($prescription->notes)
            <div class="notes-section">
                <div class="notes-title">DOCTOR'S NOTES</div>
                <div class="notes-content">{{ $prescription->notes }}</div>
            </div>
        @endif

        <!-- Instructions -->
        @if ($prescription->instructions)
            <div class="notes-section">
                <div class="notes-title">PATIENT INSTRUCTIONS</div>
                <div class="notes-content">{{ $prescription->instructions }}</div>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <div class="issued-date">
                Issued: {{ $prescription->issued_at?->format('M d, Y H:i A') ?? 'Draft' }}
            </div>
            <div class="doctor-signature">
                <div class="signature-line"></div>
                <div class="doctor-name">Dr. {{ $prescription->doctor->name }}</div>
                <div style="font-size: 10px; color: #999; margin-top: 3px;">
                    @if ($prescription->doctor->doctor)
                        {{ $prescription->doctor->doctor->specialist ?? ($prescription->doctor->doctor->qualification ?? 'Doctor') }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>

</html>
