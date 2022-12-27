<?php

namespace App\Services;

interface SettingsServiceInterface {
    
    // Active Periods
    public function getActivePeriods();
    public function updateActivePeriods(Array $input);
    public function updateActivePeriod($input);

    // Active Forms
    public function getActiveForms();
    public function updateActiveForms(Array $input);
    public function updateActiveForm($input);

    // Receive Upcoming Solicitudes
    public function getReceiveUpcomingSolicitudes();
    public function updateReceiveUpcomingSolicitudes(Array $input);
    public function updateReceiveUpcomingSolicitude($input);

}