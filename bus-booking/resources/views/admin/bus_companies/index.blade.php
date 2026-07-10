@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Bus Companies</h2>
    <a href="{{ route('bus-companies.create') }}" class="btn btn-primary">Create New Company</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Logo</th>
                        <th>Company Name</th>
                        <th>Owner Name</th>
                        <th>Mobile Number</th>
                        <th>Licence Number</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr>
                            <td>
                                @if($company->logo)
                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="50" height="50" class="rounded-circle object-fit-cover">
                                @else
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">N/A</div>
                                @endif
                            </td>
                            <td>{{ $company->company_name }}</td>
                            <td>{{ $company->owner_name ?? '-' }}</td>
                            <td>{{ $company->owner_mobile ?? '-' }}</td>
                            <td>{{ $company->licence_number }}</td>
                            <td>
                                @if($company->commission_amount)
                                    {{ $company->commission_type == 'Percentage (%)' ? $company->commission_amount . '%' : 'Rs.' . $company->commission_amount }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('bus-companies.toggleStatus', $company->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm rounded-pill {{ $company->status ? 'btn-success' : 'btn-danger' }}">
                                        {{ $company->status ? '🟢 Active' : '🔴 Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('bus-companies.show', $company->id) }}" class="btn btn-sm btn-info text-white">View</a>
                                <a href="{{ route('bus-companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No bus companies found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
