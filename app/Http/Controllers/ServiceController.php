<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:services,name',
        'fee' => 'required|numeric|min:0',
    ]);

    Service::create($validated);
    return redirect()->route('services.index')
        ->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:services,name,' . $service->id,
        'fee' => 'required|numeric|min:0',
    ]);

    $service->update($validated);
    return redirect()->route('services.index')
        ->with('success', 'Service updated successfully!');
    }
public function destroy(Service $service)
    {
    if ($service->appointments()->exists()) {
        return redirect()->route('services.index')
            ->with('error', 'Service cannot be deleted because it has existing appointments!');
    }

    $service->delete();

    return redirect()->route('services.index')
        ->with('success', 'Service deleted successfully!');
    }
}