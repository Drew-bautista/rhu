@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Add New Medicine to Inventory</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('staff.inventory.store') }}" method="POST">
                            @csrf
                            
                            <h5 class="mb-3 text-primary">Medicine Information</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" 
                                           id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" required>
                                    @error('medicine_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="generic_name" class="form-label">Generic Name</label>
                                    <input type="text" class="form-control @error('generic_name') is-invalid @enderror" 
                                           id="generic_name" name="generic_name" value="{{ old('generic_name') }}">
                                    @error('generic_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror" 
                                           id="brand_name" name="brand_name" value="{{ old('brand_name') }}">
                                    @error('brand_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="medicine_type" class="form-label">Medicine Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('medicine_type') is-invalid @enderror" 
                                            id="medicine_type" name="medicine_type" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="tablet" {{ old('medicine_type') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                        <option value="capsule" {{ old('medicine_type') == 'capsule' ? 'selected' : '' }}>Capsule</option>
                                        <option value="syrup" {{ old('medicine_type') == 'syrup' ? 'selected' : '' }}>Syrup</option>
                                        <option value="injection" {{ old('medicine_type') == 'injection' ? 'selected' : '' }}>Injection</option>
                                        <option value="cream" {{ old('medicine_type') == 'cream' ? 'selected' : '' }}>Cream</option>
                                        <option value="drops" {{ old('medicine_type') == 'drops' ? 'selected' : '' }}>Drops</option>
                                        <option value="inhaler" {{ old('medicine_type') == 'inhaler' ? 'selected' : '' }}>Inhaler</option>
                                        <option value="other" {{ old('medicine_type') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('medicine_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dosage_strength" class="form-label">Dosage Strength <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('dosage_strength') is-invalid @enderror" 
                                           id="dosage_strength" name="dosage_strength" value="{{ old('dosage_strength') }}" 
                                           placeholder="e.g., 500mg, 250mg/5ml" required>
                                    @error('dosage_strength')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="unit_of_measure" class="form-label">Unit of Measure <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('unit_of_measure') is-invalid @enderror" 
                                           id="unit_of_measure" name="unit_of_measure" value="{{ old('unit_of_measure') }}" 
                                           placeholder="e.g., pieces, bottles, boxes" required>
                                    @error('unit_of_measure')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="mb-3 text-primary mt-4">Stock Information</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantity_in_stock" class="form-label">Quantity in Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('quantity_in_stock') is-invalid @enderror" 
                                           id="quantity_in_stock" name="quantity_in_stock" value="{{ old('quantity_in_stock') }}" 
                                           min="0" required>
                                    @error('quantity_in_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="reorder_level" class="form-label">Reorder Level <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('reorder_level') is-invalid @enderror" 
                                           id="reorder_level" name="reorder_level" value="{{ old('reorder_level', 10) }}" 
                                           min="0" required>
                                    <small class="form-text text-muted">Alert when stock reaches this level</small>
                                    @error('reorder_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="mb-3 text-primary mt-4">Additional Information</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" 
                                           id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                                    @error('expiry_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="batch_number" class="form-label">Batch Number</label>
                                    <input type="text" class="form-control @error('batch_number') is-invalid @enderror" 
                                           id="batch_number" name="batch_number" value="{{ old('batch_number') }}">
                                    @error('batch_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <input type="text" class="form-control @error('supplier') is-invalid @enderror" 
                                           id="supplier" name="supplier" value="{{ old('supplier') }}">
                                    @error('supplier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="storage_location" class="form-label">Storage Location</label>
                                    <input type="text" class="form-control @error('storage_location') is-invalid @enderror" 
                                           id="storage_location" name="storage_location" value="{{ old('storage_location') }}" 
                                           placeholder="e.g., Cabinet A, Shelf 2">
                                    @error('storage_location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                                              id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('staff.inventory.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Inventory
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Add Medicine
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
