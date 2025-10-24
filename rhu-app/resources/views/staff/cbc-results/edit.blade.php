@extends('layout.app')

<style>
    label {
        font-weight: bold;
        margin-top: 0.5em;
    }
</style>

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="d-flex align-items-center justify-content-between">
                    <h2>Edit Cbc Results</h2>
                    <a href="{{ url()->previous() }}" class="btn btn-lg">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Display success message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Display error message --}}
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Service Type Warning --}}
                @if($cbcResult->appointments && strtolower($cbcResult->appointments->service) !== 'cbc')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This appointment is for "{{ $cbcResult->appointments->service }}" service, not CBC. 
                        Please make sure you're editing the correct record.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Edit Form -->
                <form action="{{ route('staff.cbc-results.update', $cbcResult->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="John Doe" value="{{ old('name', $cbcResult->appointments->name) }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service">Appointment Service</label>
                                <input type="text" name="service" id="service" class="form-control"
                                    value="{{ $cbcResult->appointments->service ?? 'N/A' }}" readonly
                                    class="form-control {{ strtolower($cbcResult->appointments->service ?? '') !== 'cbc' ? 'border-warning' : 'border-success' }}">
                                <small class="text-muted">This shows what service was booked for this appointment</small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hemoglobin">Hemoglobin</label>
                                <input type="text" name="hemoglobin" id="hemoglobin" class="form-control"
                                    value="{{ old('hemoglobin', $cbcResult->hemoglobin) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hematocrit">Hematocrit</label>
                                <input type="text" name="hematocrit" id="hematocrit" class="form-control"
                                    value="{{ old('hematocrit', $cbcResult->hematocrit) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rbc_count">RBC</label>
                                <input type="text" name="rbc_count" id="rbc_count" class="form-control"
                                    value="{{ old('rbc_count', $cbcResult->rbc_count) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="wbc_count">WBC</label>
                                <input type="text" name="wbc_count" id="wbc_count" class="form-control"
                                    value="{{ old('wbc_count', $cbcResult->wbc_count) }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="platelet_count">Platelet</label>
                                <input type="text" name="platelet_count" id="platelet_count" class="form-control"
                                    value="{{ old('platelet_count', $cbcResult->platelet_count) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mcv">Mcv</label>
                                <input type="text" name="mcv" id="mcv" class="form-control"
                                    value="{{ old('mcv', $cbcResult->mcv) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mch">Mch</label>
                                <input type="text" name="mch" id="mch" class="form-control"
                                    value="{{ old('mch', $cbcResult->mch) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mchc">Mchc</label>
                                <input type="text" name="mchc" id="mchc" class="form-control"
                                    value="{{ old('mchc', $cbcResult->mchc) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="neutrophils">Neutrophils</label>
                                <input type="text" name="neutrophils" id="neutrophils" class="form-control"
                                    value="{{ old('neutrophils', $cbcResult->neutrophils) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lymphocytes">Lymphocytes</label>
                                <input type="text" name="lymphocytes" id="lymphocytes" class="form-control"
                                    value="{{ old('lymphocytes', $cbcResult->lymphocytes) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="monocytes">Monocytes</label>
                                <input type="text" name="monocytes" id="monocytes" class="form-control"
                                    value="{{ old('monocytes', $cbcResult->monocytes) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="eosinophils">Eosinophils</label>
                                <input type="text" name="eosinophils" id="eosinophils" class="form-control"
                                    value="{{ old('eosinophils', $cbcResult->eosinophils) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="basophils">Basophils</label>
                                <input type="text" name="basophils" id="basophils" class="form-control"
                                    value="{{ old('basophils', $cbcResult->basophils) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <input type="text" name="remarks" id="remarks" class="form-control"
                                    value="{{ old('remarks', $cbcResult->remarks) }}">
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning float-end mt-4">Update
                                    Appointment</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
