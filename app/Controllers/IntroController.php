<?php
class IntroController extends BaseController
{
    public function index()
    {
        return $this->view('intro.index');  //tên folder bên view + .index
    }
}
?>