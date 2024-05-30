@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">EDIT PRODUCT BUNDLE</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif
                    <form action="{{route('product-bundle.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="name" class="col-sm-3 col-form-label">Bundle name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="hidden" class="form-control" name="id" id="id" value="{{ !empty($product_bundles->id) ? $product_bundles->id : '' }}">
                                            <input type="text" class="form-control" name="name" id="name" value="{{ !empty($product_bundles->name) ? $product_bundles->name : '' }}" placeholder="Enter Bundles Name here">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="title" class="col-sm-3 col-form-label">Title</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title" id="title" value="{{ !empty($product_bundles->title) ? $product_bundles->title : '' }}" placeholder="Enter Title here">
                                            @if ($errors->has('title'))
                                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="products" class="col-sm-3 col-form-label">Product</label></strong>
                                        <select class="form-control select2" name="products[]" id="products[]" multiple>
                                            @forelse($products as $product)
                                                <option value="{{ $product->id }}" {{ $selected_products->contains($product->id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                             @empty
                                            @endforelse
                                        </select>
                                        @if ($errors->has('products'))
                                            <span class="text-danger">{{ $errors->first('products') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="category_id" class="col-sm-3 col-form-label">Category</label></strong>
                                        <select class="form-control select2" name="category_id" id="category_id">
                                            <option value="" selected disabled >Select Category</option>
                                            @forelse($categories as $category)
                                                <option value="{{ $category['id'] }}" {{ $product_bundles->category_id  == $category['id'] ? 'selected' : ''}} >{{ $category['name'] }}</option>
                                                @empty
                                            @endforelse
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="discount" class="col-sm-3 col-form-label">Discount</label></strong>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" name="discount" id="discount" value="{{ !empty($product_bundles->discount) ? $product_bundles->discount : '' }}" placeholder="Enter Discount here">
                                            @if ($errors->has('discount'))
                                                <span class="text-danger">{{ $errors->first('discount') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="discount_type" class="col-sm-3 col-form-label">Discount Type</label></strong>
                                        <select name="discount_type" id="discount_type" class="form-control select2">
                                            <option value="percent"  {{ $product_bundles->discount_type  == 'percent' ? 'selected' : ''}}>Percentage (%)</option>
                                            <option value="flat" {{ $product_bundles->discount_type  == 'flat' ? 'selected' : ''}} >Flat (direct)</option>
                                        </select>
                                        @if ($errors->has('discount_type'))
                                            <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="text-align: center;">
                            <button type="submit" class="btn btn-primary w-md">Update</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('customScripts')
   <script>
       $(document).ready(function () {
          $('.select2').select2();

        $("#products").select2({
        tags: true
        });

        $("#products").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);

        window.setTimeout(function () {
        if ($("#products").find(":selected").length > 1) {
            var $second = $("#products").find(":selected").eq(-2);

            $element.detach();
            $second.after($element);
        } else {
            $element.detach();
            $("#products").prepend($element);
        }

        $("#products").trigger("change");
        }, 1);
        });

        $("#products").on("select2:unselect", function (evt) {
        if ($("#products").find(":selected").length) {
            var element = evt.params.data.element;
            var $element = $(element);
        $("#products").find(":selected").after($element);
        }
        });
       });

    </script>

@endpush
