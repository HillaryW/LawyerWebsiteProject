<?php
/**
 * Created by PhpStorm.
 * User: Hillary
 * Date: 5/16/2017
 * Time: 11:25 AM
 */

// Include the PHPWord.php, all other classes were loaded by an autoloader
require_once 'phpWordLib/PHPWord.php';



function will($userData, $radioBtns) {

    $will = new PHPWord();

    $willDoc = $will->loadTemplate('/home/attorneyatlaw/IslamicWillTemplate.docx');


    setWillValues($userData, $radioBtns, $willDoc);
    saveDoc($userData, $willDoc, 'LWAT.docx');

}

function POA($userData, $radioBtns)
{
    $POA = new PHPWord();

    $poaDoc = $POA->loadTemplate('/home/attorneyatlaw/POATemplate.docx');


    setPOAValues($userData, $radioBtns, $poaDoc);
    saveDoc($userData, $poaDoc, 'POA.docx');
}

function healthPOA($userData, $radioBtns) {

    // Create a new PHPWord Object
    $HealthPOA = new PHPWord();

    $hpoaDoc = $HealthPOA->loadTemplate('/home/attorneyatlaw/POAHealthTemplate.docx');

    setPOAValues($userData, $radioBtns, $hpoaDoc);
    saveDoc($userData, $hpoaDoc, 'POAHealth.docx');
}

function setPOAValues($userData, $radioBtns, $phpDoc) {

    $principal = $userData['First Name'] . " " . $userData['Last Name'];

    // Set poa values in the template document
    $phpDoc->setValue('Principal', $principal);
    $phpDoc->setValue('AIF', $userData['Attorney-in-fact First Name'] .
        ' ' . $userData['Attorney-in-fact Last Name']);
    $phpDoc->setValue('AIF2', $userData['Attorney-in-fact2 First Name'] .
        ' ' . $userData['Attorney-in-fact2 Last Name']);
}

function setWillValues($userData, $radioBtns, $willDoc) {

    $predeceasedChildren =  "";
    $children = "";
    $wasiyaaProportion = "";

    //person creating the will
    $testator = $userData['First Name'] . " " . $userData['Last Name'];

    $spouse = $userData['Spouse First Name'] . " " . $userData['Spouse Last Name'];

    //first personal rep
    $personalRep = $userData['Personal Rep First Name'] . " " .
        $userData['Personal Rep Last Name'];

    $altPersonalRep = $userData['Alt Personal Rep First Name'] . " " .
        $userData['Alt Personal Rep Last Name'];

    // TODO: $alt2PersonalRep;




    $wasiyyaPercent = $radioBtns['Wasiyya Percent'];

    foreach ($userData['Wasiyya Beneficiary'] as $bene) {
        $wasiyaaProportion .= $bene . " ";
    }



    if(sizeof($userData['Children']) > 1){
        $aliveChildOrChildren = "children";
    } else if (sizeof($userData['Children']) == 1) {
        $aliveChildOrChildren = "child";
    }

    $guardian = $userData['Guardian First Name'] . " " .
        $userData['Guardian Last Name'];;

    $altGuardian = $userData['Alt-Guardian First Name'] . " " . $userData['Alt-Guardian Last Name'];

    if(sizeof($userData['predeceasedChildren']) > 1){
        $decChildOrChildren = "children";
    } else if (sizeof($userData['predeceasedChildren']) == 1) {
        $decChildOrChildren = "child";
    }

    foreach ($userData['Children'] as $child) {
        $children .= $child . " ";
    }



    foreach ($userData['Predeceased Children'] as $child) {
        $predeceasedChildren .= $child . " ";
    }



    //if will creator has spouse, living children, and deceased children
    if($radioBtns['Has Spouse'] == 'yes' && $radioBtns['Has Dependent'] == 'yes'
        && $radioBtns['Has Predeceased'] == 'no'){

        $family = "My immediate family consists of my spouse, " . $spouse . " and my children " . $children . " . I have no deceased children.  
Except as provided below, I make no provision in this Will for any of my children who survive me, 
whether named herein or hereafter born or adopted, nor for the descendants of any child who 
does not survive me. ";
    }
    //has spouse and living children
    else if($radioBtns['Has Spouse'] == 'yes' && $radioBtns['Has Dependent'] == 'yes' &&
        $radioBtns['Has Predeceased'] == 'yes') {

        $family = "My immediate family consists of my spouse, "
        . $spouse . " and my " . $aliveChildOrChildren . " " . $children .
            ". My " . $decChildOrChildren . " " . $predeceasedChildren . " have predeceased me. 
Except as provided below, I make no provision in this Will for any of my children who survive 
me, whether named herein or hereafter born or adopted, nor for the descendants of any child 
who does not survive me.";

    } else if ($radioBtns['Has Spouse'] == 'no' && $radioBtns['Has Predeceased'] == 'no' &&
        $radioBtns['Has Dependent'] == 'yes') {

        $family = "I am unmarried. My immediate family consists of my " .
            $aliveChildOrChildren . $children . ". I have no deceased children. Except as 
provided below, I make no provision in this Will for any of my children who survive me, 
whether named herein or hereafter born or adopted, nor for the descendants of any child who 
does not survive me.";

    } else if ($radioBtns['Has Spouse'] == 'no' && $radioBtns['Has Predeceased'] == 'no' &&
        $radioBtns['Has Dependent'] == 'no'){

        $family = "I am unmarried and have no children. 
I have no deceased children. Except as provided below, I make no provision in this Will for 
any of my children who survive me, whether named herein or hereafter born or adopted, nor for 
the descendants of any child who does not survive me.";

    } else if ($radioBtns['Has Spouse'] == 'no' && $radioBtns['Has Predeceased'] == 'yes' &&
        $radioBtns['Has Dependent'] == 'yes'){

        $family = "I am unmarried. My immediate family consists of my ". $aliveChildOrChildren .
            $children . ". My " . $decChildOrChildren . $predeceasedChildren .
            " have predeceased me. Except as provided below, I make no provision in this Will "
        . "for any of my children who survive me, whether named herein or hereafter born or adopted,"
            . " nor for the descendants of any child who does not survive me.";

    }




    $willDoc->setValue('TESTATOR', $testator);
    $willDoc->setValue('IdentFam', $family);
    $willDoc->setValue('PersonalRep', $personalRep);
    $willDoc->setValue('AltPersonalRep', $altPersonalRep);
    $willDoc->setValue('2AltPersonalRep', "TODO");
    $willDoc->setValue('WasiyyaPercent', $wasiyyaPercent);
    $willDoc->setValue('WasiyyaPortion', $wasiyaaProportion);
    $willDoc->setValue('Guardian', $guardian);
    $willDoc->setValue('ALTGUARDIAN', $altGuardian);

}

function saveDoc($userData, $phpDoc, $fileExt) {
    $phpDoc->save($userData["First Name"] . $userData["Last Name"] . $fileExt );
}

?>