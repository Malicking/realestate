<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Agent\AgentPropertyController;

use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ChatController;

use App\Http\Controllers\FrontEnd\FrontEndController;


Route::controller(UserController::class)->group(function () {
    Route::get('/', 'Index')->name('home.page');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/profile', 'userProfile')->name('profile');
            Route::post('/profile/store', 'userProfileStore')->name('profile.store');
            Route::get('/logout', 'userLogout')->name('logout');
            Route::get('/change/password', 'userChangePassword')->name('change.pwd');
            Route::post('/update/password', 'userUpdatePassword')->name('update.pwd');

            // demandes de visites effectuées par l'utilisateur
            Route::get('/schedule/request', 'userScheduleRequest')->name('schedule.request');
        });

        // mon chatlive
        Route::get('/live-chat', 'LiveChat')->name('live.chat');
    });
});

require __DIR__.'/auth.php';


// ************************* les URLs de l'Admin *************************
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::get('/logout', 'adminLogout')->name('logout');
            Route::get('/profile', 'adminProfile')->name('profile');
            Route::post('/profile/store', 'adminProfileStore')->name('profile.store');
            Route::get('/change-password', 'adminChangePwd')->name('change.password');
            Route::post('/update-password', 'adminUpdatePwd')->name('update.password');

            Route::get('/all', 'adminAll')->name('all');
            Route::get('/add', 'adminAdd')->name('add');
            Route::post('/store', 'adminStore')->name('store');
            Route::get('/{id}/edit', 'adminEdit')->name('edit');
            Route::post('/update', 'adminUpdate')->name('update');
            Route::get('/{id}/delete', 'adminDelete')->name('delete');

            // Historique d'achat de forfaits
            Route::get('/package/history', 'adminPackageHistory')->name('package.history');
            Route::get('/package/invoice/{id}', 'adminPackageInvoice')->name('package.invoice');

            // ******************************* messages *******************************
            Route::prefix('message')->name('property.message')->group(function () {
                Route::get('/all', 'allPropertyMessages');
                Route::get('/new', 'newPropertyMessages')->name('.new');
                Route::get('/{id}/details', 'detailPropertyMessages')->name('.details');
            });
        });

        // Gestion des agents (agences)
        Route::prefix('agents')->name('agent.')->group(function () {
            Route::get('/all', 'agentAll')->name('all')->middleware('permission:agent.all');
            Route::get('/add', 'agentAdd')->name('add')->middleware('permission:agent.add');
            Route::post('/store', 'agentStore')->name('store');
            Route::get('/edit/{id}', 'agentEdit')->name('edit')->middleware('permission:agent.edit');
            Route::post('/update/{id}', 'agentUpdate')->name('update');
            Route::get('/delete/{id}', 'agentDelete')->name('delete')->middleware('permission:agent.delete');
            Route::post('/manage/{id}', 'agentManage')->name('manage');
        });
    });

    Route::controller(PropertyTypeController::class)->group(function () {
        // types de propriétés
        Route::prefix('properties-type')->name('property.type.')->group(function () {
            Route::get('/all', 'allPropertiesType')->name('all')->middleware('permission:type.all');
            Route::get('/add', 'addPropertyType')->name('add')->middleware('permission:type.add');
            Route::post('/store', 'storePropertyType')->name('store');
            Route::get('/edit/{id}', 'editPropertyType')->name('edit')->middleware('permission:type.edit');
            Route::post('/update', 'updatePropertyType')->name('update');
            Route::get('/delete/{id}', 'deletePropertyType')->name('delete')->middleware('permission:type.delete');
        });

        // amenités
        Route::prefix('amenities')->name('amenities.')->group(function () {
            Route::get('/all', 'allAmenities')->name('all')->middleware('permission:amenities.all');
            Route::get('/add', 'addAmenities')->name('add')->middleware('permission:amenities.add');
            Route::post('/store', 'storeAmenities')->name('store');
            Route::get('/edit/{id}', 'editAmenities')->name('edit')->middleware('permission:amenities.edit');
            Route::post('/update', 'updateAmenities')->name('update');
            Route::get('/delete/{id}', 'deleteAmenities')->name('delete')->middleware('permission:amenities.delete');
        });
    });

    // ******************************* proprités *******************************
    Route::controller(PropertyController::class)->group(function () {
        Route::prefix('property')->name('property.')->group(function () {
            Route::get('/all', 'allProperty')->name('all')->middleware('permission:property.all');
            Route::get('/add', 'addProperty')->name('add')->middleware('permission:property.add');
            Route::post('/store', 'storeProperty')->name('store');
            Route::get('/edit/{slug}', 'editProperty')->name('edit')->middleware('permission:property.edit');
            Route::post('/update', 'updateProperty')->name('update');
            Route::get('/delete/{slug}', 'deleteProperty')->name('delete')->middleware('permission:property.delete');
            Route::get('/detail/{slug}', 'detailProperty')->name('detail');
            Route::post('/manage/status', 'managePropertyStatus')->name('manage.status');
            // Route::get('/changeStatus', 'changeStatus');

            Route::prefix('multiImg')->name('multiImg.')->group(function () {
                Route::post('/update', 'updateMultiImg')->name('update');
                Route::get('/delete/{id}', 'deleteMultiImg')->name('delete');
                Route::post('/store', 'storeMultiImg')->name('store');
            });

            Route::post('/facilities/update', 'updateFacilities')->name('facilities.update');
        });
    });

    // ************************** les régions / Etats **************************
    Route::controller(StateController::class)->group(function () {
        Route::prefix('state')->name('state.')->group(function () {
            Route::get('/all', 'allState')->name('all')->middleware('permission:state.all');
            Route::get('/add', 'addState')->name('add')->middleware('permission:state.add');
            Route::post('/store', 'storeState')->name('store');
            Route::get('/{id}/edit', 'editState')->name('edit')->middleware('permission:state.edit');
            Route::post('/update', 'updateState')->name('update');
            Route::get('/{id}/delete', 'deleteState')->name('delete')->middleware('permission:state.delete');
        });
    });

    // **************************** les témoignages **************************
    Route::controller(TestimonialController::class)->group(function () {
        Route::prefix('testimonial')->name('testimonial.')->group(function () {
            Route::get('/all', 'allTestimonial')->name('all')->middleware('permission:testimonial.all');
            Route::get('/add', 'addTestimonial')->name('add')->middleware('permission:testimonial.add');
            Route::post('/store', 'storeTestimonial')->name('store');
            Route::get('/{id}/edit', 'editTestimonial')->name('edit')->middleware('permission:testimonial.edit');
            Route::post('/update', 'updateTestimonial')->name('update');
            Route::get('/{id}/delete', 'deleteTestimonial')->name('delete')->middleware('permission:testimonial.delete');
        });
    });

    // **************************** le blog **************************
    Route::controller(BlogController::class)->group(function () {
        Route::prefix('blog-category')->name('blog.category.')->group(function () {
            Route::get('/all', 'allBlogCategory')->name('all');
            Route::post('/store', 'storeBlogCategory')->name('store');
            Route::get('/{id}/edit', 'editBlogCategory')->name('edit');
            Route::post('/update', 'updateBlogCategory')->name('update');
            Route::get('/{id}/delete', 'deleteBlogCategory')->name('delete');
        });

        Route::prefix('blog-post')->name('blog.post.')->group(function () {
            Route::get('/all', 'allBlogPost')->name('all');
            Route::get('/add', 'addBlogPost')->name('add');
            Route::post('/store', 'storeBlogPost')->name('store');
            Route::get('/{id}/edit', 'editBlogPost')->name('edit');
            Route::post('/update', 'updateBlogPost')->name('update');
            Route::get('/{id}/delete', 'deleteBlogPost')->name('delete');
            Route::get('/comments', 'commentBlogPost')->name('comment');
            Route::get('/{id}/replay', 'replayBlogPost')->name('replay');
            Route::post('/replay/message', 'replayMessageBlogPost')->name('replay.message');
        });
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('/smtp/setting', 'smtpSetting')->name('smtp.setting');
        Route::post('/smtp/update', 'smtpUpdate')->name('smtp.update');

        Route::get('/site/setting', 'siteSetting')->name('site.setting');
        Route::post('/site/update', 'siteUpdate')->name('site.update');
    });

    // Rôles & Permissions
    Route::controller(RoleController::class)->group(function () {
        Route::prefix('permission')->name('permission')->group(function () {
            Route::get('/all', 'allPermission')->name('.all');
            Route::get('/add', 'addPermission')->name('.add');
            Route::post('/store', 'storePermission')->name('.store');
            Route::get('/{id}/edit', 'editPermission')->name('.edit');
            Route::post('/update', 'updatePermission')->name('.update');
            Route::get('/{id}/delete', 'deletePermission')->name('.delete');
            Route::get('/export', 'exportPermission')->name('.export');
            Route::get('/import', 'importPermission')->name('.import');
            Route::post('/import/save', 'importPermissionSave')->name('.import.save');
        });

        Route::prefix('roles')->name('roles')->group(function () {
            Route::get('/all', 'allRole')->name('.all')->middleware('permission:role.menu');
            Route::get('/add', 'addRole')->name('.add')->middleware('permission:role.menu');
            Route::post('/store', 'storeRole')->name('.store');
            Route::get('/{id}/edit', 'editRole')->name('.edit')->middleware('permission:role.menu');
            Route::post('/update', 'updateRole')->name('.update');
            Route::get('/{id}/delete', 'deleteRole')->name('.delete')->middleware('permission:role.menu');

            Route::prefix('permissions')->name('.permission')->group(function () {
                Route::get('/all', 'allRolePermission')->name('.all')->middleware('permission:role.menu');
                Route::get('/add', 'addRolePermission')->name('.add')->middleware('permission:role.menu');
                Route::post('/store', 'storeRolePermission')->name('.store');
                Route::get('/{id}/edit', 'editRolePermission')->name('.edit')->middleware('permission:role.menu');
                Route::post('/update', 'updateRolePermission')->name('.update');
                Route::get('/{id}/delete', 'deleteRolePermission')->name('.delete')->middleware('permission:role.menu');
            });
        });
    });
});


Route::controller(AdminController::class)->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)->group(function () {
        Route::get('/admin/login', 'adminLogin')->name('admin.login');
    });
});


// ************************* les URLs de l'Agent *************************
Route::prefix('agent')->name('agent.')->group(function () {
    Route::middleware(['auth', 'roles:agent'])->group(function () {
        Route::controller(AgentController::class)->group(function () {
            Route::get('/dashboard', 'agentDashboard')->name('dashboard');
            Route::get('/logout', 'agentLogout')->name('logout');
            Route::get('/profile', 'agentProfile')->name('profile');
            Route::post('/profile/store', 'agentProfileStore')->name('profile.store');
            Route::get('/change-password', 'agentChangePwd')->name('change.pwd');
            Route::post('/update-password', 'agentUpdatePwd')->name('update.pwd');
        });

        Route::controller(AgentPropertyController::class)->group(function () {
            Route::prefix('property')->name('property.')->group(function () {
                Route::get('/all', 'agentAllProperty')->name('all');
                Route::get('/add', 'agentAddProperty')->name('add');
                Route::post('/store', 'agentStoreProperty')->name('store');
                Route::get('/detail/{id}', 'agentDetailProperty')->name('detail');
                Route::get('/edit/{id}', 'agentEditProperty')->name('edit');
                Route::post('/update', 'agentUpdateProperty')->name('update');
                Route::get('/delete/{id}', 'agentDeleteProperty')->name('delete');
                Route::post('/manage/status', 'agentManagePropertyStatus')->name('manage.status');

                Route::post('/update/thumbnail', 'agentUpdatePropertyThumbnail')->name('update.thumbnail');

                // autres images de la propriété
                Route::prefix('multi-image')->name('multiImg.')->group(function () {
                    Route::post('/update', 'agentUpdateMultiImg')->name('update');
                    Route::get('/delete/{id}', 'agentDeleteMultiImg')->name('delete');
                    Route::post('/store', 'agentStoreMultiImg')->name('store');
                });

                Route::post('facilities/update', 'agentUpdateFacilities')->name('facilities.update');

                // messages envoyés à l'agent
                Route::prefix('message')->name('message')->group(function () {
                    Route::get('/', 'agentPropertyMessage');
                    Route::get('/news', 'agentPropertyNewMessages')->name('.new');
                    Route::get('/{id}/details', 'agentPropertyMessageDetail')->name('.details');
                });

                // visites de propriétés
                Route::get('/schedule/request', 'agentScheduleRequest')->name('schedule.request');
                Route::get('/schedule/{id}/details', 'agentScheduleDetails')->name('schedule.details');
                Route::post('/schedule/update', 'agentScheduleUpdate')->name('schedule.update');
            });
        });
    });


    // Redirection si l'utilisateur est déjà connecté et qu'il essaie de
    // revenir à la page d'authentification
    Route::controller(AgentController::class)->group(function () {
        Route::middleware(RedirectIfAuthenticated::class)->group(function () {
            Route::get('/login', 'agentLogin')->name('login');
        });

        // inscription d'agent
        Route::post('/register', 'agentRegister')->name('register');
    });
});


Route::middleware(['auth', 'roles:agent'])->group(function () {
    Route::controller(AgentPropertyController::class)->group(function () {
        // achat de forfait
        Route::get('/buy/package', 'buyPackage')->name('buy.package');

        Route::get('/buy/business/plan', 'buyBusinessPlan')->name('buy.business.plan');
        Route::post('/store/business/plan', 'storeBusinessPlan')->name('store.business.plan');

        Route::get('/buy/professional/plan', 'buyProfessionalPlan')->name('buy.professional.plan');
        Route::post('/store/professional/plan', 'storeProfessionalPlan')->name('store.professional.plan');

        Route::get('/package/history', 'packageHistory')->name('package.history');
        Route::get('/package/invoice/{id}', 'packageInvoice')->name('package.invoice');
    });
});


Route::controller(FrontEndController::class)->group(function () {
    Route::get('/property-detail/{id}/{slug}', 'propertyDetail')->name('propertyDetail');

    Route::middleware(['auth'])->group(function () {
        // ********************************** Wishlist **********************************
        // Route::post('/add-to-wishlist/{property_id}', 'addToWishList');
        Route::get('/add-to-wishlist/{p_id}', 'addToWishlist')->name('add_to_wishlist');
        Route::get('/remove-from-wishlist/{p_id}', 'removeFromWishlist')->name('rm_from_wishlist');
        Route::get('/user/wishlist', 'userWishlist')->name('user.wishlist');
        Route::get('/get-wishlist-property', 'getWishlistProperty')->name('get_wishlist_property');

        // ****************************** Comparaison ******************************
        Route::get('/add_compare/{p_id}', 'addCompare')->name('compare.add');
        Route::get('/remove_compare/{id}', 'removeCompare')->name('compare.remove');
        Route::get('/user/compare', 'userCompare')->name('user.compare');
    });

    // Envoie de message à partir de la page propertyDetail
    Route::post('/property/message', 'propertyMessage')->name('property.message');

    // détails (infos) d'un agent
    Route::get('/agent/{id}/details', 'agentDetails')->name('agent.details');

    // envoie de message à un agent (à partir des détails)
    Route::post('/message', 'agentDetailsMessage')->name('agent.details.message');

    // les propriétés disponibles pour location
    Route::get('/rent/property', 'rentProperties')->name('rent.property');

    // les propriétés à vendre
    Route::get('/buy/property', 'buyProperties')->name('buy.property');

    // l'ensemble des propriétés par type
    Route::get('/property/type/{id}', 'propertyType')->name('property.type');

    // l'ensemble des propriétés par région
    Route::get('/state/{id}/details', 'stateDetails')->name('state.details');

    // option de recherche sur la page d'accueil
    Route::post('/buy/property/search', 'buyPropertySearch')->name('buy.property.search');
    Route::post('/rent/property/search', 'rentPropertySearch')->name('rent.property.search');
    Route::post('/all/property/search', 'allPropertySearch')->name('all.property.search');

    // blog
    Route::prefix('/blog')->name('blog.page')->group(function () {
        Route::get('/', 'postAll');
        Route::get('/{slug}', 'postDetail')->name('.detail');
        Route::get('/{id}/category', 'postCategory')->name('.category');
    });

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::post('/store/comment', 'blogStoreComment')->name('comment.store');
    });

    // Programmer un tour
    Route::post('/store/schedule', 'storeSchedule')->name('schedule.store');

});


// Chat Live
Route::controller(ChatController::class)->group(function () {
    Route::post('/send-message', 'SendMsg')->name('send.msg');
    Route::get('/user-all', 'GetAllUsers');
    Route::get('/user-message/{userId}', 'UserMsgById');
});

