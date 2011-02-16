@extends('layout.app')

<script>
function myFunction(data){
    var discount=document.getElementById("discount");
    if(data=="discount"){
        discount.removeAttribute("readonly");

    }else{
        discount.setAttribute("readonly", "");
        discount.value=0;  
    }
    
}

function sum() {
       var txtFirstNumberValue = document.getElementById('quantity').value;
       var txtSecondNumberValue = document.getElementById('rate').value;
       var txtThirdNumberValue = document.getElementById('discount').value;
       if (txtFirstNumberValue == "")
           txtFirstNumberValue = 0;
       if (txtSecondNumberValue == "")
           txtSecondNumberValue = 0;
       if (txtThirdNumberValue.disabled)
           txtThirdNumberValue = 0;

       var result = (parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue))-txtThirdNumberValue;
       if (!isNaN(result)) {
           document.getElementById('amount').value = result;
       }
   }
</script>
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Add Products</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf
                            <div class="form-group mb-3">

                            <select  placeholder="product name" id="name" class="form-control" name="name" required
                                    autofocus>
                                    <option value="">Select product name</option>
                                <option value="fan">fan</option>
                                <option value="refrigerator">refrigerator</option>
                                <option value="bulb">bulb</option>
                                <option value="table">table</option>
                                <option value="chair">chair</option>
                                </select>
                              
                            </div>
 
                            <div class="form-group mb-3">
                                <input type="text" onKeyup="sum()" placeholder="quantity" id="quantity" class="form-control" name="quantity" required>
                                
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" onKeyup="sum()" placeholder="rate" id="rate" class="form-control" name="rate" required>
                                
                            </div>
                            <div class="form-group mb-3">
                            <select onchange="myFunction(this.value)"  placeholder="product type" id="product_type" class="form-control" name="product_type" required>
                                <option value="">Select product type</option>
                                <option value="flat">flat</option>
                                <option value="discount">discount</option>
                                </select>
                                
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" onKeyup="sum()" placeholder="discount" id="discount" class="form-control" name="discount">
                                
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="amount" id="amount" class="form-control" name="amount" required>
                                
                            </div>
                            
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Submit</button>
                            </div>
                        </form>
 
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection


