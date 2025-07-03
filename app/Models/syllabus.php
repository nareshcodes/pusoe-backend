<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class syllabus extends Model
{
    /**
     * Get the semester te syllabus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(semester::class);
    }
    /**
     * Get the user that owns the syllabus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
