<body>
 <div class="container">
  <br />
  <h3 align="center">Import Data Product From Shopee</h3>
  <form method="post" id="import_form" enctype="multipart/form-data">
   <p>
   <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>
   <select name="seller_id" id="inputState" class="form-control">Choose
     <option value="Lyole"> Shop 1 </option>
     <option value="2"> Shop 2 </option>
     <option value="3"> Shop 3 </option>
   </section>
   <br />
   <input type="submit" name="import" value="Import" class="btn btn-info" />
  </form>
  <br />
  <div class="table-responsive" id="customer_data">

  </div>
 </div>

</body>
<script>
$(document).ready(function(){
 $('#import_form').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"<?php echo base_url(); ?>ProductShopeeCreatDetail",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   success:function(data){
    alert('Import thành công!');
   }
  })
 });

});
</script>