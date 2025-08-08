@extends('layouts.app')

@section('title', 'Editar Transação')

@section('content')
<div class="shadow-sm card">
    <div class="card-body">
        <form method="POST" action="{{ route('transactions.update', $transaction) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label class="form-label">Valor (R$):</label>
                <input type="number" step="0.01" name="valor" class="form-control"
                       value="{{ old('valor', $transaction->valor) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CPF:</label>
                <input type="text" name="cpf" class="form-control"
                       value="{{ old('cpf', $transaction->cpf) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status:</label>
                <select name="status" class="form-select" required>
                    <option value="Em processamento" @selected(old('status', $transaction->status) == 'Em processamento')>Em processamento</option>
                    <option value="Aprovada" @selected(old('status', $transaction->status) == 'Aprovada')>Aprovada</option>
                    <option value="Negada" @selected(old('status', $transaction->status) == 'Negada')>Negada</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Documento:</label>
                <input type="file" name="document" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
            </div>

            @if($transaction->documento)
                <div class="mb-3">
                    <label class="form-label">Documento atual:</label>
                    <a href="{{ asset('storage/'.$transaction->documento) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-file-earmark-text"></i> Visualizar Documento
                    </a>
                    <button type="submit" name="remove_document" value="1" class="btn btn-outline-danger btn-sm ms-2">
                        <i class="bi bi-trash"></i> Remover Documento
                    </button>
                </div>
            @endif

            <div class="mt-4 d-flex justify-content-between">
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
