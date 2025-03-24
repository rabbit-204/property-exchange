<?php
class HomepageController extends BaseController
{
    public function index()
    {
        return $this->view('homepage.index');  //tên folder bên view + .index
    }
}
?>