<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Item;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|JsonResponse
     */
    public function index(): Response|JsonResponse
    {
        return $this->render($this->paginate(Item::with('images', 'tags'), 10));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|JsonResponse
     */
    public function store(Request $request): Response|JsonResponse
    {
        $this
            ->option('title', 'required|string')
            ->option('description', 'required|string')
            ->option('images', 'required|array')
            ->option('location', 'nullable')
            ->option('tags', 'required|array')
            ->verify();


        $item = (new Item($request->only(['title', 'description', 'location'])))
            ->option('images', 'required|array|min:1')
            ->option('tags', 'required|array')
            ->verify();

        $item = (new Item($request->only(['title', 'description'])))
            ->user()->associate(auth()->user());

        $item->save();
        $item->images()->saveMany(Image::whereIn('id', $request->images)->get());
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $item->tags()->attach($tag);
        }

        return $this->success('item.added', ['title' => $item->title], $item);
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
