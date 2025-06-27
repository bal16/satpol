<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceItemController extends Controller
{
    /**
     * Returns data for DataTables for a specific service's items.
     */
    public function data(Request $request, Service $service)
    {
        if ($request->ajax()) {
            $data = $service->items()->latest(); // Order by creation date (default)

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline edit-item-btn" data-id="' . $row->id . '">Edit</button>';
                    $deleteBtn = '<button class="font-medium text-red-600 dark:text-red-500 hover:underline delete-item-btn ml-2" data-id="' . $row->id . '">Hapus</button>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Store a newly created service item in storage.
     */
    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'href' => 'nullable|url',
        ]);

        $service->items()->create($validated);

        return response()->json(['message' => 'Item berhasil ditambahkan!'], 201);
    }

    /**
     * Update the specified service item in storage.
     */
    public function update(Request $request, ServiceItem $item)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'href' => 'nullable|url',
        ]);

        $item->update($validated);

        return response()->json(['message' => 'Item berhasil diperbarui!'], 200);
    }

    /**
     * Remove the specified service item from storage.
     */
    public function destroy(ServiceItem $item)
    {
        $item->delete();

        return response()->json(['message' => 'Item berhasil dihapus!'], 200);
    }
}