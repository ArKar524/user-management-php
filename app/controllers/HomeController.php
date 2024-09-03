<?php
class Home extends Controller
{

    function __construct()
    {
        auth();
    }
    public function index()
    {
        $this->view('home');
    }
}