@extends('shopify-app::layouts.default')
<style>
    .button-add{
    font-family:nunito;
    font-size:0.9rem;
    background-color:#fff;
    color:#7A97B3;
    float:right;
    font-weight: 600;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
@section('content')
    
    {{-- <p>You are: {{ Auth::user()->name }}</p>
    
      <button id="package_btn" class="btn btn-success offset-3" onclick="openForm()">Add Packages</button>
    
  
    <form action="" id="package_form" style="display: none">
        <div class="card w-50 offset-3">
            <div class="card-header">Select Package Details</div>
            <div class="card-body">
        <label>Select Time Period</label>
        <select name="package_name" id="" class="form-control">
            <option value="1">Monthly</option>
            <option value="2">Yearly</option>
            <option value="3">Lifetime</option>
        </select>
       
    </div>
    </form>
</div> --}}
<div class="card" id="packages_list">
    <div class="card-header">Packages List</div>
    
    <div class="button-add"> <button onclick="openForm()" class="btn btn-primary">Add Package</button></div>
    <div class="card-body">
        <table class="table table-hover">
            <tr>
                <th>
                    Package Name
                </th>
                <th>
                    Package Type
                </th>
                <th>
                    Actions
                </th>
            </tr>
           
                @forelse ($packages as $row)
                 <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->type }}</td>
                <td><a class="editbtn" href="{{  route('editpackage',['id'=>$row->id]) }}" class="btn btn-primary">Edit</a></td>
                    
                @empty
                <tr><td>Nothing to show</td></tr>
            </tr>        
                @endforelse
                
            
        </table>
        
    </div>
</div>
{{-- Addition Form --}}

        <form method="POST" action="{{ route('AddPackage') }}" enctype="multipart/form-data" id="add_package_form" style="display: block">
           {{ csrf_field() }}
            <div class="card w-50 offset-3">
                <button class=""></button>
                <div class="card-header">Add Package</div>
                <div class="card-body">
                    <input type="text" value="{{ $id??'' }}">
                    <div class="form-group row">
                        <label for="package_name"
                               class="col-md-4 col-form-label text-md-right">{{ __('Package Name') }}</label>

                        <div class="col-md-6">
                            <input id="package_name" type="text"
                                   class="form-control"
                                   name="name" value="{{ $modify_packages->name??'' }}" required autocomplete="name"
                                   autofocus>

                           
                        </div>
                        <label for="package_name"
                        class="col-md-4 col-form-label text-md-right">{{ __('Package Type') }}</label>

                
                        <div class="col-md-6">
                            <input id="package_type" type="number"
                                   class="form-control"
                                   name="type" value="{{ $modify_packages->type??'' }}" required autocomplete="name"
                                   autofocus>

                           
                        </div>
                        <label for="package_name"
                        class="col-md-4 col-form-label text-md-right">{{ __('Package Price') }}</label>

                
                        <div class="col-md-6">
                            <input id="package_price" type="text"
                                   class="form-control"
                                   name="price" value="{{ $modify_packages->price??'' }}" required autocomplete="name"
                                   autofocus>

                           
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
        </div></div>
        </form>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Welcome',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
        function openForm()
        {
            $('#add_package_form').show();
            $('#packages_list').hide();
            
        }
    </script>
@endsection