<?php

Route::group(['middleware' => ['web']], function () {

    $adminDomainUrl = "tssserviceportal.com";


//    if (App::environment() != 'local') {
//        $DomainUrl = "netproclivity.test";
//        $adminDomainUrl = "admin.e-learning.kawikatech.com";
//    }
    //

    Route::group(['domain' => $adminDomainUrl], function(){
        //ssdd('dfdds');
        //User methods
        Route::group(['middleware' => ['guest']], function () {
            Route::get('', ['as' => 'login', 'uses' => 'Admin\SettingsController@getView']);
            
            Route::post('user/auth', ['as' => 'AdminAuthManage', 'uses' => 'Admin\SettingsController@authManage']);
            Route::get('adminReset/{token?}', ['as' => 'AdminResetPassword', 'uses' => 'Admin\SettingsController@getView']);

        });

        Route::group(['middleware' => ['auth']], function () {

            Route::get('dashboard', ['as' => 'AdminDashboard', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('home', ['as' => 'Home', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('tss_dashboard', ['as' => 'TssDashboard', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('asp_dashboard', ['as' => 'AspDashboard', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('user_dashboard', ['as' => 'UserDashboard', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('log_dashboard', ['as' => 'LogDashboard', 'uses' => 'Admin\SettingsController@getView']);

            Route::get('addbrand', ['as' => 'AdminBrand', 'uses' => 'Admin\SettingsController@getView']);

            Route::post('post/manage', ['as' => 'AdminPostManage', 'uses' => 'Admin\SettingsController@authManage']);
            Route::post('post-data', ['as' => 'postData', 'uses' => 'Admin\PostController@postManage']);
            Route::post('post-image', ['as' => 'PostImageUpload', 'uses' => 'Admin\PostController@postFileUpload']);
            Route::post('post-remove', ['as' => 'PostRemove', 'uses' => 'Admin\PostController@postRemove']);
            Route::post('validate/{id?}', ['as' => 'Validation', 'uses' => 'Admin\ValidationController@postValidation']);
            Route::post('post/dropdowns', ['as' => 'PostDropdowns', 'uses' => 'Admin\PostController@postDropdowns']);
            //Authentication
            Route::get('logout', ['as' => 'AdminLogout', 'uses' => 'Admin\SettingsController@logout']);
            Route::get('admin-profile', ['as' => 'AdminProfile', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('admin-password', ['as' => 'AdminPassword', 'uses' => 'Admin\SettingsController@getView']);

            /*Admin permissions*/
            Route::get('permissions', ['as' => 'Permissions', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('create-permission/{token?}', ['as' => 'CreatePermission', 'uses' => 'Admin\SettingsController@getView']);

            /*Admin Roles*/
            Route::get('roles', ['as' => 'Roles', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('create-role/{token?}', ['as' => 'CreateRole', 'uses' => 'Admin\SettingsController@getView']);
            /*Admin Roles*/
            Route::get('user-roles', ['as' => 'UserRoles', 'uses' => 'Admin\SettingsController@getView']);
            Route::get('create-user-role/{token?}', ['as' => 'CreateUserRoles', 'uses' => 'Admin\SettingsController@getView']);

            Route::post('post-csv', ['as' => 'postCsv', 'uses' => 'Admin\PostController@postCsv']);
            Route::post('post-validate', ['as' => 'postValidate', 'uses' => 'Admin\ValidationController@postValidation']);

            /*Categories*/

            Route::get('uploads', ['as' => 'Uploads', 'uses' => 'Admin\AdminController@getView']);
            Route::get('new-upload/{token?}', ['as' => 'NewUpload', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-upload/{token?}', ['as' => 'ViewUpload', 'uses' => 'Admin\AdminController@getView']);

            Route::get('technicians', ['as' => 'Technicians', 'uses' => 'Admin\AdminController@getView']);
            Route::get('new-technician/{token?}', ['as' => 'NewTechnician', 'uses' => 'Admin\AdminController@getView']);
            Route::get('new-technician_tss/{token?}', ['as' => 'NewTechnicianTss', 'uses' => 'Admin\AdminController@getView']);

            Route::get('warehouses', ['as' => 'Warehouse', 'uses' => 'Admin\AdminController@getView']);
            Route::get('new-warehouse/{token?}', ['as' => 'NewWarehouse', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-warehouse/{token?}', ['as' => 'ViewWarehouse', 'uses' => 'Admin\AdminController@getView']);

            Route::get('asp_admin', ['as' => 'AspAdmin', 'uses' => 'Admin\AdminController@getView']);
            
            Route::get('asp_tech', ['as' => 'AspTech', 'uses' => 'Admin\AdminController@getView']);
            Route::get('new-asp_admin/{token?}', ['as' => 'NewAspAdmin', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-asp_admin/{token?}', ['as' => 'ViewAspAdmin', 'uses' => 'Admin\AdminController@getView']);

            Route::get('jobs', ['as' => 'Jobs', 'uses' => 'Admin\AdminController@getView']);
            Route::get('new-job', ['as' => 'NewJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-job/{token?}', ['as' => 'EditJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-job/{token?}', ['as' => 'ViewJob', 'uses' => 'Admin\AdminController@getView']);

            Route::get('all_jobs', ['as' => 'AllJobs', 'uses' => 'Admin\AdminController@getView']);

            
            Route::get('completed_jobs', ['as' => 'CompletedJobs', 'uses' => 'Admin\AdminController@getView']);
            Route::get('pending_jobs', ['as' => 'PendingJobs', 'uses' => 'Admin\AdminController@getView']);


            Route::get('asp_jobs', ['as' => 'AspJobs', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_edit-job/{token?}', ['as' => 'EditAspJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-asp_job/{token?}', ['as' => 'ViewAspJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_all_jobs', ['as' => 'AspAllJobs', 'uses' => 'Admin\AdminController@getView']);

            Route::get('progress_jobs_asp', ['as' => 'AspJobsProgress', 'uses' => 'Admin\AdminController@getView']);
            Route::get('completed_jobs_asp', ['as' => 'AspJobsCompleted', 'uses' => 'Admin\AdminController@getView']);


            Route::get('tech_jobs_progress', ['as' => 'TechJobsProgress', 'uses' => 'Admin\AdminController@getView']);
            Route::get('tech_jobs_compelted', ['as' => 'TechJobsCompleted', 'uses' => 'Admin\AdminController@getView']);


            Route::get('tech_jobs', ['as' => 'TechJobs', 'uses' => 'Admin\AdminController@getView']);
            Route::get('tech_edit-job/{token?}', ['as' => 'EditTechJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-tech_job/{token?}', ['as' => 'ViewTechJob', 'uses' => 'Admin\AdminController@getView']);
            
            Route::get('appointment/{token?}', ['as' => 'Appointment', 'uses' => 'Admin\AdminController@getView']);
            Route::get('appointments', ['as' => 'Appointments', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit_appointment/{token?}', ['as' => 'EditAppointment', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view_appointment/{token?}', ['as' => 'ViewAppointment', 'uses' => 'Admin\AdminController@getView']);

            Route::get('waiting_parts/{token?}', ['as' => 'WaitingParts', 'uses' => 'Admin\AdminController@getView']);
            
            Route::get('parts_order', ['as' => 'PartsOrder', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-parts_order/{token?}', ['as' => 'EditPartsOrder', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-parts_order/{token?}', ['as' => 'ViewPartsOrder', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-parts_order_wo_job/{token?}', ['as' => 'EditPartsOrderWojob', 'uses' => 'Admin\AdminController@getView']);

            Route::get('new-parts_order', ['as' => 'NewPartsOrder', 'uses' => 'Admin\AdminController@getView']);
            Route::get('approved-req', ['as' => 'ApprovedRequests', 'uses' => 'Admin\AdminController@getView']);
            Route::get('rejected-req', ['as' => 'RejectedRequests', 'uses' => 'Admin\AdminController@getView']);
           
            Route::get('log_parts_order', ['as' => 'LogPartsOrder', 'uses' => 'Admin\AdminController@getView']);

            Route::get('tech-parts_order', ['as' => 'TechPartsOrder', 'uses' => 'Admin\AdminController@getView']);
            Route::get('app_tech_parts', ['as' => 'TechApprParts', 'uses' => 'Admin\AdminController@getView']);
            Route::get('rej_tech_parts', ['as' => 'TechRejParts', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-parts_tech/{token?}', ['as' => 'ViewPartsTech', 'uses' => 'Admin\AdminController@getView']);


            Route::get('assign_job', ['as' => 'AssignJobs', 'uses' => 'Admin\AdminController@getView']);
            Route::get('create-assign_job/{token?}', ['as' => 'NewAssignJobs', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-assign_job/{token?}', ['as' => 'EditAssignJobs', 'uses' => 'Admin\AdminController@getView']);

           
            Route::get('unassigned_jobs', ['as' => 'UnAssignedJobs', 'uses' => 'Admin\AdminController@getView']);

            Route::get('assigned_jobs', ['as' => 'AssignedJobs', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp-appointment/{token?}', ['as' => 'AspAppointment', 'uses' => 'Admin\AdminController@getView']);
            Route::get('admin-appointment/{token?}', ['as' => 'AdminAppointment', 'uses' => 'Admin\AdminController@getView']);
            Route::get('admin-waiting_parts/{token?}', ['as' => 'AdminWaitingParts', 'uses' => 'Admin\AdminController@getView']);
            Route::get('admin-new_claim/{token?}', ['as' => 'AdminNewClaim', 'uses' => 'Admin\AdminController@getView']);



            Route::get('assign_tech_job', ['as' => 'AssignTechnician', 'uses' => 'Admin\AdminController@getView']);
            Route::get('create-assign_tech_job/{token?}', ['as' => 'NewAssignTechnician', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-assign_tech_job/{token?}', ['as' => 'EditAssignTechnician', 'uses' => 'Admin\AdminController@getView']);

            Route::get('new-csv/{token?}', ['as' => 'NewCsv', 'uses' => 'Admin\AdminController@getView']);
            Route::get('csvfiles', ['as' => 'Csv', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-csvfiles/{token?}', ['as' => 'ViewCsv', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-csvfiles/{token?}', ['as' => 'EditCsv', 'uses' => 'Admin\AdminController@getView']);

            Route::get('download/{token?}', ['as' => 'Download', 'uses' => 'Admin\AdminController@getView']);
            
            Route::get('new-claim/{token?}', ['as' => 'NewClaim', 'uses' => 'Admin\AdminController@getView']);
            Route::get('claims', ['as' => 'Claims', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit_claim/{token?}', ['as' => 'EditClaim', 'uses' => 'Admin\AdminController@getView']);

            Route::get('admin_claims', ['as' => 'AdminClaims', 'uses' => 'Admin\AdminController@getView']);
            Route::get('admin_edit_claim/{token?}', ['as' => 'EditAdminClaim', 'uses' => 'Admin\AdminController@getView']);

            Route::get('admin_appr_claims', ['as' => 'AdminApprClaims', 'uses' => 'Admin\AdminController@getView']);
            Route::get('admin_rej_claims', ['as' => 'AdminRejClaims', 'uses' => 'Admin\AdminController@getView']);

            Route::get('appr_claims', ['as' => 'ApprClaims', 'uses' => 'Admin\AdminController@getView']);
            Route::get('rej_claims', ['as' => 'RejClaims', 'uses' => 'Admin\AdminController@getView']);

            Route::get('asp_parts_order', ['as' => 'AspPartsOrder', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_appr_list', ['as' => 'AspApprOrder', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_rej_list', ['as' => 'AspRejOrder', 'uses' => 'Admin\AdminController@getView']);

            Route::get('edit-parts_asp/{token?}', ['as' => 'AspEditPartsOrder', 'uses' => 'Admin\AdminController@getView']);


            Route::get('unassigned_jobs_tech', ['as' => 'UnAssignedJobsTech', 'uses' => 'Admin\AdminController@getView']);

            Route::get('assigned_jobs_tech', ['as' => 'AssignedJobsTech', 'uses' => 'Admin\AdminController@getView']);

            Route::get('view-asp_parts_order/{token?}', ['as' => 'ViewAspPartsOrder', 'uses' => 'Admin\AdminController@getView']);


            Route::get('asp_partsedit/{token?}', ['as' => 'AspWaitingParts', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_claim_edit/{token?}', ['as' => 'AspNewClaim', 'uses' => 'Admin\AdminController@getView']);
            Route::get('image', ['as' => 'Image', 'uses' => 'Admin\AdminController@getView']);


            Route::post('post-rma', ['as' => 'postRma', 'uses' => 'Admin\PostController@postRma']);
            Route::post('post-grn', ['as' => 'postGrn', 'uses' => 'Admin\PostController@postGrn']);
            Route::post('post-rma-asp', ['as' => 'postRmaasp', 'uses' => 'Admin\PostController@postRmaasp']);
            Route::post('post-grn-asp', ['as' => 'postGrnasp', 'uses' => 'Admin\PostController@postGrnasp']);
            Route::post('post-rma-tss', ['as' => 'postRmaTss', 'uses' => 'Admin\PostController@postRmaTss']);
            Route::post('post-grn-tss', ['as' => 'postGrnTss', 'uses' => 'Admin\PostController@postGrnTss']);
            Route::get('rma_requests', ['as' => 'RmaRequests', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-rma/{token?}', ['as' => 'EditRma', 'uses' => 'Admin\AdminController@getView']);

            Route::get('gma_requests', ['as' => 'GmaRequests', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-gma/{token?}', ['as' => 'EditGma', 'uses' => 'Admin\AdminController@getView']);
            

            Route::get('part_wo_job', ['as' => 'PartWithOutJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('create_part_wo_job', ['as' => 'CreatePartWithOutJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-part_wo_job/{token?}', ['as' => 'ViewPartsWoJob', 'uses' => 'Admin\AdminController@getView']);

            Route::get('asp_part_wo_job', ['as' => 'AspPartWithOutJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_create_part_wo_job', ['as' => 'AspCreatePartWithOutJob', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_view-part_wo_job/{token?}', ['as' => 'AspViewPartsWoJob', 'uses' => 'Admin\AdminController@getView']);

            Route::get('gma_tech_lists', ['as' => 'GmaTechList', 'uses' => 'Admin\AdminController@getView']);
            Route::get('rma_tech_lists', ['as' => 'RmaTechList', 'uses' => 'Admin\AdminController@getView']);

            Route::get('gma_asp_lists', ['as' => 'GmaAspList', 'uses' => 'Admin\AdminController@getView']);
            Route::get('rma_asp_lists', ['as' => 'RmaAspList', 'uses' => 'Admin\AdminController@getView']);

            Route::get('file_share', ['as' => 'FileShare', 'uses' => 'Admin\AdminController@getView']);
            Route::get('create_file_share', ['as' => 'CreateFileShare', 'uses' => 'Admin\AdminController@getView']);
          
            Route::get('generate-pdf/{token?}', ['as' => 'GeneratePdf', 'uses' => 'Admin\AdminController@getView']);
            Route::get('generate-pdf-grn/{token?}', ['as' => 'GeneratePdfGrn', 'uses' => 'Admin\AdminController@getView']);
            Route::get('download-pdf', ['as' => 'DownLoadPdf', 'uses' => 'Admin\AdminController@DownLoadPdf']);

            Route::post('post-file-share', ['as' => 'postFileShare', 'uses' => 'Admin\PostController@postFileShare']);
            Route::get('edit_file_share/{token?}', ['as' => 'EditFileShare', 'uses' => 'Admin\AdminController@getView']);
            Route::post('update_file_share', ['as' => 'updateFileShare', 'uses' => 'Admin\PostController@updateFileShare']);


            Route::get('asp_claims', ['as' => 'AspClaims', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_files', ['as' => 'AspFiles', 'uses' => 'Admin\AdminController@getView']);

            Route::get('invoices', ['as' => 'Invoices', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp-invoices', ['as' => 'AspInvoices', 'uses' => 'Admin\AdminController@getView']);
            Route::get('tech-invoices', ['as' => 'TechInvoices', 'uses' => 'Admin\AdminController@getView']);

            Route::get('tech_files', ['as' => 'TechFiles', 'uses' => 'Admin\AdminController@getView']);


            Route::get('log_rma_order', ['as' => 'LogRmaOrder', 'uses' => 'Admin\AdminController@getView']);
            
            Route::get('log_grn_order', ['as' => 'LogGrnOrder', 'uses' => 'Admin\AdminController@getView']);
            
            Route::get('generate-grn-report/{token?}', ['as' => 'GenerateGrnReport', 'uses' => 'Admin\AdminController@getView']);
            Route::get('generate-rma-report/{token?}', ['as' => 'GenerateRmaReport', 'uses' => 'Admin\AdminController@getView']);
            Route::get('generate-credit-note/{token?}', ['as' => 'GenerateCreditNote', 'uses' => 'Admin\AdminController@getView']);
            Route::get('generate-transfer-order/{token?}', ['as' => 'GenerateTransfer', 'uses' => 'Admin\AdminController@getView']);
            Route::get('generate-faulty-report/{token?}', ['as' => 'GenerateFaultyReport', 'uses' => 'Admin\AdminController@getView']);
            Route::get('generate-delivery-report/{token?}', ['as' => 'GenerateDeliveryReport', 'uses' => 'Admin\AdminController@getView']);
            Route::get('generate-delivery-parts/{token?}', ['as' => 'GenerateDeliveryParts', 'uses' => 'Admin\AdminController@getView']);


            Route::get('asp-edit-rma/{token?}', ['as' => 'AspEditRma', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp-edit-gma/{token?}', ['as' => 'AspEditGma', 'uses' => 'Admin\AdminController@getView']);
            Route::get('asp_appointments', ['as' => 'AspAppointments', 'uses' => 'Admin\AdminController@getView']);
            Route::get('tss_appointments', ['as' => 'TssAppointments', 'uses' => 'Admin\AdminController@getView']);
            Route::get('tech-edit-rma/{token?}', ['as' => 'TechEditRma', 'uses' => 'Admin\AdminController@getView']);
            Route::get('tech-edit-gma/{token?}', ['as' => 'TechEditGma', 'uses' => 'Admin\AdminController@getView']);
            Route::get('parts_wo_job_tss', ['as' => 'TssPartsWoJob', 'uses' => 'Admin\AdminController@getView']);



            Route::get('parts_list', ['as' => 'Parts', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-spare-part/{token?}', ['as' => 'EditPart', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-spare-part/{token?}', ['as' => 'ViewPart', 'uses' => 'Admin\AdminController@getView']);

            Route::get('mileag_list', ['as' => 'Mileages', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-mileag/{token?}', ['as' => 'EditMileage', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-mileag/{token?}', ['as' => 'ViewMileage', 'uses' => 'Admin\AdminController@getView']);


            Route::get('faulty_list', ['as' => 'Faultylist', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-faulty_list/{token?}', ['as' => 'EditFaultylist', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-faulty_list/{token?}', ['as' => 'ViewFaultylist', 'uses' => 'Admin\AdminController@getView']);

            Route::get('symptoms', ['as' => 'Symptom', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-symptom/{token?}', ['as' => 'EditSymptom', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-symptom/{token?}', ['as' => 'ViewSymptom', 'uses' => 'Admin\AdminController@getView']);

            Route::get('resolutions', ['as' => 'Resolutions', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-resolution/{token?}', ['as' => 'EditResolution', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-resolution/{token?}', ['as' => 'ViewResolution', 'uses' => 'Admin\AdminController@getView']);

            Route::get('product_list', ['as' => 'Products', 'uses' => 'Admin\AdminController@getView']);
            Route::get('edit-product/{token?}', ['as' => 'EditProduct', 'uses' => 'Admin\AdminController@getView']);
            Route::get('view-product/{token?}', ['as' => 'ViewProduct', 'uses' => 'Admin\AdminController@getView']);

            Route::get('view-spare-part-log/{token?}', ['as' => 'ViewPartLog', 'uses' => 'Admin\AdminController@getView']);



            Route::get('pending_part/{token?}', ['as' => 'Pendingpart', 'uses' => 'Admin\AdminController@getView']);
            Route::get('pending_asp/{token?}', ['as' => 'PendingAsp', 'uses' => 'Admin\AdminController@getView']);
            Route::get('pending_tech/{token?}', ['as' => 'PendingTech', 'uses' => 'Admin\AdminController@getView']);

            Route::get('reports', ['as' => 'Reports', 'uses' => 'Admin\AdminController@getView']);


        });
        Route::get('$2y$10$V091JdZYAeUEdnuQZaEUUe24XOd9gcp3eqi27jUbU43uFrMJR', ['as' => '404', 'uses' => 'Admin\SettingsController@getView']);


    });

    /*Route::group(['domain' => $domainUrl], function () {



        Route::group(['middleware' => ['guest']], function () {

            Route::get('/',['as' => 'Netproclivity', 'uses' => 'Frontend\FrontendController@getView']);
            Route::get('about-us/{token?}',['as' => 'AboutUs', 'uses' => 'Frontend\FrontendController@getView']);
            Route::get('executive-team/{token?}',['as' => 'ExecutiveTeam', 'uses' => 'Frontend\FrontendController@getView']);
            Route::get('services/{token?}',['as' => 'Services', 'uses' => 'Frontend\FrontendController@getView']);
            Route::get('digital-transformation/{token?}',['as' => 'Digitaltransformation', 'uses' => 'Frontend\FrontendController@getView']);
            Route::get('experience-transformation/{token?}',['as' => 'Experiencetransformation', 'uses' => 'Frontend\FrontendController@getView']);
            Route::get('itstaffing-transformation/{token?}',['as' => 'Itstaffingtransformation', 'uses' => 'Frontend\FrontendController@getView']);
            Route::get('contact-us/{token?}',['as' => 'Contact', 'uses' => 'Frontend\FrontendController@getView']);

            Route::post('post-contact', ['as' => 'PostManage', 'uses' => 'Frontend\FrontendController@postManage']);
        });

        Route::group(['middleware' => ['auth']], function () {

        });

    });*/
});





