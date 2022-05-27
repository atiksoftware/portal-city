<?php

namespace App\Models;

use Spatie\SchemaOrg\Schema;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
	use HasSlug;

	protected $attributes = [
		'name' => '', // [type:string]
		'slug' => '', // [type:string]

		'phone' => '', // [type:string, nullable]
		'email' => '', // [type:string, nullable]
		'website' => '', // [type:string, nullable]

		'district_id' => null, // [type:integer, model:District, nullable] District ID

		'facebook_link' => '', // [type:string, nullable]
		'twitter_link' => '', // [type:string, nullable]
		'instagram_link' => '', // [type:string, nullable]
		'linkedin_link' => '', // [type:string, nullable]
		'youtube_link' => '', // [type:string, nullable]
		'tiktok_link' => '', // [type:string, nullable]
		'github_link' => '', // [type:string, nullable]

		'birth_date' => '', // [type:string, nullable]
		'birth_place' => '', // [type:string, nullable]

		'job_title' => '', // [type:string, nullable]
		'company_name' => '', // [type:string, nullable]

		'user_id' => null, // [type:integer, model:User, nullable] User ID

		'view_count' => 0, // [type:integer, default:0]

		'fill_percentage' => 0, // [type:integer, default:0]

		'is_active' => false, // [type:boolean, default:true]
	];

	protected $casts = [
		'name' => 'string',
		'slug' => 'string',
		'phone' => 'string',
		'email' => 'string',
		'website' => 'string',
		'district_id' => 'integer',
		'facebook_link' => 'string',
		'twitter_link' => 'string',
		'instagram_link' => 'string',
		'linkedin_link' => 'string',
		'youtube_link' => 'string',
		'tiktok_link' => 'string',
		'github_link' => 'string',
		'birth_date' => 'string',
		'birth_place' => 'string',
		'job_title' => 'string',
		'company_name' => 'string',
		'user_id' => 'integer',
		'view_count' => 'integer',
		'fill_percentage' => 'integer',
		'is_active' => 'boolean',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function getSlugOptions(): SlugOptions
	{
		return SlugOptions::create()
			->generateSlugsFrom('name')
			->saveSlugsTo('slug');
	}

	public function profile_images()
	{
		return $this->belongsToMany(Inode::class, 'person_profile_images', 'person_id', 'inode_id');
	}

	public function getProfileImageAttribute()
	{
		return $this->profile_images->first();
	}

	public function cover_images()
	{
		return $this->belongsToMany(Inode::class, 'person_cover_images', 'person_id', 'inode_id');
	}

	public function blocks()
	{
		return $this->belongsToMany(Block::class, 'person_blocks', 'person_id', 'block_id');
	}

	public function getFirstnameAttribute()
	{
		return explode(' ', $this->name)[0] ?? '';
	}

	public function getLastnameAttribute()
	{
		return explode(' ', $this->name)[1] ?? '';
	}

	public function getPublicLinkAttribute()
	{
		return route('person', $this->slug);
	}

	public function getStructuredDataAttribute()
	{
		$person = Schema::person();

		$person->name($this->name);

		if ($this->birth_date) {
			$person->birthDate($this->birth_date);
		}
		if ($this->birth_place) {
			$person->birthPlace($this->birth_place);
		}
		if ($this->phone) {
			$person->telephone($this->phone);
		}
		if ($this->email) {
			$person->email($this->email);
		}
		if ($this->website) {
			$person->url($this->website);
		}
		if ($this->profile_image) {
			$person->image($this->profile_image->url);
		}
		if ($this->facebook_link) {
			$person->sameAs($this->facebook_link);
		}
		if ($this->twitter_link) {
			$person->sameAs($this->twitter_link);
		}
		if ($this->instagram_link) {
			$person->sameAs($this->instagram_link);
		}
		if ($this->linkedin_link) {
			$person->sameAs($this->linkedin_link);
		}
		if ($this->youtube_link) {
			$person->sameAs($this->youtube_link);
		}
		if ($this->tiktok_link) {
			$person->sameAs($this->tiktok_link);
		}
		if ($this->github_link) {
			$person->sameAs($this->github_link);
		}
		if ($this->job_title) {
			$person->jobTitle($this->job_title);
		}
		if ($this->company_name) {
			$person->worksFor($this->company_name);
		}

		return $person->toScript();
	}

	public static function MyPerson()
	{
		$authed_user = Auth::user();

		$person = self::where('user_id', $authed_user->id)->first();
		if (!$person) {
			$person = new self();
			$person->name = $authed_user->fullname;
			$person->user_id = $authed_user->id;
			$person->save();
		}

		return $person;
	}
}
