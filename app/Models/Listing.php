<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'code',
        'street',
        'street_num',
        'price'
    ];
    protected $sortable =[
        'price', 'created_at'
    ];
    public function owner(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'by_user_id');
    }

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
    /*        $query = Listing::orderByDesc('created_at')
                ->when(
                    $filters['minPrice'] ?? false,
                    fn($query, $value) => $query->where('price', '>=', $value)
                )
                ->when(
                    $filters['maxPrice'] ?? false,
                    fn($query, $value) => $query->where('price', '<=', $value)
                )
                ->when(
                    $filters['beds'] ?? false,
                    fn($query, $value) => $query->where('beds', $value)
                )
                ->when(
                    $filters['baths'] ?? false,
                    fn($query, $value) => $query->where('baths', $value)
                )
                ->when(
                    $filters['minArea'] ?? false,
                    fn($query, $value) => $query->where('area', '>=', $value)
                )
                ->when(
                    $filters['maxArea'] ?? false,
                    fn($query, $value) => $query->where('area', '<=', $value)
                );

            if($filters['minPrice'] ?? false){
                $query->where('price', '>=', $filters['minPrice']);
            }
            if($filters['maxPrice'] ?? false){
                $query->where('price', '<=', $filters['maxPrice']);
            }
            if($filters['beds'] ?? false){
                $query->where('beds', $filters['beds']);
            }
            if($filters['baths'] ?? false){
                $query->where('baths', $filters['baths']);
            }
            if($filters['minArea'] ?? false){
                $query->where('area', '>=', $filters['minArea']);
            }
            if($filters['maxArea'] ?? false){
                $query->where('area', '<=', $filters['maxArea']);
            }*/
    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
                $filters['minPrice'] ?? false,
                fn($query, $value) => $query->where('price', '>=', $value)
            )
            ->when(
                $filters['maxPrice'] ?? false,
                fn($query, $value) => $query->where('price', '<=', $value)
            )
            ->when(
                $filters['beds'] ?? false,
                fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
            )
            ->when(
                $filters['baths'] ?? false,
                fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
            )
            ->when(
                $filters['minArea'] ?? false,
                fn($query, $value) => $query->where('area', '>=', $value)
            )
            ->when(
                $filters['maxArea'] ?? false,
                fn($query, $value) => $query->where('area', '<=', $value)
            )
            ->when(
                $filters['deleted'] ?? false,
                fn($query, $value) => $query->withTrashed()
            )
            ->when(
                $filters['by'] ?? false,
                fn($query, $value) =>
                    !in_array($value, $this->sortable)
                        ? $query
                        : $query->orderBy($value, $filters['order'] ?? 'desc')
            );
    }
}
