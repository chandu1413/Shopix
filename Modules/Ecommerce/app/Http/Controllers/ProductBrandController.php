<?php

namespace Modules\Ecommerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
// use Modules\Ecommerce\Models\ProductBrand;
use Modules\Ecommerce\Repositories\ProductBrandRepository;
use Modules\Ecommerce\Services\ProductBrandService;

class ProductBrandController extends Controller
{
    protected $productBrandService;
    protected $ProductBrandRepository;

    public function __construct(
        ProductBrandService $productBrandService,
        ProductBrandRepository $ProductBrandRepository
    ) {
        $this->productBrandService = $productBrandService;
        $this->ProductBrandRepository = $ProductBrandRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = $this->productBrandService->getAllBrands();
        // dd($brands);
        return view('ecommerce::product.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ecommerce::product.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $this->validateStoreBrand($request);

        try {
            // Create the brand using the repository
            $brand = $this->productBrandService->createBrand($validatedData);
            return response()->json([
                'message' => 'Brand created successfully.',
                'brand' => $brand,
            ], 201);
        } catch (Exception $e) {
            // Return a JSON response with the error message
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $brands = $this->productBrandService->getBrandById($id);
        return response()->json($brands);
    }

    public function getAllBrands()
    {
        $brands = $this->productBrandService->getAllBrands();
        return response()->json($brands);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ecommerce::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            // Add other validation rules as needed
        ]);

        $brand = $this->productBrandService->updateBrand($id, $data);
        return response()->json($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleteBrand = $this->ProductBrandRepository->deleteBrand($id);
        return  $deleteBrand;
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the status
        $request->validate([
            'status' => 'required|boolean', // Assuming status is a boolean
        ]);

        // Update the status using the repository
        return $this->ProductBrandRepository->updateStatus($id, $request->status);
    }

    /**
     * Validate the brand request.
     *
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateStoreBrand(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'], // Only name is required
            'description' => ['nullable', 'string'], // Optional
            'meta_name' => ['nullable', 'string'], // Optional
            'meta_description' => ['nullable', 'string'], // Optional
            'meta_keywords' => ['nullable', 'string'], // Optional
            'brand_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Optional: Validate if an image is uploaded
        ]);
    }
}
