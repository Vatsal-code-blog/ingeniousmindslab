@extends('app.index')
@section('css')
    <link href="{{$THEME_PATH}}/css/dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{$THEME_PATH}}/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@stop
@section('content')
    <div class="container">
        @if(isset($data->id)) 
            @php $id = $data->id @endphp
        @else 
            @php $id = 0 @endphp
        @endif
        <form action="{{url($actionURL.'/save')}}" enctype="multipart/form-data" method="post" id="customerForm">
            <div class="row" id="data">
                <div class="col-lg-12">
                    <div class="card2D br-20 p-3 card mb-3">
                        <div class="card-body card-dark">
                            <div class="form-wrap">
                                <div class="col-lg-12">
                                <h2>Add/Edit Category</h2>
                                <hr class="mt-1 mb-2">
                                <div class="row">
                                    <input type="hidden" name="edit_id" value="0">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label">First Name </label>
                                            <input type="text" name="first_name" value="{{ $data->first_name ?? '' }}" placeholder="Enter First Name" class="form-control fs-14 form-rounded">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Last Name </label>
                                            <input type="text" name="last_name" value="{{ $data->last_name ?? '' }}" class="form-control fs-14 form-rounded">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Avatar </label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 100px;">
                                                    @if(isset($data->avatar) && !empty($data->avatar) )
                                                        @php $imageURL = $UPLOAD_PATH.'/customer/'.$data->avatar @endphp
                                                    @else
                                                        @php $imageURL = $UPLOAD_PATH.'/'.'image-default.png' @endphp
                                                    @endif
                                                    <img src="{{$imageURL}}" style="max-width: 100px" alt= />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px;"> </div>
                                                <div>
                                                    <span class="btn btn-rounded default btn-file">
                                                        <span class="fileinput-new btn btn-primary btn-rounded"> Select Image </span>
                                                        <span class="fileinput-exists btn btn-danger"> Change </span>
                                                        <input type="file" name="avatar" class="form-control"> 
                                                    </span>
                                                    <a href="javascript:;" class="btn btn-rounded btn-outline-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Shop</label>
                                            <select class="form-control form-rounded form-select" id="shop_id" name="shop_id">
                                                <option value="">Select Shop</option>
                                                @if(isset($shops) && count($shops) > 0)
                                                    @foreach($shops as $shop)
                                                        <option value="{{ $shop->id }}" @if( isset($data->shop_id) && $data->shop_id == $shop->id ) selected @endif>{{ $shop->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">City </label>
                                            <input type="text" name="city" value="{{ $data->city ?? '' }}" class="form-control fs-14 form-rounded">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Birth Date </label>
                                            <input type="date" name="birthdate" value="{{ $data->birthdate ?? '' }}" class="form-control fs-14 form-rounded">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrap btn-group-left-right d-flex flex-wrap justify-content-between">
                                    <a href="{{ url($actionURL) }}" class="btn btn-outline-light btn-wh-130-50 btn-rounded">Cancel</a>
                                    <button type="submit" class="btn btn-primary btn-wh-160-50 btn-rounded">Save</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <hr></hr>
    <div class="container">
        <h2>List Category</h2>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>avatar</th>
                    <th>Customer Name</th>
                    <th>shop name</th>
                    <th>birthdate</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody id="customer-list">
                @if (isset($customers) && count($customers) > 0)
                    @foreach ($customers as $key => $customer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            @if(isset($customer->avatar) && !empty($customer->avatar) )
                                @php $imageURL = $UPLOAD_PATH.'/customer/'.$customer->avatar @endphp
                            @else
                                @php $imageURL = $UPLOAD_PATH.'/'.'image-default.png' @endphp
                            @endif
                            <td><img src="{{$imageURL}}" alt="" width="50px" height="50px"></td>
                            <td>{{$customer->FullName}}</td>
                            <td>{{$customer->Shop->name}}</td>
                            <td>{{_nice_date($customer->birthdate)}}</td>
                            <td>
                                <div class="d-flex text-center">
                                    {{-- <a title="Edit" href="{{url($actionURL.'/edit/'.$customer->id)}}"><i class="fa fa-edit text-success fs-18"></i> </a> --}}
                                    <button title="Edit" onclick="getEditBlade({{$customer->id}})">
                                        <i class="fa fa-edit text-success fs-18"></i> 
                                    </button>
                                    <span class="mx-1">|</span>
                                    <button title="Delete" href="javascript:void(0)" onclick="deleteCustomer({{ $customer->id }})">
                                        <i class="fa fa-trash fs-18 text-danger"></i>
                                    </button>
                                </div></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@stop
@section('js')

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="{{$THEME_PATH}}/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="{{$THEME_PATH}}/js/datatables/dataTables.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
$(document).ready(function () {
    $('#example').DataTable();
});

function getEditBlade(editId) {
    var url = "customer/edit/"+editId;
    shop_app.ajaxRequest(url,'', 'get').then(function(res) {
        // console.log(res.data.message);
        if(res.data.success == true){
            $('#data').html(res.data.edit_data);
        }else{
            toastr.error('something went wrong!');
        }
    });
}
function deleteCustomer(delete_id) {
    var url = "customer/delete/"+delete_id;
    if (confirm("Delete Customer ?")) {
        shop_app.ajaxRequest(url,'', 'get').then(function(res) {
            if(res.data.success == true){
                $('#customer-list').html(res.data.customers);
                toastr.success(res.data.message);
            }else{
                toastr.error('something went wrong!');
            }
        });
  }
}
</script>

@stop