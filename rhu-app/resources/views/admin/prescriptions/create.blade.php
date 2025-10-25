@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Create New Prescription</h4>
                            <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left"></i> Back to Prescriptions
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.prescriptions.store') }}" method="POST" id="prescriptionForm">
                            @csrf
                            
                            <!-- Patient Information -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="text-primary mb-3">Patient Information</h5>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="appointment_id" class="form-label">Select Appointment (Optional)</label>
                                    <select class="form-select" id="appointment_id" name="appointment_id">
                                        <option value="">-- Select Appointment --</option>
                                        @foreach($appointments as $appointment)
                                            <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                                {{ $appointment->name }} - {{ $appointment->service }} ({{ $appointment->date_of_appointment }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="patient_name" class="form-label">Patient Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="patient_name" name="patient_name" 
                                           value="{{ old('patient_name') }}" required>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="patient_age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="patient_age" name="patient_age" 
                                           value="{{ old('patient_age') }}" min="1" max="120">
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="patient_contact" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="patient_contact" name="patient_contact" 
                                           value="{{ old('patient_contact') }}">
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="prescription_date" class="form-label">Prescription Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="prescription_date" name="prescription_date" 
                                           value="{{ old('prescription_date', date('Y-m-d')) }}" required>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="doctor_name" class="form-label">Doctor Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="doctor_name" name="doctor_name" 
                                           value="{{ old('doctor_name', auth()->user()->name ?? '') }}" required>
                                </div>
                            </div>

                            <!-- Medical Information -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="text-primary mb-3">Medical Information</h5>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="diagnosis" class="form-label">Diagnosis</label>
                                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3">{{ old('diagnosis') }}</textarea>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="symptoms" class="form-label">Symptoms</label>
                                    <textarea class="form-control" id="symptoms" name="symptoms" rows="3">{{ old('symptoms') }}</textarea>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label for="medical_history" class="form-label">Medical History</label>
                                    <textarea class="form-control" id="medical_history" name="medical_history" rows="2">{{ old('medical_history') }}</textarea>
                                </div>
                            </div>

                            <!-- Medicines -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="text-primary mb-0">Prescribed Medicines</h5>
                                        <button type="button" class="btn btn-success btn-sm" id="addMedicine">
                                            <i class="fas fa-plus"></i> Add Medicine
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div id="medicinesContainer">
                                        <!-- Medicine items will be added here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Notes and Follow-up -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="text-primary mb-3">Additional Information</h5>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="follow_up_date" class="form-label">Follow-up Date</label>
                                    <input type="date" class="form-control" id="follow_up_date" name="follow_up_date" 
                                           value="{{ old('follow_up_date') }}">
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="follow_up_notes" class="form-label">Follow-up Notes</label>
                                    <textarea class="form-control" id="follow_up_notes" name="follow_up_notes" rows="3">{{ old('follow_up_notes') }}</textarea>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Create Prescription
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Medicine Item Template -->
    <template id="medicineTemplate">
        <div class="medicine-item border rounded p-3 mb-3">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <label class="form-label">Medicine <span class="text-danger">*</span></label>
                    <select class="form-select medicine-select" name="medicines[INDEX][medicine_id]" required>
                        <option value="">-- Select Medicine --</option>
                        @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}">{{ $medicine->medicine_name }} ({{ $medicine->strength }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="medicines[INDEX][quantity]" min="1" required>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label">Dosage <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="medicines[INDEX][dosage]" placeholder="e.g., 500mg" required>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label">Frequency <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="medicines[INDEX][frequency]" placeholder="e.g., 3x daily" required>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label">Duration <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="medicines[INDEX][duration]" placeholder="e.g., 7 days" required>
                </div>
                <div class="col-md-1 mb-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger btn-sm remove-medicine">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Instructions</label>
                    <input type="text" class="form-control" name="medicines[INDEX][instructions]" placeholder="Special instructions">
                </div>
            </div>
        </div>
    </template>

    <script>
        let medicineIndex = 0;

        document.getElementById('addMedicine').addEventListener('click', function() {
            const template = document.getElementById('medicineTemplate');
            const container = document.getElementById('medicinesContainer');
            
            let html = template.innerHTML.replace(/INDEX/g, medicineIndex);
            
            const div = document.createElement('div');
            div.innerHTML = html;
            container.appendChild(div.firstElementChild);
            
            medicineIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-medicine') || e.target.parentElement.classList.contains('remove-medicine')) {
                e.target.closest('.medicine-item').remove();
            }
        });

        // Add first medicine item on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('addMedicine').click();
        });

        // Auto-fill patient info when appointment is selected
        document.getElementById('appointment_id').addEventListener('change', function() {
            if (this.value) {
                const selectedOption = this.options[this.selectedIndex];
                const appointmentText = selectedOption.text;
                const patientName = appointmentText.split(' - ')[0];
                
                document.getElementById('patient_name').value = patientName;
            }
        });
    </script>
@endsection
