<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductGallary;
use App\Http\Resources\ProductResource;
use Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data= ProductResource::collection(Product::latest('id')->with('category', 'image_gallary')->get());
            return response()->json([
                'status'=>'success',
                'message'=>'Products',
                'data'=>$data,
            ]);
        }catch(\Excepiton $e){

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


            try{
                $validator=Validator::make($request->all(),[
                    'name'=>'required',
                    'price'=>'required',
                    'sku'=>'required|unique:products,sku',
                    // 'image'=>'nullable|max:1024|mimes:jpeg,jpg,png,gif',
                    'image_gallary[]'=>'nullable|max:1024|mimes:jpeg,jpg,png,gif',
                ]);
                if($validator->fails()){
                    return response()->json($validator->errors(),422);
                }

                $product=new Product;
                $product->name=$request->name;
                $product->category_id=$request->category_id;
                $product->quantity=$request->quantity;
                $product->description=$request->description;
                $product->price=$request->price;
                $product->sku=$request->sku;
                $product->total_review=$request->total_review;
                $product->total_ratting=$request->total_ratting;


                // if($request->file('image')){
                //     $img=$request->file('image');
                //     $img_name = time() . rand(1, 100) . '.' . $img->extension();
                //     $img->move(public_path('uploads/product_img'), $img_name);
                //     $product->image=$img_name;
                // }

                $product->save();
                if (!empty($product->id) && $request->hasfile('image_gallary')) {
                    foreach ($request->file('image_gallary') as $file) {
                        $name = time() . rand(1, 100) . '.' . $file->extension();
                        $file->move(public_path('uploads/product_img'), $name);
                        ProductGallary::insert([
                            'product_id' => $product->id,
                            'image' => $name,
                        ]);
                    }
                }


                if(!empty($product)){
                    $data=new ProductResource(Product::findOrFail($product->id));

                    return response()->json([
                        'status'=>true,
                        'data'=>$data,
                        'message'=>'Product created successfully',
                    ]);
                }
            }catch(\Exception $e){
                return response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage()
                ],500);
            }

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

        try{


            $product=Product::find($id);
            if(empty($product)){
                return response()->json([
                    'status'=>false,
                    'message'=>'Data not found',
                ],404);
            }

            $data=new ProductResource($product);
            return response()->json([
                'status'=>'success',
                'data'=> $data,
                'message'=>'Product details',
            ]);
        }catch(\Exception $e){

                return response()->json([
                    'status'=>false,
                    'message'=>$e->getMessage()
                ],500);

        }
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

        try{
            $validator=Validator::make($request->all(),[
                'name'=>'required',
                'price'=>'required',
                'sku'=>'required|unique:products,sku,'.$id,
               // 'image'=>'nullable|max:1024|mimes:jpeg,jpg,png,gif',
                'image_gallary[]'=>'nullable|max:1024|mimes:jpeg,jpg,png,gif',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(),422);
            }

            $product=Product::find($id);
            if(empty($product)){
                return response()->json([
                'status'=>false,
                'message'=>'Data not found',
                ],404);
            }

            $product->name=$request->name;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->sku=$request->sku;
            $product->total_review=$request->total_review;
            $product->total_ratting=$request->total_ratting;


            // if($request->file('image')){
            //     $img=$request->file('image');
            //     $img_name = time() . rand(1, 100) . '.' . $img->extension();
            //     $img->move(public_path('uploads/product_img'), $img_name);
            //     $product->image=$img_name;

            // }

            if (!empty($id) && $request->hasfile('image_gallary')) {
                foreach ($request->file('image_gallary') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('uploads/product_img'), $name);
                    ProductGallary::insert([
                        'product_id' => $id,
                        'image' => $name,
                    ]);
                }
            }

            if( $product->save()){
                return response()->json([
                'status'=>true,
                'message'=>'Data updated successfuly',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage(),
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $product=Product::find($id);
            if(empty($product)){
                return response()->json([
                'status'=>false,
                'message'=>'Data not found',
                ],404);
            }
               // $product->delete();
                if($product->delete()){
                return response()->json([
                'status'=>true,
                'message'=>'Data Deleted successfuly',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage(),
            ],500);
        }
    }
}
