<?= $this->extend('layouts/app') ?>
<?= $this->section('main-content') ?>
<main id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Employee Registration</h1>
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
                    <div class="separator mb-5"></div>
                </div>
            </div>
            <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Personal Information</h5>
                             <hr>
                            <form method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="form-group mt-4 d-flex justify-content-center">
                                         <div style="border-radius: 50%;" class="thumbnail-wrapper d128 flex-shrink-0">
                                            <img  width="115" id="one" height="115" style=" border-radius: 50%;" alt="" data-src-retina="<?= base_url(); ?>/public/asset/img/profiles/download.png" data-src="<?= base_url(); ?>/public/asset/img/profiles/download.png" src="<?= base_url(); ?>/public/asset/img/profiles/download.png">
                                            
                                         </div>
                                        </div>
                                         <label>Image</label><font style="color: red;">*</font>
                                            <div class="custom-file">
                                                <input tabindex="0" v-model="bindImage" type="file" class="custom-file-input" name="onefile" id="onefile" onchange="photoOne(this);">
                                                <input  type="hidden" v-model="imgValue">
                                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                <p style="color: red" v-if="onefile_error!=''">{{onefile_error}}</p>
                                            </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>First Name <font style="color: red;">*</font></label>
                                        <input tabindex="1"  type="text" v-model="fname" class="form-control" id="inputfname4" placeholder="First Name">
                                        <p style="color: red" v-if="fname_error!=''">{{fname_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Last Name <font style="color: red;">*</font></label>
                                        <input tabindex="2" type="text" v-model="lname" class="form-control" id="inputlname4" placeholder="Last Name">
                                        <p style="color: red" v-if="lname_error!=''">{{lname_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Father Name <font style="color: red;">*</font></label>
                                        <input tabindex="3" type="text" v-model="father_name" class="form-control" id="inputfathername4" placeholder="Father Name">
                                        <p style="color: red" v-if="father_name_error!=''">{{father_name_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label >CNIC <font style="color: red;">*</font></label>
                                        <input tabindex="4" type="number" min="1" v-model="cnic" class="form-control"  placeholder="e.g 3520274024335">
                                        <p style="color: red" v-if="cnic_error!=''">{{cnic_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Email</label>
                                        <input tabindex="5" type="email" v-model="email" class="form-control" id="inputEmail4" placeholder="Email">
                                        <p style="color: red" v-if="email_error!=''">{{email_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputEmail4">Officail Email</label>
                                        <input tabindex="5" type="email" v-model="official_email" class="form-control" id="inputEmail4" placeholder="Official Email">
                                        <p style="color: red" v-if="official_email_error!=''">{{official_email_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label >Contact No. <font style="color: red;">*</font></label>
                                        <input tabindex="6" type="number" min="1" v-model="contact_no" class="form-control"  placeholder="Contact No.">
                                        <p style="color: red" v-if="contact_no_error!=''">{{contact_no_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label ><span>Gender<font style="color: red;">*</font></span></label>
                                        <select tabindex="7" v-model="gender" name="gender"  class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <p style="color: red" v-if="gender_error!=''">{{gender_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label ><span>Marital Status<font style="color: red;">*</font></span></label>
                                        <select v-model="marital_status"  name="marital_status"  tabindex="8" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                        </select>
                                        <p style="color: red" v-if="marital_status_error!=''">{{marital_status_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label ><span>Blood Group</label>
                                        <select v-model="blood_group"  name=""  tabindex="9" class="form-control">
                                            <option value="">Select</option>
                                            <option value="A+">A+</option>
                                            <option value="B+">B+</option>
                                            <option value="O+">O+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="A-">A-</option>
                                            <option value="B-">B-</option>
                                            <option value="O-">O-</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                       <label>DOB <font style="color: red;">*</font></label>
                                        <input type="date" tabindex="10" v-model="dob" class="form-control" placeholder="Date Of Birth">
                                        <p style="color: red" v-if="dob_error!=''">{{dob_error}}</p> 

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label >Family Members <font style="color: red;">*</font></label>
                                        <input tabindex="11" type="number" min="1" v-model="family_members" class="form-control" placeholder=" Family Members">
                                        <p style="color: red" v-if="family_members_error!=''">{{family_members_error}}</p> 
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Emergency Contact No. <font style="color: red;">*</font></label>
                                        <input tabindex="12" type="number" min="1" v-model="emergency_contact_no" class="form-control" placeholder="Emergency Contact No.">
                                        <p style="color: red" v-if="emergency_contact_no_error!=''">{{emergency_contact_no_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Emergency Contact Relation <font style="color: red;">*</font></label>
                                        <select  v-model="emergency_contact_relation"  name="emergency_contact_relation"  tabindex="13" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Son">Son</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="Friend">Friend</option>
                                        </select>
                                        <p style="color: red" v-if="emergency_contact_relation_error!=''">{{emergency_contact_relation_error}}</p>
                                    </div>
                                </div> 

                                 
                                <div style="margin-top: 30px">
                                  <h5  class="mb-4">Address</h5>
                                  <hr>
                                </div>
                                <div class="form-row">
                                   <div class="form-group col-md-6">
                                        <label>City <font style="color: red;">*</font></label>
                                        <select  v-model="city"  name="city"  tabindex="15" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="karachi">karachi</option>
                                            <option value="Rawalpindi">Rawalpindi</option>
                                            <option value="Faisalabad">Faisalabad</option>
                                        </select>
                                        <p style="color: red" v-if="city_error!=''">{{city_error}}</p>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Province <font style="color: red;">*</font></label>
                                        <select v-model="province"  name=""  tabindex="16" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="kpk">kpk</option>
                                            <option value="Sindh">Sindh</option>
                                            <option value="Balochistan">Balochistan</option>
                                            <option value="ICT">ICT</option>
                                        </select>
                                        <p style="color: red" v-if="province_error!=''">{{province_error}}</p>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address <font style="color: red;">*</font></label>
                                    <input tabindex="17" v-model="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                <p style="color: red" v-if="address_error!=''">{{address_error}}</p>
                                </div> 
                                <div style="margin-top: 30px">
                                  <h5  class="mb-4">Job Detail</h5>
                                  <hr>
                                </div>                                
                                <div class="form-row">
                                  <div class="form-group col-md-4">
                                        <label>Designation <font style="color: red;">*</font></label>
                                        <select v-model="designation_id"  name=""  tabindex="18" class="form-control">
                                          <option value="">Choose</option>
                                          <option v-for="option in designations" v-bind:value="option.desid">
                                          {{ option.designation_name }}
                                          </option>
                                        </select>
                                        <p style="color: red" v-if="designation_id_error!=''">{{designation_id_error}}</p>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label>Department<font style="color: red;">*</font></label>
                                        <select v-model="department_id"  name=""  tabindex="19" class="form-control">
                                          <option value="">Choose</option>
                                          <option v-for="option in departments" v-bind:value="option.depid">
                                          {{ option.department_name }}
                                          </option>
                                        </select>
                                        <p style="color: red" v-if="department_id_error!=''">{{department_id_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Rank</label>
                                        <select v-model="rank"  name=""  tabindex="19" class="form-control">
                                          <option value="">Choose</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          </option>
                                        </select>
                                        <p style="color: red" v-if="rank_error!=''">{{rank_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Category<font style="color: red;">*</font></label>
                                        <select v-model="category"  name=""  tabindex="20" class="form-control">
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
                                    <div class="form-group col-md-4">
                                        <label>Division<font style="color: red;">*</font></label>
                                        <select v-model="division_id"  name="emergency_contact_no"  tabindex="21" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">Mangement</option>
                                            <option value="2">Operation</option>
                                            <option value="3">Administration</option>
                                        </select>
                                        <p style="color: red" v-if="division_id_error!=''">{{division_id_error}}</p>
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label>Company<font style="color: red;">*</font></label>
                                        <select v-model="company_id" name=""  tabindex="22" class="form-control">
                                            <option value="">Select</option>
                                            <option value="T.M Cargo & Logistics">T.M Cargo & Logistics</option>
                                            <option value="T.M Delivery Express">T.M Delivery Express</option>
                                        </select>
                                        <p style="color: red" v-if="company_id_error!=''">{{company_id_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                       <label>Date Of Joining <font style="color: red;">*</font></label>
                                        <input type="date" v-model="doj" tabindex="23" class="form-control" placeholder="Date Of Joining">
                                        <p style="color: red" v-if="doj_error!=''">{{doj_error}}</p>
                                    </div>  
                                    <div class="form-group col-md-4">
                                        <label>Reporting Area<font style="color: red;">*</font></label>
                                        <select v-model="reporting_area"   name="" class="form-control" tabindex="24">
                                            <option value="">Select</option>
                                            <option value="Lahore">Lahore</option>
                                            <option value="Islamabad">Islamabad</option>
                                            <option value="Karachi">Karachi</option>
                                        </select>
                                        <p style="color: red" v-if="reporting_area_error!=''">{{reporting_area_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Reporting Region<font style="color: red;">*</font></label>
                                        <select v-model="reporting_region"  class="form-control"
                                        tabindex="25">
                                            <option value="">Select</option>
                                            <option value="East">East</option>
                                            <option value="West">West</option>
                                            <option value="South">South</option>
                                            <option value="North">North</option>
                                        </select>
                                        <p style="color: red" v-if="reporting_region_error!=''">{{reporting_region_error}}</p>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label>Shift<font style="color: red;">*</font></label>
                                        <select tabindex="27" v-model="shift"  name="" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Day">Day</option>
                                            <option value="Night">Night</option>
                                        </select>
                                        <p style="color: red" v-if="shift_error!=''">{{shift_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Education Type<font style="color: red;">*</font></label>
                                        <select tabindex="29"  v-model="education_type" name="" class="form-control">
                                            <option value="">Select</option>
                                            <option value="Matric">Matric</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="bachelor">bachelor</option>
                                            <option value="Master">Master</option>
                                            <option value="M.phill">M.phill</option>
                                            <option value="P.H.D">P.H.D</option>
                                        </select>
                                        <p style="color: red" v-if="education_type_error!=''">{{education_type_error}}</p>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label >Education <font style="color: red;">*</font></label>
                                        <input tabindex="30" v-model="education" type="text" class="form-control" placeholder=" Education">
                                        <p style="color: red" v-if="education_error!=''">{{education_error}}</p>
                                    </div>   
                                    <div class="form-group col-md-4">
                                        <label >Machine ID </label>
                                        <input v-model="machine_id" min="1"  type="number" class="form-control" tabindex="26" placeholder=" Machine ID">
                                        <p style="color: red" v-if="machine_id_error!=''">{{machine_id_error}}</p>
                                    </div>                              
                                </div>
                                <div style="margin-top: 30px">
                                  <h5  class="mb-4">Working Experience</h5>
                                  <hr>
                                </div>
                                <div class="form-row">
                                   <div class="form-group col-md-4">
                                        <label >Previous Company </label>
                                        <input tabindex="31" v-model="previous_comp" type="text" class="form-control" placeholder=" Previous Company Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label >Previous Company Designation </label>
                                        <input tabindex="32" v-model="previous_comp_designation" type="text" class="form-control" placeholder=" Previous Company Designation">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label >Experience </label>
                                        <input tabindex="33" v-model="experience" min="0" type="number" class="form-control" placeholder=" Previous Company Designation">
                                    </div>  
                                </div>
                                <div style="margin-top: 30px">
                                  <h5  class="mb-4">Bank Information</h5>
                                  <hr>
                                </div> 
                                <div class="form-row">  
                                    <div class="form-group col-md-4">
                                        <label>Bank </label>
                                        <select tabindex="34" v-model="bank_name"  name="" class="form-control">
                                            <option value="">Select</option>
                                            <option value="HBL">HBL</option>
                                            <option value="Al-Habib">Al-Habib</option>
                                            <option value="Punjab Bank">Punjab Bank</option>
                                            <option value="National Bank">National Bank</option>
                                        </select>
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label >Account Title </label>
                                        <input tabindex="35" v-model="account_title" type="text" class="form-control" placeholder=" Account Title">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label >Account No </label>
                                        <input tabindex="36" v-model="account_no" min="1" type="number" class="form-control" placeholder=" Account No">
                                        <p style="color: red" v-if="account_no_error!=''">{{account_no_error}}</p>
                                    </div>   
                                     <div class="form-group col-md-4">
                                        <label >Account IBAN </label>
                                        <input tabindex="37" v-model="account_iban" min="1" type="number" class="form-control" placeholder=" Account IBAN">
                                         <p style="color: red" v-if="account_iban_error!=''">{{account_iban_error}}</p>
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label >NTN </label>
                                        <input tabindex="38" v-model="ntn" min="1" type="number" class="form-control" placeholder=" NTN">
                                        <p style="color: red" v-if="ntn_error!=''">{{ntn_error}}</p>
                                        
                                    </div>  
                                     <div class="form-group col-md-4">
                                        <label >Taxable </label>
                                        <select tabindex="39" v-model="is_taxable" name="" class="form-control">
                                            <option value="0">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                         <p style="color: red" v-if="is_taxable_error!=''">{{is_taxable_error}}</p>
                                    </div>   
                                </div>

                                <!-- <div class="form-check form-check-inline">
                                    <input  class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                    <label class="form-check-label" for="inlineCheckbox1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                    <label class="form-check-label" for="inlineCheckbox2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled="">
                                    <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
                                </div> -->
                                </form>
                                <button @click="postEmployee()"  class="btn btn-primary d-block mt-3">Submit</button>
                            
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
    onefile:'',
    fname:'',
    lname:'',
    father_name:'',
    cnic:'',
    email:'',
    official_email:'',
    contact_no:'',
    gender:'',
    marital_status:'',
    blood_group:'',
    dob:'',
    family_members:'',
    emergency_contact_no:'',
    emergency_contact_relation:'',
    bindImage:'',
    imgValue:'No',
    city:'',
    province:'',
    address:'',
    designation_id:'',
    rank: '',
    department_id:'',
    category:'',
    division_id:'',
    company_id:'',
    doj:'',
    reporting_area:'',
    reporting_region:'',
    machine_id:'',
    shift:'',
    education_type:'',
    education:'',
    previous_comp:'',
    previous_comp_designation:'',
    experience:'',
    bank_name:'',
    account_title:'',
    account_no:'',
    account_iban:'',
    ntn:'',
    is_taxable:0,
    onefile_error:'',
    fname_error:'',
    lname_error:'',
    father_name_error:'',
    cnic_error:'',
    email_error:'',
    official_email_error:'',
    contact_no_error:'',
    gender_error:'',
    marital_status_error:'',
    blood_group_error:'',
    dob_error:'',
    family_members_error:'',
    emergency_contact_no_error:'',
    emergency_contact_relation_error:'',
    image_error:'',
    city_error:'',
    province_error:'',
    address_error:'',
    designation_id_error:'',
    rank_error:'',
    department_id_error:'',
    category_error:'',
    division_id_error:'',
    company_id_error:'',
    doj_error:'',
    reporting_area_error:'',
    reporting_region_error:'',
    machine_id_error:'',
    shift_error:'',
    rank_error:'',
    education_type_error:'',
    education_error:'',
    account_no_error:'',
    account_iban_error:'',
    ntn_error:'',
    is_taxable_error:'',
  },
  methods:{
        getDepartments()
        { 
          axios.get('dep/getAllDepartments').then((response)=>{
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
           //$('#id').files[0];    
          
          var oneFile         = $('input[name=onefile]');
          if(oneFile!=''){
          var onefileUpload   = oneFile[0].files[0];   
          }
          else{
            var onefileUpload = '';
          }
           
          const form = new FormData();
          form.append("fname", this.fname);
          form.append("lname", this.lname);
          form.append("father_name", this.father_name);
          form.append("cnic", this.cnic);
          form.append("email", this.email);
          form.append("official_email", this.official_email);
          form.append("contact_no", this.contact_no);
          form.append("gender", this.gender);
          form.append("marital_status", this.marital_status);
          form.append("blood_group", this.blood_group);
          form.append("dob", this.dob);
          form.append("family_members", this.family_members);
          form.append("emergency_contact_no", this.emergency_contact_no);
          form.append("emergency_contact_relation", this.emergency_contact_relation);
          if(this.bindImage!=''){
           form.append("newfile", onefileUpload);
            this.imgValue ='Yes';
          }
          else{
            this.imgValue ='No';
          }
          form.append("imgValue", this.imgValue);
          form.append("city", this.city);
          form.append("province", this.province);
          form.append("address", this.address);
          form.append("designation_id", this.designation_id);
          form.append("rank", this.rank);
          form.append("department_id", this.department_id);
          form.append("category", this.category);
          form.append("division_id", this.division_id);
          form.append("company_id", this.company_id);
          form.append("doj", this.doj);
          form.append("reporting_area", this.reporting_area);
          form.append("reporting_region", this.reporting_region);
          if(this.machine_id!=''){
          form.append("machine_id", this.machine_id);
          }
          form.append("shift", this.shift);
          form.append("rank", this.rank);
          form.append("education_type", this.education_type);
          form.append("education", this.education);
          form.append("previous_comp", this.previous_comp);
          form.append("previous_comp_designation", this.previous_comp_designation);
          form.append("experience", this.experience);
          form.append("bank_name", this.bank_name);
          form.append("account_title", this.account_title);
          if(this.account_no!=''){
          form.append("account_no", this.account_no);
          }
          if(this.account_iban!=''){
          form.append("account_iban", this.account_iban);
          }
          if(this.ntn!=''){
          form.append("ntn", this.ntn);  
          }
          
          form.append("is_taxable", this.is_taxable);

          axios.post('employee/create',form).then((response)=>{
           
           Swal.fire({
              // position: 'top-end',
              icon: 'success',
              title: this.fname+' Employee has been Created Successfully',
              showConfirmButton: false,
              timer: 2000
            })
            this.clearForm();
            // this.bindImage='';
            // this.imgValue ='No';
            this.clearErrors();
            $('#onefile').val('');
            $('#one').attr('src', '<?= base_url(); ?>/public/asset/img/profiles/download.png').width(128).height(128); 
          }).catch(err => {
            this.clearErrors();
              Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'Something Went Wrong! Please Fill All Fields Carefully',
              showConfirmButton: false,
              timer: 2000
            })
            if(err.response.data.messages.newfile)
            { this.onefile_error = err.response.data.messages.newfile; }  
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
            if(err.response.data.messages.official_email)
            { this.official_email_error = err.response.data.messages.official_email; }
            if(err.response.data.messages.contact_no)
            { this.contact_no_error = err.response.data.messages.contact_no; }
            if(err.response.data.messages.gender)
            { this.gender_error = err.response.data.messages.gender; }
            if(err.response.data.messages.marital_status)
            { this.marital_status_error = err.response.data.messages.marital_status; }
            if(err.response.data.messages.blood_group)
            { this.blood_group_error = err.response.data.messages.blood_group; }
            if(err.response.data.messages.dob)
            { this.dob_error = err.response.data.messages.dob; }
            if(err.response.data.messages.family_members)
            { this.family_members_error = err.response.data.messages.family_members; }
            if(err.response.data.messages.emergency_contact_no)
            { this.emergency_contact_no_error = err.response.data.messages.emergency_contact_no; }
            if(err.response.data.messages.emergency_contact_relation)
            { this.emergency_contact_relation_error = err.response.data.messages.emergency_contact_relation; }
            if(err.response.data.messages.city)
            { this.city_error = err.response.data.messages.city; }
            if(err.response.data.messages.province)
            { this.province_error = err.response.data.messages.province; }
            if(err.response.data.messages.address)
            { this.address_error = err.response.data.messages.address; }
            if(err.response.data.messages.designation_id)
            { this.designation_id_error = err.response.data.messages.designation_id; }
            if(err.response.data.messages.rank)
            { this.rank_error = err.response.data.messages.rank; }
            if(err.response.data.messages.department_id)
            { this.department_id_error = err.response.data.messages.department_id; }
            if(err.response.data.messages.category)
            { this.category_error = err.response.data.messages.category; }
            if(err.response.data.messages.division_id)
            { this.division_id_error = err.response.data.messages.division_id; }
            if(err.response.data.messages.company_id)
            { this.company_id_error = err.response.data.messages.company_id; }
            if(err.response.data.messages.doj)
            { this.doj_error = err.response.data.messages.doj; }
            if(err.response.data.messages.reporting_area)
            { this.reporting_area_error = err.response.data.messages.reporting_area; }
            if(err.response.data.messages.reporting_region)
            { this.reporting_region_error = err.response.data.messages.reporting_region; }
            if(err.response.data.messages.machine_id)
            { this.machine_id_error = err.response.data.messages.machine_id; }
            if(err.response.data.messages.shift)
            { this.shift_error = err.response.data.messages.shift; }
            if(err.response.data.messages.rank)
            { this.rank_error = err.response.data.messages.rank; }
            if(err.response.data.messages.education_type)
            { this.education_type_error = err.response.data.messages.education_type; }
            if(err.response.data.messages.education)
            { this.education_error = err.response.data.messages.education; }
            if(err.response.data.messages.account_no)
            { this.account_no_error = err.response.data.messages.account_no; }
            if(err.response.data.messages.account_iban)
            { this.account_iban_error = err.response.data.messages.account_iban; }
            if(err.response.data.messages.ntn)
            { this.ntn_error = err.response.data.messages.ntn; }
            if(err.response.data.messages.is_taxable)
            { this.is_taxable_error = err.response.data.messages.is_taxable; }
        });
        },
        clearErrors()
        {
            this.onefile_error='';
            this.fname_error='';
            this.lname_error='';
            this.father_name_error='';
            this.cnic_error='';
            this.email_error='';
            this.official_email_error='';
            this.contact_no_error='';
            this.gender_error='';
            this.marital_status_error='';
            this.blood_group_error='';
            this.dob_error='';
            this.family_members_error='';
            this.emergency_contact_no_error='';
            this.emergency_contact_relation_error='';
            this.image_error='';
            this.city_error='';
            this.province_error='';
            this.address_error='';
            this.designation_id_error='';
            this.rank_error='';
            this.department_id_error='';
            this.category_error='';
            this.division_id_error='';
            this.company_id_error='';
            this.doj_error='';
            this.reporting_area_error='';
            this.reporting_region_error='';
            this.machine_id_error='';
            this.shift_error='';
            this.rank_error='';
            this.education_type_error='';
            this.education_error='';
            this.account_no_error='';
            this.account_iban_error='';
            this.ntn_error='';
            this.is_taxable_error='';

        },
        clearForm()
        {
            this.bindImage='';
            this.imgValue ='No';
            this.fname='';
            this.lname='';
            this.father_name='';
            this.cnic='';
            this.email='';
            this.official_email='';
            this.contact_no='';
            this.gender='';
            this.marital_status='';
            this.blood_group='';
            this.dob='';
            this.family_members='';
            this.emergency_contact_no='';
            this.emergency_contact_relation='';
            this.image='';
            this.city='';
            this.province='';
            this.address='';
            this.designation_id='';
            this.rank='';
            this.department_id='';
            this.category='';
            this.division_id='';
            this.company_id='';
            this.doj='';
            this.reporting_area='';
            this.reporting_region='';
            this.machine_id='';
            this.shift='';
            this.rank='';
            this.education_type='';
            this.education='';
            this.previous_comp='';
            this.previous_comp_designation='';
            this.experience='';
            this.bank_name='';
            this.account_title='';
            this.account_no='';
            this.account_iban='';
            this.ntn='';
            this.is_taxable=0;  
        },
  },
  created(){
   this.getDesignations(); 
   this.getDepartments(); 
  }

  });  
function photoOne(input) {

if (input.files && input.files[0]) {

var reader = new FileReader();

reader.onload = function (e) {

$('#one').attr('src', e.target.result).width(115).height(115);

var path=$('#onefile').val();

$('#onefilepath').val(path);

};

reader.readAsDataURL(input.files[0]);

}}
  </script> 
<?= $this->endSection() ?>    