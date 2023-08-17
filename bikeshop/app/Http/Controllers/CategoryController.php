<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Config, Validator;

class CategoryController extends Controller
{   
    var $rp = 10;
    public function index() {
        // $products = Product::all();
        $categorys = category::paginate($this->rp);
        return view('category/index',compact('categorys'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $categorys = category::where('id', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->paginate($this->rp);
        }
        else {
            $categorys = category::paginate($this->rp);
            }
        return view('category/index', compact('categorys'));
        }

    public function edit($id = null) {
        if($id) {
            $categorys = category::find($id);
            return view('category/edit')->with('category', $categorys);  
        } else {
            return view('category/add');
        }
      
    
        
    }

    public function update(Request $request) {
        $rules = array(
            'name' => 'required',
            );
            
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            );
            
        $id = $request->id;

        $temp = array(
            'id' => $request->id,
            'name' => $request->name
            );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
        return redirect('category/edit/'.$id)
        ->withErrors($validator)
        ->withInput();
        }

        $categorys = category::find($id);
        $categorys->id = $request->id;
        $categorys->name = $request->name;
 
        $categorys->save();
        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    }
    public function insert(Request $request){

        $categorys = new category();
        $categorys->name = $request->name;
        $categorys->save();


        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');
    }

    public function remove($id) {
        category::find($id)->delete();
        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
}
            