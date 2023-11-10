<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{get_static_option('site_'.get_user_lang().'_title')}} - {{get_static_option('site_'.get_user_lang().'_tag_line')}}</title>
</head>

<body>
{{__('Redirecting Please Wait..')}}
<form action="{{get_paypal_form_url()}}" method="post" id="payment_form">
    <input type="hidden" name="cmd" value="_xclick"/>
    <input type="hidden" name="business" value="{{$paypal_details['business']}}"/>
    <input type="hidden" name="cbt" value="{{$paypal_details['cbt'] }}"/>
    <input type="hidden" name="currency_code" value="{{$paypal_details['currency_code'] }}"/>
    <input type="hidden" name="quantity" value="1"/>
    <input type="hidden" name="item_name" value="{{$paypal_details['item_name']}}"/>
    <input type="hidden" name="custom" value="{{$paypal_details['custom']}}"/>
    <input type="hidden" name="amount" value="{{$paypal_details['amount']}}"/>
    <input type="hidden" name="return" value="{{$paypal_details['return']}}"/>
    <input type="hidden" name="cancel_return" value="{{$paypal_details['cancel_return']}}"/>
    <input type="hidden" name="notify_url" value="{{$paypal_details['notify_url']}}"/>
</form>

<script>
    document.getElementById("payment_form").submit();
</script>
</body>

</html>
    
    
    