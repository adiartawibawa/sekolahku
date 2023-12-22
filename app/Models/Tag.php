<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Tags\Tag as ModelTag;

class Tag extends ModelTag
{
    use HasFactory;
    use HasUuids;
}
