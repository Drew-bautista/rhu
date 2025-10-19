@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <h2>Edit Animal Bite Case</h2>
                    <div class="position-absolute top-0 end-0 mt-4 me-4">
                        <a href="{{ route('staff.animal-bite.index') }}" class="text-dark" style="font-size:1.25rem;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <br>

                    <form action="{{ route('staff.animal-bite.update', $animalBiteCase->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="appointment_id" class="form-label">Linked Appointment (optional)</label>
                                <select name="appointment_id" id="appointment_id" class="form-select">
                                    <option value="">-- Select Appointment --</option>
                                    @foreach($appointments as $appointment)
                                        <option value="{{ $appointment->id }}" 
                                            {{ old('appointment_id', $animalBiteCase->appointment_id) == $appointment->id ? 'selected' : '' }}>
                                            {{ $appointment->name }} ({{ \Carbon\Carbon::parse($appointment->date_of_appointment)->format('M d, Y') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="date_of_incident" class="form-label">Date of Incident</label>
                                <input type="date" name="date_of_incident" id="date_of_incident" 
                                    value="{{ old('date_of_incident', $animalBiteCase->date_of_incident ? $animalBiteCase->date_of_incident->format('Y-m-d') : '') }}" 
                                    class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="animal_type" class="form-label">Animal Type</label>
                                <input type="text" name="animal_type" id="animal_type" 
                                    value="{{ old('animal_type', $animalBiteCase->animal_type) }}" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="bite_site" class="form-label">Bite Site</label>
                                <input type="text" name="bite_site" id="bite_site" 
                                    value="{{ old('bite_site', $animalBiteCase->bite_site) }}" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="bite_category" class="form-label">Bite Category</label>
                                <select name="bite_category" id="bite_category" class="form-select">
                                    <option value="">-- Select Category --</option>
                                    <option value="I" {{ old('bite_category', $animalBiteCase->bite_category) == 'I' ? 'selected' : '' }}>Category I</option>
                                    <option value="II" {{ old('bite_category', $animalBiteCase->bite_category) == 'II' ? 'selected' : '' }}>Category II</option>
                                    <option value="III" {{ old('bite_category', $animalBiteCase->bite_category) == 'III' ? 'selected' : '' }}>Category III</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="arv_dose" class="form-label">ARV Dose</label>
                                <input type="text" name="arv_dose" id="arv_dose" 
                                    value="{{ old('arv_dose', $animalBiteCase->arv_dose) }}" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea name="remarks" id="remarks" rows="3" class="form-control">{{ old('remarks', $animalBiteCase->remarks) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">Update Case</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
