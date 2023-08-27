@extends('layouts.master')
@section('title') SneakerShop | รายการสินค้า @stop
@section('content')
<h1>แก้ไขสินค้า </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('shoe') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขสินค้า </li>
</ul>

{!! Form::model($shoe, array('action' => 'App\Http\Controllers\ShoeController@update','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $shoe->id }}">

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
        <td>{{ Form::text('code', $shoe->code, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('name', 'ชื่อสินค้า ') }}</td>
        <td>{{ Form::text('name', $shoe->name, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('brand_id', 'ประเภทสินค้า ') }}</td>
        <td>{{ Form::select('brand_id', $brands, Request::old('brand_id'), ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('stock_qty', 'คงเหลือ') }}</td>
        <td>{{ Form::text('stock_qty', $shoe->stock_qty, ['class' => 'form-control']) }} </td>
    </tr>

    <tr>
        <td>{{ Form::label('price', 'ราคาขายต่อหน่วย') }}</td>
        <td>{{ Form::text('price', $shoe->price, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('image', 'เลือกรูปภาพสินค้า ') }}</td>
        <td>{{ Form::file('image') }}</td>
    </tr>

    @if($shoe->image_url)
    <tr>
    <td><strong>รูปสินค้า </strong></td>
    <td><img src="{{ URL::to($shoe->image_url) }}" width="100px"></td>
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