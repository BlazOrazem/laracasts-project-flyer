<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The associated table.
     *
     * @var string
     */
    protected $table = 'flyer_photos';

    /**
     * Fillable fields for a photo.
     *
     * @var array
     */
    protected $fillable = ['path', 'name', 'thumbnail_path'];

    /**
     * A photo belongs to a flyer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Get the base directory for photo uploads.
     *
     * @return string
     */
    public function baseDir()
    {
        return 'uploads/flyers';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }

    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }


}
