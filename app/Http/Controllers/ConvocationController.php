<?php

namespace App\Http\Controllers;

use App\Models\Convocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ConvocationStoreRequest;
use App\Http\Requests\ConvocationUpdateRequest;

class ConvocationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Convocation::class);

        $search = $request->get('search', '');

        $convocations = Convocation::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.convocations.index',
            compact('convocations', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Convocation::class);

        return view('app.convocations.create');
    }

    /**
     * @param \App\Http\Requests\ConvocationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvocationStoreRequest $request)
    {
        $this->authorize('create', Convocation::class);

        $validated = $request->validated();
        if ($request->hasFile('logo_path')) {
            $validated['logo_path'] = $request
                ->file('logo_path')
                ->store('public');
        }

        $convocation = Convocation::create($validated);

        return redirect()
            ->route('convocations.edit', $convocation)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Convocation $convocation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Convocation $convocation)
    {
        $this->authorize('view', $convocation);

        return view('app.convocations.show', compact('convocation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Convocation $convocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Convocation $convocation)
    {
        $this->authorize('update', $convocation);

        return view('app.convocations.edit', compact('convocation'));
    }

    /**
     * @param \App\Http\Requests\ConvocationUpdateRequest $request
     * @param \App\Models\Convocation $convocation
     * @return \Illuminate\Http\Response
     */
    public function update(
        ConvocationUpdateRequest $request,
        Convocation $convocation
    ) {
        $this->authorize('update', $convocation);

        $validated = $request->validated();
        if ($request->hasFile('logo_path')) {
            if ($convocation->logo_path) {
                Storage::delete($convocation->logo_path);
            }

            $validated['logo_path'] = $request
                ->file('logo_path')
                ->store('public');
        }

        $convocation->update($validated);

        return redirect()
            ->route('convocations.edit', $convocation)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Convocation $convocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Convocation $convocation)
    {
        $this->authorize('delete', $convocation);

        if ($convocation->logo_path) {
            Storage::delete($convocation->logo_path);
        }

        $convocation->delete();

        return redirect()
            ->route('convocations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
