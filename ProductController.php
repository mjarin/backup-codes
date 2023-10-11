<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Upload;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Session;

class ProductController extends Controller
{

public function wholeProduct(){
    
      $products=DB::table('products  as product')
     ->join('uploads as img','product.photos','=','img.id')
     ->join('categories as cate','product.category_id','=','cate.id')
     ->where('product.published','=','1')
     ->get([
     'product.id as prodId', 
     'product.name as prodName',
     'product.tags',
     'img.file_name',
     'product.description',
     'product.unit_price as price',
     'product.slug as prodSlug',
     'product.current_stock',
     'product.published',
     'product.category_id as cateId',
     'cate.name as catName',
     'cate.slug',
     'cate.meta_title'
     
     ]);
     
    
        return $products;

    
}
    
    
public function testApi(){
    
     $ids = [666,667,669,718,719];
     
     $products=DB::table('products  as product')
     ->join('uploads as img','product.photos','=','img.id')
     ->join('categories as cate','product.category_id','=','cate.id')
     ->whereIn('product.category_id',$ids)
     ->where('product.published','=','1')
     ->get([
     'product.id as prodId', 
     'product.name as prodName',
     'product.tags',
     'img.file_name',
     'product.description',
     'product.unit_price as price',
     'product.slug as prodSlug',
     'product.current_stock',
     'product.published',
     'product.category_id as cateId',
     'cate.name as catName',
     'cate.slug',
     'cate.meta_title'
     
     ]);
     
    
        return $products;
}

public function categoryApi(){
    


 $category = Category::all();
     
    return $category;
    
}

// end controller class
}
