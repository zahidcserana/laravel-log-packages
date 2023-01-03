<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Redactors\LeftRedactor;

class Product extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public const CATEGORIES = [
        'Phones and Electronics',
        'Fashion',
        'Furniture',
        'Groceries'
    ];


    protected $guarded = [];

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
            $data['old_values']['category_id'] = self::CATEGORIES[$this->getOriginal('category_id')];
            $data['new_values']['category_id'] = self::CATEGORIES[$this->getAttribute('category_id')];
        }

        return $data;
    }
}
