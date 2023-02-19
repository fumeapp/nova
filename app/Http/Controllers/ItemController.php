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
use MatanYadaev\EloquentSpatial\Objects\Point;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|JsonResponse
    {
        return $this->render($this->paginate(Item::with('images', 'tags', 'location'), 10));
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
            ->option('status', 'required|string')
            ->option('location', 'nullable')
            ->option('images', 'required|array')
            ->option('tags', 'required|array')
            ->verify();

        $item = (new Item($request->only(['title', 'description', 'status'])))
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
            'coordinate' => new Point($coords['lat'], $coords['lng']),

        ]))->item()->associate($item);
        $location->save();

        return $this->success('item.added', ['title' => $item->title], $item);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item): JsonResponse|Response
    {
        return $this->render($item->load(['tags', 'images','location']));
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
            ->option('status', 'required|string')
            ->option('location', 'nullable')
            ->option('images', 'required|array|min:1')
            ->option('tags', 'required|array')
            ->verify();

        $item->title = $request->title;
        $item->description = $request->description;
        $item->status = $request->status;

        $item->tags()->detach();
        foreach ($request->tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $item->tags()->attach($tag);
        }
        $item->images()->saveMany(Image::whereIn('id', $request->images)->get());
        $item->save();


        $location = $item->location;
        $coords = $request->location['geometry']['location'];
        $location->payload = $request->location;
        $location->place_id = $request->location['place_id'];
        $location->coordinate = new Point($coords['lat'], $coords['lng']);
        $location->save();

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
