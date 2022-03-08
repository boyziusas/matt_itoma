<?php

namespace App\Models;

use App\Casts\CompanyNameCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'website',
        'logo'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'name' => CompanyNameCast::class
    ];

    /**
     * @return int
     */
    public function getEmployeeCount(): int
    {
        return $this->employees()->count();
    }

    /**
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
