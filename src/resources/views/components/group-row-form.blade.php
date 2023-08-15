<tr>
    <form
        id="row-form-{{$group->id ?? "new"}}"
        method="POST"
        action="{{ (isset($group->id)) ?
                (route('groups.update', $group->id))
                :
                (route('groups.store')) }}">
        @csrf
        @method('PATCH')
    </form>
    <td>
        <input form="row-form-{{$group->id ?? "new"}}"
               id="name"
               name="name"
               @isset($group)
                   value="{{$group->name}}"
               data-form-id="{{$group->id}}"
               @endisset
               class="form-control-plaintext"
               readonly
        />
    </td>
    <td>
        <input form="row-form-{{$group->id ?? "new"}}"
               id="description"
               name="description"
               @isset($group)
                   value="{{$group->description}}"
               data-form-id="{{$group->id}}"
               @endisset
               class="form-control-plaintext"
               readonly
        />
    </td>
    <td>
        @isset($group)
            {{$group->routes->count()}}
        @endisset
    </td>

    @isset($group)
        <td>
            @if($group->enabled)
                enabled
            @else
                disabled
            @endif
        </td>
    @endisset

    <td>
        @isset($group)
            <div data-field-editor="default-button-set" data-form-id="{{$group->id}}">
                <x-edit-button tooltipName="Group" fieldId="{{$group->id}}"></x-edit-button>
                <x-delete-button tooltipName="Group" fieldId="{{$group->id}}" :resource="$group"></x-delete-button>
            </div>
            <div data-field-editor="edit-button-set" data-form-id="{{$group->id}}" style="display: none">
                <x-save-button fieldId="{{$group->id}}" :resource="$group"></x-save-button>
                <x-cancel-button fieldId="{{$group->id}}"></x-cancel-button>
            </div>
        @endisset
    </td>


    @if ($errors->any())
        @foreach($errors->all() as $error)
            <!-- TODO replace message with error toast-->
            {{ $error }}<br>
        @endforeach
    @endif
</tr>

