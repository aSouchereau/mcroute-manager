<form action="{{route($routeName, $resource->id)}}" method="POST">
    @csrf
    @method('patch')
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch"
               @if($resource->enabled) checked @endif
               onchange="this.form.submit()"
        >
    </div>
</form>
