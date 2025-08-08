@extends('layouts.app')

@section('content')
<h1>Detalhes da Transação</h1>

<p><strong>Data:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
<p><strong>Valor:</strong> R$ {{ number_format($transaction->value, 2, ',', '.') }}</p>
<p><strong>CPF:</strong> {{ $transaction->cpf }}</p>
<p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>

@if($transaction->document_path)
    <p><a href="{{ asset('storage/'.$transaction->document_path) }}" target="_blank">Visualizar Documento</a></p>
@endif

<a href="{{ route('transactions.index') }}">Voltar</a>
@endsection
