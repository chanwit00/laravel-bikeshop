<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\Brand;
use Config, Validator;

class BrandController extends Controller
{
    var $rp = 10;
    public function index() {

        $brands = brand::paginate($this->rp);
        return view('brand/index',compact('brands'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $brands = brand::where('id', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->paginate($this->rp);
        }
        else {
            $brands = brand::paginate($this->rp);
            }
        return view('brand/index', compact('brands'));
        }

    public function edit($id = null) {
        if($id) {
            $brands = brand::find($id);
            return view('brand/edit')->with('brand', $brands);  
        } else {
            return view('brand/add');
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
        return redirect('brand/edit/'.$id)
        ->withErrors($validator)
        ->withInput();
        }

        $brands = brand::find($id);
        $brands->id = $request->id;
        $brands->name = $request->name;
 
        $brands->save();
        return redirect('brand')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    }
    public function insert(Request $request){

        $brands = new brand();
        $brands->name = $request->name;
        $brands->save();


        return redirect('brand')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');
    }

    public function remove($id) {
        brand::find($id)->delete();
        return redirect('brand')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
}
