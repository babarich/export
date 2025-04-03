<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryTreeResource;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');

        $categories = Category::query()
            ->orderBy($sortField, $sortDirection)
            ->latest()
            ->get();

        return Inertia::render('Categories/index',[
           'categories' => CategoryResource::collection($categories)
        ]);
    }

    public function getAsTree()
    {
        return Category::getActiveAsTree(CategoryTreeResource::class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        
        $data = $request->validated();
        try{
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;
        if($request->hasFile('image')){
                $image = $request->file('image');
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
            $data['url'] = $url;
            $data['path'] = $relativePath;
            $data['mime'] = $image->getClientMimeType();
            $data['size'] = $image->getSize();
        }
        
       
        $category = Category::create($data);

        }catch (\Exception $e){
          
           Log::info('error', [$e]);
           return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
       }
       return Redirect::back()->with('success','You have added successfully a new catgeory');
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
         try{
            $data = $request->validated();
            $data['updated_by'] = $request->user()->id;
             if($request->hasFile('image')){
                $image = $request->file('image');
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
                $data['url'] = $url;
                $data['path'] = $relativePath;
                $data['mime'] = $image->getClientMimeType();
                $data['size'] = $image->getSize();
        }
        
       
            $category->update($data);

        }catch (\Exception $e){
          
           Log::info('error', [$e]);
           return  Redirect::back()->with('error', 'sorry something went wrong cannot create loan try again');
       }
       return Redirect::back()->with('success','You have update successfully a new catgeory');
        
       

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

         return Redirect::back()->with('success','You have deleted successfully a  catgeory');
    }
}
