<?php
namespace App\Http\Controllers;

class UserController extends Controller
{
    public function show($id){
        echo 'รหัสผู้ใช้='.$id;
    }
}