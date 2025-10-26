@php
    $formattedDate = optional($birthCertificate->date_of_birth)->format('F d, Y');
    $formattedTime = $birthCertificate->time_of_birth ? \Carbon\Carbon::parse($birthCertificate->time_of_birth)->format('h:i A') : null;
    $motherDob = optional($birthCertificate->mother_date_of_birth)->format('F d, Y');
    $fatherDob = optional($birthCertificate->father_date_of_birth)->format('F d, Y');
    $marriageDate = optional($birthCertificate->parents_marriage_date)->format('F d, Y');
    $registeredDate = optional($birthCertificate->date_registered)->format('F d, Y');
@endphp

<div class="birth-certificate-print">
    <style>
        .birth-certificate-print {
            font-family: 'Times New Roman', serif;
            color: #000;
        }
        .birth-certificate-print .certificate-container {
            border: 2px solid #000;
            padding: 1.5rem;
            background-color: #fff;
        }
        .birth-certificate-print .certificate-header {
            text-align: center;
            margin-bottom: 1rem;
        }
        .birth-certificate-print .certificate-header h2,
        .birth-certificate-print .certificate-header h3,
        .birth-certificate-print .certificate-header h4 {
            margin: 0;
            text-transform: uppercase;
        }
        .birth-certificate-print .certificate-grid {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        .birth-certificate-print .certificate-grid th,
        .birth-certificate-print .certificate-grid td {
            border: 1px solid #000;
            padding: 0.35rem 0.5rem;
            vertical-align: top;
        }
        .birth-certificate-print .section-title {
            background: #f2f2f2;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .birth-certificate-print .field-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
        }
        .birth-certificate-print .field-value {
            font-size: 0.9rem;
        }
        .birth-certificate-print .signature-row td {
            height: 4rem;
        }
        .birth-certificate-print .signature-placeholder {
            border-bottom: 1px solid #000;
            height: 2rem;
            margin-bottom: 0.5rem;
        }
        @media print {
            body {
                background: #fff;
            }
            .birth-certificate-print .certificate-container {
                box-shadow: none;
                border-width: 1px;
            }
        }
    </style>

    <div class="certificate-container">
        <div class="certificate-header">
            <h4>Republic of the Philippines</h4>
            <h4>Philippine Statistics Authority</h4>
            <h3>Office of the Civil Registrar General</h3>
            <h2>Certificate of Live Birth</h2>
            <div style="margin-top: 0.5rem; font-size: 0.85rem;">
                <span><strong>Registry No.:</strong> {{ $birthCertificate->registry_number ?? '______________' }}</span>
                <span style="margin-left: 1.5rem;"><strong>Status:</strong> {{ strtoupper($birthCertificate->status) }}</span>
            </div>
        </div>

        <table class="certificate-grid">
            <tr class="section-title">
                <td colspan="4">Child Information</td>
            </tr>
            <tr>
                <td width="25%">
                    <div class="field-label">Name (First)</div>
                    <div class="field-value">{{ $birthCertificate->child_first_name }}</div>
                </td>
                <td width="25%">
                    <div class="field-label">Name (Middle)</div>
                    <div class="field-value">{{ $birthCertificate->child_middle_name ?? 'N/A' }}</div>
                </td>
                <td width="25%">
                    <div class="field-label">Name (Last)</div>
                    <div class="field-value">{{ $birthCertificate->child_last_name }}</div>
                </td>
                <td width="25%">
                    <div class="field-label">Sex</div>
                    <div class="field-value">{{ $birthCertificate->child_sex }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Date of Birth</div>
                    <div class="field-value">{{ $formattedDate }}</div>
                </td>
                <td>
                    <div class="field-label">Time of Birth</div>
                    <div class="field-value">{{ $formattedTime ?? 'N/A' }}</div>
                </td>
                <td colspan="2">
                    <div class="field-label">Place of Birth</div>
                    <div class="field-value">{{ $birthCertificate->place_of_birth }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Type of Birth</div>
                    <div class="field-value">{{ $birthCertificate->type_of_birth }}</div>
                </td>
                <td>
                    <div class="field-label">Birth Order</div>
                    <div class="field-value">{{ $birthCertificate->birth_order ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Weight at Birth (kg)</div>
                    <div class="field-value">{{ $birthCertificate->birth_weight ? number_format($birthCertificate->birth_weight, 2) : 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Length at Birth (cm)</div>
                    <div class="field-value">{{ $birthCertificate->birth_length ?? 'N/A' }}</div>
                </td>
            </tr>

            <tr class="section-title">
                <td colspan="4">Mother Information</td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Name (First)</div>
                    <div class="field-value">{{ $birthCertificate->mother_first_name }}</div>
                </td>
                <td>
                    <div class="field-label">Name (Middle)</div>
                    <div class="field-value">{{ $birthCertificate->mother_middle_name ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Name (Last)</div>
                    <div class="field-value">{{ $birthCertificate->mother_last_name }}</div>
                </td>
                <td>
                    <div class="field-label">Maiden Name</div>
                    <div class="field-value">{{ $birthCertificate->mother_maiden_name ?? 'N/A' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Date of Birth</div>
                    <div class="field-value">{{ $motherDob ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Age at Time of Birth</div>
                    <div class="field-value">{{ $birthCertificate->mother_age_at_birth ? $birthCertificate->mother_age_at_birth . ' years' : 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Citizenship</div>
                    <div class="field-value">{{ $birthCertificate->mother_citizenship ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Religion</div>
                    <div class="field-value">{{ $birthCertificate->mother_religion ?? 'N/A' }}</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="field-label">Occupation</div>
                    <div class="field-value">{{ $birthCertificate->mother_occupation ?? 'N/A' }}</div>
                </td>
                <td colspan="2">
                    <div class="field-label">Residence / Address</div>
                    <div class="field-value">{{ $birthCertificate->mother_address }}</div>
                </td>
            </tr>

            <tr class="section-title">
                <td colspan="4">Father Information</td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Name (First)</div>
                    <div class="field-value">{{ $birthCertificate->father_first_name ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Name (Middle)</div>
                    <div class="field-value">{{ $birthCertificate->father_middle_name ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Name (Last)</div>
                    <div class="field-value">{{ $birthCertificate->father_last_name ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Date of Birth</div>
                    <div class="field-value">{{ $fatherDob ?? 'N/A' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Age at Time of Birth</div>
                    <div class="field-value">{{ $birthCertificate->father_age_at_birth ? $birthCertificate->father_age_at_birth . ' years' : 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Citizenship</div>
                    <div class="field-value">{{ $birthCertificate->father_citizenship ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Religion</div>
                    <div class="field-value">{{ $birthCertificate->father_religion ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Occupation</div>
                    <div class="field-value">{{ $birthCertificate->father_occupation ?? 'N/A' }}</div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="field-label">Residence / Address</div>
                    <div class="field-value">{{ $birthCertificate->father_address ?? 'N/A' }}</div>
                </td>
            </tr>

            <tr class="section-title">
                <td colspan="4">Parents' Marriage Information</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="field-label">Date of Marriage</div>
                    <div class="field-value">{{ $marriageDate ?? 'N/A' }}</div>
                </td>
                <td colspan="2">
                    <div class="field-label">Place of Marriage</div>
                    <div class="field-value">{{ $birthCertificate->parents_marriage_place ?? 'N/A' }}</div>
                </td>
            </tr>

            <tr class="section-title">
                <td colspan="4">Attendant Information</td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="field-label">Attendant Name</div>
                    <div class="field-value">{{ $birthCertificate->attendant_name ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Attendant Type</div>
                    <div class="field-value">{{ $birthCertificate->attendant_type ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Title / Position</div>
                    <div class="field-value">{{ $birthCertificate->attendant_title ?? 'N/A' }}</div>
                </td>
            </tr>

            <tr class="section-title">
                <td colspan="4">Registration Information</td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">Date Registered</div>
                    <div class="field-value">{{ $registeredDate ?? 'N/A' }}</div>
                </td>
                <td>
                    <div class="field-label">Registered By</div>
                    <div class="field-value">{{ $birthCertificate->registered_by ?? 'N/A' }}</div>
                </td>
                <td colspan="2">
                    <div class="field-label">Registrar Name</div>
                    <div class="field-value">{{ $birthCertificate->registrar_name ?? 'N/A' }}</div>
                </td>
            </tr>

            <tr class="signature-row">
                <td colspan="2">
                    <div class="field-label">Signature of Informant</div>
                    <div class="signature-placeholder"></div>
                </td>
                <td colspan="2">
                    <div class="field-label">Signature of Civil Registrar</div>
                    <div class="signature-placeholder"></div>
                </td>
            </tr>
        </table>
    </div>
</div>
