<div id="app" class="app app-full-height app-without-header">
        <!-- BEGIN error -->
        <div class="error-page">
            <!-- BEGIN error-page-content -->
            <div class="error-page-content">
                <div class="error-img">
                    <div class="error-img-code">404</div>
                    <img src="assets/img/page/404.svg" alt="">
                </div>
                
                <h1>Oops!</h1> 
                <h3>We can't seem to find the page you're looking for</h3>
                <a href="<?= URL?>/item" class="btn btn-theme">Go to Homepage</a>
            </div>
            <!-- END error-page-content -->
        </div>
        <!-- END error -->
        
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
        
    </div>