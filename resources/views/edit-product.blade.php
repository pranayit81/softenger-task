@extends('layouts.master_layout')
@section('content')

  <div class="container">
      <div class="col-md-12">
        <h1>Edit product</h1>
          <div class=" mt-5">


            <form action="{{url('/updateProduct')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$product->id}}" name="product_id">
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Name</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter name" required name="name"  value="{{$product->name}}">
                </div>


                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Price</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter price" required name="price"  value="{{$product->price}}">
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">UPC</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter upc" required name="upc" value="{{$product->upc}}">
                </div>


                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="active" @if($product->status == 'active') selected @endif>Active</option>
                        <option value="inactive" @if($product->status == 'inactive') selected @endif>InActive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Image</label>
                    <input type="file" class="form-control" id="formGroupExampleInput" required name="image">

                    <input type="hidden" name="old_image"  value="{{$product->image}}">
                </div>
                <button type="submit" class="btn btn-primary">update</button>
            </form>

          </div>

      </div>
  </div>

@endsection



