@extends('layouts.master')
@section('title') BookShop | รายการหนังสือ@stop
@section('content')

    <div class="container">

        <h1>รายการหนังสือ </h1>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title"><strong>รายการ</strong></div>
            </div>

            <div class="panel-body">

                <form action="{{ URL::to('book/search') }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <input type="text" name="q" class="form-control" placeholder="...">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                    <a href="{{ URL::to('book/edit') }}" class="btn btn-success pull-right">เพิ่มหนังสือ
                    </a>
                </form>

            </div>


            <table class="table table-bordered bs-table">

            </table>
            <table class="table table-bordered bs-table">
                <thead>
                    <tr>
                        <th>รูปหนังสือ </th>
                        <th>รหัส </th>
                        <th>ชื่อหนังสือ </th>
                        <th>ประเภท </th>
                        <th>คงเหลือ </th>
                        <th>ราคาต่อหน่วย </th>
                        <th>การทำงาน </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($books as $p)
                        <tr>
                            <td><img src="\{{ $p->image_url }}" width="50px"></td>
                            <td>{{ $p->code }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->typebook->name }}</td>
                            <td class="bs-price">{{ number_format($p->stock_qty, 0) }}</td>
                            <td class="bs-price">{{ number_format($p->price, 2) }}</td>

                            <td class="bs-center">
                                <a href="{{ URL::to('book/edit/' . $p->id) }}" class="btn btn-info"><i
                                        class="fa fa-edit"></i> แก้ไข</a>
                                <a href="#" class="btn btn-danger btn-delete" id-delete="{{ $p->id }}"><i
                                        class="fa fa-trash"></i> ลบ</a>


                            </td>

                        </tr>
                    @endforeach
                </tbody>

                {{-- หาผลรวม --}}
                <tfoot>
                    <tr>
                        <th colspan="4">รวม</th>
                        <th class="bs-price">{{ number_format($books->sum('stock_qty'), 0) }}</th>
                        <th class="bs-price">{{ number_format($books->sum('price'), 2) }}</th>
                    </tr>
                </tfoot>

            </table>
            <div class="panel-footer">
                <span>แสดงข้อมูลจํานวน {{ count($books) }} รายการ</span>
            </div>
        </div>
    </div>




    <div class="container">
        {{ $books->links() }}
    </div>


    <script>
        $('.btn-delete').on('click', function() {
            if (confirm("คุณต้องการลบข้อมูลหนังสือหรือไม่?")) {
                var url = "{{ URL::to('book/remove') }}" +
                    '/' + $(this).attr('id-delete');
                window.location.href = url;
            }
        });
    </script>

@endsection
