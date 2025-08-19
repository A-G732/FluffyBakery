<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $categoryParam = $request->query('category');
        $map = config('categories.map', []);

        // Por defecto mostrar "pasteles" para alinear con la UI
        if ($categoryParam === null || $categoryParam === '') {
            $categoryParam = 'pasteles';
        }

        $query = Producto::query()->orderBy('product_name');

        // Búsqueda por nombre
        $search = $request->query('q');
        if ($search) {
            $query->where('product_name', 'like', '%'.$search.'%');
        }

        $categoryId = null;
        if (is_numeric($categoryParam)) {
            $categoryId = (int) $categoryParam;
        } elseif (isset($map[$categoryParam])) {
            $categoryId = (int) $map[$categoryParam];
        }

        if (!is_null($categoryId)) {
            $query->where('id_category', $categoryId);
        }

        $productos = $query->paginate(10);

        $activeCategory = $categoryParam;

        return view('admin.productos.index', compact('productos', 'activeCategory'));
    }

    public function create()
    {
        $map = config('categories.map', []);
        $categoryOptions = [];
        foreach ($map as $slug => $id) {
            $categoryOptions[$id] = ucfirst($slug);
        }

        return view('admin.productos.create', compact('categoryOptions'));
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
            $destination = public_path('storage/products');
            if (!is_dir($destination)) {
                @mkdir($destination, 0775, true);
            }
            $request->image->move($destination, $filename);
            $data['image'] = $filename;
        }

        Producto::create($data);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    public function edit(Producto $producto)
    {
        $map = config('categories.map', []);
        $categoryOptions = [];
        foreach ($map as $slug => $id) {
            $categoryOptions[$id] = ucfirst($slug);
        }

        return view('admin.productos.edit', compact('producto', 'categoryOptions'));
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
                $oldPath = public_path('storage/products/'.$producto->image);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $filename = time().'_'.$request->image->getClientOriginalName();
            $destination = public_path('storage/products');
            if (!is_dir($destination)) {
                @mkdir($destination, 0775, true);
            }
            $request->image->move($destination, $filename);
            $data['image'] = $filename;
        }

        $producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy(Producto $producto)
    {
        if ($producto->image) {
            $path = public_path('storage/products/'.$producto->image);
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
