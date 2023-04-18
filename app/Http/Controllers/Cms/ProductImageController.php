<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Product_image;
use App\Services\Product\ProductServiceInterface;
use App\Utilities\Common;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @var Application|mixed
     */
    private $productService;

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = $this->productService->find($id);
        $productImages = $product->productImages;
        return view('layouts.admin.products.product_image', compact('productImages','product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $data = $request->all();
        if($request->hasFile('image')) {
            $data['path'] = Common::uploadFile($request->file('image'),'front/img/products');
            unset($data['image']);

            Product_image::create($data);
        }
        return redirect('admin/products/'.$id.'/images');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $product_id
     * @param  $product_image_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $product_image_id)
    {
        $file_name = Product_image::find($product_image_id)->path;
        if($file_name != '') {
            unlink('front/img/products/'.$file_name);
        }

        Product_image::find($product_image_id)->delete();
        return redirect('admin/products/' .$product_id.'/images');
    }
}
