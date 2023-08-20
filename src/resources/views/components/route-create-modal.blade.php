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
                    <div class="mb-3">
                        <label class="form-label" for="nickname">Nickname:</label>
                        <input class="form-control" name="nickname" id="nickname" type="text">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="domain_name">Domain Name:</label>
                        <input class="form-control" name="domain_name" id="domain_name" type="text">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="host">Host Address:</label>
                        <input class="form-control" name="host" id="host" type="text">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="group_id">Group</label>
                        <select class="form-select" name="group_id" id="group_id">
                            <option value="" selected>Select Group</option>
                                @foreach($groups as $group)
                                    <option value="{{$group->id}}">{{ $group->name }}</option>
                                @endforeach
                        </select>
                    </div>


                    <input type="hidden" name="enabled" value="1">
                    <br>
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <p style="color: red">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer row">
                    <button type="button" class="btn btn-outline-secondary col-6" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary col-6" value="Create">
                </div>
            </form>
        </div>
    </div>
</div>
