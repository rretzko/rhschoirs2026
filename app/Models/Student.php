<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_students
 * @property string $student_id
 * @property int $class_of
 * @property string $first_name
 * @property string|null $maiden_name
 * @property string $last_name
 * @property string|null $address_01
 * @property string|null $address_02
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $phone
 * @property string|null $email
 * @property-read string $full_name
 */
class Student extends Model
{
    protected $table = 'students';

    protected $primaryKey = 'id_students';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'class_of',
        'first_name',
        'maiden_name',
        'last_name',
        'address_01',
        'address_02',
        'city',
        'state',
        'postal_code',
        'phone',
        'email',
    ];

    protected function fullName(): Attribute
    {
        return Attribute::get(function () {
            $name = $this->first_name.' '.$this->last_name;

            if ($this->maiden_name) {
                $name = $this->first_name.' ('.$this->maiden_name.') '.$this->last_name;
            }

            return $name;
        });
    }

    public function scopeValidYear(Builder $query): Builder
    {
        return $query->whereBetween('class_of', [1983, 2100]);
    }

    public function scopeSearch(Builder $query, string $term): Builder
    {
        $term = '%'.$term.'%';

        return $query->where(function (Builder $q) use ($term) {
            $q->where('last_name', 'LIKE', $term)
                ->orWhere('first_name', 'LIKE', $term)
                ->orWhere('maiden_name', 'LIKE', $term);
        });
    }
}
