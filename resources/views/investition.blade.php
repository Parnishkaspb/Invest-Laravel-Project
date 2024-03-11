@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        {{ __('Инвестировать') }}
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif



                    <form method="POST" action="{{ route('investition.create') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="depositAmount" class="col-md-4 col-form-label text-md-end">{{ __('Сумма вклада') }}</label>

                            <div class="col-md-6">
                                <input id="depositAmount" placeholder="Минимальная сумма вклада 3 млн " type="number" class="form-control @error('email') is-invalid @enderror" name="depositAmount" value="{{ old('depositAmount') }}" required  autofocus min="3000000" step="50000">

                                @error('depositAmount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="depositTerm" class="col-md-4 col-form-label text-md-end">{{ __('Срок вклада') }}</label>

                            <div class="col-md-6">
                                <select id="depositTerm" name="depositTerm" class="form-control @error('depositTerm') is-invalid @enderror" required>
                                    <option value="1">1 год (20%)</option>
                                    <option value="2">2 года (25%)</option>
                                    <option value="3">3 года (30%)</option>
                                    <option value="5">5 лет (40%)</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-mb-20">
                            <label for=""></label>
                            
                        </div>
                        <div class="text-center">
                            <p>Сумма после срока: <span id="finalAmount">0</span> руб.</p>
                            <p>Дата закрытия вклада: <span id="closingDate">-</span></p>
                        </div>
                        <div class="row mb-0">
                            <input type="hidden" id="hidden_money" name="hidden_money">
                            <input type="hidden" id="hidden_date" name="hidden_date">
                            <div class="col-md-8 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Создать') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        document.getElementById('depositAmount').addEventListener('input', calculate);
        document.getElementById('depositTerm').addEventListener('change', calculate);

        function calculate() {
            const amount = parseFloat(document.getElementById('depositAmount').value);
            const term = parseInt(document.getElementById('depositTerm').value);
            const rates = {1: 0.20, 2: 0.25, 3: 0.30, 5: 0.40};
            const rate = rates[term];
            
            if (!isNaN(amount) && amount >= 3000000) {
                const finalAmount = amount + amount * rate;
                document.getElementById('finalAmount').textContent = finalAmount.toFixed(2);
                document.getElementById('hidden_money').value = finalAmount;
                const closingDate = new Date();
                closingDate.setFullYear(closingDate.getFullYear() + term);
                document.getElementById('closingDate').textContent = closingDate.toLocaleDateString();
                document.getElementById('hidden_date').value = closingDate.toLocaleDateString();
            } else {
                document.getElementById('finalAmount').textContent = '0';
                document.getElementById('closingDate').textContent = '-';
            }
        }
    </script>
@endsection
