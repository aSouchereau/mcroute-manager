<tr>
    <td>
        <form
            id="row-form-{{isset($route->id) ?? "new"}}"
            method="POST"
            action="{{ (isset($route->id)) ?
                (route('routes.update', $route->id))
                :
                (route('routes.store')) }}">
            @csrf
            @method('PATCH')
            <input form="row-form-{{isset($route->id) ?? "new"}}"
                @isset($route)
                    value="{{$route->nickname}}"
                @endisset
                class="form-control-plaintext"
                readonly
            />
        </form>
    </td>
    <td>
        <input form="row-form-{{isset($route->id) ?? "new"}}"
               @isset($route)
                   value="{{$route->domain_name}}"
               @endisset
               class="form-control-plaintext"
               readonly
        />
    </td>
    <td>
        <input form="row-form-{{isset($route->id) ?? "new"}}"
               @isset($route)
                   value="{{$route->host}}"
               @endisset
               class="form-control-plaintext"
               readonly
        />
    </td>
    <td>
        <input form="row-form-{{isset($route->id) ?? "new"}}"
               @isset($route)
                   value="{{$route->group_id}}"
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
        @endisset
        <input type="submit" value="Submit"><br>
    </td>


    @if ($errors->any())
        @foreach($errors->all() as $error)
            <!-- TODO replace message with error toast-->
            {{ $error }}<br>
        @endforeach
    @endif
</tr>

