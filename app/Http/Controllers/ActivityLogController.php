<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        if (request()->user()->cannot('viewAny', Activity::class)) {
            abort(403);
        }

        return view('modules.activity-logs.index');
    }
}
