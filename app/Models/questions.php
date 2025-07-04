<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    /**
     * Get the semester that owns the questions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(semester::class);
    }
    /**
     * Get the user that owns the questions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo(category::class);
    }
}
