<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',


            'الفواتير',
            'قائمة الفواتير',
            'الفواتير المدفوعة',
            'الفواتير الغير المدفوعة',
            'الفواتير المدفوعة جزئيا',
            'إضافة فاتورة',
            'الارشيف',
            'تصدير اكسيل',
            'تعديل فاتورة',
            'حذف فاتورة',
            'عرض فاتورة',
            'إضافة مرفق',
            'عرض المرفق',
            'حذف المرفق',
            'تحميل المرفق',


            'حالة الدفع',
            'طباعة فاتورة',
            'نقل الى الارشيف',
            'استعادة فاتورة',


            'الاعدادات',

            'البنوك',
            'إضافة بنك',
            'تعديل بنك',
            'حذف بنك',

            'الفئات',
            'إضافة فئة',
            'تعديل فئة',
            'حذف فئة',

             'المستخدمين',

            'عرض مستخدم',

            'صلاحيات المستخدمين',
            'عرض صلاحية',

             'التقارير',
            'تقارير الفواتير',
            'تقارير العملاء',
            'الاشعارات',

         ];

          // Looping and Inserting Array's Permissions into Permission Table
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
