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

        // Check if any articles exist
        $featuredArticle = Article::with('category')
            ->latest()
            ->first();

        $articles = collect(); // Initialize as empty collection

        // Only query for additional articles if a featured article exists
        if ($featuredArticle) {
            $articles = Article::with('category')
                ->where('id', '!=', $featuredArticle->id)
                ->latest()
                ->get();
        }

        $events = Event::orderBy('id', 'desc')
            ->take(3)
            ->get();

        $libraries = Library::orderBy('id', 'desc')
            ->take(3)
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
        $programs = Program::orderBy('id', 'desc') // Urutkan dari id terbaru
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.tentang',
            compact(
                'programs',
                'heroSection',
                'callToAction',
            )
        );
    }

    public function pendiri()
    {
        $founders = Founder::orderBy('order') // Urutkan dari id terbaru
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.pendiri',
            compact(
                'founders',
                'heroSection',
                'callToAction',
            )
        );
    }

    public function pendiriDetail($slug)
    {
        $founder = Founder::with(['contributions' => function($query) {
            $query->orderBy('order');
        }, 'legacies'])
            ->where('slug', $slug)
            ->firstOrFail();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.pendiri-detail', compact(
            'founder',
            'heroSection',
            'callToAction',
        ));
    }

    public function pengurus()
    {
        // Fetch management members grouped by their respective boards
        $dewanDirectureExcecutive = Management::where('dewan', 'Directure Excecutive')
            ->orderBy('order')
            ->get();
        $dewanPengurus = Management::where('dewan', 'Pengurus')
            ->orderBy('order')
            ->get();
        $dewanKehormatan = Management::where('dewan', 'Kehormatan')
            ->orderBy('order')
            ->get();
        $dewanPembina = Management::where('dewan', 'Pembina')
            ->orderBy('order')
            ->get();
        $dewanPengawas = Management::where('dewan', 'Pengawas')
            ->orderBy('order')
            ->get();
        $dewanPengurusHarian = Management::where('dewan', 'Pengurus Harian')
            ->orderBy('order')
            ->get();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.pengurus', compact(
            'dewanDirectureExcecutive',
            'dewanPengurus',
            'dewanKehormatan',
            'dewanPembina',
            'dewanPengawas',
            'dewanPengurusHarian',
            'heroSection',
            'callToAction',
        ));
    }

    public function pengurusDetail($slug)
    {
        $management = Management::with(['contributions' => function($query) {
            $query->orderBy('order');
        }, 'legacies'])
            ->where('slug', $slug)
            ->firstOrFail();

        $heroSection = HeroSection::first();

        $callToAction = CallToAction::first();

        return view('main.pengurus-detail', compact(
            'management',
            'heroSection',
            'callToAction',
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
        // Check if any articles exist
        $featuredArticle = Article::with('category')
            ->latest()
            ->first();

        $articles = collect(); // Initialize as empty collection

        // Only query for additional articles if a featured article exists
        if ($featuredArticle) {
            $articles = Article::with('category')
                ->where('id', '!=', $featuredArticle->id)
                ->latest()
                ->get();
        }

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
