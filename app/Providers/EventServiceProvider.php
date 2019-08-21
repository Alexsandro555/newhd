<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Files\Events\FileFormatAdded;
use Modules\Files\Events\FileFormatDeleted;
use Modules\Files\Events\TypeFilesModdified;
use Modules\Files\Listeners\AddFormat;
use Modules\Files\Listeners\DelFormat;
use Modules\Files\Listeners\ResizeImages;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
    ],
    FileFormatAdded::class => [
      AddFormat::class
    ],
    FileFormatDeleted::class => [
      DelFormat::class
    ],
    TypeFilesModdified::class => [
      ResizeImages::class
    ]
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();

    //
  }
}
