<template>
<table class="table table-striped table-md">
      <tbody><tr>
        <th>Warehouse name</th>
        <th>Crops Type</th>
        <th>Quantity</th>
        <th>Region</th>
        <th>Destrict</th>
        <th>action</th>
      </tr>
      <tr>
        <th><input type="text" name='warehouse' class="form-control" id="warehouseid" placeholder="search by warehouse"></th>
        <th> <input type="text" name='crop_type' class="form-control" id="crop_typeid" placeholder="search by Crops Type"></th>
        <th> <input type="text" name='quantity' class="form-control" id="quantityid" placeholder="search by Quantity"></th>
        <th> <input type="text" name='region' class="form-control" id="regionid" placeholder="search by Region"></th>
        <th> <input type="text" name='destrict' class="form-control" id="destrictid" placeholder="search by Destrict"></th>
        <th> <h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form"><i class="fa fa-search"></i></button></h4></th>
        
      </tr>
        <tr>
            <td>Mkwakwani ltd</td>
            <td>Mahindi</td>
            <td>100000kg</td>
            <td>Tanga</td>
            <td>Tanga</td>
            <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
        </tr>
        <tr>
            <td>Mbeya ltd</td>
            <td>Mpunga</td>
            <td>600000kg</td>
            <td>Mbeya</td>
            <td>kyera</td>
            <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
        </tr>
        <tr>
            <td>Mkwakwani ltd</td>
            <td>Mahindi</td>
            <td>100000kg</td>
            <td>Tanga</td>
            <td>Tanga</td>
            <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
        </tr>
        <tr>
            <td>Mkwakwani ltd</td>
            <td>Maharage</td>
            <td>1200000kg</td>
            <td>Tanga</td>
            <td>Tanga</td>
            <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
        </tr>
        <tr>
            <td>Mbwa ltd</td>
            <td>Miwa</td>
            <td>330000kg</td>
            <td>Morogoro</td>
            <td>kirombelo</td>
            <td><h4><button class="btn btn-primary"  data-toggle="modal" data-target="#newacount_form">Order</button></h4></td>
        </tr>
        
      

    </tbody>
    <div class="card-footer text-right">
      <nav class="d-inline-block">
        <ul class="pagination mb-0">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
          </li>
        </ul>
      </nav>
        </div> 
    
      
  </table>

</template>
<script>
export default {
        mounted() {
            console.log('Component mounted.')
        }
    }

</script>