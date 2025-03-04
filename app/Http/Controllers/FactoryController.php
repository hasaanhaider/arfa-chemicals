<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Services\FactoryService;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    // public function index()
    // {
    //     return view('fac');
    // }

    protected $factory;
    public function __construct(FactoryService $factory)
    {
        $this->factory = $factory;
    }

    public function index()
    {
        return view('factories.index', ['factories' => $this->factory->getFactories()]);
    }

    public function create()
    {
        return view('factories.create');
    }

    public function store(Request $request)
    {
        try {
            $this->factory->createFactory($request->all());
            return view('factories.create')->with('success', 'Factory added successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        return view('factories.edit', ['factory' => $this->factory->editFactory($id)]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->factory->updateFactory($request->all());
            return back()->with('success', 'Factory updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->factory->delete($id);
            return back()->with('success', 'Factory deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
