<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CallToAction;
use App\Models\Event;
use App\Models\Founder;
use App\Models\Hero;
use App\Models\Library;
use App\Models\Member;

class MainController extends Controller
{
    public function __construct(
        protected Hero $hero,
        protected Article $article,
        protected Event $event,
        protected Founder $founder,
        protected Library $library,
        protected Member $member,
        protected CallToAction $callToAction
    ) {}

    public function index()
    {
        return view('main.index', [
            'heroSection' => $this->hero->first(),
            'featuredArticles' => $this->article->getFeaturedWithCategories(),
            'latestArticles' => $this->article->getLatestWithCategories(),
            'upcomingEvents' => $this->event->getUpcoming(),
            'featuredLibraries' => $this->library->getFeatured(),
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function tentangKami()
    {
        return view('main.tentang-kami', [
            'heroSection' => $this->hero->first(),
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function pendiri()
    {
        return view('main.pendiri', [
            'heroSection' => $this->hero->first(),
            'founders' => $this->founder->latest()->get(),
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function pendiriDetail(Founder $founder)
    {
        return view('main.pendiri-detail', [
            'heroSection' => $this->hero->first(),
            'founder' => $founder,
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function pengurus()
    {
        return view('main.pengurus', [
            'heroSection' => $this->hero->first(),
            'members' => $this->member->latest()->get(),
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function pengurusDetail(Member $member)
    {
        return view('main.pengurus-detail', [
            'heroSection' => $this->hero->first(),
            'member' => $member,
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function kontakKami()
    {
        return view('main.kontak', [
            'heroSection' => $this->hero->first(),
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function artikel()
    {
        return view('main.artikel', [
            'heroSection' => $this->hero->first(),
            'articles' => $this->article->published()->with('articleCategory')->latest()->get(),
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function artikelDetail(Article $article)
    {
        $relatedArticles = $this->article->published()
            ->with('articleCategory')
            ->where('id', '!=', $article->id)
            ->where('article_category_id', $article->article_category_id)
            ->latest()
            ->take(6)
            ->get();

        return view('main.artikel-detail', [
            'heroSection' => $this->hero->first(),
            'article' => $article,
            'relatedArticles' => $relatedArticles,
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function pustaka()
    {
        return view('main.pustaka', [
            'heroSection' => $this->hero->first(),
            'libraries' => $this->library->published()->latest()->get(),
            'callToAction' => $this->callToAction->first()
        ]);
    }

    public function pustakaDetail(Library $library)
    {
        $relatedLibraries = $this->library->published()
            ->where('id', '!=', $library->id)
            ->latest()
            ->take(6)
            ->get();

        return view('main.pustaka-detail', [
            'heroSection' => $this->hero->first(),
            'library' => $library,
            'relatedLibraries' => $relatedLibraries,
            'callToAction' => $this->callToAction->first()
        ]);
    }
}
