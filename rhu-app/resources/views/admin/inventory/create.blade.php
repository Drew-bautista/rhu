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
                        <form action="{{ route('admin.inventory.store') }}" method="POST">
                            @csrf
                            
                            <h5 class="mb-3 text-primary">Medicine Information</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" 
                                           id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" 
                                           placeholder="e.g., Paracetamol" required>
                                    @error('medicine_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="generic_name" class="form-label">Generic Name</label>
                                    <input type="text" class="form-control @error('generic_name') is-invalid @enderror" 
                                           id="generic_name" name="generic_name" value="{{ old('generic_name') }}"
                                           placeholder="e.g., Acetaminophen">
                                    @error('generic_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" class="form-control @error('brand_name') is-invalid @enderror" 
                                           id="brand_name" name="brand_name" value="{{ old('brand_name') }}"
                                           placeholder="e.g., Biogesic">
                                    @error('brand_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="dosage_form" class="form-label">Dosage Form <span class="text-danger">*</span></label>
                                    <select class="form-control @error('dosage_form') is-invalid @enderror" 
                                            id="dosage_form" name="dosage_form" required>
                                        <option value="">-- Select Form --</option>
                                        <option value="tablet" {{ old('dosage_form') == 'tablet' ? 'selected' : '' }}>Tablet</option>
                                        <option value="capsule" {{ old('dosage_form') == 'capsule' ? 'selected' : '' }}>Capsule</option>
                                        <option value="syrup" {{ old('dosage_form') == 'syrup' ? 'selected' : '' }}>Syrup</option>
                                        <option value="injection" {{ old('dosage_form') == 'injection' ? 'selected' : '' }}>Injection</option>
                                        <option value="cream" {{ old('dosage_form') == 'cream' ? 'selected' : '' }}>Cream</option>
                                        <option value="ointment" {{ old('dosage_form') == 'ointment' ? 'selected' : '' }}>Ointment</option>
                                        <option value="drops" {{ old('dosage_form') == 'drops' ? 'selected' : '' }}>Drops</option>
                                        <option value="inhaler" {{ old('dosage_form') == 'inhaler' ? 'selected' : '' }}>Inhaler</option>
                                        <option value="powder" {{ old('dosage_form') == 'powder' ? 'selected' : '' }}>Powder</option>
                                        <option value="other" {{ old('dosage_form') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('dosage_form')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="strength" class="form-label">Strength <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('strength') is-invalid @enderror" 
                                           id="strength" name="strength" value="{{ old('strength') }}"
                                           placeholder="e.g., 500mg, 250mg/5ml" required>
                                    @error('strength')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                                           id="unit" name="unit" value="{{ old('unit') }}"
                                           placeholder="e.g., pieces, bottles, boxes" required>
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3" 
                                              placeholder="Medicine description or notes">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                           id="category" name="category" value="{{ old('category') }}"
                                           placeholder="e.g., Analgesic, Antibiotic, Vitamin">
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <h5 class="mb-3 text-primary">Stock Information</h5>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="current_stock" class="form-label">Current Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('current_stock') is-invalid @enderror" 
                                           id="current_stock" name="current_stock" value="{{ old('current_stock', 0) }}"
                                           min="0" required>
                                    @error('current_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="minimum_stock" class="form-label">Minimum Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('minimum_stock') is-invalid @enderror" 
                                           id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', 10) }}"
                                           min="0" required>
                                    <small class="text-muted">Alert when stock falls below this level</small>
                                    @error('minimum_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="maximum_stock" class="form-label">Maximum Stock <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('maximum_stock') is-invalid @enderror" 
                                           id="maximum_stock" name="maximum_stock" value="{{ old('maximum_stock', 1000) }}"
                                           min="1" required>
                                    <small class="text-muted">Maximum stock capacity</small>
                                    @error('maximum_stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="unit_price" class="form-label">Unit Price <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" 
                                           id="unit_price" name="unit_price" value="{{ old('unit_price', 0) }}"
                                           min="0" required>
                                    @error('unit_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="classification" class="form-label">Classification <span class="text-danger">*</span></label>
                                    <select class="form-control @error('classification') is-invalid @enderror" 
                                            id="classification" name="classification" required>
                                        <option value="">-- Select Classification --</option>
                                        <option value="Prescription" {{ old('classification') == 'Prescription' ? 'selected' : '' }}>Prescription</option>
                                        <option value="OTC" {{ old('classification') == 'OTC' ? 'selected' : '' }}>Over-the-Counter (OTC)</option>
                                    </select>
                                    @error('classification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="">-- Select Status --</option>
                                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : 'selected' }}>Active</option>
                                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="batch_number" class="form-label">Batch Number</label>
                                    <input type="text" class="form-control @error('batch_number') is-invalid @enderror" 
                                           id="batch_number" name="batch_number" value="{{ old('batch_number') }}">
                                    @error('batch_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="expiry_date" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" 
                                           id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                                    @error('expiry_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="manufacturer" class="form-label">Manufacturer</label>
                                    <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" 
                                           id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}"
                                           placeholder="Manufacturer name">
                                    @error('manufacturer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                          id="notes" name="notes" rows="3" 
                                          placeholder="Additional notes or instructions">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Add to Inventory
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
