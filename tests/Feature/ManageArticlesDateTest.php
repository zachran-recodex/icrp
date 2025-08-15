<?php

use App\Livewire\Dashboard\ManageArticles;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->category = ArticleCategory::factory()->create();
});

test('can create article with publication date', function () {
    $publishedAt = '2024-12-25';

    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->set('title', 'Test Article')
        ->set('content', 'Test content')
        ->set('article_category_id', $this->category->id)
        ->set('published_at', $publishedAt)
        ->set('image', \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->call('saveArticle')
        ->assertHasNoErrors();

    $article = Article::where('title', 'Test Article')->first();
    expect($article)->not->toBeNull();
    expect($article->published_at->format('Y-m-d'))->toBe($publishedAt);
});

test('can create article without publication date', function () {
    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->set('title', 'Test Article No Date')
        ->set('content', 'Test content')
        ->set('article_category_id', $this->category->id)
        ->set('published_at', '')
        ->set('image', \Illuminate\Http\UploadedFile::fake()->image('test.jpg'))
        ->call('saveArticle')
        ->assertHasNoErrors();

    $article = Article::where('title', 'Test Article No Date')->first();
    expect($article)->not->toBeNull();
    expect($article->published_at)->toBeNull();
});

test('can filter articles by date range', function () {
    // Create articles with different dates
    $article1 = Article::factory()->create([
        'title' => 'Article 1',
        'published_at' => '2024-01-15',
        'article_category_id' => $this->category->id,
    ]);

    $article2 = Article::factory()->create([
        'title' => 'Article 2',
        'published_at' => '2024-02-15',
        'article_category_id' => $this->category->id,
    ]);

    $article3 = Article::factory()->create([
        'title' => 'Article 3',
        'published_at' => '2024-03-15',
        'article_category_id' => $this->category->id,
    ]);

    // Test filtering from date
    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->set('dateFrom', '2024-02-01')
        ->assertSee('Article 2')
        ->assertSee('Article 3')
        ->assertDontSee('Article 1');

    // Test filtering to date
    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->set('dateTo', '2024-02-28')
        ->assertSee('Article 1')
        ->assertSee('Article 2')
        ->assertDontSee('Article 3');

    // Test filtering date range
    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->set('dateFrom', '2024-02-01')
        ->set('dateTo', '2024-02-28')
        ->assertSee('Article 2')
        ->assertDontSee('Article 1')
        ->assertDontSee('Article 3');
});

test('can clear all filters', function () {
    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->set('search', 'test')
        ->set('selectedCategory', $this->category->id)
        ->set('dateFrom', '2024-01-01')
        ->set('dateTo', '2024-12-31')
        ->call('clearFilters')
        ->assertSet('search', '')
        ->assertSet('selectedCategory', '')
        ->assertSet('dateFrom', '')
        ->assertSet('dateTo', '');
});

test('displays publication date in articles table', function () {
    $article = Article::factory()->create([
        'title' => 'Test Article',
        'published_at' => '2024-12-25',
        'article_category_id' => $this->category->id,
    ]);

    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->assertSee('Dec 25, 2024');
});

test('displays not set for articles without publication date', function () {
    $article = Article::factory()->create([
        'title' => 'Test Article',
        'published_at' => null,
        'article_category_id' => $this->category->id,
    ]);

    Livewire::actingAs($this->user)
        ->test(ManageArticles::class)
        ->assertSee('Not set');
});
