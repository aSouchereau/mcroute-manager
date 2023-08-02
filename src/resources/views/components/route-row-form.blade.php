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
        />
    </td>
    <td>
        <input form="row-form-{{$route->id ?? "new"}}"
               id="group_id"
               name="group_id"
               @isset($route)
                   value="{{$route->group_id}}"
                   data-form-id="{{$route->id}}"
               @endisset
               class="form-control-plaintext"
               readonly
        />
    </td>

    @isset($route)
        <td>
                @if($route->enabled)
                    enabled
                @else
                    disabled
                @endif
        </td>
    @endisset

    <td>
        @isset($route)
            <x-edit-button tooltipName="Route" fieldId="{{$route->id}}"></x-edit-button>
            <x-delete-button tooltipName="Route" fieldId="{{$route->id}}" :resource="$route"></x-delete-button>
            <x-save-button tooltipName="Route" fieldId="{{$route->id}}" :resource="$route"></x-save-button>
        @endisset
    </td>


    @if ($errors->any())
        @foreach($errors->all() as $error)
            <!-- TODO replace message with error toast-->
            {{ $error }}<br>
        @endforeach
    @endif
</tr>

