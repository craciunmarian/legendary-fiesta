<?php

class About extends Controller
{
    public function index()
    {
        $this->view('about/index');
    }

    public function report()
    {
        $this->view('about/report');
    }

    public function guide()
    {
        $this->view('about/guide');
    }
}
