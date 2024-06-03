<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'start_date',
        'end_date',
        'objective',
        'place',
        'result',
        'user_id_creator',
        'user_id_approver',
        'status',
        'comment'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id_creator');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'user_id_approver');
    }

    public function scopeApproved($query)
    {
        return $query->whereNotNull('user_id_approver');
    }

    public function scopePendingApproval($query)
    {
        return $query->whereNull('user_id_approver');
    }
}
