<?php
class IntroController extends BaseController
{
    private $introModel;
    public function __construct()
    {
        parent::__construct();
        $this->introModel = $this->model('intro');
    }
    public function index()
    {

        $listIntro = $this->introModel->getListIntro();
        $listProvince= $this->introModel->getListProvince();
        // echo "abc";
        return $this->view(
            'intro.index',
            [
                'listIntro' => $listIntro,
                'listProvince' =>$listProvince,
            ]
        );
    }
}
