<?php

namespace App\Http\Controllers;

use App\Helpers\GroupHelper;
use App\Http\Requests\GroupGetRequest;
use App\Http\Resources\GroupCollection;

class GroupController extends Controller
{
    public function index(GroupGetRequest $request)
    {
        $input = $request->validated();
        $groups = GroupHelper::getGroups($input);

        $additionalData = [
            "pagination:total_items" => $groups->total(),
            "pagination:per_page" => (int)$request->perPage,
            "pagination:page" => (int)$request->page
        ];

        return response()->success(new GroupCollection($groups), $additionalData);
    }
}
