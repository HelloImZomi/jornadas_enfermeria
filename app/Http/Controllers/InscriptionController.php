<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Inscription;
use App\Models\Convocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InscriptionStoreRequest;
use App\Http\Requests\InscriptionUpdateRequest;

class InscriptionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Inscription::class);

        $search = $request->get('search', '');

        $inscriptions = Inscription::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.inscriptions.index',
            compact('inscriptions', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Inscription::class);

        $convocations = Convocation::pluck('name', 'id');
        $schools = School::pluck('name', 'id');

        return view(
            'app.inscriptions.create',
            compact('convocations', 'schools')
        );
    }

    /**
     * @param \App\Http\Requests\InscriptionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InscriptionStoreRequest $request)
    {
        $this->authorize('create', Inscription::class);

        $validated = $request->validated();
        if ($request->hasFile('receipt_path')) {
            $validated['receipt_path'] = $request
                ->file('receipt_path')
                ->store('public');
        }

        $inscription = Inscription::create($validated);

        return redirect()
            ->route('inscriptions.edit', $inscription)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inscription $inscription
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Inscription $inscription)
    {
        $this->authorize('view', $inscription);

        return view('app.inscriptions.show', compact('inscription'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inscription $inscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Inscription $inscription)
    {
        $this->authorize('update', $inscription);

        $convocations = Convocation::pluck('name', 'id');
        $schools = School::pluck('name', 'id');

        return view(
            'app.inscriptions.edit',
            compact('inscription', 'convocations', 'schools')
        );
    }

    /**
     * @param \App\Http\Requests\InscriptionUpdateRequest $request
     * @param \App\Models\Inscription $inscription
     * @return \Illuminate\Http\Response
     */
    public function update(
        InscriptionUpdateRequest $request,
        Inscription $inscription
    ) {
        $this->authorize('update', $inscription);

        $validated = $request->validated();
        if ($request->hasFile('receipt_path')) {
            if ($inscription->receipt_path) {
                Storage::delete($inscription->receipt_path);
            }

            $validated['receipt_path'] = $request
                ->file('receipt_path')
                ->store('public');
        }

        $inscription->update($validated);

        return redirect()
            ->route('inscriptions.edit', $inscription)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Inscription $inscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Inscription $inscription)
    {
        $this->authorize('delete', $inscription);

        if ($inscription->receipt_path) {
            Storage::delete($inscription->receipt_path);
        }

        $inscription->delete();

        return redirect()
            ->route('inscriptions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
