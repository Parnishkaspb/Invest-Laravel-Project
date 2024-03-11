<?php



namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = User::find(Auth::user()->id);
        $investitions = $user->agreedInvestitions;
        $all_investititon = $user->investitions;

        // return view('home', ['investition' => $investitions, 'all_invst' => $all_investititon]);
        return view('home', ['investition' => $all_investititon, 'all_invst' => $all_investititon]);
    }
}