<?php
/**
 * Created by PhpStorm.
 * User: Eze
 * Date: 24/06/2019
 * Time: 11:12 AM
 */
namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user()->load('posts');
        return view('admin', compact('user'));
    }
}
