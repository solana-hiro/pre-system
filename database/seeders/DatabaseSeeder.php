<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DefDepartmentsTableSeeder::class);
        $this->call(Def1MenusTableSeeder::class);
        $this->call(Def2MenusTableSeeder::class);
        $this->call(Def3MenusTableSeeder::class);
        $this->call(DefCustomerClassThingsTableSeeder::class);
        $this->call(DefArrivalDatesTableSeeder::class);
        $this->call(DefDistrictClassesTableSeeder::class);
        $this->call(DefPioneerYearsTableSeeder::class);
        $this->call(DefSupplierClassThingsTableSeeder::class);
        $this->call(DefItemClassThingsTableSeeder::class);
        $this->call(DefItemChangeHistoryThingsTableSeeder::class);
        $this->call(DefPsKbnsTableSeeder::class);
        $this->call(DefSlipKindKbnsTableSeeder::class);
        $this->call(MtUsersTableSeeder::class);
        $this->call(MtSlipKindsTableSeeder::class);
        $this->call(DefTaxRateKbnsTableSeeder::class);
        $this->call(DefStickyNoteKindsTableSeeder::class);
        $this->call(DefOrderReceiveKbnsTableSeeder::class);

        $this->call(MtCustomerClassesTableSeeder::class);
        $this->call(MtSupplierClassesTableSeeder::class);
        $this->call(MtColorsTableSeeder::class);
        $this->call(MtSizesTableSeeder::class);
        $this->call(MtItemClassesTableSeeder::class);
        $this->call(MtBanksTableSeeder::class);
        $this->call(MtShippingCompaniesTableSeeder::class);
        $this->call(MtWarehousesTableSeeder::class);
        $this->call(MtRootsTableSeeder::class);
        $this->call(MtTaxRateSettingsTableSeeder::class);
        $this->call(MtOrderReceiveStickyNotesTableSeeder::class);

    }
}
