<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Quiz extends Model
{
    use HasFactory;
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'quiz_coupons', 'quiz_id', 'coupon_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->inRandomOrder()->limit(5)->distinct();
    }

    public function questionAnswers(int $questionId): HasManyThrough
    {
        return $this->hasManyThrough(Answer::class, Question::class)->where('question_id', $questionId);
    }
}
