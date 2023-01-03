<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $audits = \OwenIt\Auditing\Models\Audit::with('user')->orderBy('created_at', 'desc')->get();
        return view('audits.list', ['audits' => $audits]);
    }

    public function list()
    {
        $audits = \OwenIt\Auditing\Models\Audit::with('user')->orderBy('created_at', 'desc')->get();
        return view('audits.index', ['audits' => $audits]);
    }
}
