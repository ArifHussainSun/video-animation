<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProductBundles;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProductBundlesController extends Controller
{
    function __construct()
    {
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product_bunbles = ProductBundles::all();
            return DataTables::of($product_bunbles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    $html .= '<button href="#"  class="btn btn-primary btn-product"  data-bs-toggle="modal" data-bs-target=".orderdetails" data-id="'.$row->id.'"><i class="">Products</i></button>&nbsp' ;
                    $html .= '<a href="'.route('product-bundle.edit', $row->id).'"  class="btn btn-success btn-edit"><i class="fas fa-edit"></i></a>&nbsp' ;
                    $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';

                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="productBundle_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action','created_at', 'status'])->make(true);
        }

        return view('admin.productbundles.list');
    }

    public function trashed(Request $request){

        if ($request->ajax()) {
            $product_bunbles = ProductBundles::onlyTrashed();
            return DataTables::of($product_bunbles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    $html .= '<button href="#"  class="btn btn-primary btn-product"  data-bs-toggle="modal" data-bs-target=".orderdetails" data-id="'.$row->id.'"><i class="">Products</i></button>&nbsp' ;
                    $html .= '<a href="'.route('product-bundle.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';

                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="productBundle_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action','deleted_at', 'status'])->make(true);
        }

        return view('admin.productbundles.trashed');
    }

    public function form()
    {
        $categories = Categories::all();
        $products = Product::all();
        return view('admin.productbundles.add',compact('categories','products'));
    }

    function status(Request $request, $id,$isType=null) 
    {
        $productBandle = ProductBundles::find($id);
        $productBandle->active = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($productBandle->save()) {
            $response["success"] = true;
            $response["message"] = "Product Bundles Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Product Bundles Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'products' => 'required',
            'category_id' => 'required',
            'discount' => 'nullable',
            'discount_type' => 'nullable',
        ]);
        if($valid)
        {
          $product_bunbles = new ProductBundles();
          $product_bunbles->name = $request->name;
          $product_bunbles->title = $request->title;
          $product_bunbles['products'] = json_encode($request->products);
          $product_bunbles->category_id = $request->category_id;
          $product_bunbles->discount = $request->discount;
          $product_bunbles->discount_type = $request->discount_type;
          $management = User::role(['Admin', 'Brand Manager'])->get();
          $management->pluck('id');
          $data = array(
            "success"=> true,
            "message" => "Product Bundle Added Successfully."
          );

          if($product_bunbles->save()) {

            $notify = array(
              "performed_by" => Auth::user()->id,
              "title" => "Created Product Bundle",
              "desc" => array(
                  "added_title" => $request->input('name'),
                  "added_description" => strip_tags($request->title),
                  )
           );
           Notification::send($management, new QuickNotify($notify));
           Session::flash('error', $data["message"]);
          } else {
            $data["success"] = false;
            $data["message"] = "Failed to add Product Budle";

            Session::flash('error', $data["message"]);
          }
          return redirect()->route('product-bundle.list')->with($data);

        }
        else {
           return redirect()->back();
        }
    }

    public function restore(Request $request ,$id)
    {
        $productBundle = ProductBundles::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Product Bundle Restored Successfully!"
        );

        if(!$productBundle->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Product Bundle!";
        }

        return redirect()->route('product-bundle.list')->with($response);
    }

    public function edit(Request $request,$id)
    {
        $categories = Categories::all();
        $where = array('id' => $id);
        $product_bundles  = ProductBundles::where($where)->first();
        $selected_products = collect(json_decode($product_bundles->products));
        $selected_bundle = collect(json_decode($product_bundles->discount_type));
        $products = Product::all();
        return view('admin.productbundles.edit',compact('products','selected_products','selected_bundle','categories','product_bundles'));
    }

    public function view(Request $request , $isTrashed=null)
    {
        $categories = Categories::all();
        $where = array('id' => $request->id);
        if($isTrashed != null && $isTrashed == 1 ) {

            $product_bundles  = ProductBundles::onlyTrashed()->where($where)->first();
            $selected_products = collect($product_bundles->products);
            $selected_bundle = collect(json_decode($product_bundles->discount_type));
            $products = Product::all();

            $html = '';
            $discount_type = '';
            foreach($products as $product) {
                if($selected_products->contains($product->id)) {
                    $html .= '<option value="'.$product->id.'" selected>'.$product->product_name.'</option>';
                } else {
                    $html .= '<option value="'.$product->id.'">'.$product->product_name.'</option>';
                }
            }
            $product_bundles['html'] = $html;
            $product_bundles["categories"] = $categories;

        } else {

            $product_bundles  = ProductBundles::where($where)->first();
            $selected_products = collect($product_bundles->products);
            $selected_bundle = collect(json_decode($product_bundles->discount_type));
            $products = Product::all();

            $html = '';
            $discount_type = '';
            foreach($products as $product) {
                if($selected_products->contains($product->id)) {
                    $html .= '<option value="'.$product->id.'" selected>'.$product->product_name.'</option>';
                } else {
                    $html .= '<option value="'.$product->id.'">'.$product->product_name.'</option>';
                }
            }
            $product_bundles['html'] = $html;
            $product_bundles["categories"] = $categories;

        }

        return Response::json(["status"=>true,"product_bundle"=>$product_bundles]);
    }

    public function ProductDisplay(Request $request,$isType=null)
    {
        $where = array('id' => $request->id);

        if($isType != null  ) {
            $product_bundles  = ProductBundles::where($where)->with('products','category')->first();
            $products = Product::select('id', 'name','title','price','description')->whereIn('id', json_decode($product_bundles->products))->get();
            $data["products"] = $products;
        } else {
            $product_bundles  = ProductBundles::onlyTrashed()->where($where)->with('products','category')->first();
            $products = Product::select('id', 'name','title','price','description')->whereIn('id', json_decode($product_bundles->products))->get();
            $data["products"]  = $products;
        }

        return Response()->json($data);
    }

    public function ProductBundlesApi($id=null)
    {
        $product_bundles = ProductBundles::where('id', $id)->with('productdetails')->first();

        if (!empty($product_bundles)) {
            return response()->json([
                "status" => true,
                "data" => $product_bundles
            ]);

        }else{
            return response()->json(array(
                "status" => false,
                "message" => 'Product Bundle Id Does Not Exit',
            ), 400);
        }
    }

   public function Product_bundle_discount($discount_type, $products_discount, $amount)
    {
        if($discount_type == "flat"){
            $discounted_amount =  floatval($amount - $products_discount);
        }else {
            $discount_amount = $amount/100 * $products_discount;
            $discounted_amount = floatval($amount - $discount_amount);
        }

        return floatval($discounted_amount);
    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'products' => 'required',
            'category_id' => 'required',
            'discount' => 'nullable',
            'discount_type' => 'nullable',
        ]);
        if($valid)
        {
          $product_bunbles = ProductBundles::find($request->id);
          $product_bunbles->name = $request->name;
          $product_bunbles->title = $request->title;
          $product_bunbles['products'] = json_encode($request->products);
          $product_bunbles->category_id = $request->category_id;
          $product_bunbles->discount = $request->discount;
          $product_bunbles->discount_type = $request->discount_type;
          $management = User::role(['Admin', 'Brand Manager'])->get();
          $management->pluck('id');
          $data = array(
            "success"=> true,
            "message" => "Product Bundle Updated Successfully"
         );

         if($product_bunbles->save()) {

            $notify = array(
               "performed_by" => Auth::user()->id,
               "title" => "Updated Product Bundle",
               "desc" => array(
                   "added_title" => $request->input('name'),
                   "added_description" => strip_tags($request->title),
                   )
            );
            Notification::send($management, new QuickNotify($notify));
            Session::flash('success', $data["message"]);

         } else {

            $data["success"] = false;
            $data["message"] = "Product Bundle Not Added Successfully.";

            Session::flash('error', $data["message"]);
         }

         return redirect()->route('product-bundle.list')->with($data);
        }
        else {
           return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $product_bundles = ProductBundles::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Product Bundle Deleted Successfully!"
        );

        if(!$product_bundles->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Delete Product Bundle!";
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $product_bundles = ProductBundles::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Product Bundle Destroy Successfully!"
        );

        if(!$product_bundles->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Product Bundle!";
        }

        return response()->json($response);

    }
}
