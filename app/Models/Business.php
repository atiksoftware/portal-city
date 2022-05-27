<?php

namespace App\Models;

use Spatie\SchemaOrg\Schema;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Facades\Auth;
use libphonenumber\PhoneNumberFormat;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
	use HasSlug;

	protected $attributes = [
		'name' => '', // [type:string, nullable]
		'slug' => '', // [type:string, nullable]

		'phone' => '', // [type:string, nullable]
		'fax' => '', // [type:string, nullable]
		'email' => '', // [type:string, nullable]
		'website' => '', // [type:string, nullable]

		'address' => '', // [type:string, nullable]
		'zip' => '', // [type:string, nullable]

		'district_id' => null, // [type:integer, model:District, nullable] District ID
		'category_id' => null, // [type:integer, model:Category, nullable] Category ID

		'google_maps_link' => '', // [type:string, nullable]
		'location_lat' => 0, // [type:float, nullable]
		'location_lng' => 0, // [type:float, nullable]
		'location_heading' => 0, // [type:float, nullable]
		'location_pitch' => 0, // [type:float, nullable]
		'location_show_map' => false, // [type:boolean, nullable]
		'location_show_view' => false, // [type:boolean, nullable]

		'working_start_at' => '08:00', // [type:string, size:5, nullable]
		'working_end_at' => '18:30', // [type:string, size:5, nullable]

		'min_price' => 0, // [type:integer]
		'max_price' => 0, // [type:integer]
		'currency' => 'TRY', // [type:string, size:3, default:TRY, nullable]

		'contact_person_name' => '', // [type:string, nullable]

		'youtube_link' => '', // [type:string, nullable]

		'level' => 0, // [type:integer, default:0]

		'user_id' => null, // [type:integer, model:User, nullable] User ID

		'view_count' => 0, // [type:integer, default:0]

		'fill_percentage' => 0, // [type:integer, default:0]

		'is_active' => false, // [type:boolean, default:true]
	];

	protected $casts = [
		'name' => 'string',
		'slug' => 'string',
		'phone' => 'string',
		'fax' => 'string',
		'email' => 'string',
		'website' => 'string',
		'address' => 'string',
		'zip' => 'string',
		'district_id' => 'integer',
		'category_id' => 'integer',
		'google_maps_link' => 'string',
		'location_lat' => 'float',
		'location_lng' => 'float',
		'location_heading' => 'float',
		'location_pitch' => 'float',
		'location_show_map' => 'boolean',
		'location_show_view' => 'boolean',
		'working_start_at' => 'string',
		'working_end_at' => 'string',
		'min_price' => 'integer',
		'max_price' => 'integer',
		'currency' => 'string',
		'contact_person_name' => 'string',
		'youtube_link' => 'string',
		'level' => 'integer',
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
		return $this->belongsToMany(Inode::class, 'business_profile_images', 'business_id', 'inode_id');
	}

	public function getProfileImageAttribute()
	{
		return $this->profile_images->first();
	}

	public function cover_images()
	{
		return $this->belongsToMany(Inode::class, 'business_cover_images', 'business_id', 'inode_id');
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function district()
	{
		return $this->belongsTo(District::class);
	}

	public function blocks()
	{
		return $this->belongsToMany(Block::class, 'business_blocks', 'business_id', 'block_id');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'business_tags', 'business_id', 'tag_id');
	}

	public function getPhoneFormatedAttribute()
	{
		try {
			$phoneUtil = PhoneNumberUtil::getInstance();
			$phoneNumber = $phoneUtil->parse($this->phone, 'TR');

			return $phoneUtil->format($phoneNumber, PhoneNumberFormat::INTERNATIONAL);
		} catch (\Exception $e) {
			return $this->phone;
		}
	}

	public function getPhoneTruncatedAttribute()
	{
		return substr($this->phone_formated, 0, -5) . '** **';
	}

	public function getLocationIframeUrlAttribute()
	{
		if ($this->google_maps_link) {
			return $this->google_maps_link;
		}

		return 'https://www.google.com/maps/embed/v1/place?q=' . $this->location_lat . ',' . $this->location_lng . '&key=' . Settings::get('GOOGLE_MAPS_API_KEY') . '&zoom=14&language=' . app()->getLocale();
	}

	public function getPriceRangeAttribute()
	{
		if (null !== $this->min_price && null !== $this->max_price) {
			return $this->min_price . ' - ' . $this->max_price;
		}

		return null;
	}

	public function getPublicLinkAttribute()
	{
		return route('business', $this->slug);
	}

	public function getStructuredDataAttribute()
	{
		$localBusiness = Schema::localBusiness();
		$localBusiness->name($this->name);
		if ($this->phone) {
			$localBusiness->telephone($this->phone);
		}
		if ($this->fax) {
			$localBusiness->faxNumber($this->fax);
		}
		if ($this->email) {
			$localBusiness->email($this->email);
		}
		if ($this->website) {
			$localBusiness->url($this->website);
		}
		if ($this->address) {
			$localBusiness->address($this->address);
		}
		if ($this->zip) {
			$localBusiness->postalCode($this->zip);
		}
		if ($this->district) {
			$localBusiness->addressLocality($this->district->name);
		}
		if ($this->category) {
			$localBusiness->category($this->category->name);
		}
		if (null !== $this->price_range) {
			$localBusiness->priceRange($this->price_range);
		}

		if ($this->google_maps_link) {
			$localBusiness->hasMap($this->google_maps_link);
		}
		if ($this->location_lat && $this->location_lng) {
			$localBusiness->geo($this->location_lat, $this->location_lng);
		}
		if ($this->location_heading) {
			$localBusiness->geoHeading($this->location_heading);
		}
		if ($this->location_pitch) {
			$localBusiness->geoPitch($this->location_pitch);
		}

		$localBusiness->openingHoursSpecification([
			'opens' => $this->working_start_at,
			'closes' => $this->working_end_at,
		]);

		$localBusiness->image($this->profile_image->image);

		if ($this->contact_person_name) {
			$localBusiness->contactPoint([
				'@type' => 'Person',
				'name' => $this->contact_person_name,
			]);
		}

		return $localBusiness->toScript();
	}

	public static function MyBusiness()
	{
		$authed_user = Auth::user();

		$business = self::where('user_id', $authed_user->id)->first();
		if (!$business) {
			$business = new self();
			$business->name = $authed_user->fullname;
			$business->user_id = $authed_user->id;
			$business->save();
		}

		return $business;
	}
}
