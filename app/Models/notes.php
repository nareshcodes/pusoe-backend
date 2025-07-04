<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notes extends Model
{
    /**
     * Get the semester that owns the notes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(semester::class);
    }
    /**
     * Get the category that owns the notes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()    {
        return $this->belongsTo(category::class);
    }
}
