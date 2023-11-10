<a tabindex="0" class="btn btn-xs btn-danger btn-sm mb-3 mr-1"
   role="button"
   data-toggle="popover"
   data-trigger="focus"
   data-html="true"
   title=""
   data-content="
   <h6>{{__('Are you sure to delete this item?')}}</h6>
   <form method='post' action='{{$url}}'>
   <input type='hidden' name='_token' value='{{csrf_token()}}'>
   <br>
    <input type='submit' class='btn btn-danger btn-sm' value='{{__('Yes, Please')}}'>
    </form>
    ">
    <i class="ti-trash"></i>
</a>