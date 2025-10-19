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
                    <h2>Edit Urinalysis Results</h2>
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
                <form action="{{ route('staff.urinalysis-results.update', $urinalysisResult->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{ $urinalysisResult->appointments->name }}"
                                readonly>
                        </div>



                        <div class="col-md-4">
                            <label for="color">Color</label>
                            <input type="text" name="color" id="color" class="form-control"
                                value="{{ old('color', $urinalysisResult->color) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="transparency">Transparency</label>
                            <input type="text" name="transparency" id="transparency" class="form-control"
                                value="{{ old('transparency', $urinalysisResult->transparency) }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="specific_gravity">Specific Gravity</label>
                            <input type="number" step="0.001" name="specific_gravity" id="specific_gravity"
                                class="form-control"
                                value="{{ old('specific_gravity', $urinalysisResult->specific_gravity) }}">
                        </div>

                        <div class="col-md-4">
                            <label for="ph">pH</label>
                            <input type="number" step="0.1" name="ph" id="ph" class="form-control"
                                value="{{ old('ph', $urinalysisResult->ph) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="protein">Protein</label>
                            <input type="text" name="protein" id="protein" class="form-control"
                                value="{{ old('protein', $urinalysisResult->protein) }}">
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-3">
                            <label for="glucose">Glucose</label>
                            <input type="text" name="glucose" id="glucose" class="form-control"
                                value="{{ old('glucose', $urinalysisResult->glucose) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="ketones">Ketones</label>
                            <input type="text" name="ketones" id="ketones" class="form-control"
                                value="{{ old('ketones', $urinalysisResult->ketones) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="bilirubin">Bilirubin</label>
                            <input type="text" name="bilirubin" id="bilirubin" class="form-control"
                                value="{{ old('bilirubin', $urinalysisResult->bilirubin) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="urobilinogen">Urobilinogen</label>
                            <input type="text" name="urobilinogen" id="urobilinogen" class="form-control"
                                value="{{ old('urobilinogen', $urinalysisResult->urobilinogen) }}">
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-3">
                            <label for="nitrite">Nitrite</label>
                            <input type="text" name="nitrite" id="nitrite" class="form-control"
                                value="{{ old('nitrite', $urinalysisResult->nitrite) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="leukocyte_esterase">Leukocyte Esterase</label>
                            <input type="text" name="leukocyte_esterase" id="leukocyte_esterase" class="form-control"
                                value="{{ old('leukocyte_esterase', $urinalysisResult->leukocyte_esterase) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="rbc">RBC</label>
                            <input type="text" name="rbc" id="rbc" class="form-control"
                                value="{{ old('rbc', $urinalysisResult->rbc) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="wbc">WBC</label>
                            <input type="text" name="wbc" id="wbc" class="form-control"
                                value="{{ old('wbc', $urinalysisResult->wbc) }}">
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-3">
                            <label for="epithelial_cells">Epithelial Cells</label>
                            <input type="text" name="epithelial_cells" id="epithelial_cells" class="form-control"
                                value="{{ old('epithelial_cells', $urinalysisResult->epithelial_cells) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="bacteria">Bacteria</label>
                            <input type="text" name="bacteria" id="bacteria" class="form-control"
                                value="{{ old('bacteria', $urinalysisResult->bacteria) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="crystals">Crystals</label>
                            <input type="text" name="crystals" id="crystals" class="form-control"
                                value="{{ old('crystals', $urinalysisResult->crystals) }}">
                        </div>
                        <div class="col-md-3">
                            <label for="casts">Casts</label>
                            <input type="text" name="casts" id="casts" class="form-control"
                                value="{{ old('casts', $urinalysisResult->casts) }}">
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-md-4">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="2">{{ old('remarks', $urinalysisResult->remarks) }}</textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-warning float-end">Update Urinalysis</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
