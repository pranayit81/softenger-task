@extends('layouts.master_layout')
@section('content')

    <div class="container">
        <div class="col-md-12">
            <h1>Products</h1>
            <div class=" mt-5">


                <table class="table">
                    <thead>
                    <tr>
                        <td>Select</td>
                        <th>Id</th>
                        <th>name</th>
                        <th>price</th>
                        <th>upc</th>
                        <th>status</th>
                        <th>image</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($allProducts) > 0)
                        @foreach ($allProducts as $product )
                            <tr>
                                <td><input type="checkbox" class="product_checkbox" data-emp-id="{{$product->id}}"></td>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->upc}}</td>
                                <td>{{$product->status}}</td>
                                <td>
                                    @if (!empty($product->image))
                                        <img
                                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/Image_created_with_a_mobile_phone.png/1200px-Image_created_with_a_mobile_phone.png"
                                            alt="" width="50" height="50">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <th><a href="{{url('editProduct').'/'.$product->id}}">edit</a></th>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add product
            </button>

            <a href="#" id="delete_records" class="btn btn-danger float-right">Delete Bulk Records</a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Enter product details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{url('/postProduct')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                           placeholder="Enter name" required name="name">
                                </div>


                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                           placeholder="Enter price" required name="price">
                                </div>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">UPC</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput"
                                           placeholder="Enter upc" required name="upc">
                                </div>


                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="active">Active</option>
                                        <option value="inactive">InActive</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="formGroupExampleInput" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="formGroupExampleInput" required
                                           name="image">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">save</button>
                        </div>
                    </div>
                </div>
            </div>

            </form>

        </div>
    </div>


    <script>

        $('#delete_records').on('click', function (e) {
            var product = [];
            $(".product_checkbox:checked").each(function () {
                product.push($(this).data('emp-id'));
            });
            if (product.length <= 0) {
                alert("Please select records.");
            } else {
                profiles_delete = "Are you sure you want to delete " + (product.length > 1 ? "these" : "this") + " " + (product.length > 1 ? "user's" : "user") + "?";
                var checked = confirm(profiles_delete);
                if (checked == true) {
                    var selected_values = product.join(",");
                    $.ajax({
                        type: "POST",
                        url: "{{url('bulk-delete')}}",
                        cache: false,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "emp_id": selected_values,

                        },
                        success: function (response) {
                            $("html,body").animate({scrollTop: $("body").offset().top}, "1000");

                            if (response.status == "success") {
                                $("#javascript_alert_msg").css("display", "block");
                                $("#javascript_alert_msg").slideDown().html('<div class="alert alert-success custom-alert-success   alert-block text-center"><button type="button" class="close custom-alert-close" data-dismiss="alert">×</button><span>' + response['msg'] + '</span></div>').delay(3000).slideUp('fast');
                                $('#user_tbl').load(location.href + ' #user_tbl');
                            }
                            if (response.status == "error") {
                                $("#javascript_alert_msg").css("display", "block");
                                $("#javascript_alert_msg").slideDown().html('<div class="alert alert-danger custom-alert-danger  text-center"><button type="button" class="close custom-alert-close" data-dismiss="alert">×</button><span>' + response['msg'] + '</span></div>').delay(3000).slideUp('fast');

                                $('#user_tbl').load(location.href + ' #user_tbl');

                            }
                            setTimeout(function () {
                                location.reload(true);
                            }, 3000)
                        }
                    });
                }
            }
        });
    </script>



@endsection

