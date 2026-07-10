@extends('layouts.admin')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <h2>Company Profile: {{ $company->company_name }}</h2>
    <div>
        <a href="{{ route('bus-companies.edit', $company->id) }}" class="btn btn-warning">Edit Profile</a>
        <a href="{{ route('bus-companies.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="row">
    <!-- Company Details -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Company Details</h5>
            </div>
            <div class="card-body text-center">
                @if($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="rounded mb-3 object-fit-cover" style="width: 120px; height: 120px; border: 2px solid #ccc;">
                @else
                    <div class="bg-secondary text-white rounded d-inline-flex align-items-center justify-content-center mb-3" style="width: 120px; height: 120px; font-size: 24px;">N/A</div>
                @endif
                <h4>{{ $company->company_name }}</h4>
                <p class="text-muted">{{ $company->status ? '🟢 Active' : '🔴 Inactive' }}</p>
                <hr>
                <div class="text-start">
                    <p><strong>Address:</strong><br> {{ $company->address }}</p>
                    <p><strong>Licence Number:</strong> {{ $company->licence_number }}</p>
                    <p><strong>Created On:</strong> {{ $company->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Owner Details -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Owner Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Owner Name:</th>
                        <td>{{ $company->owner_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Mobile Number:</th>
                        <td>{{ $company->owner_mobile ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Email Address:</th>
                        <td>{{ $company->owner_email ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Bank Details -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Bank Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Bank Name:</th>
                        <td>{{ $company->bank_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Account Holder:</th>
                        <td>{{ $company->account_holder_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Account Number:</th>
                        <td>{{ $company->account_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Branch:</th>
                        <td>{{ $company->branch ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- Commission Settings -->
    <div class="col-md-6 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Commission Setup</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Commission Type:</th>
                        <td>{{ $company->commission_type ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Commission Amount:</th>
                        <td>
                            @if($company->commission_amount)
                                {{ $company->commission_type == 'Percentage (%)' ? $company->commission_amount . '%' : 'Rs.' . $company->commission_amount }}
                                @if($company->commission_type == 'Per Seat Amount') /seat @endif
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
