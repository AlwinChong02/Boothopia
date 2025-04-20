<?php

namespace App\Http\Controllers;

use App\Models\EventsModel;
use App\Models\SearchModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends BaseController
{
    public function index()
    {
        return view('searchBar.index');
    }

    public function search(Request $request)
    {
        $results = SearchModel::where('name', 'LIKE', "%{$request->search}%")->get();
        return view('searchBar.results', compact('results'))->with('search', $request->search);
    }
}