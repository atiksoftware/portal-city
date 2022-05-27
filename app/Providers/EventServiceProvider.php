<?php

namespace App\Providers;

use App\Models\Adword;
use App\Models\Post;
use App\Models\User;
use App\Models\Block;
use App\Models\Person;
use App\Models\Business;
use App\Models\Category;
use App\Models\District;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array<class-string, array<int, class-string>>
	 */
	protected $listen = [
		Registered::class => [
			SendEmailVerificationNotification::class,
		],
	];

	/**
	 * Register any events for your application.
	 */
	public function boot(): void
	{
		District::observe(\App\Observers\DistrictObserver::class);
		Category::observe(\App\Observers\CategoryObserver::class);
		Post::observe(\App\Observers\PostObserver::class);
		Person::observe(\App\Observers\PersonObserver::class);
		Block::observe(\App\Observers\BlockObserver::class);
		Business::observe(\App\Observers\BusinessObserver::class);
		User::observe(\App\Observers\UserObserver::class);
		Adword::observe(\App\Observers\AdwordObserver::class);
	}

	/**
	 * Determine if events and listeners should be automatically discovered.
	 *
	 * @return bool
	 */
	public function shouldDiscoverEvents()
	{
		return false;
	}
}
