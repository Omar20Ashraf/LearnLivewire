<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'user_id',
        'support_ticket_id',
        'body',
        'image',
    ];

    public function getImagePathAttribute()
    {
        # code...
        return Storage::disk('public')->url($this->image);
    }

    public function creator()
    {
        # code...
        return $this->belongsTo(User::class,'user_id');
    }

    public function ticket()
    {
        # code...
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id');
    }
}
