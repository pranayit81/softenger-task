<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products(Request $request)
    {

        $allProducts = Product::all();

        return view("products", compact("allProducts"));
    }

    public function postProduct(Request $request)
    {

        $formData = request()->except(['_token']);


        $this->validate($request, [
            'name' => ['required'],
            'image' => ['required', 'mimes:jpg,png'],
            'price' => ['required'],
            'upc' => ['required'],
            'status' => ['required'],
        ],);

        if ($request->hasFile('image')) {
            $allowedfileExtension = ['jpeg', 'jpg', 'png', 'svg'];
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, $allowedfileExtension)) {
                $formData['image'] = $file->store('products');
            }
        }

        Product::create($formData);

        return redirect()->back()->with('success', 'Product created successfully');
    }

    public function saveProduct(Request $request)
    {

        $formData = request()->except(['_token']);


        $this->validate($request, [
            'name' => ['required'],
            'image' => ['required', 'mimes:jpg,png'],
            'price' => ['required'],
            'upc' => ['required'],
            'status' => ['required'],
        ],);

        if ($request->hasFile('image')) {
            $allowedfileExtension = ['jpeg', 'jpg', 'png', 'svg'];
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, $allowedfileExtension)) {
                $formData['image'] = $file->store('products');
            }
        }

        Product::create($formData);

        return redirect()->back()->with('success', 'Product created successfully');
    }

    public function bulkDelete(Request $request)
    {

        $id = explode(',', $request->emp_id);
        foreach ($id as $i) {
            Product::where('id', $i)->delete();
        }

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function edit($id)
    {

        $product = Product::find($id);

        return view('edit-product', compact('product'));
    }

    public function update(Request $request)
    {


        $formData = request()->except(['_token']);
        $id = $request->product_id;
        $module = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->clientExtension();
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            $file = $request->file('image');
            Storage::delete($formData['old_image']);
            $extension = $file->getClientOriginalExtension();
            if (in_array($extension, $allowedfileExtension)) {
                $formData['image'] = $file->store('module_banners');
            }
        } else {
            $formData['image'] = $formData['old_image'];
        }
        //update product
        $updated = Product::find($module->id)->update($formData);

        return redirect()->route('products')->withSuccess('Product updated successfully.');
    }
}
