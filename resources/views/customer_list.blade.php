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
                    <button title="Edit" onclick="getEditBlade({{$customer->id}})">
                        <i class="fa fa-edit text-success fs-18"></i> 
                    </button>
                    <span class="mx-1">|</span>
                    <button title="Delete" href="javascript:void(0)" onclick="deleteCustomer({{ $customer->id }})">
                        <i class="fa fa-trash fs-18 text-danger"></i>
                    </button>
                    </a>
                </div></td>
        </tr>
    @endforeach
@endif