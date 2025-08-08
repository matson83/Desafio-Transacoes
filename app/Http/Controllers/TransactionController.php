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
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Transaction::where('user_id', auth()->id());

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('status', 'ilike', "%{$search}%")
              ->orWhereRaw("CAST(valor AS TEXT) ILIKE ?", ["%{$search}%"]);
        });
    }

    $transactions = $query->orderBy('created_at', 'desc')->paginate(10);

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
        'cpf' => new Cpf,
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
        'valor' => 'required|numeric|min:0.01',
        'cpf' => ['required', new Cpf],
        'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        'status' => 'required|in:Em processamento,Aprovada,Negada',
    ]);

    if ($request->hasFile('document')) {
        $data['documento'] = $request->file('document')->store('documents','public');
    }

    if ($request->has('remove_document') && $transaction->documento) {
        \Storage::disk('public')->delete($transaction->documento);
        $data['documento'] = null;
    }

    $transaction->update($data);

    return redirect()->route('transactions.index')->with('success', 'Transação atualizada!');
}

public function destroy(Transaction $transaction)
{
    $this->authorize('delete', $transaction);
    $transaction->delete();
    return redirect()->route('transactions.index')->with('success', 'Transação excluída!');
}

}
