<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstituteRequest;
use App\Http\Requests\InstituteUpdateRequest;
use App\Models\Institute;
use App\Models\Product;
use Illuminate\Http\Request;

class InstistuteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institutes = Institute::join('products', 'products.id', '=', 'institutes.id_product')
            ->select('institutes.*', 'products.name as product_name')
            ->get();
        return view('institute.index', compact('institutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('institute.add', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstituteRequest $request)
    {
        $logo = null;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos');
        }

        $data = $request->validated();
        $data['logo'] = $logo;

        Institute::create($data);

        return redirect()->route('institusi.index')->with('success', 'Berhasil menambahkan institusi baru.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::all();

        $institute = Institute::find($id);
        return view('institute.edit', compact('institute', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstituteUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        $institute = Institute::find($id);

        $logo = $institute->logo;
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('logos');
        }

        if (!$request->filled('password')) {
            unset($data['password']);
        }

        $data['logo'] = $logo;

        $institute->update($data);

        return redirect()->route('institusi.index')->with('success', 'Berhasil mengubah data institusi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $institute = Institute::find($id);
        $institute->delete();

        return redirect()->route('institusi.index')->with('success', 'Berhasil menghapus data institusi.');
    }
}
