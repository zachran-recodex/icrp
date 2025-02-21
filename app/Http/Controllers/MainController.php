<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function berita()
    {
        return view('main.berita');
    }

    public function beritaDetail($slug)
    {
        return view('main.berita-detail');
    }

    public function tentang()
    {
        return view('main.tentang');
    }

    public function pendiri()
    {
        return view('main.pendiri');
    }

    public function pengurus()
    {
        return view('main.pengurus');
    }

    public function sahabat()
    {
        return view('main.sahabat');
    }

    public function jaringan()
    {
        return view('main.jaringan');
    }

    public function pustaka()
    {
        return view('main.pustaka');
    }

    public function kontak()
    {
        return view('main.kontak');
    }
}
