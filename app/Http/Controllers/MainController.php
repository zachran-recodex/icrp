<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CallToAction;
use App\Models\Event;
use App\Models\Hero;
use App\Models\Library;

class MainController extends Controller
{
    public function __construct(
        protected Hero $hero,
        protected Article $article,
        protected Event $event,
        protected Library $library,
        protected CallToAction $callToAction
    ) {}

    public function index()
    {
        $heroSection = $this->hero->first();
        $featuredArticles = $this->article->getFeaturedWithCategories();
        $latestArticles = $this->article->getLatestWithCategories();
        $upcomingEvents = $this->event->getUpcoming();
        $featuredLibraries = $this->library->getFeatured();
        $callToAction = $this->callToAction->first();

        return view('main.index', compact(
            'heroSection',
            'featuredArticles', 
            'latestArticles',
            'upcomingEvents',
            'featuredLibraries',
            'callToAction'
        ));
    }
}
