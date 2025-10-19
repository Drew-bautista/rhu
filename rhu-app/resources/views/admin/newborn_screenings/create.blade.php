@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>Create Newborn Screening</h2>
                        <div class="position-absolute top-0 end-0 mt-4 me-4">
                            <a href="{{ route('admin.newborn_screenings.index') }}" class="text-dark"
                                style="font-size: 1.25rem;">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </div>
                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.newborn_screenings.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Registry Information --}}
                                <div class="col-md-6 mb-3">
                                    <label>Registry No.</label>
                                    <input type="text" name="registry_no" class="form-control"
                                        value="{{ old('registry_no') }}" placeholder="Registry Number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Province</label>
                                    <input type="text" name="province" class="form-control"
                                        value="{{ old('province') }}" placeholder="Nueva Ecija">
                                </div>
                                
                                {{-- 🍼 Child Information --}}
                                <div class="col-md-12"><h5 class="text-primary mt-3">CHILD</h5><hr></div>
                                <div class="col-md-4 mb-3">
                                    <label>1. NAME (First)</label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>(Middle)</label>
                                    <input type="text" name="middle_name" class="form-control"
                                        value="{{ old('middle_name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>(Last)</label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name') }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>2. SEX</label>
                                    <select name="sex" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>3. DATE OF BIRTH (day) (month) (year)</label>
                                    <input type="date" name="date_of_birth" class="form-control"
                                        value="{{ old('date_of_birth') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Time of Birth</label>
                                    <input type="time" name="time_of_birth" class="form-control"
                                        value="{{ old('time_of_birth') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>4. PLACE OF BIRTH (Name of Hospital/Clinic/Institution)</label>
                                    <input type="text" name="place_of_birth" class="form-control"
                                        value="{{ old('place_of_birth') }}" placeholder="Hospital/Clinic/Institution">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>City/Municipality</label>
                                    <input type="text" name="city_municipality" class="form-control"
                                        value="{{ old('city_municipality') }}" placeholder="Gabaldon">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>5a. TYPE OF BIRTH</label>
                                    <select name="type_of_birth" class="form-control">
                                        <option value="">-- Select --</option>
                                        <option value="Single" {{ old('type_of_birth') == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Twin" {{ old('type_of_birth') == 'Twin' ? 'selected' : '' }}>Twin</option>
                                        <option value="Triplet" {{ old('type_of_birth') == 'Triplet' ? 'selected' : '' }}>Triplet</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>5b. IF MULTIPLE BIRTH, CHILD WAS</label>
                                    <select name="birth_order" class="form-control">
                                        <option value="">-- Select --</option>
                                        <option value="First" {{ old('birth_order') == 'First' ? 'selected' : '' }}>First</option>
                                        <option value="Second" {{ old('birth_order') == 'Second' ? 'selected' : '' }}>Second</option>
                                        <option value="Third" {{ old('birth_order') == 'Third' ? 'selected' : '' }}>Third</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>6. WEIGHT AT BIRTH (grams)</label>
                                    <input type="number" name="weight_at_birth_grams" class="form-control"
                                        value="{{ old('weight_at_birth_grams') }}" placeholder="3247">
                                </div>

                                {{-- 👩‍🍼 MOTHER --}}
                                <div class="col-md-12"><h5 class="text-primary mt-3">MOTHER</h5><hr></div>
                                <div class="col-md-4 mb-3">
                                    <label>6. MAIDEN NAME (First)</label>
                                    <input type="text" name="mother_first_name" class="form-control"
                                        value="{{ old('mother_first_name') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>(Middle)</label>
                                    <input type="text" name="mother_middle_name" class="form-control"
                                        value="{{ old('mother_middle_name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>(Last)</label>
                                    <input type="text" name="mother_last_name" class="form-control"
                                        value="{{ old('mother_last_name') }}" required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>7. CITIZENSHIP</label>
                                    <input type="text" name="mother_citizenship" class="form-control"
                                        value="{{ old('mother_citizenship') }}" placeholder="Filipino">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>8. RELIGION</label>
                                    <input type="text" name="mother_religion" class="form-control"
                                        value="{{ old('mother_religion') }}" placeholder="Roman Catholic">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Mother's Age</label>
                                    <input type="number" name="mother_age" class="form-control"
                                        value="{{ old('mother_age') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>9a. Total number of children born alive</label>
                                    <input type="number" name="total_children_born_alive" class="form-control"
                                        value="{{ old('total_children_born_alive') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>b. No. of children still living including this birth</label>
                                    <input type="number" name="children_still_living" class="form-control"
                                        value="{{ old('children_still_living') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>c. No. of children born alive but now dead</label>
                                    <input type="number" name="children_born_dead" class="form-control"
                                        value="{{ old('children_born_dead') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>10. OCCUPATION</label>
                                    <input type="text" name="mother_occupation" class="form-control"
                                        value="{{ old('mother_occupation') }}" placeholder="Housewife">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mother's Contact</label>
                                    <input type="text" name="mother_contact" class="form-control"
                                        value="{{ old('mother_contact') }}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>12. RESIDENCE (House No., Street, Barangay)</label>
                                    <textarea name="mother_address" class="form-control" placeholder="South Poblacion, Gabaldon, Nueva Ecija">{{ old('mother_address') }}</textarea>
                                </div>

                                {{-- 👨‍🦱 FATHER --}}
                                <div class="col-md-12"><h5 class="text-primary mt-3">FATHER</h5><hr></div>
                                <div class="col-md-4 mb-3">
                                    <label>13. NAME (First)</label>
                                    <input type="text" name="father_first_name" class="form-control"
                                        value="{{ old('father_first_name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>(Middle)</label>
                                    <input type="text" name="father_middle_name" class="form-control"
                                        value="{{ old('father_middle_name') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>(Last)</label>
                                    <input type="text" name="father_last_name" class="form-control"
                                        value="{{ old('father_last_name') }}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>14. CITIZENSHIP</label>
                                    <input type="text" name="father_citizenship" class="form-control"
                                        value="{{ old('father_citizenship') }}" placeholder="Filipino">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>15. RELIGION</label>
                                    <input type="text" name="father_religion" class="form-control"
                                        value="{{ old('father_religion') }}" placeholder="Roman Catholic">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>17. Age at the time of this birth</label>
                                    <input type="number" name="father_age_at_birth" class="form-control"
                                        value="{{ old('father_age_at_birth') }}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>16. OCCUPATION</label>
                                    <input type="text" name="father_occupation" class="form-control"
                                        value="{{ old('father_occupation') }}" placeholder="Tricycle Driver">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>18. DATE AND PLACE OF MARRIAGE OF PARENTS</label>
                                    <input type="date" name="parents_marriage_date" class="form-control"
                                        value="{{ old('parents_marriage_date') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Place of Marriage</label>
                                    <input type="text" name="parents_marriage_place" class="form-control"
                                        value="{{ old('parents_marriage_place') }}" placeholder="Gabaldon, Nueva Ecija">
                                </div>

                                {{-- 🧾 Screening Details --}}
                                <div class="col-md-4 mb-3">
                                    <label>Screening Date</label>
                                    <input type="date" name="screening_date" class="form-control"
                                        value="{{ old('screening_date') }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Facility</label>
                                    <input type="text" name="facility" class="form-control"
                                        value="{{ old('facility') }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Kit No.</label>
                                    <input type="text" name="kit_no" class="form-control" value="{{ old('kit_no') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Sample Collection Date & Time</label>
                                    <input type="datetime-local" name="sample_collection_at" class="form-control"
                                        value="{{ old('sample_collection_at') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Specimen Type</label>
                                    <input type="text" name="specimen_type" class="form-control"
                                        value="{{ old('specimen_type') }}">
                                </div>

                                {{-- 🧪 Screening Results --}}
                                <div class="col-md-12 mb-3">
                                    <label for="conditions_tested" class="form-label">
                                        Conditions Tested
                                        <small class="text-muted">(Type multiple, separated by comma)</small>
                                    </label>

                                    <input type="text" name="conditions_tested" id="conditions_tested"
                                        class="form-control" placeholder="Ex: Congenital Hypothyroidism, G6PD Deficiency"
                                        value="{{ old('conditions_tested') }}">

                                    <small class="text-muted d-block mt-1">
                                        Separate conditions with a comma (,)
                                    </small>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label>Result Status</label>
                                    <select name="result_status" class="form-control" required>
                                        <option value="Normal" {{ old('result_status') == 'Normal' ? 'selected' : '' }}>
                                            Normal</option>
                                        <option value="Positive"
                                            {{ old('result_status') == 'Positive' ? 'selected' : '' }}>
                                            Positive</option>
                                        <option value="Retest" {{ old('result_status') == 'Retest' ? 'selected' : '' }}>
                                            Retest</option>
                                    </select>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label>Remarks</label>
                                    <textarea name="remarks" class="form-control">{{ old('remarks') }}</textarea>
                                </div>

                                {{-- 👨‍⚕️ Health Provider --}}
                                <div class="col-md-6 mb-3">
                                    <label>Provider Name</label>
                                    <input type="text" name="provider_name" class="form-control"
                                        value="{{ old('provider_name') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Provider Role</label>
                                    <input type="text" name="provider_role" class="form-control"
                                        value="{{ old('provider_role') }}">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Save</button>
                            {{-- <a href="{{ route('newborn_screenings.index') }}" class="btn btn-secondary">Cancel</a> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
