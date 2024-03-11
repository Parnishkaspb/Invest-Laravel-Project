<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function index()
    {
        $user = User::where('id',Auth::user()->id)
                   ->firstOrFail();
        return view('edit', compact('user'));
    }

    public function update(Request $request)
    {
        return redirect()->route('edit')->with('success', 'Профиль успешно обновлен!');
    }
}
