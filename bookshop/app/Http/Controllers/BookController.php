<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Typebook;
use Config, Validator;

use Illuminate\Http\Request;

class BookController extends Controller
{
    var $rp = 10;
    public function index() {
        $books = Book::paginate($this->rp);
        return view('book/index',compact('books'));
    }

    public function search(Request $request) {
        $query = $request->q;
        if($query) {
        $books = Book::where('code', 'like', '%'.$query.'%')
        ->orWhere('name', 'like', '%'.$query.'%')
        ->paginate($this->rp);
        }
        else {
            $books = Book::paginate($this->rp);
            }
        return view('book/index', compact('books'));
        }

    public function edit($id = null) {
        $typebooks = Typebook::pluck('name', 'id')->prepend('เลือกรายการ', '');
        if($id) {
            // edit view
            $book = Book::where('id', $id)->first(); return view('book/edit')
            ->with('book', $book)
            ->with('typebooks', $typebooks);
            } else {
            // add view
            return view('book/add')
            ->with('typebooks', $typebooks);
            }
        }

    public function update(Request $request) {
        $rules = array(
            'code' => 'required', 'name' => 'required',
            'typebook_id' => 'required|numeric', 'price' => 'numeric',
            'stock_qty' => 'numeric',
            );
            
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
             'numeric' => 'กรุณากรอกข้อมูล
            :attribute ให้เป็นตัวเลข',
            );
            
        $id = $request->id;
        $temp = array(
            'code' => $request->code,
            'name' => $request->name,
            'typebook_id' => $request->typebook_id,
            'stock_qty' => $request->stock_qty,
            'price' => $request->price,
            'image' => $request->image,

            );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
        return redirect('book/edit/'.$id)
        ->withErrors($validator)
        ->withInput();
        }


        $book = Book::find($id);
        $book->code = $request->code;
        $book->name = $request->name;
        $book->typebook_id = $request->typebook_id;
        $book->price = $request->price;
        $book->stock_qty = $request->stock_qty;

    
        $book->save();

        if($request->hasFile('image'))
        {
            $f = $request->file('image');
            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            $f->move($absolute_path, $f->getClientOriginalName());

            $book->image_url = $relative_path;
            $book->save();
        }

        return redirect('book')
        ->with('ok', true)
        ->with('msg', 'บันทึกขอมูลเรียบร้อยแล้ว');
    }

    public function insert(Request $request){

        $book = new Book();
        $book->code = $request->code;
        $book->name = $request->name;
        $book->typebook_id = $request->typebook_id;
        $book->price = $request->price;
        $book->stock_qty = $request->stock_qty;
        $book->save();

        if($request->hasFile('image'))
        {
            $f = $request->file('image');
            $upload_to = 'upload/images';

            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;

            $f->move($absolute_path, $f->getClientOriginalName());

            $book->image_url = $relative_path;
            $book->save();
        }

        return redirect('book')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว ');
    }

    public function remove($id) {
        Book::find($id)->delete();
        return redirect('book')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสําเร็จ');
    }
    


}
