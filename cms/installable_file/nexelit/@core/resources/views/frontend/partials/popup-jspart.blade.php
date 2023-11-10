@php
    if(empty($popup_details)) {return;}
@endphp
@if(!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_'.$user_select_lang_slug.'_id')))
&& !empty($popup_details))
<script>
    $(document).ready(function () {

        var delayTime = "{{get_static_option('popup_delay_time')}}";
        var popupBackdrop =  $('.nx-popup-backdrop');
        var popupWrapper =  $('.nx-popup-wrapper');

        delayTime = delayTime ? delayTime : 4000;


        if (getCookie('nx_popup_show') == '') {
            setTimeout(function () {
                popupBackdrop.addClass('show');
                popupWrapper.addClass('show');

            }, parseInt(delayTime));
        }

        $(document).on('click', '.nx-popup-close,.nx-popup-backdrop', function (e) {
            e.preventDefault();
            $('.nx-modal-content').html('');
            popupBackdrop.removeClass('show');
            popupWrapper.removeClass('show');
            setCookie('nx_popup_show', 'no', 1);
        });

        var offerTime = "{{$popup_details->offer_time_end}}";
        var year = offerTime.substr(0, 4);
        var month = offerTime.substr(5, 2);
        var day = offerTime.substr(8, 2);
        if (offerTime && $('#countdown').length > 0) {
            $('#countdown').countdown({
                year: year,
                month: month,
                day: day,
                labels: true,
                labelText: {
                    'days': "{{__('days')}}",
                    'hours': "{{__('hours')}}",
                    'minutes': "{{__('min')}}",
                    'seconds': "{{__('sec')}}",
                }
            });
        }
    });
</script>
@endif
