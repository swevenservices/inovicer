<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 18,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 19,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 20,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 21,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 22,
                'title' => 'invoice_item_create',
            ],
            [
                'id'    => 23,
                'title' => 'invoice_item_edit',
            ],
            [
                'id'    => 24,
                'title' => 'invoice_item_delete',
            ],
            [
                'id'    => 25,
                'title' => 'invoice_item_access',
            ],
            [
                'id'    => 26,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 27,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 28,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 29,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 30,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 31,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 32,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 33,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 34,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 35,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 36,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 37,
                'title' => 'expense_create',
            ],
            [
                'id'    => 38,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 39,
                'title' => 'expense_show',
            ],
            [
                'id'    => 40,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 41,
                'title' => 'expense_access',
            ],
            [
                'id'    => 42,
                'title' => 'income_create',
            ],
            [
                'id'    => 43,
                'title' => 'income_edit',
            ],
            [
                'id'    => 44,
                'title' => 'income_show',
            ],
            [
                'id'    => 45,
                'title' => 'income_delete',
            ],
            [
                'id'    => 46,
                'title' => 'income_access',
            ],
            [
                'id'    => 47,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 48,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 49,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 50,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 51,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 52,
                'title' => 'currency_create',
            ],
            [
                'id'    => 53,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 54,
                'title' => 'currency_show',
            ],
            [
                'id'    => 55,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 56,
                'title' => 'currency_access',
            ],
            [
                'id'    => 57,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 58,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 59,
                'title' => 'email_template_create',
            ],
            [
                'id'    => 60,
                'title' => 'email_template_edit',
            ],
            [
                'id'    => 61,
                'title' => 'email_template_show',
            ],
            [
                'id'    => 62,
                'title' => 'email_template_delete',
            ],
            [
                'id'    => 63,
                'title' => 'email_template_access',
            ],
            [
                'id'    => 64,
                'title' => 'receipt_create',
            ],
            [
                'id'    => 65,
                'title' => 'receipt_edit',
            ],
            [
                'id'    => 66,
                'title' => 'receipt_show',
            ],
            [
                'id'    => 67,
                'title' => 'receipt_delete',
            ],
            [
                'id'    => 68,
                'title' => 'receipt_access',
            ],
            [
                'id'    => 69,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
