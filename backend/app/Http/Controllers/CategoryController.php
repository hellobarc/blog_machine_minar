<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveCategoryRequest;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Response;

use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): JsonResponse 
    {
        $getData = $this->categoryRepository->getAll();
        $allData = CategoryResource::collection($getData);
        return response()->json([
            'data' => $allData,
        ]);
    }

    public function store(SaveCategoryRequest $request): JsonResponse 
    {
        $orderDetails = $request->only([
            'cat_name',
            'parent_id',
            'slug',
            'meta_keyword',
            'meta_description',
            'page_title',
            'thumbnail',
        ]);

        return response()->json(
            [
                'data' => $this->categoryRepository->create($orderDetails)
            ],
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request): JsonResponse 
    {
        $catId = $request->route('id');

        return response()->json([
            'data' => $this->categoryRepository->getById($catId)
        ]);
    }

    public function update(SaveCategoryRequest $request): JsonResponse 
    {
        $catId = $request->route('id');
        $categoryDetails = $request->only([
            'cat_name',
            'parent_id',
            'slug',
            'meta_keyword',
            'meta_description',
            'page_title',
            'thumbnail',
        ]);

        return response()->json([
            'data' => $this->categoryRepository->update($catId, $categoryDetails)
        ]);
    }

    public function destroy(Request $request): JsonResponse 
    {
        $catId = $request->route('id');
        $this->categoryRepository->delete($catId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
