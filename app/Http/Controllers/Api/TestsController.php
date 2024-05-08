<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestsController extends Controller
{
public function index(Request $request)
{
    $searchWord = $request->query('searchWord');
    $filter = $request->query('filter');

    $query = Test::query();
 // if condition {for searchword and filter}
    if (!$searchWord) {
        return response()->json(['message' => 'Missing  parameter: search Word']);
    }
    if ($filter) {
        $firstChar = substr($filter, 0, 1);
        $query->where('name', 'like', "$firstChar%");
    }

    $query->where('name', 'like', "%{$searchWord}%");

    $tests = $query->get();

    if ($tests->isEmpty()) {

        return response()->json(['message' => 'No tests found for this search query'] );
    }

    return response()->json($tests);
}

}
