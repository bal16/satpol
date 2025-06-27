<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('admin.gallery'); // Or your main category management page if separate
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->select(['id', 'name', 'created_at', 'updated_at']); // Ensure 'id' is selected
            return DataTables::of($data)
                ->addIndexColumn() // Adds DT_RowIndex
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="cursor-pointer text-blue-500 hover:text-blue-700 edit-category-btn" data-id="' . $row->id . '" data-name="' . htmlspecialchars($row->name, ENT_QUOTES) . '">Edit</button>';
                    $deleteBtn = '<button class="cursor-pointer text-red-500 hover:text-red-700 delete-category-btn ml-2" data-id="' . $row->id . '">Hapus</button>';
                    return $editBtn . $deleteBtn;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d-m-Y H:i:s') : '-';
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d-m-Y H:i:s') : '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // If not AJAX, or for a fallback, you can redirect or show an error
        return abort(403, 'Unauthorized action.');
    }

    /**
     * Display a listing of the resource for select dropdowns.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $search = $request->input('search', '');
        $categories = Category::where('name', 'LIKE', "%{$search}%")->select('id', 'name')->get();
        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create($request->validated());
            return response()->json(['message' => 'Kategori berhasil ditambahkan!'], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error storing category: ' . $e->getMessage());
            return response()->json(['message' => 'Gagal menambahkan kategori. Silakan coba lagi.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        // Not typically used if details are handled via modals or not needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // Not typically used if editing is handled via modals
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->update($request->validated());
            return response()->json(['message' => 'Kategori berhasil diperbarui!'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage() . ' for category ID: ' . $category->id);
            return response()->json(['message' => 'Gagal memperbarui kategori. Silakan coba lagi.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Optional: Check if the category is being used by any gallery items
            // if ($category->galleries()->exists()) { // Assuming you have a 'galleries' relationship in your Category model
            //      return response()->json(['message' => 'Kategori tidak dapat dihapus karena masih digunakan oleh item galeri.'], 409); // 409 Conflict
            // }

            $category->delete();
            return response()->json(['message' => 'Kategori berhasil dihapus!'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage() . ' for category ID: ' . $category->id);
            return response()->json(['message' => 'Gagal menghapus kategori. Silakan coba lagi.'], 500);
        }
    }
}