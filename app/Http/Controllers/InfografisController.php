<?php

namespace App\Http\Controllers;

use App\Models\Demografi;
use App\Models\ApbdesSummary;
use App\Models\ApbdesDetail;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function penduduk()
    {
        $demografi = Demografi::first();
        return view('frontend.infografis.penduduk', compact('demografi'));
    }

    public function apbd(Request $request)
    {
        $selectedYear = $request->query('tahun');
        
        $years = ApbdesSummary::orderBy('tahun', 'desc')->pluck('tahun');
        
        if ($selectedYear) {
            $summary = ApbdesSummary::where('tahun', $selectedYear)->first();
        } else {
            $summary = ApbdesSummary::orderBy('tahun', 'desc')->first();
        }

        $details = [];
        if ($summary) {
            $details = ApbdesDetail::where('id_summary', $summary->id)->get();
        }

        return view('frontend.infografis.apbd', compact('summary', 'details', 'years', 'selectedYear'));
    }
}
