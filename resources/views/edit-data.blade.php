@if(isset($data->id)) 
    @php $id = $data->id @endphp
@else 
    @php $id = 0 @endphp
@endif
{{-- {!! Form::open(['url'=>url($actionURL.'/action',$view).'/'.$id,'enctype'=>"multipart/form-data",'id'=>'customerForm']) !!} --}}
{{-- <form action="{{url($actionURL.'/action',$view).'/'.$id}}" enctype="multipart/form-data" method="post" id="customerForm"> --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card2D br-20 p-3 card mb-3">
                <div class="card-body card-dark">
                    <div class="form-wrap">
                        <div class="col-lg-12">
                        <h2>Add/Edit Category</h2>
                        <hr class="mt-1 mb-2">
                        <div class="row">
                            <input type="hidden" name="edit_id" value={{ $data->id ?? 0 }}>
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
{{-- </form> --}}
{{-- {!! Form::close() !!} --}}