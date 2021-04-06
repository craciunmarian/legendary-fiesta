<?php

class Visualizer extends Controller
{
    public function index()
    {
        $this->view('visualizer/index');
    }

    public function generated()
    {
        $this->view('visualizer/generated');
    }
}
