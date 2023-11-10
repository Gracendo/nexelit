@extends('frontend.user.dashboard.user-master')
@section('section')
    @if(!empty(get_static_option('product_module_status')))
        @if(!empty($downloads))
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">{{__('Thumbnail')}}</th>
                        <th scope="col">{{__('Product Info')}}</th>
                        <th scope="col">{{__('Download')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($downloads as $data)
                        <tr>
                            <th>
                                <div class="thumb-wrap" style="max-width: 60px">
                                    {!! render_image_markup_by_attachment_id($data['image']) !!}
                                </div>
                            </th>
                            <td>
                                <a href="{{route('frontend.products.single',$data['slug'])}}"><h4 style="font-weight: 600;">{{$data['title']}}</h4></a>
                                <div>
                                    <small class="d-block"><strong>{{{__('Order ID:')}}}</strong> {{$data['order_id']}}</small>
                                    <small class="d-block"><strong>{{{__('Quantity:')}}}</strong> {{$data['quantity']}}</small>
                                    <small class="d-block"><strong>{{{__('Purchased:')}}}</strong> {{date_format($data['order_date'],'d M Y')}}</small>
                                </div>
                            </td>
                            <td>
                                <a class="btn-boxed style-01 margin-bottom-10" href="{{route('user.dashboard.download.file',$data['id'])}}">{{__('Download File')}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">{{__('No Downloads Found')}}</div>
        @endif
    @endif

@endsection