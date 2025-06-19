<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SOP;
use Illuminate\Http\Request;

class SOPController extends Controller
{
    
    public function index()
    {
        return view('admin.profile.sop', [
            'items' => SOP::all(),
        ]);
    }
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ];

        $validatedData = $request->validate($rules);

        SOP::create([
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
        ]);

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
        $rules = [
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ];

        $validatedData = $request->validate($rules);

        $sop->update([
            'title' => $validatedData['title'],
            'link' => $validatedData['link'],
        ]);

        return redirect()->route('admin.profile.aop')->with('success', 'Profile item berhasil diperbarui.');
    }

    public function destroy(SOP $sop)
    {
        SOP::destroy($sop->id);

        return redirect(route('admin.profile.sop'))->with('success', 'Berita berhasil dihapus.');
    }
}