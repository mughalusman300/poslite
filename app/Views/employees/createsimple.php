    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <title>HRMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/attendance.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/font/simple-line-icons/css/simple-line-icons.css" />
    
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/vendor/bootstrap.rtl.only.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/vendor/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/vendor/bootstrap-datepicker3.min.css" />

    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/vendor/component-custom-switch.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/vendor/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/font/iconsmind-s/css/iconsminds.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/font/simple-line-icons/css/simple-line-icons.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/css/main.css" />
  
        <!--------------------Bootstrap Vue and Vue Load---------------------------------->
    <!-- Load required  BootstrapVue CSS -->
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>/public/asset/fontawesome/css/all.min.css" />
    <!-- Load polyfills to support older browsers -->
    <script src="//polyfill.io/v3/polyfill.min.js?features=es2015%2CIntersectionObserver" crossorigin="anonymous"></script>
    <!-- Load Vue followed by BootstrapVue -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script> 
    <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>
    <!-- Load the following for BootstrapVueIcons support -->
    <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js"></script>

    <!-------------------------------------------------------------------------->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?= base_url(); ?>/public/asset/js/vendor/jquery-3.3.1.min.js"></script>
<body id="app-container" class="menu-default show-spinner">    
<nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>

        </div>

<img class="navbar-logo" style="width:105px; height:65px;  "  src="<?= base_url(); ?>/public/img/tmlogo.png">
        

        <div class="navbar-right">
            <div class="header-icons d-inline-block align-middle">
                <div class="d-none d-md-inline-block align-text-bottom mr-3">
                    <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1" 
                        data-toggle="tooltip" data-placement="left" title="Dark Mode">
                        <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                        <label class="custom-switch-btn" for="switchDark"></label>
                    </div>
                </div>
                <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                    <i class="simple-icon-size-fullscreen"></i>
                    <i class="simple-icon-size-actual"></i>
                </button>

            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span>
                        <img alt="Profile Picture" src="<?= base_url(); ?>/public/asset/img/profiles/l-1.jpg" />
                    </span>
                </button>

                <div class="dropdown-menu dropdown-menu-right mt-3">
                    <!-- <a class="dropdown-item" href="#">Account</a>
                    <a class="dropdown-item" href="#">Features</a>
                    <a class="dropdown-item" href="#">History</a>
                    <a class="dropdown-item" href="#">Support</a> -->
                    <a class="dropdown-item" href="<?= base_url(); ?>/Login/logout">Sign out</a>
                </div>
            </div>
        </div>
</nav>    
<div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li>
                        <a href="<?= base_url();?>/home">
                            <i class="iconsminds-shop-4"></i>
                            <span>Dashboards</span>
                        </a>
                    </li>
                    <li>
                        <a href="#layouts">
                            <i class="iconsminds-digital-drawing"></i> Pages
                        </a>
                    </li>
                    <li>
                        <a href="#applications">
                            <i class="iconsminds-air-balloon-1"></i> Applications
                        </a>
                    </li>
                    <li>
                        <a href="#ui">
                            <i class="iconsminds-pantone"></i> UI
                        </a>
                    </li>
                    <li>
                        <a href="#menu">
                            <i class="iconsminds-three-arrow-fork"></i> Menu
                        </a>
                    </li>
                    <li class="active">
                        <a href="Blank.Page.html">
                            <i class="iconsminds-bucket"></i> Blank Page
                        </a>
                    </li>
                    <li>
                        <a href="https://dore-jquery-docs.coloredstrategies.com" target="_blank">
                            <i class="iconsminds-library"></i> Docs
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
<main id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Employee Registration</h1>
                    <div class="separator mb-5"></div>
                </div>
            </div>
            <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Employee Information</h5>
                             <hr>
                            <form method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label>First Name <font style="color: red;">*</font></label>
                                        <input tabindex="1"  type="text" v-model="fname" class="form-control" id="inputfname4" placeholder="e.g Haroon">
                                        <p style="color: red" v-if="fname_error!=''">{{fname_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label>Last Name <font style="color: red;">*</font></label>
                                        <input tabindex="2" type="text" v-model="lname" class="form-control" id="inputlname4" placeholder="e.g Ali">
                                        <p style="color: red" v-if="lname_error!=''">{{lname_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label>Father Name <font style="color: red;">*</font></label>
                                        <input tabindex="3" type="text" v-model="father_name" class="form-control" id="inputfathername4" placeholder="e.g M. Ali">
                                        <p style="color: red" v-if="father_name_error!=''">{{father_name_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label >CNIC <font style="color: red;">*</font></label>
                                        <input tabindex="4" type="number" min="1" v-model="cnic" class="form-control"  placeholder="e.g 3520274024335">
                                        <p style="color: red" v-if="cnic_error!=''">{{cnic_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label for="inputEmail4">Email <font style="color: red;">*</font></label>
                                        <input tabindex="5" type="email" v-model="email" class="form-control" id="inputEmail4" placeholder="e.g xyz@gmail.com">
                                        <p style="color: red" v-if="email_error!=''">{{email_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label >Contact No. <font style="color: red;">*</font></label>
                                        <input tabindex="6" type="number" min="1" v-model="contact_no" class="form-control"  placeholder="e.g 03034445556">
                                        <p style="color: red" v-if="contact_no_error!=''">{{contact_no_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label ><span>Gender<font style="color: red;">*</font></span></label>
                                        <select tabindex="7" v-model="gender" name="gender"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <p style="color: red" v-if="gender_error!=''">{{gender_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label>Designation <font style="color: red;">*</font></label>
                                        <select v-model="designation_id"  name=""  tabindex="8" class="form-control">
                                          <option value="">Choose</option>
                                          <option v-for="option in designations" v-bind:value="option.desid">
                                          {{ option.designation_name }}
                                          </option>
                                        </select>
                                        <p style="color: red" v-if="designation_id_error!=''">{{designation_id_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label>Department<font style="color: red;">*</font></label>
                                        <select v-model="department_id"  name=""  tabindex="9" class="form-control">
                                          <option value="">Choose</option>
                                          <option v-for="option in departments" v-bind:value="option.depid">
                                          {{ option.department_name }}
                                          </option>
                                        </select>
                                        <p style="color: red" v-if="department_id_error!=''">{{department_id_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Category<font style="color: red;">*</font></label>
                                        <select v-model="category"  name=""  tabindex="10" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Permanant">Permanant</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Daily Wages">Daily Wages</option>
                                            <option value="3rd Vender">3rd Vender</option>
                                            <option value="Janitorial">Janitorial</option>
                                            <option value="Franchisee">Franchisee</option>
                                        </select>
                                        <p style="color: red" v-if="category_error!=''">{{category_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                        <label>City <font style="color: red;">*</font></label>
                                        <select  v-model="city"  name="city"  tabindex="11" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="karachi">karachi</option>
                                            <option value="Rawalpindi">Rawalpindi</option>
                                            <option value="Faisalabad">Faisalabad</option>
                                        </select>
                                        <p style="color: red" v-if="city_error!=''">{{city_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4 input-group-sm">
                                    <label for="inputAddress">Address <font style="color: red;">*</font></label>
                                    <input tabindex="12" v-model="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                <p style="color: red" v-if="address_error!=''">{{address_error}}</p>
                                </div> 
                                </div>                                
                                </form>
                                <button tabindex="13" @click="postEmployee()"  class="btn btn-primary ml-auto d-block mt-3">Submit</button>
                            
                        </div>
                    </div>
        </div>
    </main>
<script type="text/javascript">
 var app = new Vue({
  el: '#app',
  data: {
    departments:{},
    designations:{},
    fname:'',
    lname:'',
    father_name:'',
    cnic:'',
    email:'',
    contact_no:'',
    gender:'',
    designation_id:'',
    department_id:'',
    category:'',
    city:'',
    address:'',
    //errors
    fname_error:'',
    lname_error:'',
    father_name_error:'',
    cnic_error:'',
    email_error:'',
    contact_no_error:'',
    gender_error:'',
    designation_id_error:'',
    department_id_error:'',
    category_error:'',
    city_error:'',
    address_error:'',
  },
  methods:{
        getDepartments()
        { 
          axios.get('/hrms/Department/getAllDepartments').then((response)=>{
          this.departments =response.data;
          })
        },
        getDesignations()
        {
          axios.get('/hrms/Designation/getAllDesignations').then((response)=>{
          this.designations =response.data;
          })
        },
        postEmployee()
        {
          const form = new FormData();
          form.append("fname", this.fname);
          form.append("lname", this.lname);
          form.append("father_name", this.father_name);
          form.append("cnic", this.cnic);
          form.append("email", this.email);
          form.append("contact_no", this.contact_no);
          form.append("gender", this.gender);
          form.append("designation_id", this.designation_id);
          form.append("department_id", this.department_id);
          form.append("category", this.category);
          form.append("city", this.city);
          form.append("address", this.address);
          axios.post('/hrms/employee/createEmployee',form).then((response)=>{
           
           Swal.fire({
              // position: 'top-end',
              icon: 'success',
              title: this.fname+' Employee has been Created Successfully',
              showConfirmButton: false,
              timer: 2000
            })
            this.clearForm();
            this.clearErrors();
          }).catch(err => {
            this.clearErrors();
              Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'Something Went Wrong! Please Fill All Fields Carefully',
              showConfirmButton: false,
              timer: 2000
            })
            if(err.response.data.messages.fname)
            { this.fname_error = err.response.data.messages.fname; }
            if(err.response.data.messages.lname)
            { this.lname_error = err.response.data.messages.lname; }
            if(err.response.data.messages.father_name)
            { this.father_name_error = err.response.data.messages.father_name; }
            if(err.response.data.messages.cnic)
            { this.cnic_error = err.response.data.messages.cnic; }
            if(err.response.data.messages.email)
            { this.email_error = err.response.data.messages.email; }
            if(err.response.data.messages.contact_no)
            { this.contact_no_error = err.response.data.messages.contact_no; }
            if(err.response.data.messages.gender)
            { this.gender_error = err.response.data.messages.gender; }
            if(err.response.data.messages.designation_id)
            { this.designation_id_error = err.response.data.messages.designation_id; }
            if(err.response.data.messages.department_id)
            { this.department_id_error = err.response.data.messages.department_id; }
            if(err.response.data.messages.category)
            { this.category_error = err.response.data.messages.category; }
            if(err.response.data.messages.city)
            { this.city_error = err.response.data.messages.city; }
            if(err.response.data.messages.address)
            { this.address_error = err.response.data.messages.address; }
        });
        },
        clearErrors()
        {
            this.fname_error='';
            this.lname_error='';
            this.father_name_error='';
            this.cnic_error='';
            this.email_error='';
            this.contact_no_error='';
            this.gender_error='';
            this.designation_id_error='';
            this.department_id_error='';
            this.category_error='';
            this.city_error='';
            this.address_error='';
        },
        clearForm()
        {
            this.fname='';
            this.lname='';
            this.father_name='';
            this.cnic='';
            this.email='';
            this.contact_no='';
            this.gender='';
            this.designation_id='';
            this.department_id='';
            this.category='';
            this.city='';
            this.address='';
            
        },
  },
  created(){
   this.getDesignations(); 
   this.getDepartments(); 
  }

  });  
  </script>   
 <footer class="page-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <p class="mb-0 text-muted">ColoredStrategies 2019</p>
                    </div>
                    <div class="col-sm-6 d-none d-sm-block">
                        <ul class="breadcrumb pt-0 pr-0 float-right">
                            <li class="breadcrumb-item mb-0">
                                <a href="#" class="btn-link">Review</a>
                            </li>
                            <li class="breadcrumb-item mb-0">
                                <a href="#" class="btn-link">Purchase</a>
                            </li>
                            <li class="breadcrumb-item mb-0">
                                <a href="#" class="btn-link">Docs</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    
    <script src="<?= base_url(); ?>/public/asset/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/vendor/bootstrap-datepicker.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/vendor/fullcalendar.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/vendor/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/vendor/mousetrap.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/vendor/jquery.table2excel.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/vendor/tableHTMLExport.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.10/jspdf.plugin.autotable.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/libs/FileSaver/FileSaver.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/libs/js-xlsx/xlsx.core.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/libs/js-xlsx/xlsx.core.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/libs/jsPDF/jspdf.min.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/libs/tableExport.min.js"></script>

    <script src="<?= base_url(); ?>/public/asset/js/dore.script.js"></script>
    <script src="<?= base_url(); ?>/public/asset/js/scripts.js"></script>
</body>

</html>