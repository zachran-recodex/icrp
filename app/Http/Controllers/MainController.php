<?php

namespace App\Http\Controllers;

use App\Models\Advocacy;
use App\Models\CallToAction;
use App\Models\Event;
use App\Models\Article;
use App\Models\Founder;
use App\Models\Library;
use App\Models\HeroSection;
use App\Models\Management;
use App\Models\Program;

class MainController extends Controller
{
    public function index()
    {
        $heroSection = HeroSection::first();

        $featuredArticle = Article::with('category')
            ->latest()
            ->first();

        $articles = Article::with('category')
            ->where('id', '!=', $featuredArticle->id) // Menghindari duplikasi dengan $featuredArticle
            ->latest()
            ->get();

        $events = Event::orderBy('id', 'desc') // Urutkan dari id terbaru
            ->take(3) // Ambil 3 data
            ->get();

        $libraries = Library::orderBy('id', 'desc') // Urutkan dari id terbaru
            ->take(3) // Ambil 4 data
            ->get();

        $callToAction = CallToAction::first();

        return view('main.index',
            compact(
                'heroSection',
                'featuredArticle',
                'articles',
                'events',
                'libraries',
                'callToAction'
            )
        );
    }

    public function tentang()
    {
        $heroSection = HeroSection::first();

        $programs = Program::orderBy('id', 'desc') // Urutkan dari id terbaru
            ->get();

        $callToAction = CallToAction::first();

        return view('main.tentang',
            compact(
                'heroSection',
                'programs',
                'callToAction'
            )
        );
    }

    public function pendiri()
    {
        $heroSection = HeroSection::first();

        $founders = Founder::orderBy('id', 'asc') // Urutkan dari id terbaru
            ->get();

        $callToAction = CallToAction::first();

        return view('main.pendiri',
            compact(
                'heroSection',
                'founders',
                'callToAction'
            )
        );
    }

    public function pendiriDetail($slug)
    {
        $heroSection = HeroSection::first();
        $callToAction = CallToAction::first();

        $founder = Founder::with(['contributions' => function($query) {
            $query->orderBy('order');
        }, 'legacies'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('main.pendiri-detail', compact(
            'founder',
            'heroSection',
            'callToAction',
        ));
    }

    public function pengurus()
    {
        $heroSection = HeroSection::first();
        $callToAction = CallToAction::first();

        // Fetch management members grouped by their respective boards
        $dewanPengurus = Management::where('dewan', 'Pengurus')->get();
        $dewanKehormatan = Management::where('dewan', 'Kehormatan')->get();
        $dewanPembina = Management::where('dewan', 'Pembina')->get();
        $dewanPengawas = Management::where('dewan', 'Pengawas')->get();
        $dewanPengurusHarian = Management::where('dewan', 'Pengurus Harian')->get();

        return view('main.pengurus', compact(
            'heroSection',
            'callToAction',
            'dewanPengurus',
            'dewanKehormatan',
            'dewanPembina',
            'dewanPengawas',
            'dewanPengurusHarian'
        ));
    }

    public function kontak()
    {
        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.kontak',
            compact(
                'heroSection',
                'callToAction'
            )
        );
    }

    public function sahabat()
    {
        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.sahabat',
            compact(
                'heroSection',
                'callToAction'
            )
        );
    }

    public function jaringan()
    {
        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.jaringan',
            compact(
                'heroSection',
                'callToAction'
            )
        );
    }

    public function berita()
    {
        $featuredArticle = Article::with('category')
            ->latest()
            ->first();

        $articles = Article::with('category')
            ->where('id', '!=', $featuredArticle->id) // Menghindari duplikasi dengan $featuredArticle
            ->latest()
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.berita',
            compact(
                'featuredArticle',
                'articles',
                'heroSection',
                'callToAction'
            )
        );
    }

    public function beritaDetail($slug)
    {
        $article = Article::with('category')
            ->where('slug', $slug)
            ->firstOrFail();

        $articles = Article::with('category')
            ->where('id', '!=', $article->id) // Menghindari duplikasi dengan $featuredArticle
            ->latest()
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.berita-detail',
            compact(
                'article',
                'articles',
                'heroSection',
                'callToAction'
            )
        );
    }

    public function pustaka()
    {
        $libraries = Library::orderBy('id', 'desc') // Urutkan dari id terbaru
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.pustaka',
            compact(
                'libraries',
                'heroSection',
                'callToAction'
            )
        );
    }

    public function pustakaDetail($slug)
    {
        $library = Library::where('slug', $slug)->firstOrFail();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.pustaka-detail',
            compact(
                'library',
                'heroSection',
                'callToAction'
            )
        );
    }

    public function advokasi()
    {
        $featuredAdvocacy = Advocacy::latest()
            ->first();

        $advocacies = Advocacy::where('id', '!=', $featuredAdvocacy->id) // Menghindari duplikasi dengan $featuredArticle
            ->latest()
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.advokasi',
            compact(
                'featuredAdvocacy',
                'advocacies',
                'heroSection',
                'callToAction'
            )
        );
    }

    public function advokasiDetail($slug)
    {
        $advocacy = Advocacy::where('slug', $slug)
            ->firstOrFail();

        $advocacies = Advocacy::where('id', '!=', $advocacy->id) // Menghindari duplikasi dengan $featuredArticle
            ->latest()
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.advokasi-detail',
            compact(
                'advocacy',
                'advocacies',
                'heroSection',
                'callToAction'
            )
        );
    }
}
