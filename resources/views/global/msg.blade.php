@if (Session::has('msg'))
<div class="notification is-info">
     {{ Session::get('msg') }}
</div>
@endif