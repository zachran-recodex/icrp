<?php

namespace App\Http\Controllers;

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
            ->take(3) // Ambil 3 data
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

        $founders = Founder::orderBy('id', 'desc') // Urutkan dari id terbaru
            ->take(4) // Ambil 4 data
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
        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.berita',
            compact(
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

        $relatedArticles = Article::with('category')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.berita-detail',
            compact(
                'article',
                'relatedArticles',
                'heroSection',
                'callToAction'
            )
        );
    }

    public function pustaka()
    {
        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.pustaka',
            compact(
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

    public function buku()
    {
        $libraries = Library::latest()
            ->paginate(9);

        return view('dashboard.test-comment', compact('libraries'));
    }

    public function bukuDetail(Library $library)
    {
        return view('dashboard.comment', compact('library'));
    }
}
