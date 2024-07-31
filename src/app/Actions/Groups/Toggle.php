<?php
/*      Group Toggle
 * Disables/Enables all routes within the target group.
 * This is a destructive action, meaning it will overwrite each
 * routes enabled value which cannot be restored. e.g.
 *
 * To achieve this we should explicitly set all enabled fields to 0 or 1,
 * rather than simply swapping as that would produce confusing behaviour.
 *
 */

namespace App\Actions\Groups;

use App\Models\Group;
use App\Actions\Routes\Toggle as RouteToggle;
use Illuminate\Http\Client\HttpClientException;

class Toggle
{
    private RouteToggle $toggleRoute;

    function __construct(RouteToggle $toggleRoute)
    {
        $this->toggleRoute = $toggleRoute;
    }


    /**
     * Enable/Disable all routes within a group.
     *
     * @return void
     */
    public function toggle(Group $group) {
        try {
            if ($group->enabled) {
                $this->disableGroup($group);
            } else {
                $this->enableGroup($group);
            }
        } catch (HttpClientException $e) {
            notyf()->addError('Router API: Failed to toggle route status - ' . $e->getMessage());
        }
    }

    private function enableGroup(Group $group) {
        $routes = Group::find($group->id)->routes;

        foreach ($routes as $route) {
            $this->toggleRoute->setEnabled($route);
        }

        $group->enabled = true;
        $group->save();
    }

    private function disableGroup(Group $group) {
        $routes = Group::find($group->id)->routes;

        foreach ($routes as $route) {
            $this->toggleRoute->setDisabled($route);
        }

        $group->enabled = false;
        $group->save();
    }
}
