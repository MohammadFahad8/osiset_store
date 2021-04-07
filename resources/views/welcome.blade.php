@extends('shopify-app::layouts.default')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

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
@section('content')
<div id="shop">
    
 
    {{-- <p>You are: {{ Auth::user()->name }}</p> --}}
    
<div class="card" id="packages_list">
    <div class="card-header">Packages List</div>
    
    <div class="button-add"> <button @click="openPackageForm" class="btn btn-primary">Add Package</button></div>
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
                    Package Price
                </th>
                
                <th class="offset-3">
                    Actions
                </th>
            </tr>
           
                
            <tr v-for="(row,key,index) in packages" :key="row.id">
               
                <td>@{{ row.name }}</td>
                <td>@{{ row.type }}</td>
                <td>@{{ row.price }}</td>
                <td><a href="javascript:void(0)" @click="openEditWindow(row)" class="btn btn-secondary">Edit</a></td>
                <td><a href="javascript:void(0)" @click="deleterecord(row.id)" class="btn btn-danger" >Delete</a></td>
                    
          
            </tr>        
          
                
            
        </table>
        
    </div>
</div>

<div class="modal fade" id="addNew"  >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                Add New Student
            </div>
            <form @submit.prevent="editCheck ? updateData():insertData()">
                <div class="modal-body">
                <div class="form-group">
                    <input v-model="form.name" type="text" class="form-control" placeholder="Enter Name">
                </div>
                    <div class="form-group">
                    <input v-model="form.type" type="number" class="form-control" min="10" max="100" placeholder="Enter Type">
                    </div>
                    <div class="form-group">
                    <input v-model="form.price" type="text" class="form-control" placeholder="Enter Price">
                    </div>
                  
                    

                </div>
                <div class="modal-footer">

                    <button v-show="!editCheck" class="btn btn-success" type="submit">Add</button>
                    <button v-show="editCheck" class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>
@endsection

@section('scripts')
    @parent
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


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
        function openWindow()
        {
            $('#add_package_form').show();
            $('#packages_list').hide();
            
        }
       
    </script>
    <script>
         window.onload = function(){
            
        var vu = new Vue({
            el:'#shop',
            data:{
                packages:{},
                form:{
                name:'',
                type:'',
                price:'',
                
            },
                editCheck:false,
            },
            methods: {
                getRecords:function()
                {
                    axios.get('/getPackages').then((res)=>{
                        
                        this.packages = res.data;
                        

                    })
                },
                insertData:function (){
                    
                    axios.post('/add_package',this.form).then((res)=>{
                    //   this.row.uid = res.data.id;
                      $('#addNew').modal('hide');
                       
                      this.getRecords();
                     
                      
                     
                      
  
                    }).catch((error)=>{
  
                    })
  
                  },
                updateData:function (){
                  axios.post('/update/'+this.form.id,this.form).then((res)=>{
                      $('#addNew').modal('hide');
                      document.getElementById("addNew").reset();

                  }).catch((res)=>{

                  })

                },
                deleterecord:function (id){


Swal.fire({
    icon: 'success',
    title: 'Deleted',
    text: 'Record deleted is non-retrievable! Do you wish to proceed?',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
}).then((result)=>{
  
    if(result.value) {
      $('#'+id).addClass('animate__animated animate__hinge');

        axios.get('/delete/' + id).then((res) => {
            
            
            this.getRecords();
        }).catch((error)=>{
          Swal.fire({
    icon: 'error',
    title: 'Package Error',
    text: 'Package Deletion Failed!',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
   
}).then((resu)=>{
    if(resu.value){
      this.getRecords();
      
      
      
    }
    

})

        })
    }
})



},
                openEditWindow:function (user){
                    this.editCheck = true;
                  this.form = '';

                  
    
                $('#addNew').modal('show');

                
                 
                  this.form = user;

                },
                openPackageForm:function (){

                $('#addNew').modal('show');
  

                  

                },
                
            },
            mounted()
            {
                
                this.getRecords();
            }
        })
    }
    </script>
@endsection