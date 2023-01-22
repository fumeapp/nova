<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->option('file', 'required|image')
            ->verify();

        $file = $request->file->storePublicly('');
        $url = 'https://' . config('filesystems.disks.s3.bucket') . '.s3.amazonaws.com/' . $file;

        $image = (new Image(['url' => $url]))
            ->user()->associate(auth()->user());
        $image->save();

        $client = new RekognitionClient([
            'region' => 'us-east-1',
            'version' => 'latest',
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ]
        ]);

        $result = $client->detectLabels([
            'Image' => [
                'S3Object' => [
                'Bucket' => config('filesystems.disks.s3.bucket'),
                'Name' => $file,
                ],
            ],
            'MaxLabels' => 10,
            'MinConfidence' => 80,
        ]);

        foreach ($result['Labels'] as $label) {
            $categories = [];
            foreach ($label['Categories'] as $category) {
                $categories[] = $category['Name'];
            }
            $image->labels()->create([
                'name' => $label['Name'],
                'confidence' => $label['Confidence'],
                'categories' => $categories,
            ]);

        }

        return $this->success('image.uploaded', [], $image->load('labels'));
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Image $image
     * @return Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
