<tr>
    <form
        id="row-form-{{$group->id}}"
        method="POST"
        action="{{route('groups.update', $group->id)}}">
        @csrf
        @method('PATCH')
    </form>
    <td>
        <input form="row-form-{{$group->id}}"
               id="name"
               name="name"
               value="{{$group->name}}"
               data-form-id="{{$group->id}}"
               class="form-control-plaintext"
               readonly
               disabled
        />
    </td>
    <td>
        <input form="row-form-{{$group->id}}"
               id="description"
               name="description"
               value="{{$group->description}}"
               data-form-id="{{$group->id}}"
               class="form-control-plaintext"
               readonly
               disabled
        />
    </td>
    <td>
        {{$group->routes->count()}}
    </td>

    <td>
        @if($group->enabled)
            enabled
        @else
            disabled
        @endif
    </td>

    <td>
        <div data-field-editor="default-button-set" data-form-id="{{$group->id}}">
            <x-edit-button tooltipName="Group" fieldId="{{$group->id}}"></x-edit-button>
            <x-delete-button tooltipName="Group" fieldId="{{$group->id}}" :resource="$group"></x-delete-button>
        </div>
        <div data-field-editor="edit-button-set" data-form-id="{{$group->id}}" style="display: none">
            <x-save-button fieldId="{{$group->id}}" :resource="$group"></x-save-button>
            <x-cancel-button fieldId="{{$group->id}}"></x-cancel-button>
        </div>
    </td>
</tr>

