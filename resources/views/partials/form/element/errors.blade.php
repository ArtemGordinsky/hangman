@if(count($errors))
    @foreach($errors->all() as $error)
        <span class="help-block">{{ $error }}</span>
    @endforeach
@endif