<?php
namespace App\Http\Controllers;

use App\Models\Investition;
use Illuminate\Support\Facades\Auth;

class InfoInvestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $info = Investition::where('id', $id)
                   ->where('user_id', Auth::user()->id)
                   ->firstOrFail();

        return view('info', compact('info'));
    }
}
