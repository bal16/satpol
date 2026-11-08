<?php

namespace App\Http\Controllers\Admin;

use App\Data\ServiceData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    public function __construct(private ServiceService $service) {}

    public function index()
    {
        return view('admin.services.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->service->dataTableQuery())
                ->addIndexColumn()
                ->addColumn('items_count', function ($row) {
                    return $row->items()->count();
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="'.route('admin.services.edit', $row->id).'" class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Edit</a> ';
                    $manageItemsBtn = '<button class="font-medium text-blue-600 dark:text-blue-500 hover:underline manage-items-btn ml-2 cursor-pointer" data-id="'.$row->id.'" data-title="'.htmlspecialchars($row->title, ENT_QUOTES).'">Kelola Item</button> ';
                    $deleteBtn = '<button class="cursor-pointer font-medium text-red-600 dark:text-red-500 hover:underline delete-service-btn ml-2" data-id="'.$row->id.'">Hapus</button>';

                    return $editBtn.$manageItemsBtn.$deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $service = new Service;

        return view('admin.services.create', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function store(StoreServiceRequest $request)
    {
        $this->service->create(
            ServiceData::fromArray($request->validated()),
            $request->file('image_src')
        );

        return redirect()->route('admin.services')->with('success', 'Kartu Informasi berhasil dibuat.');
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $this->service->update(
            $service,
            ServiceData::fromArray($request->validated()),
            $request->file('image_src')
        );

        return redirect()->route('admin.services')->with('success', 'Kartu Informasi berhasil diperbarui.');
    }

    public function destroy(Request $request, Service $service)
    {
        $this->service->delete($service);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['message' => 'Kartu Informasi berhasil dihapus.'], 200);
        }

        return redirect()->route('admin.services')->with('success', 'Kartu Informasi berhasil dihapus.');
    }
}
