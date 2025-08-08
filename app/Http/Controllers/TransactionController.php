<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Rules\Cpf;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TransactionController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Pega transações do tenant e usuário autenticado
    $transactions = Transaction::where('user_id', auth()->id())->paginate(10);
    return view('transactions.index', compact('transactions'));
}

public function create()
{
    return view('transactions.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'valor' => 'required|numeric|min:0.01',
        'cpf' => new Cpf, // pode usar regra custom ou regex
        'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'status' => 'required|in:Em processamento,Aprovada,Negada',
    ]);

    if ($request->hasFile('document')) {
        $data['document_path'] = $request->file('document')->store('documents');
    }

    $data['user_id'] = auth()->id();

    Transaction::create($data);

    return redirect()->route('transactions.index')->with('success', 'Transação criada!');
}

public function show(Transaction $transaction)
{
    $this->authorize('view', $transaction);
    return view('transactions.show', compact('transaction'));
}

public function edit(Transaction $transaction)
{
    $this->authorize('update', $transaction);
    return view('transactions.edit', compact('transaction'));
}

public function update(Request $request, Transaction $transaction)
{
    $this->authorize('update', $transaction);

    $data = $request->validate([
        'value' => 'required|numeric|min:0.01',
        'cpf' => 'required|cpf',
        'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'status' => 'required|in:processing,approved,denied',
    ]);

    if ($request->hasFile('document')) {
        // opcional: delete o arquivo antigo
        $data['document_path'] = $request->file('document')->store('documents');
    }

    $transaction->update($data);

    return redirect()->route('transactions.index')->with('success', 'Transação atualizada!');
}

public function destroy(Transaction $transaction)
{
    $this->authorize('delete', $transaction);
    $transaction->delete(); // Soft delete
    return redirect()->route('transactions.index')->with('success', 'Transação excluída!');
}

}
