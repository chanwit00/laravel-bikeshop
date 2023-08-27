<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Typebook;
use Config, Validator;


class TypebookController extends Controller
{
    var $rp = 10;
    public function index() {
        $typebooks = typebook::paginate($this->rp);
        return view('typebook/index',compact('typebooks'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $typebooks = typebook::where('id', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->paginate($this->rp);
        }
        else {
            $typebooks = typebook::paginate($this->rp);
            }
        return view('typebook/index', compact('typebooks'));
        }

    public function edit($id = null) {
        if($id) {
            $typebooks = typebook::find($id);
            return view('typebook/edit')->with('typebook', $typebooks);  
        } else {
            return view('typebook/add');
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
        return redirect('typebook/edit/'.$id)
        ->withErrors($validator)
        ->withInput();
        }

        $typebooks = typebook::find($id);
        $typebooks->id = $request->id;
        $typebooks->name = $request->name;
 
        $typebooks->save();
        return redirect('typebook')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    }
    public function insert(Request $request){

        $typebooks = new typebook();
        $typebooks->name = $request->name;
        $typebooks->save();


        return redirect('typebook')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');
    }

    public function remove($id) {
        typebook::find($id)->delete();
        return redirect('typebook')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
}
