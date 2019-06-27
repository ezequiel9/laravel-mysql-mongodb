<?php
/**
 * Created by PhpStorm.
 * User: Eze
 * Date: 23/06/2019
 * Time: 11:12 AM
 */
namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

/**
 * Class Post
 * @package App\Models
 */
class Post extends Eloquent
{
    protected $connection = 'mongodb';

    protected $collection = 'posts';

    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'author_id',
        'image',
        'slug'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
