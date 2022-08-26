<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $user->load('books');
        return view('book.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request, User $user)
    {
        $data = $request->validated();
        $book = $user->books()->create([
            'name' => $data['name'],
            'content' => $data['content'],
            'link_access' => (bool)$request->link_access
        ]);
        return redirect()->route('user.book.edit',[$user->id,$book->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Book $book)
    {
        return view('book.show',compact('user','book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Book $book)
    {
        return view('book.edit',compact('user','book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, User $user, Book $book)
    {
        $data = $request->validated();
        $book->update([
            'name' => $data['name'],
            'content' => $data['content'],
            'link_access' => (bool)$request->link_access
        ]);
        return redirect()->route('user.book.edit',[$user->id,$book->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user, Book $book)
    {
        $book->delete();
        return redirect()->route('user.books',$user->id);
    }
}
