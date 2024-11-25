<?php

namespace Modules\Ecommerce\Repositories;

use Modules\Ecommerce\Interfaces\ProductBrandInterface;
use Modules\Ecommerce\Models\ProductBrand;

class ProductBrandRepository implements ProductBrandInterface
{
    public function getAllBrands()
    {
        return ProductBrand::all();
    }

    public function getBrandById(int $id)
    {
        return ProductBrand::find($id);
    }

    public function createBrand(array $data)
    {
        // Create a new instance of the ProductBrand model
        $brand = new ProductBrand();

        // Assign required fields from the data array
        $brand->name = $data['name'] ?? null;
        $brand->description = $data['description'] ?? null;

        // Handle the logo upload
        if (isset($data['brand_logo']) && $data['brand_logo'] instanceof \Illuminate\Http\UploadedFile) {
            // Generate a unique file name with the original file extension
            $extension = $data['brand_logo']->getClientOriginalExtension();
            $uniqueFileName = 'logo_' . uniqid() . '.' . $extension; // or you can use Str::random(10) for a random string

            // Store the logo in the 'products/brand/logos' directory within the public folder
            $logoPath = $data['brand_logo']->storeAs('products/brand/logo', $uniqueFileName, 'public'); // Store in 'storage/app/public/products/brand/logos'
            $brand->logo = $logoPath; // Save the path to the database
        }

        $brand->meta_title = $data['meta_name'] ?? null;
        $brand->meta_description = $data['meta_description'] ?? null;
        $brand->keywords = $data['meta_keywords'] ?? null;
        $brand->status = 1; // Default status

        // Save the brand to the database and handle any exceptions
        try {
            $brand->save();
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => 'Failed to create brand.'], 500);
        }

        // Return the created brand instance
        return response()->json([
            'message' => 'Brand created successfully from repo'
        ]);
    }

    public function updateBrand(int $id, array $data)
    {
        $brand = ProductBrand::find($id);
        if ($brand) {
            $brand->update($data);
            return $brand;
        }
        return null; // or throw an exception
    }

    public function deleteBrand(int $id)
    {
        $brand = ProductBrand::find($id);
        if ($brand) {
            $brand->delete();
            return response()->json(['message' => 'Brand deleted successfully.'], 200);
        }
        return response()->json(['message' => 'Brand not found.'], 404); // Return a 404 if the brand is not found
    }

    public function updateStatus(int $id, bool $status)
    {
        $brand = ProductBrand::findOrFail($id);
        $brand->status = $status; // Assuming status is a boolean
        $brand->save();

        return response()->json(['message' => 'Brand status updated successfully.']);
    }
}
