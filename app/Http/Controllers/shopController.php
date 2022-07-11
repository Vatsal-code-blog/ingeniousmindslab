<?php

namespace App\Http\Controllers;

use Request, Lang;
use App\Models\Customer as CustomerModel;
use App\Models\Shop as ShopModel;

class shopController extends Controller
{
	protected $viewPath;
	protected $actionURL;

	public function __construct(){
		$this->viewPath = 'customer';
		$this->actionURL = 'customer';
	}

	public function index(Request $request) {
        $customers = CustomerModel::orderBy('id', 'DESC')->get();
        // dd(count($customers));
        $shops = ShopModel::all();
		$_data=array(
            'actionURL'=>$this->actionURL,
			'customers'=>$customers,
            'shops'=>$shops
        );
        return view($this->viewPath, $_data);
    }

    public function Edit($id="") {
        try {
            $data = CustomerModel::where("id", $id)->first();
            $shops = ShopModel::all();
            if(isset($data) && !empty($data)):
                $_data=array(
                    'actionURL'=>$this->actionURL,
                    'data'=>$data,
                    'shops' => $shops
                );
                $res['edit_data'] = view('edit-data',$_data)->render();
                $res['success'] = true;
            else:
                $res['success'] = false;
                $res['message'] = Lang::get('message.noRecords');
            endif;
            return response()->json($res);
        } catch (\Throwable $th) {
            $res['success'] = false;
            $res['message'] = Lang::get('message.somethingWrong');
            return response()->json($res);
        }
    }

    public function Action() {
        try {
            $data = Request::all();
            if($data['edit_id'] == 0):
                $inserData = array(
                    'shop_id' => $data['shop_id'] ?? null,
                    'first_name' => $data['first_name'] ?? null ,
                    'last_name' => $data['last_name'] ?? null,
                    'city' => $data['city'] ?? '',
                    'birthdate' => $data['birthdate'] ?? null,
                    'avatar' => "",
                );
                if(isset($data['avatar']) && is_file($data['avatar'])):
                    $avatar_img = $data['avatar'];
                    $avatar = time() . '-' . $avatar_img->getClientOriginalName();
                    $avatar = str_replace(' ', '_', $avatar);
                    $path = public_path('uploads/customer');
                    $avatar_img->move($path, $avatar);
                    $inserData['avatar'] = $avatar;
                endif;
                CustomerModel::create($inserData);
                $res['success'] = true;
                $res['message'] = Lang::get('message.detailAdded');
                $customers = CustomerModel::orderBy('id', 'DESC')->paginate(10);
                $res['customers'] = view('customer_list',compact('customers'))->render();
                return response()->json($res);
            elseif($data['edit_id'] != 0):
                $customer_data = CustomerModel::where('id',$data['edit_id'])->first();
                $updateData = array(
                    'shop_id' => $data['shop_id'] ?? null,
                    'first_name' => $data['first_name'] ?? null ,
                    'last_name' => $data['last_name'] ?? null,
                    'city' => $data['city'] ?? null,
                    'birthdate' => $data['birthdate'] ?? null,
                    'avatar' => null,
                );
                if(isset($data['avatar']) && !empty($data['avatar'])):
                    $avatar_img = $data['avatar'];
                    $avatar = time() . '-' . $avatar_img->getClientOriginalName();
                    $avatar = str_replace(' ', '_', $avatar);
                    $path = public_path('uploads/customer');
                    $avatar_img->move($path, $avatar);
                    $updateData['avatar'] = $avatar;
                else:
                    $updateData['avatar'] = $customer_data->avatar ?? null;
                endif;
                CustomerModel::whereId($data['edit_id'])->update($updateData);

                $shops = ShopModel::all();
                    $_data=array(
                        'actionURL'=>$this->actionURL,
                        'shops' => $shops
                    );
                $res['form_data'] = view('edit-data',$_data)->render();
                $customers = CustomerModel::orderBy('id', 'DESC')->paginate(10);
                $res['customers'] = view('customer_list',compact('customers'))->render();
                $res['success'] = true;
                $res['message'] = Lang::get('message.detailUpdated');

                return response()->json($res);
            endif; 
        } catch (\Throwable $th) {
            $res['success'] = false;
            $res['message'] = Lang::get('message.somethingWrong');
            return response()->json($res);
        }
    }
    public function Delete($id="")
    {
        try {
            $_data = CustomerModel::where("id", $id)->first();
            if(isset($_data)):
                $_data->delete();
                $customers = CustomerModel::orderBy('id', 'DESC')->paginate(10);
                $res['customers'] = view('customer_list',compact('customers'))->render();
                $res['success'] = true;
                $res['message'] = Lang::get('message.detailDeleted');
                return response()->json($res); 
            else:
                $res['success'] = false;
                $res['message'] = Lang::get('message.somethingWrong');
                return response()->json($res);
            endif;
        } catch (\Throwable $th) {
            $res['success'] = false;
            $res['message'] = Lang::get('message.somethingWrong');
            return response()->json($res);
        }
        
    }
}
