<?php

session_start();
if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
    header("location:login");
}
include 'assets/includes/header.inc.php';
include_once 'assets/includes/ModalAutoPopulate.php';

/*
 *  Team Red Hot Chili Jellos
 *  Chris Barbour, Ramona Graham, Josh Lyon, Hillary Wagoner
 *  File: docWizard.php
 *  Purpose: This file will generate a basic will for clients to purchase.
 */
?>
<!-- Custom Form Modal Stylesheet -->
<link rel="stylesheet" href="assets/css/docWizard.css"/>

<title>Document Creator</title>
<meta name="description" content="Generate a basic estate planning package, or purchase a will or
durable power of attorney separately.">

<?php
include 'assets/includes/navbar.inc.php';
?>
<div id="modal-page">
    <br/>
    <br/>
    <br/>
    <!-- Trigger/Open The Modal -->
    <div id="disclosure">
        <h2 style="text-align: center;">TERMS AND CONDITIONS</h2>
        <ol>
            <li><strong>Introduction</strong></li>
        </ol>
        <p>These Website Standard Terms and Conditions written on this webpage shall manage your use of this website.
            These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed
            to accept all terms and conditions written in here. You must not use this Website if you disagree with any
            of these Website Standard Terms and Conditions.</p>
        <p>Minors or people below 18 years old are not allowed to use this Website.</p>
        <ol start="2">
            <li><strong>Intellectual Property Rights</strong></li>
        </ol>
        <p>Other than the content you own, under these Terms, Arthur Delong and/or its licensors own all the
            intellectual
            property rights and materials contained in this Website.</p>
        <p>You are granted limited license only for
            purposes of viewing the material contained on this Website.</p>
        <ol start="3">
            <li><strong>Restrictions</strong></li>
        </ol>
        <p>You are specifically restricted from all of the following</p>
        <ul>
            <li>publishing any Website material in any other media;</li>
            <li>selling, sublicensing and/or otherwise
                commercializing any Website material;
            </li>
            <li>publicly performing and/or showing any
                Website material;
            </li>
            <li>using this Website in any way that is or may be damaging to this Website;</li>
            <li>using this Website in any way that impacts user access to this Website;</li>
            <li>using this Website contrary to applicable laws and regulations, or in any way may cause harm to the
                Website, or to any person or business entity;
            </li>
            <li>engaging in any data mining, data harvesting,
                data extracting or any other similar activity in relation to this Website;
            </li>
            <li>using this Website to engage in any advertising or marketing.</li>
        </ul>
        <p>Certain areas of this Website are restricted from being access by you and Arthur Delong may further restrict
            access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password
            you may have for this Website are confidential and you must maintain confidentiality as well.</p>
        <ol start="4">
            <li><strong>Your Content</strong></li>
        </ol>
        <p>In these Website Standard Terms and Conditions,
            “Your Content” shall mean any audio, video text, images or other material you choose to display on this
            Website. By displaying Your Content, you grant Arthur Delong a non-exclusive, worldwide irrevocable, sub
            licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.</p>
        <p>Your Content must be your own and must not be invading any third-party’s rights. Arthur Delong reserves the
            right to remove any of Your Content from this Website at any time without notice.</p>
        <ol start="5">
            <li><strong>No warranties</strong></li>
        </ol>
        <p>This Website is provided “as is,” with all faults, and
            Arthur Delong express no representations or warranties, of any kind related to this Website or the materials
            contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>
        <ol start="6">
            <li><strong>Limitation of liability</strong></li>
        </ol>
        <p>In no event shall Arthur Delong, nor
            any of its officers, directors and employees, shall be held liable for anything arising out of or in any way
            connected with your use of this <a href="https://premiumlinkgenerator.com/" target="_blank">Website</a>
            whether such liability is under contract. &nbsp;Arthur Delong, including its officers, directors and
            employees shall not be held liable for any indirect, consequential or special liability arising out of or
            in any way related to your use of this Website.</p>
        <ol start="7">
            <li><strong>Indemnification</strong></li>
        </ol>
        <p>You hereby indemnify to the fullest extent Arthur Delong from and against any and/or all liabilities, costs,
            demands, causes of action, damages and expenses arising in any way related to your breach of any of the
            provisions of these Terms.</p>
        <ol start="8">
            <li><strong>Severability</strong></li>
        </ol>
        <p>If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be
            deleted without affecting the remaining provisions herein.</p>
        <ol start="9">
            <li><strong>Variation of Terms</strong></li>
        </ol>
        <p>Arthur Delong is permitted to revise these Terms at any
            time as it sees fit, and by using this Website you are expected to review these Terms on a regular
            basis.</p>
        <ol start="10">
            <li><strong>Assignment</strong></li>
        </ol>
        <p>Arthur Delong is allowed to assign, transfer,
            and subcontract its rights and/or obligations under these Terms without any notification. However, you
            are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these
            Terms.</p>
        <ol start="11">
            <li><strong>Entire Agreement</strong></li>
        </ol>
        <p>These Terms constitute the entire agreement
            between Arthur Delong and you in relation to your use of this Website, and supersede all prior agreements
            and understandings.</p>
        <ol start="12">
            <li><strong>Governing Law &amp; Jurisdiction</strong></li>
        </ol>
        <p>These Terms will be governed by and interpreted in accordance with the laws of the State of WA, and you
            submit to the non-exclusive jurisdiction of the state and federal courts located in WA for the resolution
            of any disputes.</p>
        <br/>
        <br/>
        <div id="disclosure-error" hidden>
            <p>Must accept terms and conditions to use this service</p>
        </div>
        <div>
            <input type="checkbox" id="accept" name="accept"> I have read and agree to the terms and conditions<br/>
            <button class="button" id="agree">Create Estate Planning</button>
        </div>
    </div>

    <!-- The Modal -->
    <div id="will-modal" class="modal">
        <!-- Modal content -->
        <div id="modal-content" class="modal-content">
            <!--<span class="close">&times;</span>-->
            <div id="validation" hidden>
                <p id="error-message" class="error"> Please complete all fields </p>
            </div>
            <div id="one"  hidden>
                <div>
                <label for="fName">First Name</label>
                <input type="text" name="fName" id="fName" value="<?php echo $row['firstname']; ?>"><br>

                <label for="lName">Last Name</label>
                <input type="text" name="lName" id="lName" value="<?php echo $row['lastname']; ?>"><br>

                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="<?php echo $row['username']; ?>"><br>

                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone"  value="1234567890" autofocus><br><br>
                </div>
                <div id="tooltips">
                    <h3>Tips to Enter Information</h3>
                    <p> Enter your legal name.
                    </p>
                </div>
            </div>

            <div id="will-wizard">
            </div>

            <div id="poa-wizard"></div>

            <div id="confirmation" hidden>
                <div id="user-input">
                </div>
                <br/>
                <p>Are you ready to submit your information?</p>
            </div>

            <div id="errors" hidden>
                <p>
                    Please fill out these fields:
                </p>
                <div id="errorResult">

                </div>

            </div>

            <div id="referral" hidden>
                <p>
                    Your needs are beyond what is included in the basic will package, an email will been sent to Arthur
                    and he will be in contact shortly.
                </p>
            </div>

            <div id="result" hidden>
                <p>
                    Thank you for your business.
                    Your information has been received and your documents will be emailed to you after review.
                </p>
            </div>

            <div id="payment" hidden>
                <p>
                    Please click "Purchase" button to pay for your Wasiyya Estate Planning Package.
                </p>
            </div>

            <div id="wizard-buttons" class="modal-buttons">
                <br/>
                <button id="wizard-back" name="wizard-backId" class="one-back" hidden>Back</button>
                <button id="wizard-next" name="wizard-nextId" class="one-next" hidden>Next</button>
                <button id="ok" name="ok" hidden>Ok</button>
                <button id="form-submit" name="form-submit" class="form-submit" hidden>Submit</button>
                <button id="purchase" name="purchase" class="purchase" hidden>Purchase </button>
            </div>

        </div>
    </div>
</div>

<script src="https://checkout.stripe.com/checkout.js"></script>
<?php
unset($row);
$conn = null;
include "assets/includes/willHTML.inc.php";
include "assets/includes/poaHTML.inc.php";
include_once 'assets/includes/footer.inc.php';
?>


