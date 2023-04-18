<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Category\CategoryServiceInterface;
use App\Services\Comment\CommentServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductServiceInterface $productService,CommentServiceInterface $commentService,
                                CategoryServiceInterface $categoryService, BrandServiceInterface $brandService)
    {
        $this->productService = $productService;
        $this->commentService = $commentService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;

    }

    /**
     * @var Application|mixed
     */
    private $categoryService;

    /**
     * @var Application|mixed
     */
    private $brandService;

    /**
     * @var Application|mixed
     */
    private $productService;

    /**
     * @var Application|mixed
     */
    private $commentService;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = $this->brandService->all();
        $categories = $this->categoryService->all();
        $products = $this->productService->getProductOnIndex($request);
        return view('layouts.client.page.shop', compact('products', 'categories', 'brands'));
    }

    /**
     * Show product by categories
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $categoryName
     * @return \Illuminate\Http\Response
     */
    public function category($categoryName, Request $request)
    {
        $brands = $this->brandService->all();
        $categories = $this->categoryService->all();
        $products = $this->productService->getProductsByCategory($categoryName, $request);
        return view('layouts.client.page.shop', compact('products', 'categories', 'brands'));
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
     * Store comment by user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postComment(Request $request)
    {
        $this->commentService->create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        $brands = $this->brandService->all();
        $categories = $this->categoryService->all();
        return view('layouts.client.page.product', compact('product','relatedProducts' ,'brands','categories'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
