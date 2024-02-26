<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!request()->ajax()) {
            return view('blogs.index');
        }

        $blogs = Blog::where('id', '<>', 0);

        return datatables()->of($blogs)
            ->editColumn('title', function($blog) {
                $blog_url = route('blogs.show', $blog->id);
                return "<a href='{$blog_url}'>{$blog->title}</a>";
            })
            ->editColumn('published_at', function($blog) {
                if (is_null($blog->published_at)) {
                    return "Draft";
                }

                $published_at = date('d M Y h:i A', strtotime($blog->published_at));
                return "Published<div><small>{$published_at}</small></div>";
            })
            ->editColumn('created_at', function ($blog) {
                return date('d M Y h:i A', strtotime($blog->created_at));
            })
            ->addColumn('action', function ($blog) {
                return view("blogs.action", compact('blog'));
            })
            ->rawColumns(['action', 'status', 'published_at', 'title'])
            ->make(true);;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $record = new Blog();
        return view('blogs.manage', compact('record'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate($this->validationRules());

        $blog = new Blog();

        $this->manage($request, $blog);

        return back()->with(['success' => true, 'type' => 'success', 'title' => 'Congratulations!', 'message' => 'Changes Saved!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $blog = Blog::findOrFail($id);

    return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = Blog::findOrFail($id);
        return view('blogs.manage', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::findOrFail($id);

        $this->manage($request, $blog);

        return back()->with(['success' => true, 'type' => 'success', 'title' => 'Congratulations!', 'message' => 'Changes Saved!']);
    }

    public function manage(Request $request, Blog $blog)
    {
        $blog->title = $request->title;
        $blog->status = $request->status;
        if ($request->status == Blog::PUBLISH) {
            $blog->published_at = now();
        } else {
            $blog->published_at = null;
        }
        $blog->content = $request->content;
        $blog->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blogs.index')->with(['success' => true, 'type' => 'success', 'title' => 'Congratulations!', 'message' => 'Blog deleted!']);
    }

    public function validationRules($overrideRule = [])
    {
        $rules = [
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required',
        ];

        return array_merge($rules, $overrideRule);
    }
}
