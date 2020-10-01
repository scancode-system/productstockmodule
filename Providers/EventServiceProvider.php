<?php

namespace Modules\ProductStock\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Product\Events\AfterImportEvent;
use Modules\ProductStock\Listeners\AfterImportProductListener;
use Modules\Product\Events\ProductLazyEagerLoadingEvent;
use Modules\ProductStock\Listeners\ProductLazyEagerLoadingListener;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider 
{

	public function boot() 
	{

	}

	public function register() 
	{
		Event::listen(AfterImportEvent::class, AfterImportProductListener::class, 2);
		Event::listen(ProductLazyEagerLoadingEvent::class, ProductLazyEagerLoadingListener::class);
	}

}
 