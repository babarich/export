<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BannerController extends Controller
{
    


     public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        
        $query = BannerImage::query()
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return Inertia::render('Banners/index',[
            'banners' => BannerResource::collection($query),
            
        ]);
    }

    public function store(BannerRequest $request)
    {

        try{

        $data = $request->validated();
      

        /** @var \Illuminate\Http\UploadedFile[] $images */
        $images = $data['images'] ?? [];
        $imagePositions = $data['image_positions'] ?? [];
        $status = $data['active'];
    
        $this->saveImages($images, $imagePositions, $status);

        }catch (\Exception $e){
          
           Log::info('error', [$e]);
           return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
       }
       return Redirect::back()->with('success','You have added successfully a new product');
       
    }


    /**
     *
     *
     * @param UploadedFile[] $images
     * @return string
     * @throws \Exception
     */
    private function saveImages($images, $positions, $status)
    {
       foreach ($images as $id => $image) {
    
        $disk = Storage::disk('public');
        $path = 'images/' . Str::random();
        if (!$disk->exists($path)) {
            $disk->makeDirectory($path, 0755, true);
        }
    
    
        $name = Str::random() . '.' . $image->getClientOriginalExtension();
    
    
        if (!$disk->putFileAs($path, $image, $name)) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }
    

        $relativePath = $path . '/' . $name;
        $url = URL::to(Storage::url($relativePath));
        BannerImage::create([
            'active' => $status,
            'path' => $relativePath,
            'url' => $url,
            'mime' => $image->getClientMimeType(),
            'size' => $image->getSize(),
            'position' => $positions[$id] ?? $id + 1,
        ]);

        
    }
}


}