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
                    <h2>Edit Animal Bite Case</h2>
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

                <!-- Edit Form -->
                <form action="{{ route('admin.animal-bite.update', $animalBiteCase->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control"
                                value="{{ $animalBiteCase->appointment->name ?? 'N/A' }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="date_of_incident">Date of Incident</label>
                            <input type="date" name="date_of_incident" id="date_of_incident" class="form-control"
                                value="{{ old('date_of_incident', $animalBiteCase->date_of_incident) }}">
                        </div>

                        <div class="col-md-4">
                            <label for="animal_type">Animal Type</label>
                            <input type="text" name="animal_type" id="animal_type" class="form-control"
                                value="{{ old('animal_type', $animalBiteCase->animal_type) }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="animal_ownership">Animal Ownership</label>
                            <select name="animal_ownership" id="animal_ownership" class="form-control">
                                <option value="">Select</option>
                                <option value="Owned"
                                    {{ old('animal_ownership', $animalBiteCase->animal_ownership) == 'Owned' ? 'selected' : '' }}>
                                    Owned</option>
                                <option value="Stray"
                                    {{ old('animal_ownership', $animalBiteCase->animal_ownership) == 'Stray' ? 'selected' : '' }}>
                                    Stray</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="animal_vaccination_status">Vaccination Status</label>
                            <select name="animal_vaccination_status" id="animal_vaccination_status" class="form-control">
                                <option value="">Select</option>
                                <option value="Vaccinated"
                                    {{ old('animal_vaccination_status', $animalBiteCase->animal_vaccination_status) == 'Vaccinated' ? 'selected' : '' }}>
                                    Vaccinated</option>
                                <option value="Unvaccinated"
                                    {{ old('animal_vaccination_status', $animalBiteCase->animal_vaccination_status) == 'Unvaccinated' ? 'selected' : '' }}>
                                    Unvaccinated</option>
                                <option value="Unknown"
                                    {{ old('animal_vaccination_status', $animalBiteCase->animal_vaccination_status) == 'Unknown' ? 'selected' : '' }}>
                                    Unknown</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="animal_behavior">Animal Behavior</label>
                            <select name="animal_behavior" id="animal_behavior" class="form-control">
                                <option value="">Select</option>
                                <option value="Normal"
                                    {{ old('animal_behavior', $animalBiteCase->animal_behavior) == 'Normal' ? 'selected' : '' }}>
                                    Normal</option>
                                <option value="Aggressive"
                                    {{ old('animal_behavior', $animalBiteCase->animal_behavior) == 'Aggressive' ? 'selected' : '' }}>
                                    Aggressive</option>
                                <option value="Rabid Signs"
                                    {{ old('animal_behavior', $animalBiteCase->animal_behavior) == 'Rabid Signs' ? 'selected' : '' }}>
                                    Rabid Signs</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="bite_site">Bite Site</label>
                            <input type="text" name="bite_site" id="bite_site" class="form-control"
                                value="{{ old('bite_site', $animalBiteCase->bite_site) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="bite_category">Bite Category</label>
                            <select name="bite_category" id="bite_category" class="form-control">
                                <option value="">Select</option>
                                <option value="I"
                                    {{ old('bite_category', $animalBiteCase->bite_category) == 'I' ? 'selected' : '' }}>I
                                </option>
                                <option value="II"
                                    {{ old('bite_category', $animalBiteCase->bite_category) == 'II' ? 'selected' : '' }}>II
                                </option>
                                <option value="III"
                                    {{ old('bite_category', $animalBiteCase->bite_category) == 'III' ? 'selected' : '' }}>
                                    III</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="wound_description">Wound Description</label>
                            <textarea name="wound_description" id="wound_description" class="form-control" rows="1">{{ old('wound_description', $animalBiteCase->wound_description) }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="first_consultation_date">First Consultation Date</label>
                            <input type="date" name="first_consultation_date" id="first_consultation_date"
                                class="form-control"
                                value="{{ old('first_consultation_date', $animalBiteCase->first_consultation_date) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="arv_dose">ARV Dose</label>
                            <input type="text" name="arv_dose" id="arv_dose" class="form-control"
                                value="{{ old('arv_dose', $animalBiteCase->arv_dose) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="arv_date">ARV Date</label>
                            <input type="date" name="arv_date" id="arv_date" class="form-control"
                                value="{{ old('arv_date', $animalBiteCase->arv_date) }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="rig_administered">RIG Administered</label>
                            <select name="rig_administered" id="rig_administered" class="form-control">
                                <option value="">Select</option>
                                <option value="Yes"
                                    {{ old('rig_administered', $animalBiteCase->rig_administered) == 'Yes' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="No"
                                    {{ old('rig_administered', $animalBiteCase->rig_administered) == 'No' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="2">{{ old('remarks', $animalBiteCase->remarks) }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning float-end">Update Animal Bite Case</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
