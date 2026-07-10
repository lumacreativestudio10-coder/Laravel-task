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
                        $districts = [
                            'Ampara', 'Anuradhapura', 'Badulla', 'Batticaloa', 'Colombo', 'Galle', 'Gampaha', 'Hambantota', 
                            'Jaffna', 'Kalutara', 'Kandy', 'Kegalle', 'Kilinochchi', 'Kurunegala', 'Mannar', 'Matale', 
                            'Matara', 'Monaragala', 'Mullaitivu', 'Nuwara Eliya', 'Polonnaruwa', 'Puttalam', 'Ratnapura', 
                            'Trincomalee', 'Vavuniya'
                        ];
                    @endphp
                    <select name="branch" class="form-select">
                        <option value="">Select Branch</option>
                        @foreach($districts as $district)
                            <option value="{{ $district }}" {{ old('branch') == $district ? 'selected' : '' }}>{{ $district }}</option>
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
            <div id="commissionExample" class="alert alert-secondary py-2 mb-3" style="font-size: 0.9rem;">
                <strong>Example Calculation:</strong><br>
                Enter commission amount to see calculation.
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Commission Type</label>
                    <select name="commission_type" id="commissionType" class="form-select">
                        <option value="">Select Type</option>
                        <option value="Per Seat Amount" {{ old('commission_type') == 'Per Seat Amount' ? 'selected' : '' }}>Per Seat Amount</option>
                        <option value="Percentage (%)" {{ old('commission_type') == 'Percentage (%)' ? 'selected' : '' }}>Percentage (%)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Commission Amount</label>
                    <input type="number" step="0.01" name="commission_amount" id="commissionAmount" class="form-control" value="{{ old('commission_amount') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 d-flex gap-2">
        <button type="submit" class="btn btn-success btn-lg px-5">Save Company</button>
        <a href="{{ route('bus-companies.index') }}" class="btn btn-secondary btn-lg px-4">Cancel</a>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const typeSelect = document.getElementById('commissionType');
        const amountInput = document.getElementById('commissionAmount');
        const exampleBox = document.getElementById('commissionExample');

        function updateExample() {
            const type = typeSelect.value;
            const amount = parseFloat(amountInput.value);
            const ticketPrice = 2500; // Base example ticket price

            if (!type || isNaN(amount) || amount <= 0) {
                exampleBox.innerHTML = `<strong>Example Calculation:</strong><br>Enter commission type and amount to see how much the Bus Company will receive. (Assume Ticket Price = Rs.2500)`;
                return;
            }

            let commissionRs = 0;
            let displayCommission = '';

            if (type === 'Per Seat Amount') {
                commissionRs = amount;
                displayCommission = `Rs. ${amount}`;
            } else if (type === 'Percentage (%)') {
                commissionRs = (ticketPrice * amount) / 100;
                displayCommission = `${amount}% (Rs. ${commissionRs})`;
            }

            const companyReceives = ticketPrice - commissionRs;

            exampleBox.innerHTML = `
                <strong>Example Calculation (For a Rs.2500 Ticket):</strong><br>
                Ticket Price: Rs.2500 | Platform Commission: ${displayCommission} <br>
                <strong class="text-success">Bus Company Receives: Rs. ${companyReceives}</strong>
            `;
        }

        typeSelect.addEventListener('change', updateExample);
        amountInput.addEventListener('input', updateExample);
        
        // Run once on load
        updateExample();
    });
</script>
@endsection
