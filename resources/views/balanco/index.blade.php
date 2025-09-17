@extends('layouts.app')

@section('content')
<div class="shadow-sm card">
    <div class="bg-white card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Resumo do Balanço de Transações (Aprovadas)</h5>
        <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Voltar para Transações
        </a>
    </div>

    <div class="card-body">
        <div class="row text-center">
            <div class="col-md-4 mb-3">
                <div class="p-3 rounded bg-light shadow-sm">
                    <h6 class="text-muted">Entradas</h6>
                    <h4 class="text-success">
                        R$ {{ number_format($entradas, 2, ',', '.') }}
                    </h4>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="p-3 rounded bg-light shadow-sm">
                    <h6 class="text-muted">Saídas</h6>
                    <h4 class="text-danger">
                        R$ {{ number_format($saidas, 2, ',', '.') }}
                    </h4>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="p-3 rounded shadow-sm
                    {{ $balanco >= 0 ? 'bg-success text-white' : 'bg-danger text-white' }}">
                    <h6>Balanço Total</h6>
                    <h3>
                        R$ {{ number_format($balanco, 2, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
