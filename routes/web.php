<?php
Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }
    return redirect()->route('admin.home');
});
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');


    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    Route::post('invoices/send-mail', 'InvoicesController@sendMail')->name('invoices.sendMail');


    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');


    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::get('users/ajax/search', 'UsersController@dataAjax')->name('users.ajax.search');
    Route::post('users/ajax/store', 'UsersController@storeAjax')->name('users.ajax.store');
    Route::get('users/employees/ajax', 'UsersController@dataEmployeesAjax')->name('users.ajax.employees');
    Route::resource('users', 'UsersController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');
    Route::post('event/ajax/store', 'EventsController@storeAjax')->name('events.ajax.store');
    Route::post('event/ajax/update', 'EventsController@updateAjax')->name('events.ajax.update');
    Route::post('event/ajax/add', 'EventsController@addAjax')->name('events.ajax.save');
    Route::post('event/remove/permanent', 'EventsController@remove')->name('events.permanent.remove');


    // Invoices
    Route::delete('invoices/destroy', 'InvoicesController@massDestroy')->name('invoices.massDestroy');
    Route::post('invoices/parse-csv-import', 'InvoicesController@parseCsvImport')->name('invoices.parseCsvImport');
    Route::post('invoices/process-csv-import', 'InvoicesController@processCsvImport')->name('invoices.processCsvImport');
    Route::get('invoices/print/{id}', 'InvoicesController@detail')->name('invoices.detail.invoice');
    Route::get('invoices/ajax/get', 'InvoicesController@ajaxData')->name('invoices.get.ajax');
    Route::get('invoices/clone/{id}', 'InvoicesController@Clone')->name('invoices.clone');

    Route::resource('invoices', 'InvoicesController');

    // Invoice Items
    Route::delete('invoice-items/destroy', 'InvoiceItemsController@massDestroy')->name('invoice-items.massDestroy');
    Route::resource('invoice-items', 'InvoiceItemsController', ['except' => ['show']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Currency
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrencyController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Email Templates
    Route::delete('email-templates/destroy', 'EmailTemplatesController@massDestroy')->name('email-templates.massDestroy');
    Route::post('email-templates/media', 'EmailTemplatesController@storeMedia')->name('email-templates.storeMedia');
    Route::post('email-templates/ckmedia', 'EmailTemplatesController@storeCKEditorImages')->name('email-templates.storeCKEditorImages');
    Route::resource('email-templates', 'EmailTemplatesController');


    // Items
    Route::delete('items/destroy', 'ItemsController@massDestroy')->name('items.massDestroy');
    Route::post('items/parse-csv-import', 'ItemsController@parseCsvImport')->name('items.parseCsvImport');
    Route::post('items/process-csv-import', 'ItemsController@processCsvImport')->name('items.processCsvImport');
    Route::resource('items', 'ItemsController');

    Route::get('items/ajax/search', 'ItemsController@dataAjax')->name('items.ajax.search');
    Route::post('items/ajax/store', 'ItemsController@storeAjax')->name('items.ajax.store');

    // Receipts
    Route::delete('receipts/destroy', 'ReceiptsController@massDestroy')->name('receipts.massDestroy');
    Route::resource('receipts', 'ReceiptsController');
    Route::post('receipts/send-mail', 'ReceiptsController@sendMail')->name('receipts.sendMail');


    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('events/ajax/get', 'SystemCalendarController@ajaxData')->name('events.ajax');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
