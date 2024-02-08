<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(): View
    {
        return view('admin.dashboard', []);
    }

    public function resources(): View
    {
        $resources = DB::select('SHOW TABLES');

        return view('admin.resources', compact($resources));
    }

    // public function resource($resource): View
    // {
    //     if (Schema::hasTable($resource)) 
    //     {
    //         $query = DB::table($resource)->paginate(25);
    //     }
    //     else
    //     {
    //         abort(404);
    //     }

    //     return view('resource', ['query' => $query]);
    // }
}
