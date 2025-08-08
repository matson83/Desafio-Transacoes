@extends('layouts.app')

@section('title', isset($transaction) ? 'Editar Transação' : 'Cadastrar Transação')

@section('content')
<div class="shadow-sm card">
    <div class="bg-white card-header">
        <h5 class="mb-0">{{ isset($transaction) ? 'Editar' : 'Cadastrar' }} Transação</h5>
    </div>
    <div class="card-body">
        <form
            method="POST"
            action="{{ isset($transaction) ? route('transactions.update', $transaction) : route('transactions.store') }}"
            enctype="multipart/form-data"
        >
            @csrf
            @if(isset($transaction))
                @method('PATCH')
            @endif

            <div class="mb-3">
                <label class="form-label">Valor (R$)</label>
                <input
                    type="number"
                    step="0.01"
                    name="valor"
                    value="{{ old('valor', $transaction->valor ?? '') }}"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input
                    type="text"
                    name="cpf"
                    value="{{ old('cpf', $transaction->cpf ?? '') }}"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Em processamento" {{ old('status', $transaction->status ?? '') == 'Em processamento' ? 'selected' : '' }}>Em processamento</option>
                    <option value="Aprovada" {{ old('status', $transaction->status ?? '') == 'Aprovada' ? 'selected' : '' }}>Aprovada</option>
                    <option value="Negada" {{ old('status', $transaction->status ?? '') == 'Negada' ? 'selected' : '' }}>Negada</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Documento</label>
                <input
                    type="file"
                    name="document"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png"
                >
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-save"></i> Salvar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
