@extends('layout.app')

@section('content')
    <div class="container my-5">
        <div class="d-flex align-items-center justify-content-between mb-4 d-print-none">
            <div>
                <a href="{{ route('admin.birth-certificates.index') }}" class="btn btn-link text-decoration-none">
                    <i class="fas fa-arrow-left"></i> Back to list
                </a>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.birth-certificates.edit', $birthCertificate->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <button class="btn btn-info" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Certificate
                </button>
            </div>
        </div>

        @include('birth-certificates.partials.official-form', ['birthCertificate' => $birthCertificate])
    </div>
@endsection
