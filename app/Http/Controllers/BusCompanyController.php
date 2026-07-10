<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusCompany;

class BusCompanyController extends Controller
{
    public function index()
    {
        $companies = BusCompany::orderBy('created_at', 'desc')->get();
        return view('admin.bus_companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.bus_companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string',
            'licence_number' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'owner_mobile' => 'nullable|numeric',
            'owner_email' => 'nullable|email',
            'bank_name' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|numeric',
            'branch' => 'nullable|string|max:255',
            'commission_type' => 'nullable|in:Per Seat Amount,Percentage (%)',
            'commission_amount' => 'nullable|numeric',
        ]);

        $data = $request->all();
        $data['status'] = true; // default active

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        BusCompany::create($data);

        return redirect()->route('bus-companies.index')->with('success', 'Bus company created successfully.');
    }

    public function show($id)
    {
        $company = BusCompany::findOrFail($id);
        return view('admin.bus_companies.show', compact('company'));
    }

    public function edit($id)
    {
        $company = BusCompany::findOrFail($id);
        return view('admin.bus_companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $company = BusCompany::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required|string',
            'licence_number' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'owner_mobile' => 'nullable|numeric',
            'owner_email' => 'nullable|email',
            'bank_name' => 'nullable|string|max:255',
            'account_holder_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|numeric',
            'branch' => 'nullable|string|max:255',
            'commission_type' => 'nullable|in:Per Seat Amount,Percentage (%)',
            'commission_amount' => 'nullable|numeric',
        ]);

        $data = $request->except(['logo']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);

        return redirect()->route('bus-companies.index')->with('success', 'Bus company updated successfully.');
    }

    public function toggleStatus($id)
    {
        $company = BusCompany::findOrFail($id);
        $company->status = !$company->status;
        $company->save();

        return redirect()->route('bus-companies.index')->with('success', 'Company status updated.');
    }
}
