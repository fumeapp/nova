<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Item;
use App\Models\Location;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|JsonResponse
    {
        return $this->render($this->paginate(Item::with('images', 'tags'), 10));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response|JsonResponse
    {
        $this
            ->option('title', 'required|string')
            ->option('description', 'required|string')
            ->option('location', 'nullable')
            ->option('images', 'required|array')
            ->option('tags', 'required|array')
            ->verify();

        ray($request->location['geometry']['location']);


        $item = (new Item($request->only(['title', 'description', 'location'])))
            ->user()->associate(auth()->user());

        $item->save();
        $item->images()->saveMany(Image::whereIn('id', $request->images)->get());
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $item->tags()->attach($tag);
        }

        $coords = $request->location['geometry']['location'];

        $location = (new Location([
            'payload' => $request->location,
            'place_id' => $request->location['place_id'],
            'coordinate' => DB::raw("(GeomFromText('POINT(" . $coords['lat'] . " " . $coords['lng'] . ")'))"),

        ]))->item()->associate($item);
        $location->save();

        return $this->success('item.added', ['title' => $item->title], $item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): JsonResponse|Response
    {
        return $this->render($item->load(['tags', 'images']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return JsonResponse|Response
     */
    public function update(Request $request, Item $item): JsonResponse|Response
    {
        $this
            ->option('title', 'required|string')
            ->option('description', 'required|string')
            ->option('location', 'nullable')
            ->option('images', 'required|array|min:1')
            ->option('tags', 'required|array')
            ->verify();

        $item->title = $request->title;
        $item->description = $request->description;
        $item->location = $request->location;

        $item->tags()->detach();
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $item->tags()->attach($tag);
        }
        $item->images()->saveMany(Image::whereIn('id', $request->images)->get());
        $item->save();

        return $this->success('item.updated', ['title' => $item->title], $item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
