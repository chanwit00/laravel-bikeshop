<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shoe;
use App\Models\Brand;
use Config, Validator;

class ShoeController extends Controller
{
    var $rp = 10;
    public function index() {

        $shoes = Shoe::paginate($this->rp);
        return view('shoe/index',compact('shoes'));
    }
    public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $shoes = Shoe::where('code', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->paginate($this->rp);
        }
        else {
            $shoes = Shoe::paginate($this->rp);
            }
        return view('shoe/index', compact('shoes'));
        }

    public function edit($id = null) {
        $brands = Brand::pluck('name', 'id')->prepend('เลือกรายการ', '');
        if($id) {
            // edit view
            $shoe = Shoe::where('id', $id)->first(); return view('shoe/edit')
            ->with('shoe', $shoe)
            ->with('brands', $brands);
            } else {
            // add view
            return view('shoe/add')
            ->with('brands', $brands);
            }
        }

    public function update(Request $request) {
        $rules = array(
            'code' => 'required', 'name' => 'required',
            'brand_id' => 'required|numeric',
            'price' => 'numeric',
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
            'brand_id' => $request->brand_id,
            'stock_qty' => $request->stock_qty,
            'price' => $request->price,
            'image' => $request->image,

            );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
        return redirect('shoe/edit/'.$id)
        ->withErrors($validator)
        ->withInput();
        }


        $shoe = Shoe::find($id);
        $shoe->code = $request->code;
        $shoe->name = $request->name;
        $shoe->brand_id = $request->brand_id;
        $shoe->price = $request->price;
        $shoe->stock_qty = $request->stock_qty;

    
        $shoe->save();

        if($request->hasFile('image'))
        {
            $f = $request->file('image');
            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            $f->move($absolute_path, $f->getClientOriginalName());

            $shoe->image_url = $relative_path;
            $shoe->save();
        }

        return redirect('shoe')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    }

    public function insert(Request $request){

        $shoe = new Shoe();
        $shoe->code = $request->code;
        $shoe->name = $request->name;
        $shoe->brand_id = $request->brand_id;
        $shoe->price = $request->price;
        $shoe->stock_qty = $request->stock_qty;
        $shoe->save();

        if($request->hasFile('image'))
        {
            $f = $request->file('image');
            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            $f->move($absolute_path, $f->getClientOriginalName());

            $shoe->image_url = $relative_path;
            $shoe->save();
        }

        return redirect('shoe')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');
    }

    public function remove($id) {
        Shoe::find($id)->delete();
        return redirect('shoe')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
    
}
