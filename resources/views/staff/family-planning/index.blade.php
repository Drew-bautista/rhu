@extends('layout.app')
@section('content')
    <div class="shadow mb-4 w-full p-md-5">
        <div class="container">
            <div class="row">
                <div class="col mr-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="display-6">Family Planning</h1>
                        <a href="{{ route('staff.family-planning.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add Family Planning Record
                        </a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <strong>Total:</strong>
                            </div>
                            <div class="h5 ms-1 mb-1.5 font-weight-bold text-gray-800" id="appointmentCount">
                            </div>
                        </div>
                        {{-- Search bar --}}
                        <x-searchBar placeholder="Search appointments..." />
                    </div>
                </div>

                <div class="card-body">
                    <div class="table table-responsive">
                        <table class="table table-hover" id="" width="100%" cellspacing="0">
                            <thead>
                                <tr class="table-light">
                                    {{-- <th>Date of Visit</th> --}}
                                    <th>Name</th>
                                    <th>FP Counseling</th>
                                    <th>FP Commodity</th>
                                    <th>Facility</th>
                                    <th>Follow up</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="">

                                @foreach ($familyPlannings as $familyPlanning)
                                    <tr>
                                        {{-- <td>
                                            {{ \Carbon\Carbon::parse($familyPlanning->created_at)->format('m/d/Y') }}
                                        </td> --}}
                                        <td>{{ $familyPlanning->name }}</td>
                                        {{-- <td>{{ $familyPlanning->age }}</td>
                                        <td>{{ $familyPlanning->contact }}</td>
                                        <td>{{ $familyPlanning->address }}</td> --}}
                                        <td>{{ $familyPlanning->fp_counseling }}</td>
                                        <td>{{ $familyPlanning->fp_commodity }}</td>
                                        <td>{{ $familyPlanning->facility }}</td>
                                        <td>{{ \Carbon\Carbon::parse($familyPlanning->date_of_follow_up)->format('m/d/Y') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('staff.family-planning.show', $familyPlanning->id) }}" 
                                               class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('staff.family-planning.edit', $familyPlanning->id) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
