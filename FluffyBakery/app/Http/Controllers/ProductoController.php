<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'    => 'required|string|min:3|max:100',
            'id_category'     => 'nullable|integer',
            'description'     => 'nullable|string|max:500',
            'ingredients'     => 'nullable|string|max:500',
            'price'           => 'required|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'available_unity' => 'required|integer|min:0',
            'minimum_stock'   => 'nullable|integer|min:0',
            'maximum_stock'   => 'nullable|integer|min:0',
            'status'          => 'required|boolean',
            'display_order'   => 'nullable|integer|min:0',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = time().'_'.$request->image->getClientOriginalName();
            $request->image->storeAs('public/products', $filename);
            $data['image'] = $filename;
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'product_name'    => 'required|string|min:3|max:100',
            'id_category'     => 'nullable|integer',
            'description'     => 'nullable|string|max:500',
            'ingredients'     => 'nullable|string|max:500',
            'price'           => 'required|numeric|min:0',
            'discount'        => 'nullable|numeric|min:0|max:100',
            'available_unity' => 'required|integer|min:0',
            'minimum_stock'   => 'nullable|integer|min:0',
            'maximum_stock'   => 'nullable|integer|min:0',
            'status'          => 'required|boolean',
            'display_order'   => 'nullable|integer|min:0',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($producto->image) {
                Storage::delete('public/products/'.$producto->image);
            }
            $filename = time().'_'.$request->image->getClientOriginalName();
            $request->image->storeAs('public/products', $filename);
            $data['image'] = $filename;
        }

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->image) {
            Storage::delete('public/products/'.$producto->image);
        }
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
