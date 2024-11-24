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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $filters = $request->query(); // Get filters from query parameters
        $perPage = $request->input('per_page', 10); // Default items per page
        $page = $request->input('page', 1); // Default page number

        // Call the service to get products
        $products = $this->ProductsService->getAllProducts($filters, $perPage, $page);

        return response()->json($products); // Return products as JSON
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ecommerce::product.product.create');
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
        return view('ecommerce::product.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('ecommerce::product.products.edit');
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
