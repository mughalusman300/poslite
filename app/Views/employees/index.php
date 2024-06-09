<?= $this->extend('layouts/app') ?>
<?= $this->section('main-content') ?>
<main id="app" class="default-transition" style="opacity: 1;">
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">

                    <div class="mb-3">
                        <h1>Employees</h1>
                        <div class="text-zero top-right-button-container">
                            <a href="<?= base_url();?>/addemployee" type="button" class="btn btn-primary btn-lg top-right-button mr-1">ADD NEW</a>
                            
                        </div>
                        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Library</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Data</li>
                            </ol>
                        </nav>

                    </div>

                    <div class="separator mb-5"></div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group typeahead-container">
                        <input type="text" v-model="searchWord"  class="form-control" name="query" id="query" placeholder="Search By First Name, Last Name, Email..."  autocomplete="off" v-on:keyup="search">

                        <div class="input-group-append ">
                            <button type="submit" class="btn btn-primary default" @click="search">
                                <i class="simple-icon-magnifier"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator mb-5"></div>
             <div class="row">
                
                        <div  v-for="rows in employess" class="col-12 col-md-6 col-lg-4">
                            <div style="height:200px;" class="card d-flex flex-row mb-4">
                                <a class="d-flex" href="#">
                                    <img style="width:100px;height: 100px;" alt="Profile"  onerror=this.src="<?= base_url(); ?>/public/img/download.png"  v-bind:src="'<?= base_url(); ?>/' + rows.image" 
                                        class="img-thumbnail border-0 rounded-circle  m-4 list-thumbnail align-self-center">
                                </a>
                                <div class=" d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="list-item-heading mb-1 truncate">
                                                    {{rows.fname}} {{rows.lname}}
                                                </p>
                                            </a>
                                            <p class="mb-2 text-muted text-small">
                                             {{rows.designation_name}}   
                                            </p>
                                            <p class="mb-2 text-muted text-small">
                                             {{rows.department_name}}   
                                            </p>
                                            <p v-if='rows.emp_status=="active"' class="mb-2 text-capitalize text-success  text-small">
                                             {{rows.emp_status}}   
                                            </p>
                                            <p v-else class="mb-2 text-capitalize text-danger  text-small">
                                             {{rows.emp_status}}   
                                            </p>
                                            <p class="mb-2">
                                            <a v-show="rows.emp_status=='active'" :href="'<?= base_url();?>/update/'+rows.emp_id" target="_blank"><button type="button"
                                                class="btn btn-xs btn-outline-warning ">Edit</button>
                                            </a>
                                            <a v-bind:href="'<?= base_url();?>/detail/'+rows.emp_id" target="_blank"><button type="button"
                                                class="btn btn-xs btn-outline-primary ">View</button>
                                            </a>
                                            </p>
                                            <p>

                                             <button v-show="rows.emp_status=='active'"  type="button" @click="updateStatusMode(rows.emp_id)"
                                              class="btn btn-xs btn-outline-danger ">Leave
                                            </button>
                                              <a v-show="rows.emp_status=='active'"  v-bind:href="'<?= base_url();?>/payrolldetail/'+rows.emp_id" target="_blank"><button type="button"
                                                  class="btn btn-xs btn-outline-primary ">payroll</button>
                                              </a>
                                            </p>
                                            
                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
             </div>
             <div class="text-center" v-if="loading">
               <b-spinner variant="info" class="mt-5 mb-5" style="width: 4rem; height: 4rem;" label="Large Spinner"></b-spinner>
            </div>
        </div>
<!----Employee Leave Modal----------->       
    <div class="modal fade modal-right" id="updateStatusEmpModal" tabindex="-1" role="dialog"
        aria-labelledby="updateStatusEmpModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="alert alert-info form-group" role="alert">
                            Note: All Fields Required.
                        </div>
                        <div class="form-group">
                            <label>Date of Leaving</label><font style="color: red;">*</font>
                            <input v-model="emp_dol" type="date" name="emp_dol" class="form-control">
                            <p style="color: red" v-if="leavingDateError!=''">{{leavingDateError}}</p>
                        </div>
                        <div class="form-group">
                            <label>Leave Type</label><font style="color: red;">*</font>
                            <select tabindex="7" v-model="emp_leave_type" name="emp_leave_type"  class="form-control">
                                <option value="">Select</option>
                                <option value="Resign">Resign</option>
                                <option value="Terminated">Terminated</option>
                            </select>
                            <p style="color: red" v-if="emp_leave_type_error!=''">{{emp_leave_type_error}}</p>
                        </div>
                        <div class="form-group">
                            <label>Employee Leaving Reason</label><font style="color: red;">*</font>
                            <textarea v-model="emp_l_reason" placeholder="" name="emp_l_reason" class="form-control" rows="4"></textarea>
                            <p style="color: red" v-if="leavingReasonError!=''">{{leavingReasonError}}</p>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary"
                        data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" @click.prevent="updateStatus()">Submit</button>
                </div>
            </div>
        </div>
    </div> 
<!-------End Employee Leave Modal---->        
</main>
<script type="text/javascript">
 var app = new Vue({
  el: '#app',
  data: {
  searchWord:'',
  loading:false,
  emp_id:'',
  emp_dol:'',
  emp_leave_type:'',
  emp_l_reason:'',
  leavingDateError:'',
  leavingReasonError:'',
  emp_leave_type_error:'',
  employess : [],
  },
  methods:{
        search(){
            this.employess = [];
            this.loading = true;
            axios.get('search?s='+this.searchWord).then((response)=>{  
             this.loading = false;    
            this.employess = response.data;

          }).catch(()=>{
          })

        },
        updateStatusMode(id){
        this.clearModel();
        this.clearErrors();
        this.emp_id= id; 
        $('#updateStatusEmpModal').modal('show');
        },
        updateStatus()
        {
          const form = new FormData();
          form.append("emp_dol", this.emp_dol);
          form.append("emp_leave_type", this.emp_leave_type);
          form.append("emp_l_reason", this.emp_l_reason); 
          this.employess=[];
          this.loading = true;  
          axios.post('updateStatus/'+ this.emp_id, form).then((response)=>{
          this.loading = false;  
          this.clearModel();
          $("#updateStatusEmpModal").modal("hide");
             Swal.fire({
              // position: 'top-end',
              icon: 'success',
              title:'Employee marked Deactive!',
              showConfirmButton: false,
              timer: 2000
            })
            this.getAllEmployees();
          }).catch(err =>{
            this.clearErrors();
            if(err.response.data.messages.emp_dol){
             this.leavingDateError = err.response.data.messages.emp_dol;
           }
           if(err.response.data.messages.emp_leave_type){
           this.emp_leave_type_error = err.response.data.messages.emp_leave_type;
           } 
           if(err.response.data.messages.emp_l_reason){
           this.leavingReasonError = err.response.data.messages.emp_l_reason;
           }
           this.getAllEmployees();
          }) 
        },
        getAllEmployees()
        {
          this.loading = true;
          axios.get('getAllEmployees').then((response)=>{  
          this.loading = false;  
           this.employess =response.data;
          }).catch(()=>{
          })
        },
        clearErrors()
        {
          this.leavingDateError='';
          this.emp_leave_type_error='';
          this.leavingReasonError='';
        },
        clearModel()
        {
          this.emp_id='';
          this.emp_dol='';
          this.emp_l_reason='';
        },
 },
 created()
      {
        this.getAllEmployees();
      },        
  });  
  </script>    
<?= $this->endSection() ?>    
