<?php

namespace App\Http\Controllers;

class SearchController extends Controller
{
    public function __invoke()
    {
        return statamicView('search.index');
    }
}
