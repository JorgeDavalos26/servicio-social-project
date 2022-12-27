<?php 

namespace App\Services;

use App\Models\Setting;

class SettingsService implements SettingsServiceInterface {

    private $nameOfService;

    function __construct($nameOfService) {
        $this->nameOfService = $nameOfService;
    }

    // Active Periods

    public function getActivePeriods() {
        $activePeriods = Setting::where("key", "like", "PERIODS.%.ACTIVE_ID_PERIOD")->get();
        return $activePeriods;
    }

    public function updateActivePeriods(Array $input) {
        $periods = [];
        foreach ($input as $period) $periods[] = self::updateActivePeriod($period);
        return $periods;
    }

    public function updateActivePeriod($input) {
        $period = self::getActivePeriod($input['key']);
        if (isset($input['value'])) $period->value = $input['value'];
        if (isset($input['description'])) $period->description = $input['description'];
        $period->save();
        return $period;
    }

    private function getActivePeriod($key) {
        return Setting::where("key", $key)->first();
    }

    // Active Forms

    public function getActiveForms() {
        $activeForms = Setting::where("key", "like", "FORMS.%.ACTIVE_ID_FORM")->get();
        return $activeForms;
    }

    public function updateActiveForms(Array $input) {
        $forms = [];
        foreach ($input as $form) $forms[] = self::updateActiveForm($form); 
        return $forms;
    }

    public function updateActiveForm($input) {
        $form = self::getActiveForm($input["key"]);
        if (isset($input["value"])) $form->value = $input["value"];
        if (isset($input["description"])) $form->description = $input["description"];
        $form->save();
        return $form;
    }

    private function getActiveForm($key) {
        return Setting::where("key", $key)->first();
    }

    // Receive Upcoming Solicitudes

    public function getReceiveUpcomingSolicitudes() {
        $receiveUpcomingSolicitudes = Setting::where("key", "like", "SOLICITUDES.%.RECEIVE_UPCOMING")->get();
        return $receiveUpcomingSolicitudes;
    }

    public function updateReceiveUpcomingSolicitudes(Array $input) {
        $solicitudes = [];
        foreach ($input as $solicitude) $solicitudes[] = self::updateReceiveUpcomingSolicitude($solicitude);  
        return $solicitudes;
    }

    public function updateReceiveUpcomingSolicitude($input) {
        $solicitude = self::getReceiveUpcomingSolicitude($input["key"]);
        if (isset($input["value"])) $solicitude->value = $input["value"];
        if (isset($input["description"])) $solicitude->description = $input["description"];
        $solicitude->save();
        return $solicitude;
    }

    private function getReceiveUpcomingSolicitude($key) {
        return Setting::where("key", $key)->first();
    }

}