@extends('layouts.app')

@section('content')
<div class="shadow-sm card">
    <div class="bg-white card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Transações</h5>
        <form action="{{ route('transactions.index') }}" method="GET" class="d-flex">
            <input
                type="text"
                name="search"
                class="form-control form-control-sm me-2"
                placeholder="Buscar..."
                value="{{ request('search') }}"
            >
            <button class="btn btn-outline-secondary btn-sm" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
    <div class="list-group list-group-flush">
        @forelse($transactions as $t)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('transactions.show', $t) }}" style="text-decoration: none; color: inherit;" >
                        <strong>R$ {{ number_format($t->valor, 2, ',', '.') }}</strong>
                    - {{ $t->status }}
                    - {{ $t->created_at->format('d/m/Y H:i:s') }}
                    </a>

                </div>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('transactions.show', $t) }}">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('transactions.edit', $t) }}">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </li>
                        <li>
                            <form
                                method="POST"
                                action="{{ route('transactions.destroy', $t) }}"
                                onsubmit="return confirm('Confirmar exclusão?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-trash"></i> Excluir
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @empty
            <div class="list-group-item text-muted">
                Nenhuma transação encontrada.
            </div>
        @endforelse

        <div class="mt-3 text-black">
            {{ $transactions->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
