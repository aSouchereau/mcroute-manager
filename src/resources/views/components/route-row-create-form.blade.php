<tr data-field-editor="create-button-row">
    <td colspan="6">
        <x-create-button name="Route" ></x-create-button>
    </td>
</tr>
<tr data-field-editor="form-row" style="display: none">
    <form
        id="row-form-new"
        method="POST"
        action="{{route('routes.store') }}">
        @csrf
    </form>
    <td>
        <input form="row-form-new"
               id="nickname"
               name="nickname"
               placeholder="Nickname"
               data-form-id="new"
               class="form-control"
        />
    </td>
    <td>
        <input form="row-form-new"
               id="domain_name"
               name="domain_name"
               placeholder="Domain"
               data-form-id="new"
               class="form-control"
        />
    </td>
    <td>
        <input form="row-form-new"
               id="host"
               name="host"
               placeholder="Destination"
               data-form-id="new"
               class="form-control"
        />
    </td>
    <td>
        <select form="row-form-new"
                id="group_id"
                name="group_id"
                data-form-id="new"
                class="form-select"
        >
            <option value="">Select Group</option>
            @foreach($groups as $group)
                <option value="{{$group->id}}">
                    {{$group->name}}
                </option>
            @endforeach
        </select>
    </td>
    <td></td>
    <td>
        <div data-field-editor="edit-button-set" data-form-id="new">
            <x-save-button fieldId="new"></x-save-button>
            <x-cancel-button fieldId="new"></x-cancel-button>
        </div>
    </td>
</tr>

