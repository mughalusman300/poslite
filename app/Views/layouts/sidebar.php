<?php 
if(!isset($_SESSION['permissions']) || empty($_SESSION['permissions'])) {
    header("Location:" . URL.'/login/logout'); exit(); 
}
$permissions = $_SESSION['permissions'];
?>
    <!-- BEGIN #sidebar -->
    <div id="sidebar" class="app-sidebar">
        <!-- BEGIN scrollbar -->
        <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
            <!-- BEGIN menu -->
            <div class="menu">
                
                <?php if(in_array('view_dashboard', $permissions)) :?>
                    <div class="menu-item <?= isset($dashboard_active) ? $dashboard_active: ''; ?>">
                        <a href="<?= URL?>/dashboard" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </div>
                <?php endif ;?>

                <?php if(in_array('view_dashboard', $permissions)) :?>
                    <div class="menu-header">Sales</div>
                    <div class="menu-item <?= isset($sales_active) ? $sales_active: ''; ?>">
                        <a href="<?= URL?>/sales" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-shopping-bag"></i></span>
                            <span class="menu-text">Sales & Return</span>
                        </a>
                    </div>
                <?php endif ;?>
                
                <?php if(in_array('view_inventory', $permissions) || in_array('view_category', $permissions) || in_array('view_item', $permissions)):?>
                    <div class="menu-header">Inventory</div>
                <?php endif ;?>
                <?php if(in_array('view_item', $permissions)):?>
                    <div class="menu-item <?= isset($items_active) ? $items_active: ''; ?>">
                        <a href="<?= URL?>/item" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-history"></i></span>
                            <span class="menu-text">Items</span>
                        </a>
                    </div>
                <?php endif ;?>
                <?php if(in_array('view_category', $permissions)):?>
                    <div class="menu-item <?= isset($category_active) ? $category_active: ''; ?>">
                        <a href="<?= URL?>/category" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-history"></i></span>
                            <span class="menu-text">Category</span>
                        </a>
                    </div>
                <?php endif ;?>
                <?php if(in_array('view_inventory', $permissions)):?>
                    <div class="menu-item <?= isset($inventory_active) ? $inventory_active: ''; ?>">
                        <a href="<?= URL?>/inventory" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-assistive-listening-systems"></i></span>
                            <span class="menu-text">Inventory List</span>
                        </a>
                    </div>
                <?php endif ;?>

                <?php if(in_array('view_expense', $permissions)):?>
                    <div class="menu-header">Expense</div>
                    <div class="menu-item has-sub <?= isset($expense_expand) ? $expense_expand: ''; ?>">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-arrow-right-from-file"></i>
                                <!-- <span class="menu-icon-label">6</span> -->
                            </span>
                            <span class="menu-text">Expense</span>
                            <span class="menu-caret"><b class="caret"></b></span>
                        </a>
                        <div class="menu-submenu" <?= isset($expense_expand) ? 'style="display:block"': ''; ?>>
                            <div class="menu-item <?= isset($expense_header_active) ? $expense_header_active: ''; ?>">
                                <a href="<?= URL?>/expense/expense_header" class="menu-link">
                                    <span class="menu-text">Expense Header</span>
                                </a>
                            </div>
                            <div class="menu-item <?= isset($expense_active) ? $expense_active: ''; ?>">
                                <a href="<?= URL?>/expense" class="menu-link">
                                    <span class="menu-text">Expense</span>
                                </a>
                            </div>
                            <div class="menu-item <?= isset($payment_active) ? $payment_active: ''; ?>">
                                 <a href="<?= URL?>/expense/payment_mode" class="menu-link">
                                    <span class="menu-text">Payment Mode</span> 
                                </a>
                            </div>
                            <div class="menu-item <?= isset($party_active) ? $party_active: ''; ?>">
                                 <a href="<?= URL?>/expense/party" class="menu-link">
                                    <span class="menu-text">Party</span> 
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                <?php if(in_array('view_sale_report', $permissions)):?>
                    <div class="menu-header">Reports</div>
                    <div class="menu-item has-sub <?= isset($sale_report_expand) ? $sale_report_expand: ''; ?>">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">
                                <i class="fa fa-shekel-sign"></i>
                                <!-- <span class="menu-icon-label">6</span> -->
                            </span>
                            <span class="menu-text">Sale Reports</span>
                            <span class="menu-caret"><b class="caret"></b></span>
                        </a>
                        <div class="menu-submenu" <?= isset($sale_report_expand) ? 'style="display:block"': ''; ?>>
                            <div class="menu-item <?= isset($sale_report_by_date_active) ? $sale_report_by_date_active: ''; ?>">
                                <a href="<?= URL?>/report/sale_report_by_date" class="menu-link">
                                    <span class="menu-text">Sales Report By Date</span>
                                </a>
                            </div>
                            <div class="menu-item <?= isset($sale_report_by_category_active) ? $sale_report_by_category_active: ''; ?>">
                                <a href="<?= URL?>/report/sale_report_by_category" class="menu-link">
                                    <span class="menu-text">Sale Report By Category</span>
                                </a>
                            </div>
                            <div class="menu-item <?= isset($sale_report_by_payment_active) ? $sale_report_by_payment_active: ''; ?>">
                                 <a href="<?= URL?>/report/sale_report_by_payment" class="menu-link">
                                    <span class="menu-text">Sale Report By Payment</span> 
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif;?>

                <div class="menu-item d-none">
                    <a href="<?= URL?>/item" class="menu-link">
                        <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                        <span class="menu-text">Expense Report</span>
                    </a>
                </div>    

                <?php if(in_array('view_accounts', $permissions)):?>
                    <div class="menu-header">Accounts</div>
                    <div class="menu-item">
                        <a href="<?= URL?>/item/underconstruction" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-book-journal-whills"></i></span>
                            <span class="menu-text">Accounts</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="<?= URL?>/item/underconstruction" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-bank"></i></span>
                            <span class="menu-text">Bank</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= URL?>/item/underconstruction" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-qrcode"></i></span>
                            <span class="menu-text">PNL</span>
                        </a>
                    </div>
                <?php endif;?>

                <?php if(in_array('view_system_administration', $permissions)):?>
                    <div class="menu-header">System Administration</div>
                    <div class="menu-item <?= isset($users_active) ? $users_active: ''; ?>">
                        <a href="<?= URL?>/users" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-user-plus"></i></span>
                            <span class="menu-text">Users</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= URL?>/item" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-blog"></i></span>
                            <span class="menu-text">User Logs</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= URL?>/item" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-scale-balanced"></i></span>
                            <span class="menu-text">POS Setting</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?= URL?>/item" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-assistive-listening-systems"></i></span>
                            <span class="menu-text">System Logs</span>
                        </a>
                    </div>    
                <?php endif; ?>        
            </div>
            <!-- END menu -->
        </div>
        <!-- END scrollbar -->
        
        <!-- BEGIN mobile-sidebar-backdrop -->
        <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
        <!-- END mobile-sidebar-backdrop -->
    </div>
    <!-- END #sidebar -->