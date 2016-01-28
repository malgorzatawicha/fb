<?php

namespace Fb\Http\Controllers\Admin\Cms;

use Fb\Jobs\Cms\Friends\DestroyFriend;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Friend;
use Illuminate\Http\Request;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Jobs\Cms\Friends\StoreFriend;
use Fb\Http\Requests\Cms\Friends\EditFriendRequest;
use Fb\Http\Requests\Cms\Friends\CreateFriendRequest;
use Fb\Jobs\Cms\Friends\UpdateFriend;

class FriendsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFriendRequest $request, Page $page)
    {
        $this->dispatchFromArray(StoreFriend::class, [
            'page' => $page,
            'data' => [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'image' => $request->file('image'),
                'active' => $request->get('active')
            ]
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }

    public function update(EditFriendRequest $request, Page $page, $friendId)
    {
        $friend = Friend::findOrFail($friendId);
        $this->dispatchFromArray(UpdateFriend::class, [
            'page' => $page,
            'friend' => $friend,
            'data' => [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'image' => $request->file('image'),
                'active' => $request->get('active')
            ]
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page, $friendId)
    {
        $friend = Friend::findOrFail($friendId);
        $this->dispatchFromArray(DestroyFriend::class, [
            'page' => $page,
            'friend' => $friend,
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page, $friendId)
    {
        $friend = Friend::findOrFail($friendId);
        return view('admin.cms.pages.friends.show', ['page' => $page, 'friend' => $friend]);
    }
}
