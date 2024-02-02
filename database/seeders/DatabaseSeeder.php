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
            ResigningReasonTableSeeder::class,
            AddressTypeTableSeeder::class,
            UserTableSeeder::class,
            CompanyTypeTableSeeder::class,
            CompanyTableSeeder::class,
            CompanyHierarchieTableSeeder::class,
            CompanyRegistrationDetailTableSeeder::class,
            BankDetailTableSeeder::class,
            CompanyBankDetailTableSeeder::class,
            CustomerTableSeeder::class,
            EmployeeTableSeeder::class,
            MasterCompanySeeder::class,
            AuthorisedPeopleTableSeeder::class
        ]);
    }
}