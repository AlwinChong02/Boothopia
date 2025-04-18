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
        'created_by',
        'name',
        'email',
        'description',
    ];

    public function getUserId($user_id){
        return $this->where('created_by', $user_id)->exists();
    }
    public function insertFeedbacks($insertData){
        return $this->create($insertData);
    }
        
    
}