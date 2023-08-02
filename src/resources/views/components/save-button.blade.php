<form action="{{route($formRoute, $resource->id)}}" method="post">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-stealth" data-field-editor="save-button" data-target-form-id="{{$fieldId}}">
        <a href="#" data-bs-toggle="tooltip" data-bs-title="Save Changes" data-bs-placement="bottom">
            <x-icon name="floppy-disk"></x-icon>
        </a>
    </button>
</form>
