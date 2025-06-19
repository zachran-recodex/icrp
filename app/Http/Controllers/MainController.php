<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Article;
use App\Models\Event;
use App\Models\Library;
use App\Models\CallToAction;
use App\Models\Advocacy;
use App\Models\Founder;
use App\Models\Member;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $heroSection = Hero::first();
        $featuredArticle = Article::with('articleCategory')->latest()->first();
        $articles = Article::with('articleCategory')->latest()->skip(1)->take(6)->get();
        $events = Event::where('date', '>=', now())->orderBy('date')->take(3)->get();
        $libraries = Library::latest()->take(3)->get();
        $callToAction = CallToAction::first();

        return view('main.index', compact(
            'heroSection',
            'featuredArticle', 
            'articles',
            'events',
            'libraries',
            'callToAction'
        ));
    }

    public function tentang()
    {
        $heroSection = Hero::first();
        $programs = collect([]); // Empty collection for now since we don't have programs model yet
        $callToAction = CallToAction::first();
        
        return view('main.tentang', compact('heroSection', 'programs', 'callToAction'));
    }

    public function berita()
    {
        $heroSection = Hero::first();
        $featuredArticle = Article::with('articleCategory')->latest()->first();
        $articles = Article::with('articleCategory')->latest()->skip(1)->paginate(12);
        $callToAction = CallToAction::first();

        return view('main.berita', compact('heroSection', 'featuredArticle', 'articles', 'callToAction'));
    }

    public function beritaDetail($slug)
    {
        $heroSection = Hero::first();
        $article = Article::with('articleCategory')->where('slug', $slug)->firstOrFail();
        $articles = Article::with('articleCategory')->where('id', '!=', $article->id)->latest()->take(6)->get();
        $callToAction = CallToAction::first();

        return view('main.berita-detail', compact('heroSection', 'article', 'articles', 'callToAction'));
    }

    public function pustaka()
    {
        $heroSection = Hero::first();
        $libraries = Library::latest()->paginate(12);
        $callToAction = CallToAction::first();

        return view('main.pustaka', compact('heroSection', 'libraries', 'callToAction'));
    }

    public function pustakaDetail($slug)
    {
        $heroSection = Hero::first();
        $library = Library::where('slug', $slug)->firstOrFail();

        return view('main.pustaka-detail', compact('heroSection', 'library'));
    }

    public function advokasi()
    {
        $heroSection = Hero::first();
        $featuredAdvocacy = Advocacy::latest()->first();
        $advocacies = Advocacy::latest()->skip(1)->paginate(12);
        $callToAction = CallToAction::first();

        return view('main.advokasi', compact('heroSection', 'featuredAdvocacy', 'advocacies', 'callToAction'));
    }

    public function advokasiDetail($slug)
    {
        $heroSection = Hero::first();
        $advocacy = Advocacy::where('slug', $slug)->firstOrFail();

        return view('main.advokasi-detail', compact('heroSection', 'advocacy'));
    }

    public function pendiri()
    {
        $heroSection = Hero::first();
        $founders = Founder::orderBy('name')->get();
        $callToAction = CallToAction::first();

        return view('main.pendiri', compact('heroSection', 'founders', 'callToAction'));
    }

    public function pendiriDetail($slug)
    {
        $heroSection = Hero::first();
        $founder = Founder::where('slug', $slug)->firstOrFail();

        return view('main.pendiri-detail', compact('heroSection', 'founder'));
    }

    public function pengurus()
    {
        $heroSection = Hero::first();
        $dewanDirectureExcecutive = Member::where('dewan_category', 'direktur eksekutif')->orderBy('name')->get();
        $dewanPengurus = Member::where('dewan_category', 'pengurus')->orderBy('name')->get();
        $dewanKehormatan = Member::where('dewan_category', 'kehormatan')->orderBy('name')->get();
        $dewanPembina = Member::where('dewan_category', 'pembina')->orderBy('name')->get();
        $dewanPengawas = Member::where('dewan_category', 'pengawas')->orderBy('name')->get();
        $dewanPengurusHarian = Member::where('dewan_category', 'pengurus harian')->orderBy('name')->get();
        $callToAction = CallToAction::first();

        return view('main.pengurus', compact(
            'heroSection', 
            'dewanDirectureExcecutive',
            'dewanPengurus',
            'dewanKehormatan', 
            'dewanPembina',
            'dewanPengawas',
            'dewanPengurusHarian',
            'callToAction'
        ));
    }

    public function pengurusDetail($slug)
    {
        $heroSection = Hero::first();
        $member = Member::where('slug', $slug)->firstOrFail();

        return view('main.pengurus-detail', compact('heroSection', 'member'));
    }

    public function jaringan()
    {
        $heroSection = Hero::first();
        
        return view('main.jaringan', compact('heroSection'));
    }

    public function sahabat()
    {
        $heroSection = Hero::first();
        
        return view('main.sahabat', compact('heroSection'));
    }

    public function kontak()
    {
        $heroSection = Hero::first();
        $callToAction = CallToAction::first();
        
        return view('main.kontak', compact('heroSection', 'callToAction'));
    }
}
