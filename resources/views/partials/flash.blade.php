@if (Session::has('flash_notification.message'))
   <div class="col-md-6 col-md-offset-3">
       <div class="row">
           <div class="alert alert-{{ Session::get('flash_notification.level') }}">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

               {{ Session::get('flash_notification.message') }}
           </div>
       </div>
   </div>
@endif