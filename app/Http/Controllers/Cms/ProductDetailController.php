<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Product_detail;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
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
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $product = $this->productService->find($id);
        $productDetails = $product->productDetails;
        return view('layouts.admin.products.product_detail', compact('product', 'productDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $product_id
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = $this->productService->find($product_id);
        return view('layouts.admin.products.product_detail_add', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $product_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $data = $request->all();
        Product_detail::create($data);
        $this->updateQty($product_id);
        return redirect('admin/products/'.$product_id.'/details');
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
     * @param  $product_id
     * @param  $product_detail_id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id, $product_detail_id)
    {
        $product = $this->productService->find($product_id);
        $productDetail = Product_detail::find($product_detail_id);
        return view('layouts.admin.products.product_detail_edit', compact('product','productDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $product_id
     * @param  $product_detail_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, $product_detail_id)
    {
        $data = $request->all();
        Product_detail::find($product_detail_id)->update($data);
        $this->updateQty($product_id);
        return redirect('admin/products/'.$product_id.'/details');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $product_id
     * @param  $product_detail_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $product_detail_id)
    {
        Product_detail::find($product_detail_id)->delete();

        return redirect('admin/products/'.$product_id.'/details');
    }

    /**
     * Update Quantity
     *
     * @param  $product_id
     */
    //Common method
    public function updateQty($product_id)
    {
        $product = $this->productService->find($product_id);
        $productDetails = $product->productDetails;

        $totalQty = array_sum(array_column($productDetails->toArray(), 'qty'));

        $this->productService->update(['qty'=>$totalQty], $product_id);
    }
}
