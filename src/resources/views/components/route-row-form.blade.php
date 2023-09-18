<tr>
    <form
        id="row-form-{{$route->id ?? "new"}}"
        method="POST"
        action="{{ (isset($route->id)) ?
                (route('routes.update', $route->id))
                :
                (route('routes.store')) }}">
        @csrf
        @method('PATCH')
    </form>
    <td>
        <input form="row-form-{{$route->id ?? "new"}}"
            id="nickname"
            name="nickname"
            @isset($route)
                value="{{$route->nickname}}"
                data-form-id="{{$route->id}}"
            @endisset
            class="form-control-plaintext"
            readonly
               disabled
        />
    </td>
    <td>
        <input form="row-form-{{$route->id ?? "new"}}"
               id="domain_name"
               name="domain_name"
               @isset($route)
                   value="{{$route->domain_name}}"
                   data-form-id="{{$route->id}}"
               @endisset
               class="form-control-plaintext"
               readonly
               disabled
        />
    </td>
    <td>
        <input form="row-form-{{$route->id ?? "new"}}"
               id="host"
               name="host"
               @isset($route)
                   value="{{$route->host}}"
                   data-form-id="{{$route->id}}"
               @endisset
               class="form-control-plaintext"
               readonly
               disabled
        />
    </td>
    <td>
{{--        <input form="row-form-{{$route->id ?? "new"}}"--}}
{{--               id="group_id"--}}
{{--               name="group_id"--}}
{{--               @isset($route)--}}
{{--                   value="{{$route->group_id}}"--}}
{{--                   data-form-id="{{$route->id}}"--}}
{{--               @endisset--}}
{{--               class="form-control-plaintext"--}}
{{--               readonly--}}
{{--        />--}}
        <select form="row-form-{{$route->id ?? "new"}}"
                id="group_id"
                name="group_id"
                @isset($route)
                    data-form-id="{{$route->id}}"
                @endisset
                class="form-select form-control-plaintext"
                readonly
                disabled
        >
            <option value=""></option>
            @foreach($groups as $group)
                <option value="{{$group->id}}"
                    @isset($route)
                        @if($group->id === $route->group_id)
                            selected
                       @endif
                    @endisset>{{$group->name}}</option>
            @endforeach
        </select>
    </td>

    @isset($route)
        <td>
            <div class="toggle-switch-wrapper">
                <x-toggle-switch
                    routeName="routes.toggle"
                    :resource="$route"
                />
            </div>
        </td>
    @endisset

    <td>
        @isset($route)
            <div data-field-editor="default-button-set" data-form-id="{{$route->id}}">
                <x-edit-button tooltipName="Route" fieldId="{{$route->id}}"></x-edit-button>
                <x-delete-button tooltipName="Route" fieldId="{{$route->id}}" :resource="$route"></x-delete-button>
            </div>
            <div data-field-editor="edit-button-set" data-form-id="{{$route->id}}" style="display: none">
                <x-save-button fieldId="{{$route->id}}" :resource="$route"></x-save-button>
                <x-cancel-button fieldId="{{$route->id}}"></x-cancel-button>
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

