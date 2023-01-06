<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProductUser extends Pivot
{
    use LogsActivity;

    protected $table = 'products_users';
    protected $fillable = ['product_id', 'name', 'user_id'];
    // protected static $recordEvents = ['deleted', 'created', 'updated'];

    public $incrementing = true;
	/**
	 * @return \Spatie\Activitylog\LogOptions
	 */

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            // ->useLogName('system')
            // ->logOnly(['product_id', 'name', 'user_id'])
            // ->dontLogIfAttributesChangedOnly(['name'])
            // ->logFillable() // log changes to all the $fillable
            // >logUnguarded() // to add all attributes that are not listed in $guarded.
            ->logAll()
            // ->dontLogIfAttributesChangedOnly(['description'])
            // ->logOnlyDirty()
            // ->dontSubmitEmptyLogs()
            ;
    }
}
