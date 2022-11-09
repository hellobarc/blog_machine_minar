<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Response;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) 
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): JsonResponse 
    {
        return response()->json([
            'data' => $this->categoryRepository->getAll()
        ]);
    }

    public function store(Request $request): JsonResponse 
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
        $orderId = $request->route('id');

        return response()->json([
            'data' => $this->categoryRepository->getById($orderId)
        ]);
    }

    public function update(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');
        $orderDetails = $request->only([
            'client',
            'details'
        ]);

        return response()->json([
            'data' => $this->categoryRepository->update($orderId, $orderDetails)
        ]);
    }

    public function destroy(Request $request): JsonResponse 
    {
        $orderId = $request->route('id');
        $this->categoryRepository->delete($orderId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
