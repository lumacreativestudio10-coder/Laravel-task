@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h2>Create New Bus Company</h2>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('bus-companies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Section 1: Company Information -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Section 1: Company Information</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Bus Company Name <span class="text-danger">*</span></label>
                    <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required placeholder="e.g. ABC Transport Service">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Company Logo</label>
                    <input type="file" name="logo" class="form-control" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Supported formats: JPG / PNG</small>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Company Address <span class="text-danger">*</span></label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Licence Number <span class="text-danger">*</span></label>
                    <input type="text" name="licence_number" class="form-control" value="{{ old('licence_number') }}" required>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Owner Information -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Section 2: Owner Information</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Owner Name</label>
                    <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name') }}" placeholder="e.g. Mohamed Ali">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Owner Mobile Number</label>
                    <!-- using oninput to strictly enforce numbers only as requested -->
                    <input type="text" name="owner_mobile" class="form-control" value="{{ old('owner_mobile') }}" placeholder="e.g. 077XXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Owner Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" name="owner_email" class="form-control" value="{{ old('owner_email') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: Bank Details -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Section 3: Bank Details</h5>
            <small>Used for bus company payment settlements.</small>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Bank Name</label>
                    <select name="bank_name" class="form-select">
                        <option value="">Select Bank</option>
                        <option value="Bank of Ceylon" {{ old('bank_name') == 'Bank of Ceylon' ? 'selected' : '' }}>Bank of Ceylon</option>
                        <option value="People's Bank" {{ old('bank_name') == "People's Bank" ? 'selected' : '' }}>People's Bank</option>
                        <option value="Commercial Bank" {{ old('bank_name') == 'Commercial Bank' ? 'selected' : '' }}>Commercial Bank</option>
                        <option value="Sampath Bank" {{ old('bank_name') == 'Sampath Bank' ? 'selected' : '' }}>Sampath Bank</option>
                        <option value="HNB" {{ old('bank_name') == 'HNB' ? 'selected' : '' }}>HNB</option>
                        <option value="Other" {{ old('bank_name') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Account Holder Name</label>
                    <input type="text" name="account_holder_name" class="form-control" value="{{ old('account_holder_name') }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Account Number</label>
                    <input type="text" name="account_number" class="form-control" value="{{ old('account_number') }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Branch</label>
                    @php
                        $provinces = [
                            'Central Province' => ['Kandy', 'Matale', 'Nuwara Eliya'],
                            'Eastern Province' => ['Ampara', 'Batticaloa', 'Trincomalee'],
                            'North Central Province' => ['Anuradhapura', 'Polonnaruwa'],
                            'North Western Province' => ['Kurunegala', 'Puttalam'],
                            'Northern Province' => ['Jaffna', 'Kilinochchi', 'Mannar', 'Mullaitivu', 'Vavuniya'],
                            'Sabaragamuwa Province' => ['Kegalle', 'Ratnapura'],
                            'Southern Province' => ['Galle', 'Hambantota', 'Matara'],
                            'Uva Province' => ['Badulla', 'Monaragala'],
                            'Western Province' => ['Colombo', 'Gampaha', 'Kalutara']
                        ];
                    @endphp
                    <select name="branch" class="form-select">
                        <option value="">Select Branch</option>
                        @foreach($provinces as $province => $districts)
                            <optgroup label="{{ $province }}">
                                @foreach($districts as $district)
                                    <option value="{{ $district }}" {{ old('branch') == $district ? 'selected' : '' }}>{{ $district }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 4: Commission Setup -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Section 4: Commission Setup</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Commission Type</label>
                    <select name="commission_type" class="form-select">
                        <option value="">Select Type</option>
                        <option value="Per Seat Amount" {{ old('commission_type') == 'Per Seat Amount' ? 'selected' : '' }}>Per Seat Amount</option>
                        <option value="Percentage (%)" {{ old('commission_type') == 'Percentage (%)' ? 'selected' : '' }}>Percentage (%)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Commission Amount</label>
                    <div class="input-group">
                        <input type="text" name="commission_amount" class="form-control" value="{{ old('commission_amount') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="e.g. 150">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="mb-5 d-flex gap-2">
        <button type="submit" class="btn btn-success btn-lg px-4">Save Company</button>
        <a href="{{ route('bus-companies.index') }}" class="btn btn-outline-secondary btn-lg px-4">Cancel</a>
    </div>
</form>
@endsection
