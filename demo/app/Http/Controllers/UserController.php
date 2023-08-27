<?php
namespace App\Http\Controllers;

class UserController extends Controller
{
public function construct() {
echo 'constructor เริ่มทํางาน<br>';
}

public function show($id) {
echo 'รหัสผู้ใช้='.$id.'<br>';
}
}