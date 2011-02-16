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
                    <h3 class="card-header text-center">Edit Products</h3>
                    <div class="card-body">
                        <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <select  placeholder="product name" id="product_name" class="form-control"  name="product_name" required
                                        autofocus>
                                    <option value="fan" <?php echo $product->name =="fan"?"selected":"" ?>>fan</option>
                                    <option value="refrigerator" <?php echo $product->name =="refrigerator"?"selected":"" ?>>refrigerator</option>
                                    <option value="bulb" <?php echo $product->name =="bulb"?"selected":"" ?>>bulb</option>
                                    <option value="table" <?php echo $product->name =="table"?"selected":"" ?>>table</option>
                                    <option value="chair" <?php echo $product->name =="chair"?"selected":"" ?>>chair</option>
                                    </select>
                            </div>
 
                            <div class="form-group mb-3">
                                <input type="text" onKeyup="sum()" placeholder="quantity" id="quantity" class="form-control" value="{{ $product->quantity }}" name="quantity" required>
                                
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" onKeyup="sum()" placeholder="rate" id="rate" class="form-control" value="{{ $product->rate }}" name="rate" required>
                                
                            </div>
                            <div class="form-group mb-3">
                                <select onchange="myFunction(this.value)" placeholder="product name" id="product_type"  class="form-control" name="product_type"
                                    autofocus>
                                    <option value="flat" <?php echo $product->product_type =="flat"?"selected":"" ?>>flat</option>
                                    <option value="discount" <?php echo $product->product_type =="discount"?"selected":"" ?>>discount</option>
                                </select>   
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" onKeyup="sum()" placeholder="discount" id="discount" value="{{ $product->discount }}" class="form-control" name="discount" required>
                                
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="amount" id="amount" value="{{ $product->amount }}" class="form-control" name="amount" required>
                                
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