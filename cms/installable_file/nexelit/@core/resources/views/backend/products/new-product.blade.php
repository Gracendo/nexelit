@extends('backend.admin-master')
@section('site-title')
    {{__('New Products')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <style>
        .nice-select .option {
            min-height: 30px;
            padding: 0px 10px;
            font-size: 14px;
            font-weight: 600;
        }

        .nice-select .option:hover, .nice-select .option.focus, .nice-select .option.selected.focus {
            font-weight: 700;
        }

    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapper d-flex justify-content-between">
                            <h4 class="header-title">{{__('Add New Products')}}</h4>
                            <a href="{{route('admin.products.all')}}" class="btn btn-primary">{{__('All Products')}}</a>
                        </div>

                        <form action="{{route('admin.products.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="language"><strong>{{__('Language')}}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            <option value="">{{__('Select Language')}}</option>
                                            @foreach($all_languages as $lang)
                                                <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control"  id="title" name="title" value="{{old('title')}}" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">{{__('Slug')}}</label>
                                        <input type="text" class="form-control"  id="slug" name="slug" value="{{old('slug')}}" placeholder="{{__('slug')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="badge">{{__('Badge')}}</label>
                                        <input type="text" class="form-control"  id="badge" name="badge" value="{{old('badge')}}" placeholder="{{__('eg: New')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{__('Category')}}</label>
                                        <select name="category_id" class="form-control" id="category">
                                            <option value="">{{__("Select Category")}}</option>
                                        </select>
                                        <span class="info-text">{{__('select language to get price plan by language')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="subcategory_id">{{__('Sub Category')}}</label>
                                        <select name="subcategory_id" class="form-control" id="subcategory">
                                            <option value="">{{__("Select Sub Category")}}</option>
                                        </select>
                                        <span class="info-text">{{__('select language to get price plan by language')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Description')}}</label>
                                        <textarea name="description" class="form-control summernote" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="short_description">{{__('Short Description')}}</label>
                                        <textarea name="short_description" id="short_description" class="form-control max-height-120" cols="30" rows="4" placeholder="{{__('Short Description')}}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="regular_price">{{__('Regular Price')}}</label>
                                        <input type="number" class="form-control"  id="regular_price" name="regular_price" placeholder="{{__('Regular Price')}}">
                                         <span class="info-text">{{__('select language to ge')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sale_price">{{__('Sale Price')}}</label>
                                        <input type="number" class="form-control"  id="sale_price" name="sale_price" placeholder="{{__('Sale Price')}}">
                                         <span class="info-text">{{__('select language to ge')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sku">{{__('SKU')}}</label>
                                        <input type="text" class="form-control"  id="sku" name="sku" placeholder="{{__('SKU')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_status">{{__('Stock')}}</label>
                                        <select name="stock_status" class="form-control" id="stock_status">
                                            <option value="in_stock">{{__('In Stock')}}</option>
                                            <option value="out_stock">{{__('Out Of Stock')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group attributes-field">
                                        <label for="attributes">{{__('Attributes')}}</label>
                                       <div class="attribute-field-wrapper">
                                           <input type="text" class="form-control"  id="attributes" name="attributes_title[]" placeholder="{{__('Title')}}">
                                           <textarea name="attributes_description[]"  class="form-control" rows="5" placeholder="{{__('Value')}}"></textarea>
                                          <div class="icon-wrapper">
                                              <span class="add_attributes"><i class="ti-plus"></i></span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_downloadable"><strong>{{__('Is Downloadable')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="is_downloadable" id="is_downloadable">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="downloadable_file">{{__('Downloadable File')}}</label>
                                        <input type="file" name="downloadable_file"  class="form-control" id="downloadable_file">
                                        <span class="info-text">{{__('doc,docx,jpg,jpeg,png,mp3,mp4,pdf,txt,zip file area allowed')}}</span>
                                        <div class="form-group margin-top-20">
                                            <label for="direct_download"><strong>{{__('Direct Download')}}</strong></label>
                                            <label class="switch">
                                                <input type="checkbox" name="direct_download" id="direct_download" value="1" >
                                                <span class="slider"></span>
                                            </label>
                                            <p class="info-text">{{__('direct download will only work if you product price is 0')}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_tags">{{__('Meta Tags')}}</label>
                                        <input type="text" name="meta_tags"  class="form-control" data-role="tagsinput" id="meta_tags">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">{{__('Meta Description')}}</label>
                                        <textarea name="meta_description"  class="form-control" rows="5" id="meta_description"></textarea>
                                    </div>
                                    <div class="product-variant-select-wrapper">
                                        <div class="form-group">
                                            <label for="variant_list">{{__('Product Variants')}}</label>
                                            <select id="variant_list" class="form-control">
                                                <option value="">{{__('Select Variant')}}</option>
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-primary "
                                                id="productvariantadd">{{__('Add')}}</button>
                                    </div>
                                    <div class="dynamic-variant-wrapper"> </div>

                                    <div class="form-group">
                                        <label for="image">{{__('Image')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap"></div>
                                            <input type="hidden" name="image">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="Select Product Image" data-modaltitle="Upload Product Image" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__('Upload Image')}}
                                            </button>
                                        </div>
                                        <small>{{__('Recommended image size 1920x1280')}}</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{__('Gallery')}}</label>
                                        <div class="media-upload-btn-wrapper">
                                            <div class="img-wrap"></div>
                                            <input type="hidden" name="gallery">
                                            <button type="button" class="btn btn-info media_upload_form_btn" data-mulitple="true" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                {{__('Upload Image')}}
                                            </button>
                                        </div>
                                        <small>{{__('Recommended image size 1920x1280')}}</small>
                                    </div>
                                    @if(get_static_option('product_tax_type') == 'individual')
                                        <div class="form-group">
                                            <label for="tax_percentage">{{__('Tax Percentage')}}</label>
                                            <input type="number" class="form-control"  id="tax_percentage" name="tax_percentage" >
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" id="status"  class="form-control">
                                            <option value="publish">{{__('Publish')}}</option>
                                            <option value="draft">{{__('Draft')}}</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Product')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <x-backend.auto-slug-js :url="route('admin.products.slug.check')" :type="'new'" />
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                }
            });

            $('body .nice-select').niceSelect();

            $(document).on('click', '#productvariantadd', function () {
                var variant = $('#variant_list').val();
                if (variant != '') {
                    $('#productvariantadd').append('<i class="fas fa-spinner fa-spin"></i>');
                    $('#variant_list option[value="'+variant+'"]').attr('disabled',true)
                    //write ajax call
                    $.ajax({
                        type: 'POST',
                        url: "{{route('admin.products.variants.details')}}",
                        data: {
                            _token: "{{csrf_token()}}",
                            id : variant
                        },
                        success: function (data) {
                            $('#productvariantadd').find('i').remove();
                            var terms = JSON.parse(data.terms);
                            var markup = '<div class="variant-terms-selector"> <label for="#">'+data.title+'</label><select name="variant['+data.id+'][]" multiple class="form-control nice-select wide">';
                            $.each(terms,function (index,value){
                                markup += ' <option value="'+value+'">'+value+'</option>';
                            })
                            markup += '</select></div>';

                            $('.dynamic-variant-wrapper').append(markup);
                            $('body .nice-select').niceSelect('destroy');
                            $('body .nice-select').niceSelect();
                        }
                    });
                    //
                }
            });
            $(document).on('change','#language',function(e){
                e.preventDefault();
                var selectedLang = $(this).val();
                $.ajax({
                    url: "{{route('admin.products.category.by.lang')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#subcategory').html('<option value="">{{__('Select Sub Category')}}</option>');
                        $('#category').html('<option value="">{{__('Select Category')}}</option>');
                        $.each(data,function(index,value){
                            $('#category').append('<option value="'+value.id+'">'+value.title+'</option>')
                        });
                    }
                });

                $(document).on('change','#category',function(e) {
                    e.preventDefault();

                    var selectedCatID = $(this).val();
                    $.ajax({
                        url: "{{route('admin.products.subcategory.by.category')}}",
                        type: "POST",
                        data: {
                            _token: "{{csrf_token()}}",
                            cat_id: selectedCatID,
                        },
                        success: function (data) {
                            $('#subcategory').html('<option value="">{{__('Select Sub Category')}}</option>');
                            $.each(data, function (index, value) {
                                $('#subcategory').append('<option value="' + value.id + '">' + value.title + '</option>')
                            });
                        }
                    });
                });


                $.ajax({
                    url: "{{route('admin.products.variant.by.lang')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        lang : selectedLang
                    },
                    success:function (data) {
                        $('#variant_list').html('<option value="">{{__('Select Variant')}}</option>');
                        $.each(data,function(index,value){
                            $('#variant_list').append('<option value="'+value.id+'">'+value.title+'</option>')
                        });
                    }
                });

            });

            $(document).on('change','#is_downloadable',function (e) {
                e.preventDefault();
                isDownloadableCheck('#is_downloadable');
            });

            $(document).on('click','.attribute-field-wrapper .add_attributes',function (e) {
               e.preventDefault();
                $(this).parent().parent().parent().append(' <div class="attribute-field-wrapper">\n' +
                    '<input type="text" class="form-control"  id="attributes" name="attributes_title[]" placeholder="{{__('Title')}}">\n' +
                    '<textarea name="attributes_description[]"  class="form-control" rows="5" placeholder="{{__('Value')}}"></textarea>\n' +
                    '<div class="icon-wrapper">\n' +
                    '<span class="add_attributes"><i class="ti-plus"></i></span>\n' +
                    '<span class="remove_attributes"><i class="ti-minus"></i></span>\n' +
                    '</div>\n' +
                    '</div>');

            });
            $(document).on('click','.attribute-field-wrapper .remove_attributes',function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();

            });

            function isDownloadableCheck($selector) {
                var dnFile = $('#downloadable_file');
                var dnFileUrl = $('#downloadable_file_link');
                if($($selector).is(':checked')){
                    dnFile.parent().show();
                    dnFileUrl.parent().show();
                }else{
                    dnFile.parent().hide();
                    dnFileUrl.parent().hide();
                }
            }

        }); //end document ready
    </script>

@endsection
