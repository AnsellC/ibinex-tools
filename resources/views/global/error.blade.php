@if($errors->any())
<div class="notification is-danger">
        <ul>
                @foreach($errors->all() AS $error)
    
                    <li>{{ $error }}</li>
                @endforeach
    
            </ul>
</div>

@endif