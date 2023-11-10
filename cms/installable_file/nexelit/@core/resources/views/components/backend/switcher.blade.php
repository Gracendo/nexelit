<div class="form-group">
    @php $value = $value ?? get_static_option($name); @endphp
    <label for="{{$name}}"><strong>{{$title}}</strong></label>
    <label class="switch">
        <input type="checkbox" name="{{$name}}"  @if($value) checked @endif >
        <span class="slider"></span>
    </label>
</div>