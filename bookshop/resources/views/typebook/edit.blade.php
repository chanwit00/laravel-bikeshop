@extends('layouts.master')
@section('title') BookShop | รายการหนังสือ@stop
@section('content')

<h1>แก้ไขประเภทหนังสือ </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('typebook') }}">หน้าแรก</a></li>
    <li class="active">แก้ไขประเภทหนังสือ </li>
</ul>

{!! Form::model($typebook, array('action' => 'App\Http\Controllers\TypebookController@update','method' => 'post', 'enctype' => 'multipart/form-data')) !!}
<input type="hidden" name="id" value="{{ $typebook->id }}">

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
        <td>{{ Form::label('id', 'รหัสหนังสือ') }} </td>
        <td>{{ Form::text('id', $typebook->id, ['class' => 'form-control']) }}</td>
    </tr>

    <tr>
        <td>{{ Form::label('name', 'ชื่อหนังสือ ') }}</td>
        <td>{{ Form::text('name', $typebook->name, ['class' => 'form-control']) }}</td>
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