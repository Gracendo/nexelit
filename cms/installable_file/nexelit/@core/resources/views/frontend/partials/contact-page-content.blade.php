
@if(!empty(get_static_option('contact_page_contact_info_section_status')))
    <div class="inner-contact-section padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row">
                @php $a = 1;@endphp
                @foreach($all_contact_info as $data)
                    <div class="col-md-6 col-lg-3">
                        <div class="single-contact-item">
                            <div class="icon style-0{{$a}}">
                                <i class="{{$data->icon}}"></i>
                            </div>
                            <div class="content">
                                <span class="title">{{$data->title}}</span>
                                @php
                                    $info_details = !empty($data->description) ? explode("\n",$data->description) : [];
                                @endphp
                                @foreach($info_details as $item)
                                    <p class="details">{{$item}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @php if($a == 4){$a =1;}else{$a++;} @endphp
                @endforeach
            </div>
        </div>

    </div>
@endif
@if(!empty(get_static_option('contact_page_contact_section_status')))
    <div class="contact-section padding-bottom-120">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h4 class="title">{{get_static_option('contact_page_'.$user_select_lang_slug.'_form_section_title')}}</h4>
                                </div>
                                @include('backend.partials.message')
                                @if($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <form action="{{route('frontend.contact.message')}}" method="post" class="contact-page-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            {!! render_form_field_for_frontend(get_static_option('contact_page_contact_form_fields')) !!}

                            <div class="btn-wrapper">
                                <button type="submit" class="boxed-btn reverse-color">{{get_static_option('contact_page_'.$user_select_lang_slug.'_form_submit_btn_text')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact_map">
                        {!! render_embed_google_map(get_static_option('contact_page_map_section_location'),get_static_option('contact_page_map_section_zoom')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@section('scripts')
@include('frontend.partials.google-captcha')
@endsection