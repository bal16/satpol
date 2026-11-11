<?php

namespace App\Http\Controllers\Admin;

use App\Data\CategoryData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index()
    {
        return redirect()->route('admin.gallery');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of($this->service->dataTableQuery())
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="cursor-pointer text-blue-500 hover:text-blue-700 edit-category-btn" data-id="'.$row->id.'" data-name="'.htmlspecialchars($row->name, ENT_QUOTES).'">Edit</button>';
                    $deleteBtn = '<button class="cursor-pointer text-red-500 hover:text-red-700 delete-category-btn ml-2" data-id="'.$row->id.'">Hapus</button>';

                    return $editBtn.$deleteBtn;
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

        return abort(403, 'Unauthorized action.');
    }

    public function list(Request $request)
    {
        $categories = $this->service->list($request->input('search', ''));

        return response()->json($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->service->create(CategoryData::fromArray($request->validated()));

            return response()->json(['message' => 'Kategori berhasil ditambahkan!'], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error storing category: '.$e->getMessage());

            return response()->json(['message' => 'Gagal menambahkan kategori. Silakan coba lagi.'], 500);
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $this->service->update($category, CategoryData::fromArray($request->validated()));

            return response()->json(['message' => 'Kategori berhasil diperbarui!'], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error updating category: '.$e->getMessage().' for category ID: '.$category->id);

            return response()->json(['message' => 'Gagal memperbarui kategori. Silakan coba lagi.'], 500);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $this->service->delete($category);

            return response()->json(['message' => 'Kategori berhasil dihapus!'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting category: '.$e->getMessage().' for category ID: '.$category->id);

            return response()->json(['message' => 'Gagal menghapus kategori. Silakan coba lagi.'], 500);
        }
    }
}
