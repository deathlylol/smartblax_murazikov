<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAll();

        return CategoryResource::collection($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->create($request->validated());

        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->categoryService->getById($id);
        if (!$category) return response()->json(['message' => 'Not Found'], 404);

        return new CategoryResource($category);
    }

    public function update(UpdateCategoryRequest $request, int $category_id)
    {
        $category = Category::findOrFail($category_id);
        $updated = $this->categoryService->update($category, $request->validated());

        return new CategoryResource($updated);
    }

    public function destroy(int $category_id): JsonResponse
    {
        $category = Category::findOrFail($category_id);
        $this->categoryService->delete($category);

        return response()->json(['message' => 'Deleted Successfully'], 200, );
    }
}
