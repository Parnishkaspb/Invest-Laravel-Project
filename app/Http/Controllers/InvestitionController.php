<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Investition;

class InvestitionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('investition');
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'depositAmount' => 'required|numeric|min:3000000',
            'depositTerm' => 'required|in:1,2,3,5',
            'hidden_money' => ['required', 'numeric', 'min:'.$request->input('depositAmount')],
            'hidden_date' => [
                'required',
                'date_format:d.m.Y',
                function ($attribute, $value, $fail) use ($request) {
                    $depositTerm = $request->input('depositTerm');
                    $expectedDate = Carbon::now()->addYears($depositTerm)->format('d.m.Y');
                    if ($value !== $expectedDate) {
                        $fail($attribute.' должна быть '.$expectedDate);
                    }
                },
            ],
        ]);
        
        $insetition = new Investition();
        $insetition->investment_amount = $validatedData['depositAmount'];
        $insetition->investment_amount_result = $validatedData['hidden_money'];
        $insetition->quantity_time = $validatedData['depositTerm'];
        $insetition->end_time = Carbon::createFromFormat('d.m.Y', $validatedData['hidden_date'])
                                ->format('Y-m-d');
        $insetition->user_id = Auth::user()->id;
        $insetition->is_agreed = 0;

        if ($insetition->save()) {
            return back()->with('success', 'Инвестиция успешно добавлена');
        } else {
            return back()->with('error', 'Произошла ошибка при добавлении инвестиции');
        }

    }
}
