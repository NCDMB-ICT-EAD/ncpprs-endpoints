<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return new \App\Http\Resources\AuthUserResource($request->user());
});

// New Routes
Route::prefix('reports')->group(function () {
    Route::controller(\App\Http\Controllers\ReportController::class)->group(function () {
        Route::get('project-details/{projectId}', 'projectDetails');
        Route::get('yearly-project-performance', 'yearlyProjectPerformance');
        Route::get('contractor-project-status', 'contractorProjectStatus');

        Route::get('board-project-summary', 'boardProjectSummary');
        Route::get('department-board-project-status', 'departmentBoardProjectStatus');
    });
});

Route::apiResource('projectSubmissions', \App\Http\Controllers\ProjectSubmissionController::class);
Route::apiResource('lifSubmissions', \App\Http\Controllers\LifSubmissionController::class);
Route::apiResource('employments', \App\Http\Controllers\EmploymentController::class);
Route::apiResource('trainingCategories', \App\Http\Controllers\TrainingCategoryController::class);
Route::apiResource('trainings', \App\Http\Controllers\TrainingController::class);


Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [\App\Http\Controllers\AuthApiController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\AuthApiController::class, 'logout']);

        Route::get('capacityBuildings/cdis', [\App\Http\Controllers\CapacityBuildingController::class, 'cdis']);
        Route::get('capacityBuildings/hcds', [\App\Http\Controllers\CapacityBuildingController::class, 'hcds']);

        // Resource Routes
        Route::apiResource('activities', \App\Http\Controllers\ActivityController::class);
        Route::apiResource('boardProjects', \App\Http\Controllers\BoardProjectController::class);
        Route::apiResource('boardProjectActivities', \App\Http\Controllers\BoardProjectActivityController::class);
        Route::apiResource('boardProjectUtilizations', \App\Http\Controllers\BoardProjectUtilizationController::class);
        Route::apiResource('dashboardCards', \App\Http\Controllers\DashboardCardController::class);
        Route::apiResource('brokers', \App\Http\Controllers\BrokerController::class);
        Route::apiResource('cDActivities', \App\Http\Controllers\CDActivityController::class);
        Route::apiResource('companies', \App\Http\Controllers\CompanyController::class);
        Route::apiResource('projects', \App\Http\Controllers\ProjectController::class);
        Route::apiResource('departments', \App\Http\Controllers\DepartmentController::class);
        Route::apiResource('disseminationChannels', \App\Http\Controllers\DisseminationChannelController::class);
        Route::apiResource('eQApprovals', \App\Http\Controllers\EQApprovalController::class);
        Route::apiResource('eQEmployees', \App\Http\Controllers\EQEmployeeController::class);
        Route::apiResource('eQSuccessionPlans', \App\Http\Controllers\EQSuccessionPlanController::class);
        Route::apiResource('lifActivities', \App\Http\Controllers\LifActivityController::class);
        Route::apiResource('lifInstitutions', \App\Http\Controllers\LifInstitutionController::class);
        Route::apiResource('lifServiceCategories', \App\Http\Controllers\LifServiceCategoryController::class);
        Route::apiResource('lifServices', \App\Http\Controllers\LifServiceController::class);
        Route::apiResource('materialTypes', \App\Http\Controllers\MaterialTypeController::class);
        Route::apiResource('roles', \App\Http\Controllers\RoleController::class);
        Route::apiResource('users', \App\Http\Controllers\UserController::class);
        Route::apiResource('pages', \App\Http\Controllers\PageController::class);
        Route::apiResource('permissions', \App\Http\Controllers\PermissionController::class);
        Route::apiResource('principalInvestigators', \App\Http\Controllers\PrincipalInvestigatorController::class);
        Route::apiResource('procuredMaterials', \App\Http\Controllers\ProcuredMaterialController::class);
        Route::apiResource('projectScopes', \App\Http\Controllers\ProjectScopeController::class);
        Route::apiResource('renderedServices', \App\Http\Controllers\RenderedServiceController::class);
        Route::apiResource('researchAccomodations', \App\Http\Controllers\ResearchAccomodationController::class);
        Route::apiResource('researchBudgets', \App\Http\Controllers\ResearchBudgetController::class);
        Route::apiResource('researchCentres', \App\Http\Controllers\ResearchCentreController::class);
        Route::apiResource('researchDisseminations', \App\Http\Controllers\ResearchDisseminationController::class);
        Route::apiResource('researchFacilities', \App\Http\Controllers\ResearchFacilityController::class);
        Route::apiResource('researchLibraries', \App\Http\Controllers\ResearchLibraryController::class);
        Route::apiResource('researchOutcomes', \App\Http\Controllers\ResearchOutcomeController::class);
        Route::apiResource('researchTeams', \App\Http\Controllers\ResearchTeamController::class);
        Route::apiResource('researchTeamDevelopments', \App\Http\Controllers\ResearchTeamDevelopmentController::class);
        Route::apiResource('reviews', \App\Http\Controllers\ReviewController::class);
        Route::apiResource('rndProjects', \App\Http\Controllers\RNDProjectController::class);
        Route::apiResource('schedules', \App\Http\Controllers\ScheduleController::class);
        Route::apiResource('serviceTypes', \App\Http\Controllers\ServiceTypeController::class);
        Route::apiResource('settings', \App\Http\Controllers\SettingController::class);
        Route::apiResource('vessels', \App\Http\Controllers\VesselController::class);
        Route::apiResource('vesselUtilizations', \App\Http\Controllers\VesselUtilizationController::class);
        Route::apiResource('hcds', \App\Http\Controllers\HcdController::class);
        Route::apiResource('hcdActivities', \App\Http\Controllers\HcdActivityController::class);
        Route::apiResource('capacityBuildings', \App\Http\Controllers\CapacityBuildingController::class);
        Route::apiResource('capacityBuildingActivities', \App\Http\Controllers\CapacityBuildingActivityController::class);
    });
});
