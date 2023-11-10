<div class="form-group">
    @php
    $value = $icon ?? get_static_option($name);
    @endphp
    <label for="icon" class="d-block">{{$title}}</label>
    <div class="btn-group">
        <button type="button" class="btn btn-primary iconpicker-component">
            <i class="{{$value}}"></i>
        </button>
        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                data-selected="{{$value}}" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">{{__('Toggle Dropdown')}}</span>
        </button>
        <div class="dropdown-menu"></div>
    </div>
    <input type="hidden" class="form-control"  id="icon" value="{{$value}}" name="{{$name}}">
</div>
