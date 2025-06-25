<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    public function index()
    {
        return view('admin.services.index');
    }

    /**
     * Returns data for DataTables.
     */
    public function data(Request $request)
    {
        if ($request->ajax()) { // This method is still used by index.blade.php for DataTables
            $data = Service::latest(); // Urutkan berdasarkan data terbaru

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('body', function ($row) {
                    // Ubah objek RichText menjadi string HTML sebelum dikirim ke DataTables
                    return (string) $row->body;
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . route('admin.services.edit', $row->id) . '" class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Edit</a>';
                    $deleteBtn = '<button class="font-medium text-red-600 dark:text-red-500 hover:underline delete-service-btn ml-2" data-id="' . $row->id . '">Hapus</button>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $service = new Service();
        return view('admin.services.create', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image_src' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk upload file
            'card_id' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('image_src')) {
            $path = $request->file('image_src')->store('services_images', 'public');
            $data['image_src'] = $path; // Simpan path relatif ke storage
        }

        Service::create($data);

        return redirect()->route('admin.services')->with('success', 'Kartu Informasi berhasil dibuat.');
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'image_src' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'nullable' karena tidak selalu diupdate
            'card_id' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Handle file upload for update
        if ($request->hasFile('image_src')) {
            // Hapus gambar lama jika ada
            if ($service->image_src && Storage::disk('public')->exists($service->image_src)) {
                Storage::disk('public')->delete($service->image_src);
            }
            $path = $request->file('image_src')->store('services_images', 'public');
            $data['image_src'] = $path;
        }

        $service->update($data);

        return redirect()->route('admin.services')->with('success', 'Kartu Informasi berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        // Hapus gambar terkait saat service dihapus
        if ($service->image_src && Storage::disk('public')->exists($service->image_src)) {
            Storage::disk('public')->delete($service->image_src);
        }
        $service->delete(); // Items will be deleted automatically due to onDelete('cascade')

        // For AJAX requests from the index page
        if (request()->ajax()) {
            return response()->json(['message' => 'Kartu Informasi berhasil dihapus.'], 200);
        }

        return redirect()->route('admin.services')->with('success', 'Kartu Informasi berhasil dihapus.');
    }
}
