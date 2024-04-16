<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BankDetails;
use App\Models\CompanyBankDetails;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountryTableSeeder::class,
            StateTableSeeder::class,
            DistrictTableSeeder::class,
            PermissionGroupTableSeeder::class,
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            PaymentModeTableSeeder::class,
            ReligionTableSeeder::class,
            CasteTableSeeder::class,
            NationalityTableSeeder::class,
            LocalOfficeTableSeeder::class,
            EsiDispensaryTableSeeder::class,
            ResigningReasonTableSeeder::class,
            AddressTypeTableSeeder::class,
            UserTableSeeder::class,
            CompanyTypeTableSeeder::class,
            // CompanyTableSeeder::class,
            // CompanyHierarchieTableSeeder::class,
            // CompanyRegistrationDetailTableSeeder::class,
            // BankDetailTableSeeder::class,
            // CompanyBankDetailTableSeeder::class,
            // CustomerTableSeeder::class,
            // EmployeeTableSeeder::class,
            // AuthorisedPeopleTableSeeder::class,
            RawMaterialTypeTableSeeder::class,
            // RawMaterialTableSeeder::class,
            // ProductTableSeeder::class,
            ProductSizeTableSeeder::class,
            OrderStatusTableSeeder::class,
            ProductColorTableSeeder::class,
            // ProductModelTableSeeder::class,
            // FinisingProductModelTableSeeder::class
            // OrderNoTableSeeder::class,
            // OrderDetailTableSeeder::class
        ]);
    }
}
