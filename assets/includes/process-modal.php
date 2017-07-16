<?php
/**
 * Created by PhpStorm.
 * User: Hillary
 * Date: 4/20/2017
 * Time: 8:38 AM
 */

require_once 'swiftMailer.php';
include 'wordDoc.php';

//script to process the docWizard.php form
$errMsg = false;
$swiftMailerData = "";
$userName = "";
$userEmail = "";



//Validate will and POA user input
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    $userData = $_POST['userInput'];
    $radioBtns = $_POST['radioBtns'];

    if (empty($userData['First Name'])) {
        $result[] = "First Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "First Name: " . $userData['First Name'] . "<br/>";
        $userName = $userData['First Name'];
    }
    if (empty($userData['Last Name'])) {
        $result[] = "Last Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Last Name: " . $userData['Last Name'] . "<br/>";
        $userName .= $userData['Last Name'];
    }
    if (empty($userData['Phone Number']) ||
        !validatePhone($userData['Phone Number'])
    ) {
        $result[] = "Invalid Personal Phone Number";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Phone Number: " . $userData['Phone Number'] . "<br/>";
    }
    if (empty($userData['Email']) || !filter_var($userData['Email'],
            FILTER_VALIDATE_EMAIL)
    ) {
        $result[] = "Personal Email";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Email: " . $userData['Email'] . "<br/>";
        $userEmail = $userData['Email'];
    }

    if (empty($userData['Personal Rep First Name'])) {
        $result[] = "Personal Representative First Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Personal Representative First Name: " .
            $userData['Personal Rep First Name'] . "<br/>";
    }
    if (empty($userData['Personal Rep Last Name'])) {
        $result[] = "Personal Representative Last Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Personal Representative Last Name: " .
            $userData['Personal Rep Last Name'] . "<br/>";
    }
    if (empty($userData['Personal Rep Email']) || !filter_var($userData['Personal Rep Email'],
            FILTER_VALIDATE_EMAIL)
    ) {
        $result[] = "Personal Representative Email";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Personal Representative Email: " .
            $userData['Personal Rep Email'] . "<br/>";
    }
    if (empty($userData['Personal Rep Phone Number']) || !validatePhone($userData['Personal Rep Phone Number'])) {
        $result[] = "Personal Representative Phone Number";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Personal Representative Phone Number: " .
            $userData['Personal Rep Phone Number'] . "<br/>";
    }
    if (empty($userData['Alt Personal Rep First Name'])) {
        $result[] = "Alternate Personal Representative First Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Alternate Personal Representative First Name: " .
            $userData['Alt Personal Rep First Name'] . "<br/>";
    }
    if (empty($userData['Alt Personal Rep Last Name'])) {
        $result[] = "Alternate Personal Representative Last Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Alternate Personal Representative Last Name: " .
            $userData['Alt Personal Rep Last Name'] . "<br/>";
    }
    if (empty($userData['Alt Personal Rep Email']) ||
        !filter_var($userData['Alt Personal Rep Email'], FILTER_VALIDATE_EMAIL)
    ) {
        $result[] = "Alternate Personal Representative Email";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Alternate Personal Representative Email: " .
            $userData['Alt Personal Rep Email'] . "<br/>";
    }
    if (empty($userData['Alt Personal Rep Phone Number']) ||
        !validatePhone($userData['Alt Personal Rep Phone Number'])
    ) {
        $result[] = "Alternate Personal Representative Phone Number";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Alternate Personal Representative Phone Number: " .
            $userData['Personal Rep Phone Number'] . "<br/>";
    }
    // Validate Spouse info
    if ($radioBtns['Has Spouse'] == 'yes') {
        if (empty($userData['Spouse First Name'])) {
            $result[] = "Spouse Frist Name";
            $errMsg = true;
        } else {
            $swiftMailerData .= "Spouse First Name: " . $userData['Spouse First Name'] . "<br/>";
        }
        if (empty($userData['Spouse Last Name'])) {
            $result [] = "Spouse Last Name";
            $errMsg = true;
        } else {
            $swiftMailerData .= "Spouse Last Name: " . $userData['Spouse Last Name'] . "<br/>";
        }
        if (empty($userData['Residence To Spouse'])) {
            $result [] = 'Decide if Primary Residence goes to Spouse';
            $errMsg = true;
        } else {
            $swiftMailerData .= "Leave primary residence to spouse: " .
                $userData['Residence To Spouse'] . "<br/>";
        }
        if (empty($userData['Personal To Spouse'])) {
            $result [] = 'Decide if Personal Effects go to Spouse';
            $errMsg = true;
        } else {
            $swiftMailerData .= "Leave personal effects to spouse: " . $userData['Personal To Spouse']
                . "<br/>";
        }
    }

    // validate living child[ren]
    if (sizeof($userData['Children']) > 0 && $radioBtns['Has Dependent'] == 'yes') {
        foreach ($userData['Children'] as $child) {
            $swiftMailerData .= "Child: " . $child . "<br/>";
        }
        if (!empty($radioBtns["Minors"]) && $radioBtns["Minors"] == 'yes') {
            if (!empty($userData['Guardian First Name']) && !empty($userData['Guardian Last Name'])
                && !empty($userData['Guardian City']) && !empty($userData['Guardian State'])
                && !empty($userData['Guardian Country'])
            ) {
                $swiftMailerData .= "Guardian First Name: " . $userData['Guardian First Name'] . "<br/>";
                $swiftMailerData .= "Guardian Last Name: " . $userData['Guardian Last Name'] . "<br/>";
                $swiftMailerData .= "Guardian City: " . $userData['Guardian City'] . "<br/>";
                $swiftMailerData .= "Guardian State: " . $userData['Guardian State'] . "<br/>";
                $swiftMailerData .= "Guardian Country: " . $userData['Guardian Country'] . "<br/>";
            } else {
                $result[] = "Guardian Information";
                $errMsg = true;
            }
            if (!empty($userData['Alt-Guardian First Name']) && !empty($userData['Alt-Guardian Last Name'])
                && !empty($userData['Alt-Guardian City']) && !empty($userData['Alt-Guardian State'])
                && !empty($userData['Alt-Guardian Country'])
            ) {
                $swiftMailerData .= "Alternate Guardian First Name: " . $userData['Alt-Guardian First Name'] . "<br/>";
                $swiftMailerData .= "Alternate Guardian Last Name: " . $userData['Alt-Guardian Last Name'] . "<br/>";
                $swiftMailerData .= "Alternate Guardian City: " . $userData['Alt-Guardian City'] . "<br/>";
                $swiftMailerData .= "Alternate Guardian State: " . $userData['Alt-Guardian State'] . "<br/>";
                $swiftMailerData .= "Alternate Guardian Country: " . $userData['Alt-Guardian Country'] . "<br/>";
            } else {
                $result[] = "Alternate Guardian Information";
                $errMsg = true;
            }
        } elseif (!empty($radioBtns["Minors"]) || $radioBtns["Minors"] == 'yes') {
            $result[] = "Guardian Information";
            $errMsg = true;
        } else {
            $swiftMailerData .= "No Minor Children <br/>";
        }
    } elseif (sizeof($userData['Children']) > 0 || $radioBtns['Has Dependent'] == 'yes') {
        $result[] = "Have Children or add child";
        $errMsg = true;
    } else {
        $swiftMailerData .= "No Children <br/>";
    }
    if (sizeof($userData['Predeceased Children']) > 0 &&
        $radioBtns['Has Predeceased'] == 'yes'
    ) {
        foreach ($userData['Predeceased Children'] as $child) {
            $swiftMailerData .= "Predeceased Child: " . $child . "<br/>";
        }
    } elseif (sizeof($userData['Predeceased Children']) > 0 ||
        $radioBtns['Has Predeceased'] == 'yes'
    ) {
        $result[] = "Have predeceased child[ren] or add predeceased child";
        $errMsg = true;
    } else {
        $swiftMailerData .= "No Predeceased Children <br/>";
    }

    // Wasiyya Bequest and Beneficiary
    if (sizeof($userData['Wasiyya Beneficiary']) > 0
        && $radioBtns['Wasiyya Bequest'] == 'yes'
    ) {
        foreach ($userData['Wasiyya Beneficiary'] as $beneficiary) {
            $swiftMailerData .= "Wasiyya Beneficiary: " . $beneficiary . "<br/>";
        }
    } elseif (sizeof($userData['Wasiyya Beneficiary']) > 0
        || $radioBtns['Wasiyya Beneficiary'] == 'yes'
    ) {
        $result[] = "Select Wasiyya Bequest or add Wasiyya Beneficiary";
        $errMsg = true;
    } else {
        $swiftMailerData .= "No Wasiyya Bequest <br/>";
    }

    // Attorney-in-fact
    if (empty($userData['Attorney-in-fact First Name'])) {
        $result[] = "Attorney-in-fact First Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Attorney-in-fact First Name: " .
            $userData['Attorney-in-fact First Name'] . "<br/>";
    }
    if (empty($userData['Attorney-in-fact Last Name'])) {
        $result[] = "Attorney-in-fact Last Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Attorney-in-fact Last Name: " .
            $userData['Attorney-in-fact Last Name'] . "<br/>";
    }
    if (empty($userData['Attorney-in-fact Email']) ||
        !filter_var($userData['Attorney-in-fact Email'], FILTER_VALIDATE_EMAIL)
    ) {
        $result[] = "Attorney-in-fact Email";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Attorney-in-fact Email: " .
            $userData['Attorney-in-fact Email'] . "<br/>";
    }
    if (empty($userData['Attorney-in-fact Phone Number'])
        || !validatePhone($userData['Attorney-in-fact Phone Number'])
    ) {
        $result[] = "Attorney-in-fact Phone Number";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Attorney-in-fact Phone Number: " .
            $userData['Attorney-in-fact Phone Number'] . "<br/>";
    }
    if ($errMsg) {
        $ajaxResult = json_encode($result);
    } else {
        $ajaxResult = "No Errors";
       //POA($userData, $radioBtns);
        //healthPOA($userData, $radioBtns);
        will($userData, $radioBtns);
        //sendEmails($swiftMailerData, $userName, $userEmail);
    }

    // Referral Validation
} else if (isset($_POST['referral']) && !empty($_POST['referral'])) {
    $userData = $_POST['userInput'];
    $radioBtns = $_POST['radioBtns'];

    if (empty($userData['First Name'])) {
        $result[] = "First Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "First Name: " . $userData['First Name'] . "<br/>";
        $userName = $userData['First Name'];
    }
    if (empty($userData['Last Name'])) {
        $result[] = "Last Name";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Last Name: " . $userData['Last Name'] . "<br/>";
        $userName .= $userData['Last Name'];
    }
    if (empty($userData['Phone Number'])) {
        $result[] = "Phone Number";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Phone Number: " . $userData['Phone Number'] . "<br/>";
    }
    if (empty($userData['Email'])) {
        $result[] = "Email";
        $errMsg = true;
    } else {
        $swiftMailerData .= "Email: " . $userData['Email'] . "<br/>";
        $userEmail = $userData['Email'];
    }
    if (!empty($radioBtns['business']) && $radioBtns['business'] == 'yes') {
        $swiftMailerData .= "Client has a business <br/>";
    }
    if (!empty($radioBtns['maxAssets']) && $radioBtns['maxAssets'] == 'yes') {
        $swiftMailerData .= "Client has more than $2 million in assets <br/>";
    }
    if (!empty($radioBtns['realEstate']) && $radioBtns['realEstate'] == 'yes') {
        $swiftMailerData .= "Client has multiple real estate holdings <br/>";
    }
    if (!empty($radioBtns['providePredeceased']) && $radioBtns['providePredeceased'] == 'yes') {
        $swiftMailerData .=
            "Client has grandchildren of predeceased child[ren] they would like to provide for <br/>";
    }
    if ($errMsg) {
        $ajaxResult = json_encode($result);
    } else {
        $ajaxResult = "No Errors";
        sendReferralEmail($swiftMailerData);
    }
}
echo 'No Errors';

function validatePhone($string)
{
    $numbersOnly = preg_replace("[^0-9]", "", $string);
    $numberOfDigits = strlen($numbersOnly);
    if ($numberOfDigits == 7 or $numberOfDigits == 10) {
        return true;
    } else {
        return false;
    }
}

?>