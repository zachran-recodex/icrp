<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CallToAction;
use App\Models\Event;
use App\Models\Founder;
use App\Models\Hero;
use App\Models\Library;

class MainController extends Controller
{
    public function __construct(
        protected Hero $hero,
        protected Article $article,
        protected Event $event,
        protected Founder $founder,
        protected Library $library,
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
}
