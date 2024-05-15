<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file_number',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone_number',
        'next_of_kin_relationship',
        'status',
    ];

    protected $dates = ['date_of_birth'];

    public static function countActivePatient()
    {
        $data = Patient::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::id();
                $model->save();
            }
        });
    }
}
