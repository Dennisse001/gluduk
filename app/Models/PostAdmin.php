<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAdmin extends Model
{
    use HasFactory;

    protected $table = 'post_admin';

    protected $fillable = ['judul', 'subjudul', 'tanggal', 'isi', 'user_id', 'cover'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
