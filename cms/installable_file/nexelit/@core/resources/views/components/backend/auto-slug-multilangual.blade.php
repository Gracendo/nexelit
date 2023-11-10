<script>
    $(document).ready(function (){
        "use strict";
        $(document).on('keyup','.title-field',function (){
            var parent = $(this).parent().parent();
            var slugField = parent.find('.slug-field');
            @if($type === 'new')
            slugField.val(convertToSlug($(this).val()));
            if(slugField.val() == ''){
                return;
            }
            @else
            var slug =  slugField.val();

            if(slug == ''){
                slugField.val(convertToSlug($(this).val()));
            }
            @endif
            $.ajax({
                type: 'post',
                url : "{{$url}}",
                data: {
                    _token: "{{csrf_token()}}",
                    type: '{{$type}}',
                    slug : slugField.val(),
                    lang : $('.nav-tabs .nav-item .nav-link.active').data('lang')
                },
                success: function (data){
                    parent.find('input[name="slug"]').val(data)
                }
            });
        });

        $(document).on('keyup','.slug-field',function (){
            $(this).val(convertToSlug($(this).val()));
            if($(this).val() == ''){
                return;
            }
            var el = $(this);
            var value = el.val();
            $.ajax({
                type: 'post',
                url : "{{$url}}",
                data: {
                    _token: "{{csrf_token()}}",
                    type: '{{$type}}',
                    slug : value,
                    lang : $('.nav-tabs .nav-item .nav-link.active').data('lang')
                },
                success: function (data){
                    $(this).val(data)
                }
            });
        });

        function convertToSlug(Text) {
            return Text
                .toLowerCase()
                .replace(/ /g, '-')
                // .replace(/[^\w-]+/g, '');
        }

    });
</script>