<?php

namespace App\Http\Controllers;

use App\Http\Resources\BannerResource;
use App\Models\BannerImage;
use App\Models\Category;
use App\Models\Product;
use App\Models\Question\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $query = Product::query();

        return $this->renderProducts($query);
    }


    public function allProducts(){
         $query = Product::query();

         return $this->getProducts($query);
    }

    public function byCategory(Category $category)
    {
     
        $categories = Category::getAllChildrenByParent($category);

        $query = Product::query()
            ->select('products.*')
            ->join('product_categories AS pc', 'pc.product_id', 'products.id')
            ->whereIn('pc.category_id', array_map(fn($c) => $c->id, $categories));

           return $this->getProducts($query);      
          

        
    }

    public function view(Product $product)
    {
        $products = Product::whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
        ->where('id', '!=', $product->id) 
        ->inRandomOrder()
        ->take(4)
        ->get();

        $questions = Question::query()->where('product_id', $product->id)->get();
        

        return view('product.view', [
            'product' =>  $product,
            'products' => $products,
            'questions' => $questions
        ]);
    }

    private function renderProducts(Builder $query)
    {
        $search = \request()->get('search');
        $sort = \request()->get('sort', '-updated_at');

        if ($sort) {
            $sortDirection = 'asc';
            if ($sort[0] === '-') {
                $sortDirection = 'desc';
            }
            $sortField = preg_replace('/^-?/', '', $sort);

            $query->orderBy($sortField, $sortDirection);
        }
        $products = $query
            ->where('published', '=', 1)
            ->where(function ($query) use ($search) {
                /** @var $query \Illuminate\Database\Eloquent\Builder */
                $query->where('products.title', 'like', "%$search%")
                    ->orWhere('products.description', 'like', "%$search%");
            })->paginate(8);

            $banQuery= BannerImage::query()->limit(3)->get();
             $cats = Category::query()->orderBy('updated_at', 'desc')->limit(6)->get();

        return view('product.index', [
            'products' => $products,
            'banners' => $banQuery,
            'cats' => $cats
        ]);

    }


     private function getProducts(Builder $query)
    {
        $search = \request()->get('search');
        $sort = \request()->get('sort', '-updated_at');

        if ($sort) {
            $sortDirection = 'asc';
            if ($sort[0] === '-') {
                $sortDirection = 'desc';
            }
            $sortField = preg_replace('/^-?/', '', $sort);

            $query->orderBy($sortField, $sortDirection);
        }
        $products = $query
            ->where('published', '=', 1)
            ->where(function ($query) use ($search) {
                /** @var $query \Illuminate\Database\Eloquent\Builder */
                $query->where('products.title', 'like', "%$search%")
                    ->orWhere('products.description', 'like', "%$search%");
            })->paginate(10);

        

        return view('product.list', [
            'products' => $products
        ]);

    }
}
