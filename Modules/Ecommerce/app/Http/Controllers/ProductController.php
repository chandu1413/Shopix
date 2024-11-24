<?php

namespace Modules\Ecommerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ecommerce\Services\ProductService;

class ProductController extends Controller
{
    protected $ProductsService;

    public function __construct(ProductService $ProductsService)
    {
        $this->ProductsService = $ProductsService;
    }

    /**
     * Get all products with optional filters and pagination.
     *
     * @param Request $request
     * @param int $perPage
     * @param int $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $perPage = 10, $page = 1)
    {
        $filters = $request->query(); // Get filters from query parameters

        // Optionally, you can override perPage and page from request body or other sources
        // if ($request->has('per_page')) {
        //     $perPage = $request->input('per_page');
        // }

        $perPage = 10;
        
        if ($request->has('page')) {
            $page = $request->input('page');
        }

        $products = $this->ProductsService->getAllProducts($filters, $perPage, $page);

        return response()->json($products); // Return products as JSON
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ecommerce::products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
        ]);

        $customer = $this->ProductsService->createCustomer($validatedData);

        return response()->json($customer, 201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('ecommerce::products.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ecommerce::products.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
