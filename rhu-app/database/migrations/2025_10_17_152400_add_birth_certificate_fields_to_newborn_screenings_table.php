<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('newborn_screenings', function (Blueprint $table) {
            // Birth Certificate Information
            $table->string('registry_no')->nullable()->after('id');
            $table->string('province')->nullable()->after('place_of_birth');
            $table->string('city_municipality')->nullable()->after('province');
            $table->string('type_of_birth')->nullable()->after('gestational_age'); // Single, Twin, etc.
            $table->string('birth_order')->nullable()->after('type_of_birth'); // First, Second, etc.
            $table->string('weight_at_birth_grams')->nullable()->after('birth_weight'); // in grams
            
            // Mother's detailed information
            $table->string('mother_first_name')->nullable()->after('mother_name');
            $table->string('mother_middle_name')->nullable()->after('mother_first_name');
            $table->string('mother_last_name')->nullable()->after('mother_middle_name');
            $table->string('mother_citizenship')->nullable()->after('mother_contact');
            $table->string('mother_religion')->nullable()->after('mother_citizenship');
            $table->string('mother_occupation')->nullable()->after('mother_religion');
            $table->integer('total_children_born_alive')->nullable()->after('mother_occupation');
            $table->integer('children_still_living')->nullable()->after('total_children_born_alive');
            $table->integer('children_born_dead')->nullable()->after('children_still_living');
            
            // Father's information
            $table->string('father_first_name')->nullable()->after('children_born_dead');
            $table->string('father_middle_name')->nullable()->after('father_first_name');
            $table->string('father_last_name')->nullable()->after('father_middle_name');
            $table->string('father_citizenship')->nullable()->after('father_last_name');
            $table->string('father_religion')->nullable()->after('father_citizenship');
            $table->string('father_occupation')->nullable()->after('father_religion');
            $table->integer('father_age_at_birth')->nullable()->after('father_occupation');
            
            // Marriage information
            $table->date('parents_marriage_date')->nullable()->after('father_age_at_birth');
            $table->string('parents_marriage_place')->nullable()->after('parents_marriage_date');
            
            // Attendant information
            $table->string('attendant_type')->nullable()->after('provider_role'); // Physician, Nurse, Midwife, etc.
            $table->string('attendant_other')->nullable()->after('attendant_type');
            
            // Certification information
            $table->time('birth_time_certified')->nullable()->after('time_of_birth');
            $table->string('informant_name')->nullable()->after('attendant_other');
            $table->string('informant_relationship')->nullable()->after('informant_name');
            $table->string('informant_address')->nullable()->after('informant_relationship');
            
            // Registry information
            $table->date('received_by_civil_registrar')->nullable()->after('informant_address');
            $table->string('civil_registrar_name')->nullable()->after('received_by_civil_registrar');
            $table->string('civil_registrar_title')->nullable()->after('civil_registrar_name');
            $table->date('civil_registrar_date')->nullable()->after('civil_registrar_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newborn_screenings', function (Blueprint $table) {
            $table->dropColumn([
                'registry_no', 'province', 'city_municipality', 'type_of_birth', 'birth_order', 
                'weight_at_birth_grams', 'mother_first_name', 'mother_middle_name', 'mother_last_name',
                'mother_citizenship', 'mother_religion', 'mother_occupation', 'total_children_born_alive',
                'children_still_living', 'children_born_dead', 'father_first_name', 'father_middle_name',
                'father_last_name', 'father_citizenship', 'father_religion', 'father_occupation',
                'father_age_at_birth', 'parents_marriage_date', 'parents_marriage_place', 'attendant_type',
                'attendant_other', 'birth_time_certified', 'informant_name', 'informant_relationship',
                'informant_address', 'received_by_civil_registrar', 'civil_registrar_name',
                'civil_registrar_title', 'civil_registrar_date'
            ]);
        });
    }
};
