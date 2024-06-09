    

    <!-- BEGIN btn-scroll-top -->
    <a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
    <!-- END btn-scroll-top -->
    <!-- BEGIN theme-panel -->
    <div class="theme-panel">
        <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
        <div class="theme-panel-content">
            <ul class="theme-list clearfix">
                <li><a href="javascript:;" class="bg-red" data-theme="theme-red" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Red" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-pink" data-theme="theme-pink" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Pink" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-orange" data-theme="theme-orange" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Orange" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-yellow" data-theme="theme-yellow" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Yellow" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-lime" data-theme="theme-lime" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Lime" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-green" data-theme="theme-green" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Green" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-teal" data-theme="theme-teal" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Teal" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-cyan" data-theme="theme-cyan" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
                <li class="active"><a href="javascript:;" class="bg-blue" data-theme="" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Default" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-purple" data-theme="theme-purple" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Purple" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-indigo" data-theme="theme-indigo" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Indigo" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-gray-600" data-theme="theme-gray-600" data-click="theme-selector" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-container="body" data-bs-title="Gray" data-original-title="" title="">&nbsp;</a></li>
            </ul>
            <hr class="mb-0">
            <div class="row mt-10px pt-3px">
                <div class="col-9 control-label text-body-emphasis fw-bold">
                    <div>Dark Mode <span class="badge bg-theme text-theme-color ms-1 position-relative py-4px px-6px" style="top: -1px">NEW</span></div>
                    <div class="lh-sm fs-13px fw-semibold">
                        <small class="text-body-emphasis opacity-50">
                            Adjust the appearance to reduce glare and give your eyes a break.
                        </small>
                    </div>
                </div>
                <div class="col-3 d-flex">
                    <div class="form-check form-switch ms-auto mb-0 mt-2px">
                        <input type="checkbox" class="form-check-input" name="app-theme-dark-mode" id="appThemeDarkMode" value="1">
                        <label class="form-check-label" for="appThemeDarkMode">&nbsp;</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END theme-panel -->
   <!-- ================== BEGIN core-js ================== -->
    <script src="<?= URL ?>/assets/js/vendor.min.js"></script>
    <script src="<?= URL ?>/assets/js/app.min.js"></script>
    <!-- ================== END core-js ================== -->
    
    <!-- ================== BEGIN page-js ================== -->
    <script src="<?= URL ?>/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?= URL ?>/assets/js/demo/dashboard.demo.js"></script>

    <script src="<?= URL ?>/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/bootstrap-table/dist/bootstrap-table.min.js"></script>

    <script src="<?= URL ?>/assets/plugins/sweetalert2/dist/sweetalert2.js"></script>

    <script src="<?= URL ?>/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="<?= URL ?>/assets/js/demo/highlightjs.demo.js"></script>
    <!-- ================== END page-js ================== -->
    <script src="<?= URL ?>/assets/mainjs/validation.js"></script>

    <script src="<?= URL ?>/assets/plugins/summernote/dist/summernote-lite.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-tmpl/js/tmpl.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-load-image/js/load-image.all.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js"></script>
    <script src="<?= URL ?>/assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js"></script>
    <script src="<?= URL ?>/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
    <script src="<?= URL ?>/assets/plugins/tag-it/js/tag-it.min.js"></script>
    <script src="<?= URL ?>/assets/js/demo/page-product-details.demo.js"></script>
    <script src="<?= URL ?>/assets/plugins/select2/js/select2.min.js"></script>
    
    <script type="text/javascript" src="<?=URL?>/assets/mainjs/fileUpload.js<?= version ?>"></script>
    <script type="text/javascript" src="<?=URL?>/assets/plugins/select/select.js<?= version ?>"></script>

    <?php if (in_array($main_content, array('category/category')) || in_array($main_content, array('product/product')) || in_array($main_content, array('product/addProduct')) || in_array($main_content, array('product/updateProduct')) || in_array($main_content, array('uom')) || in_array($main_content, array('variant/variant')) || in_array($main_content, array('variant/detail')) || in_array($main_content, array('group/group')) || in_array($main_content, array('location/location')) || in_array($main_content, array('inventory/inventoryin')) || in_array($main_content, array('inventory/inventory')) || in_array($main_content, array('inventory/inv_detail')) || in_array($main_content, array('store/store')) || in_array($main_content, array('item/item')) || in_array($main_content, array('users/users')) || in_array($main_content, array('report/sale_report_by_date')) || in_array($main_content, array('report/sale_report_by_category')) ) { ?>
        <script type="text/javascript" src="<?=URL?>/assets/mainjs/<?= $main_content?>.js<?= version ?>"></script>
    <?php } ?>