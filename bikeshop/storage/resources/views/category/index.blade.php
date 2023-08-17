@extends("layouts.master")
@section('title')   BikeShop  |  ประเภทสินค้า @stop
@section('content')

<div class="container">
   
    <h1>ประเภทสินค้า </h1>
    <div class="panel panel-default">
    <div class="panel-heading">
    <div class="panel-title"><strong>รายการ</strong></div>
</div>
<div class="panel-body">
    
    <form action="{{ URL::to('category/search') }}" method="post" class="form-inline">
        {{ csrf_field() }}
        <input type="text" name="q" class="form-control" placeholder="...">
        <button type="submit" class="btn btn-primary">ค้นหา</button>
    </form>         
</div>

<table class="table table-bordered bs-table">
<thead>
<tr>
    <th>รหัส </th>
    <th>ชื่อประเภท </th>
    <th>การทำงาน </th>

</tr>
</thead>

<tbody>
    @foreach ($categorys as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->name }}</td>
            
        
            <td class="bs-center">
                <a href="{{ URL::to('category/edit/'.$c->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> แก้ไข</a>
                <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</a>
            </td>

        </tr>
    @endforeach
</tbody>


</table>

<tfoot>
    <th class="bs-categoryall"> <h4> ยอดรวมทั้งหมด {{ number_format($categorys->count() , 0) }} รายการ  </h4> </th>
</tfoot>


<div class="container">
    {{ $categorys->links() }}
</div>



@endsection