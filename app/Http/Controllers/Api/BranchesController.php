<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchesController extends Controller
{
    public function index()
    {
         $branches = Branch::all();
        return response()->json($branches);
    }
}
