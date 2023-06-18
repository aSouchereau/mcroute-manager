<tr>
    <td>
        <form id="row-form-{{$route->id}}" method="POST" action="{{ route('routes.update', $route->id) }}">
            @csrf
            @method('PATCH')
            <input
                @isset($route)
                    value="{{$route->nickname}}"
                @endisset
               class="form-control-plaintext"
               readonly
               data-form-id="{{$route->id}}"
            />
        </form>
    </td>
    <td>
        <input form="row-form-{{$route->id}}"
               @isset($route)
                   value="{{$route->domain_name}}"
               @endisset
               class="form-control-plaintext"
               readonly
               data-form-id="{{$route->id}}"
        />
    </td>
    <td>
        <input form="row-form-{{$route->id}}"
               @isset($route)
                   value="{{$route->host}}"
               @endisset
               class="form-control-plaintext"
               readonly
               data-form-id="{{$route->id}}"
        />
    </td>
    <td>
        <input form="row-form-{{$route->id}}"
               @isset($route)
                   value="{{$route->group_id}}"
               @endisset
               class="form-control-plaintext"
               readonly
               data-form-id="{{$route->id}}"
        />
    </td>

    <td>@if($route->enabled) enabled @else disabled @endif</td>


    <td>
        @isset($route)
            <x-edit-button tooltipName="Route" fieldId="{{$route->id}}" ></x-edit-button>
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

