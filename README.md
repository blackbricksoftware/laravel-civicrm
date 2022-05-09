# Laravel <> CiviCRM

A collection of tools to access [CiviCRM](https://civicrm.org/) data directly inside [Laravel](https://laravel.com/).

Currently, this is just a collection of models representing the CiviCRM data structures being used for an ETL tool.

## Install Setup

Install the package with the following command `composer require blackbricksoftware/laravel-civicrm`. 

Publish the service provider `php artisan vendor:publish --provider="BlackBrickSoftware\LaravelCiviCRM\LaravelCiviCRMServiceProvider`.

Add `BlackBrickSoftware\LaravelCiviCRM\LaravelCiviCRMServiceProvider::class` to `providers` in `app/config/app.php` similar to:

```php
'providers' => [

    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    // ...

    /*
     * Package Service Providers...
     */
    BlackBrickSoftware\LaravelCiviCRM\LaravelCiviCRMServiceProvider::class,
    // ...
];
```

## Defining Custom Data relationships

Start by creating a model for the custom data table and implement `\BlackBrickSoftware\LaravelCiviCRM\Models\CustomDataInterface`. For example:

```php
<?php

namespace App\Models;

use BlackBrickSoftware\LaravelCiviCRM\Models\CustomDataInterface;
use BlackBrickSoftware\LaravelCiviCRM\Models\VolunteerNeed;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactCustomData extends Model
    implements CustomDataInterface
{
    use HasFactory;

    protected $table = 'civicrm_value_additional_in_8';

    public function contact(): BelongsTo
    {
        return $this->entity();
    }

    public function entity(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'entity_id');
    }

    public function pronouns(): BelongsTo
    {
        $relation = $this->belongsTo(OptionValue::class, 'pronouns_76', 'value');
        $query = $relation->getQuery();
        $query->whereHas('optionGroup', fn(Builder $q) => $q->where('name', 'pronouns_20220505'));
        return $relation;
    }
}

```

You can then define a [Dynamic Relationships](https://laravel.com/docs/9.x/eloquent-relationships#dynamic-relationships) from the entity to the custom data by adding the definition to the `\App\Providers\AppServiceProvider::boot` similar to:

```php
<?php

namespace App\Providers;

use App\Models\ContactCustomData;
use BlackBrickSoftware\LaravelCiviCRM\Models\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // DB::listen(function ($query) {
        //     echo $query->sql . "\n";
        //     $query->bindings
        //     $query->time
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Relate Additional Event Information custom data to volunteer projects
        Contact::resolveRelationUsing('additionalInformationCustomData', function($model) {
            return $model->hasOne(ContactCustomData::class, 'entity_id');
        });
    }
}

```