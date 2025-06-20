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
        $featuredArticles = Article::getFeaturedWithCategories();
        $latestArticles = Article::getLatestWithCategories();
        $upcomingEvents = Event::getUpcoming();
        $featuredLibraries = Library::getFeatured();
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
