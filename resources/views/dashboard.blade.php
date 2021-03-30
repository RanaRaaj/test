<x-app-layout>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    
    <script src="{{url('backend/js/sweetalert.js')}}"></script>
    <script src="{{url('backend/sweetalerts/sweetalert2.all.js')}}"></script>
<link rel="stylesheet"
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<style type="text/css">
.session-msg{
  color: green;
  font-weight: bold;
}
#table_wrapper{
  display: block;
}
#table_length{
  float: left;
}
</style>
<div class="wrapper">
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                @if(session('added'))
                <div class="session-success">
                  <h3 class="session-msg">
                    {{session('added')}}
                  </h3>
                </div>
                  @endif
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Customers</h4>
                  <h4 style="float:right">
                      <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>
                  </h4>    
                  <br><br>
                  <button style="float: right;" class="btn btn-info" id="add-client">Add New</button>
                  <!--<div class="col-md-4">-->
                  <!--    <h4>Short By</h4>-->
                  <!--    <select data-v-34c7a05b="" class="form-control c-theme">-->
                  <!--        <option>Select</option>-->
                  <!--      <option data-v-34c7a05b="" value="first"> First Name </option>-->
                  <!--      <option data-v-34c7a05b="" value="last"> Last Name </option>-->
                  <!--  </select>-->
                  <!--</div>-->
                </div>
                <div class="card-body">
                <table id="table" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Location</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if(isset($value))
                      @foreach($value as $data)
                      <tr>
                            <td>{{$data->first_name}}</td>
                            <td>{{$data->last_name}}</td>
                            <td>{{$data->location}}</td>
                            <?php 
                              $edit = Auth::user()->edit_able;
                              $del = Auth::user()->delete_able;
                            ?>
    		                    <td>
                              <a data-id="<?php echo $data->id; ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
    		                    </td>
                      </tr>
                      @endforeach
                    @endif
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

</body>
</html>
<script type="text/javascript">
    $('#table').DataTable();
    $(".session-msg").delay(5000).fadeOut('slow');
    $("#add-client").on('click',function(e){
    	e.preventDefault();
   	    var swal = window.swal;
    	swal({
            title: "Do you want to Add New Customers",
            type: 'info',
            // text: 'text is here..!',
            showCancelButton: true,
            confirmButtonColor: '#F79426',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true
        	}).then( ( result ) => {
        if ( result.value == true ) {
	        $.ajax({
	            type: "get",
	            url: "/newClient",
	            success: function(msg){
	             window.location.href = "/newClient";
	            }
	        });
  	    }

      });
    });

</script>

<!-- For Delete Record -->
<script type="text/javascript">
  
  $(".delete").on('click',function(e){
    e.preventDefault();
    var task_id = $( this ).attr( "data-id" );
    data = {
      id: task_id
    }
    var swal = window.swal;
    swal({
      title: 'Do You Want To Delete This Record..?',
      type: 'info',
      text: 'Delete..!',
      showCancelButton: true,
      confirmButtonColor: '#F79426',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      showLoaderOnConfirm: true
    }).then( (result) => {
      if(result.value == true){
        $.ajax({
          type:'post',
          headers: {
              'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
          },
          url:'/delete-customer',
          data:data,
          success:function(msg){
            swal({
              title: msg,
              type: 'success',
            }).then((result) => {
              window.location.href = "/dashboard";              
            })
          }
        });
      }  
    });
  });

    $(document).ready(function() {
        $('#example').DataTable( {
            "order": [[ 0, "desc" ]]
        } );
    } );

</script>

</x-app-layout>
