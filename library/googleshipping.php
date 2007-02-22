<?php

/**
 * Copyright (C) 2006 Google Inc.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

  class GoogleFlatRateShipping {

    var $price;
    var $name;
    var $type = "flat-rate-shipping";

    var $allowed_restrictions = false;
    var $excluded_restrictions = false;

    var $allowed_country_area;
    var $allowed_state_areas_arr;
    var $allowed_zip_patterns_arr;

    var $excluded_country_area;
    var $excluded_state_areas_arr;
    var $excluded_zip_patterns_arr;

    function GoogleFlatRateShipping($name, $price) {
      $this->price = $price;
      $this->name = $name;

      $this->allowed_state_areas_arr = array();
      $this->allowed_zip_patterns_arr = array();

      $this->excluded_state_areas_arr = array();
      $this->excluded_zip_patterns_arr = array();
    }

    function SetAllowedCountryArea($country_area) {
      if($country_area == "CONTINENTAL_48" ||
         $country_area == "FULL_50_STATES" || 
         $country_area == "ALL" ) {
        $this->allowed_country_area = $country_area;
        $this->allowed_restrictions = true;
      }
      else
        $this->allowed_country_area = "";
    }

    function SetAllowedStateAreas($areas) {
      $this->allowed_restrictions = true;
      $this->allowed_state_areas_arr = $areas;
    }

    function SetAllowedZipPattens($zips) {
      $this->allowed_restrictions = true;
      $this->allowed_zip_patterns_arr = $zips;
    }

    function SetExcludedStateAreas($areas) {
      $this->excluded_restrictions = true;
      $this->excluded_state_areas_arr = $areas;
    }

    function SetExcludedZipPatternsStateAreas($zips) {
      $this->excluded_restrictions = true;
      $this->excluded_zip_patterns_arr = $zips;
    }

    function SetExcludedCountryArea($country_area) {
      if($country_area == "CONTINENTAL_48" ||
         $country_area == "FULL_50_STATES" || 
         $country_area == "ALL" ) {
        $this->excluded_country_area = $country_area;
        $this->excluded_restrictions = true;
      }
      else
        $this->excluded_country_area = "";
    }
  }

  class GoogleMerchantCalculatedShipping {

    var $price;
    var $name;
    var $type = "merchant-calculated-shipping";

    var $allowed_restrictions = false;
    var $excluded_restrictions = false;

    var $allowed_country_area;
    var $allowed_state_areas_arr;
    var $allowed_zip_patterns_arr;

    var $excluded_country_area;
    var $excluded_state_areas_arr;
    var $excluded_zip_patterns_arr;

    function GoogleMerchantCalculatedShipping($name, $price) {
      $this->price = $price;
      $this->name = $name;

      $this->allowed_state_areas_arr = array();
      $this->allowed_zip_patterns_arr = array();

      $this->excluded_state_areas_arr = array();
      $this->excluded_zip_patterns_arr = array();
    }

    function SetAllowedCountryArea($country_area) {
      if($country_area == "CONTINENTAL_48" ||
         $country_area == "FULL_50_STATES" || 
         $country_area == "ALL" ) {
        $this->allowed_country_area = $country_area;
        $this->allowed_restrictions = true;
      }
      else
        $this->allowed_country_area = "";
    }

    function SetAllowedStateAreas($areas) {
      $this->allowed_restrictions = true;
      $this->allowed_state_areas_arr = $areas;
    }

    function SetAllowedZipPattens($zips) {
      $this->allowed_restrictions = true;
      $this->allowed_zip_patterns_arr = $zips;
    }

    function SetExcludedStateAreas($areas) {
      $this->excluded_restrictions = true;
      $this->excluded_state_areas_arr = $areas;
    }

    function SetExcludedZipPatternsStateAreas($zips) {
      $this->excluded_restrictions = true;
      $this->excluded_zip_patterns_arr = $zips;
    }

    function SetExcludedCountryArea($country_area) {
      if($country_area == "CONTINENTAL_48" ||
         $country_area == "FULL_50_STATES" || 
         $country_area == "ALL" ) {
        $this->excluded_country_area = $country_area;
        $this->excluded_restrictions = true;
      }
      else
        $this->excluded_country_area = "";
    }
  }

  class GooglePickUp {

    var $price;
    var $name;
    var $type;

    function GoogleMerchantCalculatedShipping($name, $price) {
      $this->price = $price;
      $this->name = $name;
      $type = "pickup";
    }
  }
?>
