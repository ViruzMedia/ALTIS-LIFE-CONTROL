<?php

/* 
 * Copyright (c) 2015, Pictureclass
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted. 
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

function gear_convert($input){
    
    if($input != '"[]"'){
        
        $output = array();
        $output = substr($input, 2, -3);
        $output = str_replace("],[", "|", $output);
        $output = str_replace("],", "|", $output);
        $output = str_replace(",[", "|", $output);
        $output = str_replace("]", "|", $output);
        $output = str_replace("[", "|", $output);
        $output = str_replace("``", "-", $output);
        $output = str_replace("`", "", $output);

        //$output_civ_gear = preg_match_all("/\\|(.*?)\|/", $output_civ_gear, $output);
        $output = explode("|",$output);
        
    }
    else {
      $output = false;
    }
    return $output;
    
    /*
     * 0 = Clothing (Uniform, Vest, Backpack, Headgear, Glasses)
     * 1 = Toolbelt Items
     * 2 = Primary and Secondary Weapon
     * 3 = Uniform Items (Like First Aid Kit, Map or something in the Uniform)
     * 4 = Uniform Ammunition (Magazines, Greandes, dont know if also Optics)
     * 5 = Backpack Items (Like First Aid Kit, Map, or something int the Backpack)
     * 6 = Backpack Ammunition (Magazines, Greandes, dont know if also Optics)
     * 7 = Vest Items (Like First Aid Kit, Map, or something int the Backpack)
     * 8 = Vest Ammunition (Magazines, Greandes, dont know if also Optics)
     * 9 = Primary Weapon Attatchments
     * 10 = Secondary Weapon Attatchments
     * 11 = Virtuell Altis Life Items
     */
}