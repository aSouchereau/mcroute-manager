<?php

namespace App\Http\Controllers;

use App\Actions\Groups\Toggle as ToggleGroup;
use App\Http\Requests\GroupRequest;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GroupController extends Controller
{
    private ToggleGroup $toggleGroup;

    function __construct(ToggleGroup $toggleGroup)
    {
        $this->toggleGroup = $toggleGroup;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
     $groups = Group::all();
     return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupRequest $request): RedirectResponse
    {
        $formData = $request->all();
        Group::create($formData);
        return redirect('groups');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($group): View
    {
        $group = Group::findOrFail($group);
        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupRequest $request, Group $group): RedirectResponse
    {
        $formData = $request->all();
        $group = Group::findOrFail($group->id);
        $group->update($formData);

        return redirect('groups');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group): RedirectResponse
    {
        $group = Group::findOrFail($group->id);
        $group->delete();

        return redirect('groups');
    }

    public function toggle(Group $group) {
        $this->toggleGroup->toggle($group);

        return redirect('groups');
    }
}
