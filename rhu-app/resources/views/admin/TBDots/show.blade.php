@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>TBDOTS Case Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Patient:</strong> {{ $tbdots->patient->name }}</p>
            <p><strong>Date of Diagnosis:</strong> {{ $tbdots->date_of_diagnosis }}</p>
            <p><strong>Type of TB:</strong> {{ ucfirst($tbdots->tb_type) }}</p>
            <p><strong>Lab Result:</strong> {{ $tbdots->lab_result }}</p>
            <p><strong>Treatment Phase:</strong> {{ ucfirst($tbdots->treatment_phase) }}</p>
            <p><strong>Remarks:</strong> {{ $tbdots->remarks }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.tbdots.edit', $tbdots->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.tbdots.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
