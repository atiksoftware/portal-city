<?php

namespace App\Models;

use Spatie\SchemaOrg\Schema;
use Spatie\Sluggable\HasSlug;
use Waynestate\Youtube\ParseId;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	use HasSlug;

	protected $attributes = [
		'title' => '', // [type:string]
		'slug' => '', // [type:string]

		'district_id' => null, // [type:integer, model:District, nullable] District ID
		'category_id' => null, // [type:integer, model:Category, nullable] Category ID

		'summary' => '', // [type:string, dbType:text]
		'content' => '', // [type:string, dbType:text]

		'youtube_link' => '', // [type:string, nullable]

		'user_id' => null, // [type:integer, model:User, nullable] User ID

		'view_count' => 0, // [type:integer]
	];

	protected $casts = [
		'title' => 'string',
		'slug' => 'string',
		'district_id' => 'integer',
		'category_id' => 'integer',
		'summary' => 'string',
		'content' => 'string',
		'youtube_link' => 'string',
		'user_id' => 'integer',
		'view_count' => 'integer',
	];

	protected $appends = ['public_link'];

	protected $guarded = [];

	protected $hidden = [];

	public function getSlugOptions(): SlugOptions
	{
		return SlugOptions::create()
			->generateSlugsFrom('title')
			->saveSlugsTo('slug');
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function district()
	{
		return $this->belongsTo(District::class);
	}

	public function featured_images()
	{
		return $this->belongsToMany(Inode::class, 'post_featured_images', 'post_id', 'inode_id');
	}

	public function getFeaturedImageAttribute()
	{
		return $this->featured_images->first();
	}

	public function gallery_images()
	{
		return $this->belongsToMany(Inode::class, 'post_gallery_images', 'post_id', 'inode_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
	}

	public function getPublicLinkAttribute()
	{
		if (!$this->slug) {
			return null;
		}

		return route('post', $this->slug);
	}

	public function getYoutubeEmbedLinkAttribute()
	{
		// link like https://www.youtube.com/watch?v=ZABhZWoEssE
		if (!$this->youtube_link) {
			return null;
		}

		$youtube_id = ParseId::fromUrl($this->youtube_link);

		if (!$youtube_id) {
			return null;
		}

		return 'https://www.youtube.com/embed/' . $youtube_id;
	}

	public function getStructuredDataAttribute()
	{
		$article = Schema::NewsArticle();

		$article->headline($this->title);
		$article->alternativeHeadline($this->title);

		$article->description($this->summary);
		$article->articleBody($this->content);
		if ($this->category) {
			$article->articleSection($this->category->name);
		}

		$article->datePublished($this->created_at->toIso8601String());
		$article->dateModified($this->updated_at->toIso8601String());

		$article->mainEntityOfPage([
			'@type' => 'WebPage',
			'@id' => $this->public_link,
		]);

		$article->keywords($this->tags->pluck('name')->toArray());

		$article->author([
			'@type' => 'Person',
			'name' => $this->user->fullname,
		]);
		$article->publisher([
			'@type' => 'Organization',
			'name' => Settings::get('SITE_NAME'),
			'logo' => [
				'@type' => 'ImageObject',
				'url' => asset('images/logo.png'),
				'width' => '300',
				'height' => '60',
			],
		]);
		$article->image = [
			'@type' => 'ImageObject',
			'url' => $this->featured_image->url,
			'width' => $this->featured_image->width,
			'height' => $this->featured_image->height,
		];
		$article->inLanguage(config('app.locale'));

		return $article->toScript();
	}
}
