<?php

namespace App\Http\Controllers;

use App\Helpers\GroupHelper;
use App\Http\Requests\GroupGetRequest;

class GroupController extends Controller
{
    public function index(GroupGetRequest $request)
    {
        $input = $request->validated();
        $groups = GroupHelper::getGroups($input);

        if ($groups->isEmpty()) return response()->error("Groups not found", 404);

        $completeGroups = GroupHelper::parseGroupsForTableDisplay($groups->items());

        $additionalData = [
            "pagination:total_items" => $groups->total(),
            "pagination:per_page" => (int)$request->perPage,
            "pagination:page" => (int)$request->page
        ];

        return response()->success($completeGroups, $additionalData);
    }
}
