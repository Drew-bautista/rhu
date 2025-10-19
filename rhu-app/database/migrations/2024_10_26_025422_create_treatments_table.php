<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            // $table->unsignedBigInteger('health_assessment_id');
            $table->dateTime('consultation_date_time');
            $table->text('chief_complaint')->nullable();
            $table->text('laboratory_findings')->nullable();
            $table->text('assessment_diagnosis')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('medication_treatment')->nullable();
            $table->text('personal_social_history')->nullable();
            $table->text('pregnancy_history')->nullable();
            // $table->text('interpretation_comments')->nullable();
            // $table->text('recommendations')->nullable();
            // $table->text('prescriptions')->nullable();
            // $table->text('result_summary')->nullable();
            $table->timestamps();

            // Foreign keys
            // $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            // $table->foreign('health_assessment_id')->references('id')->on('health_assessments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treatments');
    }
}
