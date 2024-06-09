<?= $this->extend('layouts/app') ?>
<?= $this->section('main-content') ?>
<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Employee Detail</h1>
                    <!-- <div class="text-zero top-right-button-container"><button type="button" class="btn btn-outline-danger btn-lg top-right-button mr-1" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight">Leave</button></div> -->
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
        </div>
        
        <div class="row">
                <div class="col-12 col-md-12 col-xl-8">
                    <div class="card mb-4">
                        <div class="card-body">

                            <div class="mb-5">
                                <h5 class="card-title">Employee</h5>
                               
                                <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead class='thead-light'>
                                            <tr>
                                            <th scope="col">Name </th>
                                            <th scope="col">Father Name </th>
                                            <th scope="col">Company</th>
                                            <th scope="col">Department</th>
                                            <th scope="col">Designation</th>
                                            <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <thead class='thead-light'>
                                            <tr>
                                            <td><?= $rows['fname']." ".$rows['lname'] ?></td>    
                                            <td><?= $rows['father_name'] ?></td>    
                                            <td><?= $rows['company_id'] ?></td>    
                                            <td><?= $rows['department_name'] ?></td>    
                                            <td><?= $rows['designation_name'] ?></td> 
                                            <?php if ($rows['emp_status']=='active') {?>     
                                            <td class="text-capitalize text-success"><?= $rows['emp_status'] ?></td>
                                        <?php } 
                                         if ($rows['emp_status']!='active') {?>
                                            <td class="text-capitalize text-danger"><?= $rows['emp_status'] ?></td>
                                         <?php } ?>       
                                            </tr>
                                        </thead>
                                        </table>  
                                 </div>         
                                
                            </div>
                            <div class="mb-5">
                                <h5 class="card-title">Contact</h5>
                                <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead class='thead-light'>
                                            <tr>
                                            <th scope="col">Contact No </th>
                                            <th scope="col">Emergency Contact No </th>
                                            <th scope="col">Contact Relation</th>
                                            </tr>
                                        </thead>
                                        <thead class='thead-light'>
                                            <tr>
                                            <td><?= $rows['contact_no']?></td>    
                                            <td><?= $rows['emergency_contact_no'] ?></td>    
                                            <td><?= $rows['emergency_contact_relation'] ?></td>        
                                            </tr>
                                        </thead>
                                        </table>  
                                 </div>         
                                
                            </div>
                            <div class="mb-5">
                                <h5 class="card-title">Address</h5>
                                <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead class='thead-light'>
                                            <tr>
                                            <th scope="col">Province </th>
                                            <th scope="col">City </th>
                                            <th scope="col">Address</th>
                                            </tr>
                                        </thead>
                                        <thead class='thead-light'>
                                            <tr>
                                            <td><?= $rows['province']?></td>    
                                            <td><?= $rows['city'] ?></td>    
                                            <td><?= $rows['address'] ?></td>        
                                            </tr>
                                        </thead>
                                        </table>  
                                 </div>         
                            </div>
                            <div class="mb-5">
                                <h5 class="card-title">Job Detail</h5>
                                <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead class='thead-light'>
                                            <tr>
                                            <th scope="col">Date of Joining </th>
                                            <th scope="col">Reporting Area </th>
                                            <th scope="col">Reporting Region</th>
                                            <th scope="col">Shift</th>
                                            </tr>
                                        </thead>
                                        <thead class='thead-light'>
                                            <tr>
                                            <td><?= $rows['doj']?></td>    
                                            <td><?= $rows['reporting_area'] ?></td>    
                                            <td><?= $rows['reporting_region'] ?></td>        
                                            <td><?= $rows['shift'] ?></td>              
                                            </tr>
                                        </thead>
                                        </table>  
                                 </div>         
                            </div>
                            <div class="mb-5">
                                <h5 class="card-title">Working Experience</h5>
                                <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead class='thead-light'>
                                            <tr>
                                            <th scope="col">Previous Company </th>
                                            <th scope="col">Designation</th>
                                            <th scope="col">Experience</th>
                                            </tr>
                                        </thead>
                                        <thead class='thead-light'>
                                            <tr>
                                            <td><?= $rows['previous_comp']?></td>    
                                            <td><?= $rows['previous_comp_designation'] ?></td>    
                                            <td><?= $rows['experience'] ?></td>                   
                                            </tr>
                                        </thead>
                                        </table>  
                                 </div>         
                            </div>
                            <div class="mb-5">
                                <h5 class="card-title">Bank Information</h5>
                                <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead class='thead-light'>
                                            <tr>
                                            <th scope="col">Bank </th>
                                            <th scope="col">Account Title</th>
                                            <th scope="col">Account No</th>
                                            <th scope="col">Account IBAN</th>
                                            <th scope="col">NTN</th>
                                            <th scope="col">Taxable</th>

                                            </tr>
                                        </thead>
                                        <thead class='thead-light'>
                                            <tr>
                                            <td><?= $rows['bank_name']?></td>    
                                            <td><?= $rows['account_title'] ?></td>    
                                            <td><?= $rows['account_no'] ?></td>                   
                                            <td><?= $rows['account_iban'] ?></td>        
                                            <td><?= $rows['ntn'] ?></td>       
                                            <td>
                                                <?php if ($rows['is_taxable']==0): ?>
                                                  No
                                                <?php endif;?>  
                                                <?php if ($rows['is_taxable']==1): ?>
                                                  Yes
                                                <?php endif;?> 
                                            </td>                 

                                            </tr>
                                        </thead>
                                        </table>  
                                 </div>         
                            </div>
                            <div class="mt-4 feedback-container">
                                <div class="text-center">
                                    <p class="feedback-answer">Was this helpful?</p>
                                    <a class="link nay" data-message="Thanks, we will work on this!"
                                        data-placement="top" data-toggle="tooltip" title="Nay" href="#"><i
                                            class="simple-icon-dislike"></i></a>
                                    <a class="link yay" data-message="Thanks, glad to help!" data-placement="top"
                                        data-toggle="tooltip" title="Yay" href="#"><i class="simple-icon-like"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-xl-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            
                            <center>
                            
                             <img 
                             width="150" height="150" 
                             alt="Profile" 
                             src="<?= base_url(); ?>/<?= $rows['image'] ?> " 
                             onerror=this.src="<?= base_url(); ?>/public/img/download.png"
                             class=" rounded-circle   align-self-center">
                             <h5></h5>
                             <h5 class="card-title"><?= $rows['fname']." ".$rows['lname'] ?></h5>
                            <h5>Email: <?= $rows['email'] ?></h5>
                            <h5>Contact: <?= $rows['contact_no'] ?></h5>
                            <h5>DOB: <?= $rows['dob'] ?></h5>

                            </center>
                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </main>
<?= $this->endSection() ?>    