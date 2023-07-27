@extends('layouts.master')

@section('title')
ข้อมูลผู้ใช้
@endsection

@section('content')
<h2>ชื่อ {{ $name }}</h2>
<h2>อายุ {{ $age }}</h2>
<h2>อีเมลล์ {{ $email }}</h2>
<ul>
    @forelse ($activities as $a)
        <li>{{ $a }}</li>@empty
    <strong>ไม่พบกิจกรรม</strong>
    @endforelse
</ul>
@endsection