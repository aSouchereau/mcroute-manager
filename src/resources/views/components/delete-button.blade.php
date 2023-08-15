<form action="{{route($formRoute, $resource->id)}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-stealth" data-field-editor="delete-button" data-target-form-id="{{$fieldId}}">
        <a href="#" data-bs-toggle="tooltip" data-bs-title="Delete {{$name}}" data-bs-placement="bottom">
            <x-icon name="trash"></x-icon>
        </a>
    </button>
</form>

