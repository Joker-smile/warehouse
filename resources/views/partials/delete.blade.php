 <form action="{{ $url }}" method="POST" onsubmit="return confirm(function(event){
   event.target.submit();
}, event)" style="margin:0px;display:inline;">
     {{ csrf_field() }}
     {{ method_field("DELETE") }}
     <button class="btn btn-sm btn-danger" data-original-title="Delete" data-toggle="tooltip" type="submit">
         删除
     </button>
 </form>