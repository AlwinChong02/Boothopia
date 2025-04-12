<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'feedback',
    ];

    public function getUserId($user_id){
        return $this->where('user_id', $user_id)->exists();
    }
    public function insertFeedbacks($insertData){
        return $this->create($insertData);
    }
        
    
}