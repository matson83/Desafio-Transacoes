@extends('layouts.app')

@section('title', 'Detalhes da Transação')

@section('content')
<div class="shadow-sm card">
    <div class="bg-white card-header">
        <h5 class="mb-0">Detalhes da Transação</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <strong>Data:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}
        </div>
        <div class="mb-3">
            <strong>Valor:</strong> R$ {{ number_format($transaction->valor, 2, ',', '.') }}
        </div>
        <div class="mb-3">
            <strong>CPF:</strong> {{ $transaction->cpf }}
        </div>
        <div class="mb-3">
            <strong>Status:</strong> {{ ucfirst($transaction->status) }}
        </div>
        @if($transaction->documento)
            <div class="mb-3">
                <strong>Documento:</strong>
                <a href="{{ asset('storage/'.$transaction->documento) }}"
                   target="_blank"
                   class="btn btn-outline-primary btn-sm ms-2">
                    <i class="bi bi-file-earmark-text"></i> Visualizar Documento
                </a>
            </div>
        @endif
        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
            <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-dark">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>
</div>
@endsection
