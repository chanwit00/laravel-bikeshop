<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Config, Validator;

class ProductController extends Controller
{   
    var $rp = 2;
    public function index() {
        // $products = Product::all();
        $products = Product::paginate($this->rp);
        return view('product/index',compact('products'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $products = Product::where('code', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->paginate($this->rp);
        }
        else {
            $products = Product::paginate($this->rp);
            }
        return view('product/index', compact('products'));
        }

    public function edit($id = null) {
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', '');
        $product = Product::find($id);

        return view('product/edit')->with('product', $product)->with('categories', $categories);  
    }

    public function update(Request $request) {
        $rules = array(
            'code' => 'required', 'name' => 'required',
            'category_id' => 'required|numeric', 'price' => 'numeric',
            'stock_qty' => 'numeric',
            );
            
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
            :attribute ให้เป็นตัวเลข',
            );
            
        $id = $request->id;
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'stock_qty' => $request->stock_qty,
            'price' => $request->price,
            'image' => $request->image,

            );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
        return redirect('product/edit/'.$id)
        ->withErrors($validator)
        ->withInput();
        }

        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;

        $product->save();
        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    }
}
            
class CategoryController extends Controller {
    public function index() {
        // $categorys = Category::all();
        $categorys = Category::paginate($this->rp);
        return view('category/index',compact('categorys'));
    }
    public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $categorys = Category::where('code', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->paginate($this->rp);
        }
        else {
            $categorys = Product::paginate($this->rp);
            }
        return view('category/index', compact('categorys'));
        }

}