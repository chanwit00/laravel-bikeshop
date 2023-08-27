@extends('layouts.master')
@section('title') BookShop | รายการหนังสือ@stop
@section('content')

<h1>แก้ไขสินค้า </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('book') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขสินค้า </li>
</ul>

{!! Form::model($book, array('action' => 'App\Http\Controllers\BookController@update','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $book->id }}">

@if($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
    @endforeach
</div>
@endif

<div class="panel panel-default">
    <div class="panel-heading">
    <div class="panel-title">
        <strong>ข้อมูลสินค้า </strong>
    </div>
</div>
<div class="panel-body">

<table>

    <tr>
        <td>{{ Form::label('code', 'รหัสสินค้า') }} </td>
        <td>{{ Form::text('code', $book->code, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('name', 'ชื่อสินค้า ') }}</td>
        <td>{{ Form::text('name', $book->name, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('typebook_id', 'ประเภทสินค้า ') }}</td>
        <td>{{ Form::select('typebook_id', $typebooks, Request::old('typebook_id'), ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('stock_qty', 'คงเหลือ') }}</td>
        <td>{{ Form::text('stock_qty', $book->stock_qty, ['class' => 'form-control']) }} </td>
    </tr>

    <tr>
        <td>{{ Form::label('price', 'ราคาขายต่อหน่วย') }}</td>
        <td>{{ Form::text('price', $book->price, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
        <td>{{ Form::file('image') }}</td>
    </tr>

    @if($book->image_url)
    <tr>
    <td><strong>รูปสินค้า </strong></td>
    <td><img src="{{ URL::to($book->image_url) }}" width="100px"></td>
    </tr> 
    @endif

    

</table>

</div>

<div class="panel-footer">
    <button type="reset" class="btn btn-danger">ยกเลิก</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
</div>
</div>



{!! Form::close() !!}

@endsection