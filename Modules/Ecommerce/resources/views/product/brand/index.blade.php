{{-- @extends('dashboard::admin.master') --}}
@extends('dashboard::adminlte.master')

@section('content-head')
    <div class="row ">
        <div class="col-sm-6 ">
            <h3 class="mb-0">Product Brands</h3>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back to Product List</a>
        </div>
    </div> <!--end::Row-->
    <div class="d-flex justify-content-start ">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Brands
            </li>
        </ol>
    </div> <!-- /.card-header -->
    <style>
         .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    
@endsection

@section('content')
    <div class="card card-info card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Brand</div>
        </div> <!--end::Header--> <!--begin::Form-->
        <form id="brand-form" class="needs-validation brand-form" enctype="multipart/form-data">
            @csrf

            <div class="card-body"> <!--begin::Row-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="g-3 p-2"> <!--begin::Col-->
                            <label for="name" class="form-label"> Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->

                        <div class="g-3 p-2"> <!--begin::Col-->
                            <label for="description" class="form-label">Product Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="2"></textarea>
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->

                        <div class="g-3 p-2 ">
                            <h6>Meta Details</h6>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="g-3 p-4"> <!--begin::Col-->
                            <label for="brand_logo" class="form-label">Brand Logo</label>
                            <input type="file" class="form-control" id="brand_logo" name="brand_logo">
                            <div class="valid-feedback">Looks good!</div>
                        </div> <!--end::Col-->
                    </div>

                </div> <!--end::Row-->

                <div class="row">
                    <div class="col-md-4">
                        <div class="g-3 p-2"> <!--begin::Col-->
                            <label for="meta_name" class="form-label">Meta Name</label>
                            <input type="text" class="form-control" id="meta_name" name="meta_name">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="g-3 p-2"> <!--begin::Col-->
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <input type="text" class="form-control" id="meta_description" name="meta_description">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="g-3 p-2"> <!--begin::Col-->
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                    </div>
                </div>

            </div> <!--end::Body--> <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn m-2" type="reset">Reset</button>
                <button class="btn btn-info m-2" type="submit">Submit form</button>
            </div> <!--end::Footer-->
        </form> <!--end::Form-->
    </div> <!--end::Form Validation-->

    <div class="print-error-msg" style="display:none;">
        <ul></ul>
    </div>



    <div class="card mb-4">

        <div class="card-body">
            <table id="brandTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Brand data will be appended here -->
                </tbody>
            </table>
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
                <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
            </ul>
        </div>
    </div> <!-- /.card -->






    <script>
        $(document).ready(function() {
            function getAllBrands() {
                $.ajax({
                    url: "{{ route('brand.getAllBrands') }}", // The route defined above
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Loop through the data and append to a table or list
                        $.each(data, function(index, brand) {
                            $('#brandTable tbody').append(`
                                <tr>
                                    <td>${brand.id}</td>
                                    <td>${brand.name}</td>
                                    <td>${brand.description}</td>
                                    <td>${brand.created_at}</td>
                                   <td>
                                        <label class="switch">
                                            <input type="checkbox" data-id="${brand.id}" ${brand.status ? 'checked' : ''}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger delete-button" onclick="deleteBrand(${brand.id}, this)">Delete</button>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching brands:', error);
                    }
                });
            }
            // Call getAllBrands on page load
            getAllBrands();
        });

        $(document).on('change', 'input[type="checkbox"]', function() {
            let brandId = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0; // Assuming 1 for active and 0 for inactive
            let csrfToken = '{{ csrf_token() }}';

            $.ajax({
                type: 'POST',
                url: `{{ route('brand.updateStatus', ':id') }}`.replace(':id', brandId),
                data: {
                    _token: csrfToken,
                    status: status
                },
                success: function(data) {
                    alert(data.message);
                    // Optionally, you can update the UI based on the response
                },
                error: function(err) {
                    console.error('Error updating status:', err);
                    alert('Failed to update status.');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.deleteBrand = function(brandId, buttonElement) {
                // Get CSRF token
                let csrfToken = '{{ csrf_token() }}';

                $.ajax({
                    type: 'DELETE', // Use DELETE for delete actions
                    url: `{{ route('brand.destroy', ':id') }}`.replace(':id', brandId),
                    data: {
                        _token: csrfToken // Include CSRF token
                    },
                    success: function(data) {
                        alert(data.message);
                        // getAllBrands() // Refresh the brand list
                        // Optionally remove the brand from the DOM
                        $(buttonElement).closest('tr')
                            .remove(); // Assuming the brand is in a table row
                    },
                    error: function(err) {
                        const error = JSON.parse(err.responseText).message;
                        $('.error').html(error);
                    }
                });
            };
        });
    </script>






    {{-- store brand script --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#brand-form').submit(function(e) {
                e.preventDefault();

                var url = "{{ route('brand.store') }}";
                let formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        alert(response.message);
                        console.log(response.message);
                        // Clear the form
                        $(this)[0].reset(); // Reset the form

                    },
                    error: (response) => {
                        $(".print-error-msg").find("ul").html('');
                        $(".print-error-msg").css('display', 'block');

                        if (response.responseJSON.errors) {
                            $.each(response.responseJSON.errors, function(key, value) {
                                $(".print-error-msg").find("ul").append('<li>' + value[
                                    0] + '</li>');
                            });
                        } else {
                            $(".print-error-msg").find("ul").append('<li>' + response
                                .responseJSON.error + '</li>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
