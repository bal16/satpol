<?php

namespace App\Http\Controllers\Admin;

use App\Data\ServiceItemData;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceItemController extends Controller
{
    public function __construct(private ServiceService $service) {}

    public function data(Request $request, Service $service)
    {
        if ($request->ajax()) {
            return DataTables::of($this->service->itemsDataTableQuery($service))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline edit-item-btn" data-id="'.$row->id.'">Edit</button>';
                    $deleteBtn = '<button class="font-medium text-red-600 dark:text-red-500 hover:underline delete-item-btn ml-2" data-id="'.$row->id.'">Hapus</button>';

                    return $editBtn.$deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'href' => 'nullable|url',
        ]);

        $this->service->createItem($service, ServiceItemData::fromArray($validated));

        return response()->json(['message' => 'Item berhasil ditambahkan!'], 201);
    }

    public function update(Request $request, ServiceItem $item)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'href' => 'nullable|url',
        ]);

        $this->service->updateItem($item, ServiceItemData::fromArray($validated));

        return response()->json(['message' => 'Item berhasil diperbarui!'], 200);
    }

    public function destroy(ServiceItem $item)
    {
        $this->service->deleteItem($item);

        return response()->json(['message' => 'Item berhasil dihapus!'], 200);
    }
}
