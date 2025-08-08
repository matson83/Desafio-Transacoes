@extends('layouts.app')

@section('content')
<h1>Lista de Transações</h1>

<table>
    <thead>
        <tr>
            <th>Data e Hora</th>
            <th>Valor (R$)</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $t)
        <tr>
            <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ number_format($t->valor, 2, ',', '.') }}</td>
            <td>
                <div class="dropdown">
                    <button>...</button>
                    <div class="dropdown-menu">
                        <a href="{{ route('transactions.show', $t) }}">Ver</a>
                        <a href="{{ route('transactions.edit', $t) }}">Editar</a>
                        <form method="POST" action="{{ route('transactions.destroy', $t) }}" onsubmit="return confirm('Confirmar exclusão?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $transactions->links() }}

<a href="{{ route('transactions.create') }}">Cadastrar Nova Transação</a>
@endsection
