<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Route</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ action([\App\Http\Controllers\RouteController::class, 'store']) }}">
                <div class="modal-body">
                    {{  csrf_field() }}
                    <label for="nickname">Route Nickname:</label> <input name="nickname" type="text"><br>
                    <label for="domain_name">Domain Name:</label> <input name="domain_name" type="text"><br>
                    <label for="host">Host Address:</label><input name="host" type="text"><br>
                    <label for="group_id">Group</label>
                    <select name="group_id">
{{--                        @foreach($groups as $group)--}}
{{--                            <option value="{{$group->id}}">{{ $group->name }}</option>--}}
{{--                        @endforeach--}}
                    </select><br>
                    <input type="hidden" name="enabled" value="1">
                    <br>
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: red">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
