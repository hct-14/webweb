<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportUserController extends Controller
{
    public function export()
    {
        return Excel::download(new UserExport(), 'users'.'.xlsx');
    }

}
