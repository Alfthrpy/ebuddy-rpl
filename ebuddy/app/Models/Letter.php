<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_letter',
        'date_out',
        'subject',
        'attachment',
        'destination',
        'destination_position',
        'content',
        'comment',
        'status',
        'user_id_creator',
        'user_id_approver',
        'template_id',
        'wm_creator',
        'wm_approver'
    ];

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function creator(){
        return $this->belongsTo(User::class, 'user_id_creator');
    }

    public function approver(){
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
