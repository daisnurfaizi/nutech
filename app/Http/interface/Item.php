<?php

namespace App\Http\interface;

interface Item
{
    public function Insert($request, $imagename);
    public function Update();
    public function Delete($param);
    public function SelectAll();
    public function SelectById();
}
