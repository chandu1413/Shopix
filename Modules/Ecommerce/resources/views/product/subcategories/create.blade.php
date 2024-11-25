{{-- @ extends('dashboard::admin.master') --}}
@extends('dashboard::adminlte.master')

@section('content-head')
    <div class="row ">
        <div class="col-sm-6 ">
            <h3 class="mb-0">Add Product</h3>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Product List</a>
        </div>
    </div> <!--end::Row-->
    <div class=" d-flex justify-content-start ">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Add Product
            </li>
        </ol>
    </div> <!-- /.card-header -->
@endsection

@section('content')
    <div class="card card-info card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Add Product</div>
        </div> <!--end::Header--> <!--begin::Form-->
        <form method="POST" action="{{ route('products.store') }}" class="needs-validation" novalidate
            enctype="multipart/form-data">
            @csrf

            <div class="card-body"> <!--begin::Row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->

                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="description" class="form-label">Product Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="5" required></textarea>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->

                    </div>

                    <div class="col-md-6">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="images" class="form-label">Product Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>

                </div> <!--end::Row-->

                <div class="row">

                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="sku" class="form-label">SKU (Stock Keeping Unit)</label>
                            <input type="text" class="form-control" id="sku" name="sku" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="category" class="form-label">Product Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="" disabled selected>Select a category</option>
                                <option value="electronics">Electronics</option>
                                <option value="clothing">Clothing</option>
                                <option value="home_goods">Home Goods</option>
                                <!-- Add more categories as needed -->
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                required>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="discount_price" class="form-label">Discount Price (if applicable)</label>
                            <input type="number" class="form-control" id="discount_price" name="discount_price"
                                step="0.01">
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>


                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-control" id="currency" name="currency" required>
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                                <!-- Add more currencies as needed -->
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="quantity" class="form-label">Quantity in Stock</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="stock_status" class="form-label">Stock Status</label>
                            <select class="form-control" id="stock_status" name="stock_status" required>
                                <option value="in_stock">In Stock</option>
                                <option value="out_of_stock">Out of Stock</option>
                                <option value="pre_order">Available for Pre-order</option>
                            </select>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="variants" class="form-label">Product Variants</label>
                            <input type="text" class="form-control" id="variants" name="variants"
                                placeholder="e.g., Size, Color">
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="weight" class="form-label">Weight</label>
                            <input type="text" class="form-control" id="weight" name="weight"
                                placeholder="e.g., 1.5 kg">
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="dimensions" class="form-label">Dimensions</label>
                            <input type="text" class="form-control" id="dimensions" name="dimensions"
                                placeholder="e.g., 10x5x3 cm">
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="tags" class="form-label">Tags/Keywords</label>
                            <input type="text" class="form-control" id="tags" name="tags"
                                placeholder="e.g., headphones, wireless">
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="shipping_info" class="form-label">Shipping Information</label>
                            <textarea class="form-control" name="shipping_info" id="shipping_info" cols="30" rows="3"></textarea>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="return_policy" class="form-label">Return Policy</label>
                            <textarea class="form-control" name="return_policy" id="return_policy" cols="30" rows="3"></textarea>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="technical_specs" class="form-label">Technical Specifications</label>
                            <textarea class="form-control" name="technical_specs" id="technical_specs" cols="30" rows="3"></textarea>
                            <div class=" valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="compatibility_info" class="form-label">Compatibility Information</label>
                            <textarea class="form-control" name="compatibility_info" id="compatibility_info" cols="30" rows="3"></textarea>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="compliance_info" class="form-label">Compliance Information</label>
                            <textarea class="form-control" name="compliance_info" id="compliance_info" cols="30" rows="3"></textarea>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>

            </div> <!--end::Body--> <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn btn-info" type="submit">Submit form</button>
            </div> <!--end::Footer-->
        </form> <!--end::Form-->
    </div> <!--end::Form Validation-->

    <script type="text/javascript">
        /*------------------------------------------
                                      --------------------------------------------
                                      Form Submit Event
                                      --------------------------------------------
                                      --------------------------------------------*/
        $('form').submit(function(e) {
            e.preventDefault();

            var url = $(this).attr("action");
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    alert('Product added successfully.');
                    location.reload(); // Reload the page to see the updated list
                },
                error: function(response) {
                    $(this).find(".print-error-msg").find("ul").html('');
                    $(this).find(".print-error-msg").css('display', 'block');
                    $.each(response.responseJSON.errors, function(key, value) {
                        $(this).find(".print-error-msg").find("ul").append('<li>' + value[0] +
                            '</li>');
                    });
                }
            });
        });
    </script>
@endsection
