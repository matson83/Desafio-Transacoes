@extends('layouts.app')

@section('content')
<h1>{{ isset($transaction) ? 'Editar' : 'Cadastrar' }} Transação</h1>

<form method="POST" action="{{ isset($transaction) ? route('transactions.update', $transaction) : route('transactions.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($transaction))
        @method('PUT')
    @endif

    <label>Valor (R$):</label>
    <input type="number" step="0.01" name="valor" value="{{ old('valor', $transaction->valor ?? '') }}" required>

    <label>CPF:</label>
    <input type="text" name="cpf" value="{{ old('cpf', $transaction->cpf ?? '') }}" required>

    <label>Status:</label>
    <select name="status" required>
        <option value="Em processamento" {{ (old('status', $transaction->status ?? '') == 'Em processamento') ? 'selected' : '' }}>Em processamento</option>
        <option value="Aprovada" {{ (old('status', $transaction->status ?? '') == 'Aprovada') ? 'selected' : '' }}>Aprovada</option>
        <option value="Negada" {{ (old('status', $transaction->status ?? '') == 'Negada') ? 'selected' : '' }}>Negada</option>
    </select>

    <label>Documento:</label>
    <input type="file" name="document" accept=".pdf,.jpg,.jpeg,.png">

    <button type="submit">Salvar</button>
</form>
@endsection
