<tr data-field-editor="create-button-row">
    <td colspan="5">
        <x-create-button name="Group"></x-create-button>
    </td>
</tr>
<tr data-field-editor="form-row" style="display: none">
    <form
        id="row-form-new"
        method="POST"
        action="{{route('groups.store')}}">
        @csrf
    </form>
    <td>
        <input form="row-form-new"
               id="name"
               name="name"
               placeholder="Name"
               data-form-id="new"
               class="form-control"
        />
    </td>
    <td>
        <input form="row-form-new"
               id="description"
               name="description"
               placeholder="Description"
               data-form-id="new"
               class="form-control"
        />
    </td>
    <td>
    </td>

    <td>
    </td>

    <td>
        <div data-field-editor="edit-button-set" data-form-id="new">
            <x-save-button fieldId="new"></x-save-button>
            <x-cancel-button fieldId="new"></x-cancel-button>
        </div>
    </td>


    @if ($errors->any())
        @foreach($errors->all() as $error)
            <!-- TODO replace message with error toast-->
            {{ $error }}<br>
        @endforeach
    @endif
</tr>

