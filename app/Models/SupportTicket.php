<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;

    protected $table = 'support_tickets';

    protected $fillable = [
        'question',
    ];

    public function comments()
    {
        # code...
        return $this->hasMany(Comment::class, 'support_ticket_id');
    }
}
