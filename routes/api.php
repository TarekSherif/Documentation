<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//========================================================================
// ActionDocumentServesController-urls  
//========================================================================

Route::get('DocumentServesTimeLine/{DID}', 'API\ActionDocumentServesController@DocumentServesTimeLine');
Route::get('ListOfCurrentDocumentServes', 'API\ActionDocumentServesController@ListOfCurrentDocumentServes');

Route::post('ListOfDocumentsNeedin', 'API\ActionDocumentServesController@ListOfDocumentsNeedin');
Route::post('UpdateDocumentsInService', 'API\ActionDocumentServesController@UpdateDocumentsInService');
Route::post('UpdateDocumentsInEnjazID', 'API\ActionDocumentServesController@UpdateDocumentsInEnjazID');


Route::post('ListOfDocumentsNeedout', 'API\ActionDocumentServesController@ListOfDocumentsNeedout');
Route::post('UpdateDocumentOUTService', 'API\ActionDocumentServesController@UpdateDocumentOUTService');

Route::get('UpdateSOrderUp/{SID}/{DID}/{SOrder}', 'API\ActionDocumentServesController@UpdateSOrderUp');
Route::get('UpdateSOrderDown/{SID}/{DID}/{SOrder}', 'API\ActionDocumentServesController@UpdateSOrderDown');

Route::post('ListOfDocumentServes/{DID}', 'API\ActionDocumentServesController@ListOfDocumentServes');
Route::post('CreateDocumentServes', 'API\ActionDocumentServesController@CreateDocumentServes');
Route::post('UpdateDocumentServes', 'API\ActionDocumentServesController@UpdateDocumentServes');
Route::post('DeleteDocumentServes', 'API\ActionDocumentServesController@DeleteDocumentServes');


//========================================================================
// ActionServesController-urls  
//========================================================================
Route::post('ListOfServes', 'API\ActionServesController@ListOfServes');
Route::post('CreateServes', 'API\ActionServesController@CreateServes');
Route::post('UpdateServes', 'API\ActionServesController@UpdateServes');
Route::post('DeleteServes', 'API\ActionServesController@DeleteServes');

Route::post('ServesListoptions/{multiple?}', 'API\ActionServesController@ServesListoptions');




//========================================================================
// ActionListOfBranchsController-urls  
//========================================================================
Route::post('ListOfBranchs', 'API\ActionBranchController@ListOfBranchs');
Route::post('CreateBranch', 'API\ActionBranchController@CreateBranch');
Route::post('UpdateBranch', 'API\ActionBranchController@UpdateBranch');
Route::post('DeleteBranch', 'API\ActionBranchController@DeleteBranch');
Route::post('BranchListoptions', 'API\ActionBranchController@BranchListoptions');
//=========================================================================
//========================================================================
// ActionListOfusersController-urls  
//========================================================================
Route::post('ListOfusers', 'API\ActionusersController@ListOfusers');
Route::post('Createuser', 'API\ActionusersController@Createuser');
Route::post('Updateuser', 'API\ActionusersController@Updateuser');
Route::post('Deleteuser', 'API\ActionusersController@Deleteuser');
//=========================================================================



//========================================================================
// ActionDocumentTypeController-urls  
//========================================================================
Route::get('ListOfACDocumentType', 'API\ActionDocumentTypeController@ListOfACDocumentType');

Route::post('ListOfDocumentTypes', 'API\ActionDocumentTypeController@ListOfDocumentTypes');
Route::post('CreateDocumentType', 'API\ActionDocumentTypeController@CreateDocumentType');
Route::post('UpdateDocumentType', 'API\ActionDocumentTypeController@UpdateDocumentType');
Route::post('DeleteDocumentType', 'API\ActionDocumentTypeController@DeleteDocumentType');
//=========================================================================
Route::post('DocumentTypeListoptions', 'API\ActionDocumentTypeController@DocumentTypeListoptions');
       


//========================================================================
// ActionViewNameController-urls  
//========================================================================
// Route::get('ListOfACViewName', 'API\ActionViewNameController@ListOfACViewName');

Route::post('ListOfViewNames', 'API\ActionViewNameController@ListOfViewNames');
Route::post('CreateViewName', 'API\ActionViewNameController@CreateViewName');
Route::post('UpdateViewName', 'API\ActionViewNameController@UpdateViewName');
Route::post('DeleteViewName', 'API\ActionViewNameController@DeleteViewName');
//=========================================================================
Route::post('ViewNameListoptions', 'API\ActionViewNameController@ViewNameListoptions');
       

//========================================================================
// ActionRoleController-urls  
//========================================================================
Route::post('ListOfRoles', 'API\ActionRoleController@ListOfRoles');
Route::post('CreateRole', 'API\ActionRoleController@CreateRole');
Route::post('UpdateRole', 'API\ActionRoleController@UpdateRole');
Route::post('DeleteRole', 'API\ActionRoleController@DeleteRole');
//=========================================================================
Route::post('RoleListoptions', 'API\ActionRoleController@RoleListoptions');

//========================================================================
// ActionViewRolePermissionController-urls  
//========================================================================
Route::post('ListOfViewRolePermissions/{RID}', 'API\ActionViewRolePermissionController@ListOfViewRolePermissions');
Route::post('CreateViewRolePermission', 'API\ActionViewRolePermissionController@CreateViewRolePermission');
Route::post('UpdateViewRolePermission', 'API\ActionViewRolePermissionController@UpdateViewRolePermission');
Route::post('DeleteViewRolePermission', 'API\ActionViewRolePermissionController@DeleteViewRolePermission');
//=========================================================================
Route::post('ViewRolePermissionListoptions', 'API\ActionViewRolePermissionController@ViewRolePermissionListoptions');
       
       
//========================================================================
// ActionCompanyController-urls  
//========================================================================
Route::post('ListOfCompanys', 'API\ActionCompanyController@ListOfCompanys');
Route::post('CreateCompany', 'API\ActionCompanyController@CreateCompany');
Route::post('UpdateCompany', 'API\ActionCompanyController@UpdateCompany');
Route::post('DeleteCompany', 'API\ActionCompanyController@DeleteCompany');
//=========================================================================
Route::post('CompanyListoptions', 'API\ActionCompanyController@CompanyListoptions');
Route::post('CompanyDocuments', 'API\ActionCompanyController@CompanyDocuments');
Route::post('CompanyDocumentsReport', 'API\ActionCompanyController@CompanyDocuments');


       
       

//========================================================================
// ActionDocumentController-urls  
//========================================================================
Route::post('ListOfDocuments', 'API\ActionDocumentController@ListOfDocuments');
Route::post('CreateDocument', 'API\ActionDocumentController@CreateDocument');
Route::post('UpdateDocument', 'API\ActionDocumentController@UpdateDocument');
Route::post('DeleteDocument', 'API\ActionDocumentController@DeleteDocument');
//===================================================================
// ActionTOrderController-urls  
//========================================================================
Route::post('ListOfOrders', 'API\ActionTOrderController@ListOfOrders');
Route::post('CreateOrder', 'API\ActionTOrderController@CreateOrder');
Route::post('UpdateOrder', 'API\ActionTOrderController@UpdateOrder');
Route::post('DeleteOrder', 'API\ActionTOrderController@DeleteOrder');
Route::post('UpdateTOrderLocked', 'API\ActionTOrderController@UpdateTOrderLocked');

// Route::post('SaveOrder/phone/{OrderID?}/{address?}/{Otherphone?}/{price?}/{paid?}', 'API\ActionTOrderController@SaveOrder');
Route::post('SaveOrder', 'API\ActionTOrderController@SaveOrder');



//===================================================================

Route::get('GetOrderByOrderID/{OrderID?}', 'API\ActionTOrderController@GetOrderByOrderID');
Route::get('ListOfACName', 'API\ActionTOrderController@ListOfACName');
Route::get('ListOfACOnlinePayment', 'API\ActionTOrderController@ListOfACOnlinePayment');



