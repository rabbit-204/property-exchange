<?php


class ProductController extends BaseController
{
    public function index()
    {
        $listProduct = $this->model('ProductModel')->getAllProducts();
        return $this->view('product.index');
    }
}
?>