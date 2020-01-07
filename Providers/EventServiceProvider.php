<?php

namespace Modules\ProductStock\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Product\Events\AfterImportEvent;
use Modules\ProductStock\Listeners\AfterImportProductListener;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider 
{

	public function boot() 
	{

	}

	public function register() 
	{
		Event::listen(AfterImportEvent::class, AfterImportProductListener::class);
	}

}
