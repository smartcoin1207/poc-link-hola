<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;
        // Define the table name if it differs from the default
        protected $table = 'roles'; 

        // Define which attributes are mass assignable
        protected $fillable = ['name', 'title', 'guard_name', 'status'];
    
        /**
         * The users that belong to the role.
         */
        public function users(): HasMany
        {
            return $this->hasMany(User::class);
        }
}
