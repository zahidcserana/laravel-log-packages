<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Redactors\LeftRedactor;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Product extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use LogsActivity;
    use \ElaborateCode\EloquentLogs\Concerns\HasLogs;

    public const CATEGORIES = [
        'Phones and Electronics',
        'Fashion',
        'Furniture',
        'Groceries'
    ];


    protected $fillable = ['name', 'category_id', 'quantity', 'description', 'user_id'];

    protected $auditInclude = [
        'name',
        'category_id',
        'quantity',
    ];

    protected $auditExclude = [
        'description',
    ];

    protected $attributeModifiers = [
        'name' => LeftRedactor::class,
    ];

    public function transformAudit(array $data): array
    {
        if (Arr::has($data, 'new_values.category_id')) {
            $data['old_values']['category_id'] = Category::find($this->getOriginal('category_id'))->name;
            $data['new_values']['category_id'] = Category::find($this->getAttribute('category_id'))->name;

            // $data['old_values']['category_id'] = self::CATEGORIES[$this->getOriginal('category_id')];
            // $data['new_values']['category_id'] = self::CATEGORIES[$this->getAttribute('category_id')];
        }

        return $data;
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'products_users')->withPivot('name');
    }

    /*** LogsActivity **/


    //  protected static $recordEvents = ['deleted']; //only the `deleted` event will get logged automatically


    // public function tapActivity(Activity $activity, string $eventName)
    // {
    //     $activity->description = "activity.logs.message.{$eventName}";
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}")
            ->useLogName('system')
            ->logOnly(['name', 'quantity', 'description', 'user.name', 'category.name'])
            // ->dontLogIfAttributesChangedOnly(['name'])
            // ->logFillable() // log changes to all the $fillable
            // >logUnguarded() // to add all attributes that are not listed in $guarded.
            // ->logAll()
            // ->dontLogIfAttributesChangedOnly(['description'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function activityLogs() {
        return \Spatie\Activitylog\Models\Activity::where('subject_type', $this::class)->where('subject_id', $this->id)->get();
    }
}
