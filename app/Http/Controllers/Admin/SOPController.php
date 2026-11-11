<?php

namespace App\Http\Controllers\Admin;

use App\Data\SopData;
use App\Http\Controllers\Controller;
use App\Models\SOP;
use App\Services\SopService;
use Illuminate\Http\Request;

class SOPController extends Controller
{
    public function __construct(private SopService $service) {}

    public function index()
    {
        return view('admin.profile.sop', [
            'items' => $this->service->list(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        $this->service->create(SopData::fromArray($validated));

        return redirect()->route('admin.profile.sop')->with('success', 'Profile item berhasil dibuat.');
    }

    public function edit(SOP $sop)
    {
        return view('admin.profile.sop', [
            'item' => $sop,
        ]);
    }

    public function update(Request $request, SOP $sop)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        $this->service->update($sop, SopData::fromArray($validated));

        return redirect()->route('admin.profile.sop')->with('success', 'SOP item berhasil diperbarui.');
    }

    public function destroy(SOP $sop)
    {
        $this->service->delete($sop);

        return redirect()->route('admin.profile.sop')->with('success', 'SOP berhasil dihapus.');
    }
}
