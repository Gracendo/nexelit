<div class="preloader" id="preloader">
    <div class="preloader-inner">
        @if(!empty(get_static_option('preloader_cacncel_button')))
        <button class="cancel-preloader" onclick="disablePreloader()">{{__('Cancel Preloader')}}</button>
        @endif
        @php $site_preloader = get_static_option('preloader_default') @endphp

        @if($site_preloader == '1')
        <div class="lds-circle"><div></div></div>
        @elseif($site_preloader == '2')
            <div class="lds-dual-ring"></div>
        @elseif($site_preloader == '3')
            <div class="lds-facebook"><div></div><div></div><div></div></div>
        @elseif($site_preloader == '4')
            <div class="lds-heart"><div></div></div>
        @elseif($site_preloader == '5')
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        @elseif($site_preloader == '6')
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        @elseif($site_preloader == '7')
            <div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        @elseif($site_preloader == '8')
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        @elseif($site_preloader == '9')
            <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        @elseif($site_preloader == '10')
            <div class="lds-hourglass"></div>
        @elseif($site_preloader == '11')
            <div class="lds-ripple"><div></div><div></div></div>
        @elseif($site_preloader == '12')
            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        @endif
    </div>
</div>
<script>
    function disablePreloader() {
        document.querySelector('#preloader').remove();
    }
</script>
