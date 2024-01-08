<tr>
    <form
        id="row-form-{{$route->id}}"
        method="POST"
        action="{{(route('routes.update', $route->id))}}">
        @method('PATCH')
        @csrf
    </form>
    <td>
        <input form="row-form-{{$route->id}}"
            id="nickname"
            name="nickname"
            value="{{$route->nickname}}"
            data-form-id="{{$route->id}}"
            class="form-control-plaintext"
            readonly
               disabled
        />
    </td>
    <td>
        <input form="row-form-{{$route->id}}"
               id="domain_name"
               name="domain_name"
               value="{{$route->domain_name}}"
               data-form-id="{{$route->id}}"
               class="form-control-plaintext"
               readonly
               disabled
        />
    </td>
    <td>
        <input form="row-form-{{$route->id}}"
               id="host"
               name="host"
               value="{{$route->host}}"
               data-form-id="{{$route->id}}"
               class="form-control-plaintext"
               readonly
               disabled
        />
    </td>
    <td>
        <select form="row-form-{{$route->id}}"
                id="group_id"
                name="group_id"
                data-form-id="{{$route->id}}"
                class="form-select form-control-plaintext"
                readonly
                disabled
        >
            <option value=""></option>
            @foreach($groups as $group)
                <option value="{{$group->id}}"
                        @if($group->id === $route->group_id)
                            selected
                       @endif
                >{{$group->name}}</option>
            @endforeach
        </select>
    </td>

    <td>
        <div class="toggle-switch-wrapper">
            <x-toggle-switch
                routeName="routes.toggle"
                :resource="$route"
            />
        </div>
    </td>

    <td>
        <div data-field-editor="default-button-set" data-form-id="{{$route->id}}">
            <x-edit-button tooltipName="Route" fieldId="{{$route->id}}"></x-edit-button>
            <x-delete-button tooltipName="Route" fieldId="{{$route->id}}" :resource="$route"></x-delete-button>
        </div>
        <div data-field-editor="edit-button-set" data-form-id="{{$route->id}}" style="display: none">
            <x-save-button fieldId="{{$route->id}}" :resource="$route"></x-save-button>
            <x-cancel-button fieldId="{{$route->id}}"></x-cancel-button>
        </div>
    </td>


    @if ($errors->any())
        @foreach($errors->all() as $error)
            <!-- TODO replace message with error toast-->
            {{ $error }}<br>
        @endforeach
    @endif
</tr>

