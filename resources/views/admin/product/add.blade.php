@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW PRODUCT</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-name-input" class="col-sm-6 col-form-label">Category</label></strong>
                                        <select class="form-control select2" name="categories_id" id="categories">
                                            <option value="" selected disabled>Select Category</option>
                                            @forelse($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @if ($errors->has('categories_id'))
                                        <span class="text-danger">{{ $errors->first('categories_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-name-input" class="col-sm-6 col-form-label">Sub Category</label></strong>
                                        <select class="form-control select2" name="sub_categories_id" id="sub_categories">
                                            <option value="" selected disabled>Select Sub Category</option>
                                            @forelse($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @if ($errors->has('sub_categories_id'))
                                        <span class="text-danger">{{ $errors->first('sub_categories_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name" id="horizontal-name-input" placeholder="Enter Name here">
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-title-input" class="col-sm-3 col-form-label">Title</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title" id="horizontal-title-input" placeholder="Enter Title here">
                                            @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-desc-input" class="col-sm-3 col-form-label">Description</label></strong>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="description" id="summernote"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-price-input" class="col-sm-5 col-form-label">Price</label></strong>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" name="price" id="horizontal-price-input" placeholder="Enter Price">

                                            @if ($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="curreny" class="col-sm-3 col-form-label">Currency</label></strong>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="currency" id="currency">
                                                <option value="" selectrd disabled>Select Currency</option>
                                                @forelse($currencies as $currency)
                                                    <option value="{{ $currency->id }}" {{ ($currency->currency_name == 'US Dollar' ? "selected" : "") }}>{{ $currency->currency_name }} ({{ $currency->currency_symbol }})</option>
                                                  @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('currency'))
                                                <span class="text-danger">{{ $errors->first('currency') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                     <div class="col-sm-6">
                                        <strong><label for="discount" class="col-sm-5 col-form-label">Discount</label></strong>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" name="discount" id="discount" placeholder="Enter Discount Price here">

                                            @if ($errors->has('discount'))
                                            <span class="text-danger">{{ $errors->first('discount') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="discount_type" class="col-sm-5 col-form-label">Discount Type</label></strong>
                                        <div class="col-sm-12">
                                            <select name="discount_type" class="form-control select2">
                                                <option value="percent">Percentage (%)</option>
                                                <option value="flat" selected>Flat (direct)</option>
                                            </select>

                                            @if ($errors->has('discount_type'))
                                            <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-sm-12">
                                    <label for="image" class="control-label">Icon image</label>
                                    <input type="file" class="form-control" name="image" id="image" style="">
                                    <div class="invalid-feedback">
                                        Please upload icon image.
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <strong><label for="horizontal-metatitle-input" class="col-sm-6 col-form-label">Meta Title</label></strong>
                                    <div class="col-sm-12">
                                        <textarea rows="4" class="form-control" name="metatitle" id="horizontal-metatitle-input" placeholder="Meta Title"></textarea>
                                        @if ($errors->has('metatitle'))
                                        <span class="text-danger">{{ $errors->first('metatitle') }}</span>
                                        @endif
                                    </div>
                                    <br />
                                    <strong><label for="horizontal-metadesc-input" class="col-sm-6 col-form-label">Meta Description</label></strong>
                                    <div class="col-sm-12">
                                        <textarea rows="4" class="form-control" name="desc" id="desc" placeholder="Meta Description"></textarea>
                                        @if ($errors->has('desc'))
                                        <span class="text-danger">{{ $errors->first('desc') }}</span>
                                        @endif
                                    </div>
                                    <br />
                                    <strong><label for="horizontal-metakeyword-input" class="col-sm-6 col-form-label">Meta Keyword</label></strong>
                                    <div class="col-sm-12">
                                        <textarea rows="4" class="form-control" name="metakeyword" id="horizontal-metakeyword-input" placeholder="Meta Keywords"></textarea>
                                        @if ($errors->has('metakeyword'))
                                        <span class="text-danger">{{ $errors->first('metakeyword') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary w-md">SAVE</button>
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
        $(document).ready(function() {
            $('.select2').select2();

            $('#summernote').summernote({
                placeholder: 'Enter Description here',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
                ]
            });
        });

    </script>
@endpush
