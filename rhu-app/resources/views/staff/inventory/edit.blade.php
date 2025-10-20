@extends('layout.app')

@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container position-relative">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Edit Medicine</h2>
                        <a href="{{ route('staff.inventory.show', $inventory->id) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Details
                        </a>
                    </div>

                    <form action="{{ route('staff.inventory.update', $inventory->id) }}" method="POST">
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

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                                <input type="text" name="medicine_name" id="medicine_name" class="form-control" 
                                    value="{{ old('medicine_name', $inventory->medicine_name) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="generic_name" class="form-label">Generic Name</label>
                                <input type="text" name="generic_name" id="generic_name" class="form-control" 
                                    value="{{ old('generic_name', $inventory->generic_name) }}">
                            </div>

                            <div class="col-md-6">
                                <label for="brand_name" class="form-label">Brand Name</label>
                                <input type="text" name="brand_name" id="brand_name" class="form-control" 
                                    value="{{ old('brand_name', $inventory->brand_name) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="medicine_type" class="form-label">Medicine Type <span class="text-danger">*</span></label>
                                <select name="medicine_type" id="medicine_type" class="form-select" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="tablet" {{ old('medicine_type', $inventory->medicine_type) == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                    <option value="capsule" {{ old('medicine_type', $inventory->medicine_type) == 'capsule' ? 'selected' : '' }}>Capsule</option>
                                    <option value="syrup" {{ old('medicine_type', $inventory->medicine_type) == 'syrup' ? 'selected' : '' }}>Syrup</option>
                                    <option value="injection" {{ old('medicine_type', $inventory->medicine_type) == 'injection' ? 'selected' : '' }}>Injection</option>
                                    <option value="cream" {{ old('medicine_type', $inventory->medicine_type) == 'cream' ? 'selected' : '' }}>Cream</option>
                                    <option value="drops" {{ old('medicine_type', $inventory->medicine_type) == 'drops' ? 'selected' : '' }}>Drops</option>
                                    <option value="inhaler" {{ old('medicine_type', $inventory->medicine_type) == 'inhaler' ? 'selected' : '' }}>Inhaler</option>
                                    <option value="other" {{ old('medicine_type', $inventory->medicine_type) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="dosage_strength" class="form-label">Dosage Strength <span class="text-danger">*</span></label>
                                <input type="text" name="dosage_strength" id="dosage_strength" class="form-control" 
                                    value="{{ old('dosage_strength', $inventory->dosage_strength) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="unit_of_measure" class="form-label">Unit of Measure <span class="text-danger">*</span></label>
                                <input type="text" name="unit_of_measure" id="unit_of_measure" class="form-control" 
                                    value="{{ old('unit_of_measure', $inventory->unit_of_measure) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="quantity_in_stock" class="form-label">Current Stock <span class="text-danger">*</span></label>
                                <input type="number" name="quantity_in_stock" id="quantity_in_stock" class="form-control" 
                                    value="{{ old('quantity_in_stock', $inventory->quantity_in_stock) }}" min="0" required>
                            </div>
                            <div class="col-md-4">
                                <label for="reorder_level" class="form-label">Reorder Level <span class="text-danger">*</span></label>
                                <input type="number" name="reorder_level" id="reorder_level" class="form-control" 
                                    value="{{ old('reorder_level', $inventory->reorder_level) }}" min="0" required>
                            </div>

                            <div class="col-md-6">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control" 
                                    value="{{ old('expiry_date', $inventory->expiry_date ? $inventory->expiry_date->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="batch_number" class="form-label">Batch Number</label>
                                <input type="text" name="batch_number" id="batch_number" class="form-control" 
                                    value="{{ old('batch_number', $inventory->batch_number) }}">
                            </div>

                            <div class="col-md-6">
                                <label for="supplier" class="form-label">Supplier</label>
                                <input type="text" name="supplier" id="supplier" class="form-control" 
                                    value="{{ old('supplier', $inventory->supplier) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="storage_location" class="form-label">Storage Location</label>
                                <input type="text" name="storage_location" id="storage_location" class="form-control" 
                                    value="{{ old('storage_location', $inventory->storage_location) }}">
                            </div>

                            <div class="col-12">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes', $inventory->notes) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">Update Medicine</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
