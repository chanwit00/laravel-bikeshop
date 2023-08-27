@extends('layouts.master')
@section('title') SneakerShop | แบรนด์สินค้า @stop
@section('content')

<h1>แก้ไขแบรนด์สินค้า </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('brand') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขแบรนด์สินค้า </li>
</ul>

{!! Form::model($brand, array('action' => 'App\Http\Controllers\BrandController@update','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $brand->id }}">

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
        <td>{{ Form::label('id', 'รหัสสินค้า') }} </td>
        <td>{{ Form::text('id', $brand->id, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('name', 'ชื่อแบรนด์ ') }}</td>
        <td>{{ Form::text('name', $brand->name, ['class' => 'form-control']) }}</td>
    </tr>



</table>

</div>

<div class="panel-footer">
    <button type="reset" class="btn btn-danger">ยกเลิก</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
</div>
</div>



{!! Form::close() !!}



@endsection