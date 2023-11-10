<div class="preloader" id="preloader">
    <div class="preloader-inner">
        @if(!empty(get_static_option('preloader_cacncel_button')))
            <button class="cancel-preloader" onclick="disablePreloader()">{{__('Cancel Preloader')}}</button>
        @endif
        {!! render_image_markup_by_attachment_id(get_static_option('preloader_custom_image')) !!}
    </div>
</div>
<script>
    function disablePreloader() {
        document.querySelector('#preloader').remove();
    }
</script>
