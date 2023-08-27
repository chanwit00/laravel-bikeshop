@extends('layouts.master')
@section('title') BookShop | รายการหนังสือ@stop
@section('content')

<h1>เพิ่มประเภทหนังสือ </h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('typebook') }}">หน้าแรก</a></li>
    <li class="active">เพิ่มประเภทหนังสือ </li>
</ul>


{!! Form::open(array('action' => 'App\Http\Controllers\TypebookController@insert','method'=>'post', 'enctype' => 'multipart/form-data')) !!}
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
        <strong>เพิ่มประเภทหนังสือ </strong>
    </div>
</div>
<div class="panel-body">

<table>
    

    <tr>
    <td>{{ Form::label('name', 'ชื่อประเภทหนังสือ ') }}</td>
    <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
    </tr>

    
    </table>

    <div class="panel-footer">
        <button type="reset" class="btn btn-danger">ยกเลิก</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
    </div>
    </div>

{!! Form::close() !!}

<script>



@endsection