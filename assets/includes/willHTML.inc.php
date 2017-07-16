<?php
/**
 * Created by PhpStorm.
 * User: Hillary
 * Date: 5/5/2017
 * Time: 11:25 AM
 */

require_once('assets/includes/stripe/config.php');
?>


<div id="two" hidden>
    <div id="a">
        <label for="business">Do you have a business?</label>
        <label><input type="radio" id="business" name="business" value="yes"> Yes</label>
        <label><input type="radio" id="business" name="business" value="no" CHECKED> No </label>
    </div>
    <div id="tooltips">
        <h3>Tips to Enter Information</h3>
        <p> Enter your legal name.
        </p>
    </div>

    <div id="b" hidden>
        <label for="maxAssets">Do you have more than 2 million in assets?</label>
        <label><input type="radio" id="maxAssets" name="maxAssets" value="yes"> Yes </label>
        <label><input type="radio" id="maxAssets" name="maxAssets" value="no" CHECKED> No </label>
        <br/>
    </div>

    <div id="c" hidden>
        <label for="realEstate">Do you own more real estate than your primary residence?</label>
        <label><input type="radio" id="realEstate" name="realEstate" value="yes"> Yes </label>
        <label><input type="radio" id="realEstate" name="realEstate" value="no" CHECKED> No </label>
        <br/>
    </div>
</div>

<div id="primary-residence" hidden>
    <label for="own-home">Do you own your primary residence?</label>
    <label><input type="radio" id="own-home" name="own-home" value="yes" CHECKED> Yes </label>
        <label><input type="radio" id="own-home" name="own-home" value="no"> No </label>
</div>

<div id="three" hidden>
    <label for="spouse"> Are you Married? </label>
    <label><input type="radio" id="spouse" name="spouse" value="yes"> Yes </label>
    <label><input type="radio" id="spouse" name="spouse" value="no"> No  </label>

    <div id="spouse-info" hidden>
        <label for="spouseFirstName">Spouse's First Name</label>
        <input type="text" name="spouseFirstName" id="spouseFirstName"><br>

        <label for="spouseLastName">Last Name</label>
        <input type="text" name="spouseLastName" id="spouseLastName"><br>
        <div id="personal-residence-to-spouse" hidden>
            <label for="residence-to-spouse">Do you want to leave your entire personal residence to your spouse?</label>
            <label><input type="radio" id="residence-to-spouse" name="residence-to-spouse" value="yes"> Yes </label>
            <label><input type="radio" id="residence-to-spouse" name="residence-to-spouse" value="no"> No </label>
        </div>
        <label for="personal-to-spouse">Do you want to leave your personal effects to your spouse?</label>
        <label><input type="radio" id="personal-to-spouse" name="personal-to-spouse" value="yes"> Yes </label>
        <label><input type="radio" id="personal-to-spouse" name="personal-to-spouse" value="no"> No </label>
    </div>
</div>

<div id="four" hidden>
    <label for="dependent">Do you have any living children?</label>
    <label><input type="radio" id="dependent" name="dependent" value="yes"> Yes </label>
    <label><input type="radio" id="dependent" name="dependent" value="no"> No </label>
    <br/>
</div>

<div id="adopted" hidden>
    <label for="adopted-child">Are any of these children adopted?</label>
    <label><input type="radio" id="adopted-child" name="adopted-child" value="yes"> Yes</label>
    <label><input type="radio" id="adopted-child" name="adopted-child" value="no" CHECKED> No</label>
    <br/>
</div>

<div id="dependent-info" hidden>
    <label for="childFirstName">Child First Name</label>
    <input type="text" id="childFirstName" name="childFirstName"><br>
    <label for="childLastName">Child Last Name</label>
    <input type="text" id="childLastName" name="childLastName"><br>
    <label for="child-age">Child's Age</label>
    <input type="number" id="child-age" name="child-age" min="1"><br/>
    <div id="children">
    </div>
    <br/>
    <button id="add-child">Add Child</button>
</div>

<div id="predeceased" hidden>
    <label for="predeceased-child">Do you have any children that have predeceased you?</label>
    <label><input type="radio" id="predeceased-child" name="predeceased-child" value="yes"> Yes</label>
    <label><input type="radio" id="predeceased-child" name="predeceased-child" value="no"> No</label>

    <div id="provide-for-predeceased" hidden>
        <label for="predeceased-provide">
            Did any of your predeceased children have children you would like to provide for with this will?
        </label>
        <label><input type="radio" id="predeceased-provide" name="predeceased-provide" value="yes"> Yes</label>
        <label><input type="radio" id="predeceased-provide" name="predeceased-provide" value="no" CHECKED> No</label>
    </div>
</div>

<div id="predeceased-info" hidden>
    <label for="pdFirstName">Child First Name</label>
    <input type="text" id="pdFirstName" name="pdFirstName"><br>
    <label for="pdLastName">Child Last Name</label>
    <input type="text" id="pdLastName" name="pdLastName"><br>
    <div id="pdchildren">
    </div>
    <br/>
    <button id="add-predeceased">Add Child</button>
</div>

<div id="minors" hidden>
    <div id="guardian">
        <label>Who would you like to designate as guardian for your minor children?</label>
        <label for="guardian-name">First Name</label>
        <input type="text" id="guardian-Fname" name="guardian-Fname"><br>
        <label for="guardian-name">Last Name</label>
        <input type="text" id="guardian-Lname" name="guardian-Lname"><br>
        <label for="guardian-city">City</label>
        <input type="text" id="guardian-city" name="guardian-city"><br>
        <label for="guardian-state">State</label>
        <input type="text" id="guardian-state" name="guardian-state"><br/>
        <label for="guardian-country">Country</label>
        <input type="text" id="guardian-country" name="guardian-country"><br/>

    </div>
    <div id="alt-guardian" hidden>
        <label>Who would you like to designate as an alternate guardian?</label>
        <label for="alt-guardian-name">First Name</label>
        <input type="text" id="alt-guardian-Fname" name="alt-guardian-Fname"><br>
        <label for="alt-guardian-name">Last Name</label>
        <input type="text" id="alt-guardian-Lname" name="alt-guardian-Lname"><br>
        <label for="alt-guardian-city">City</label>
        <input type="text" id="alt-guardian-city" name="alt-guardian-city"><br>
        <label for="alt-guardian-state">State</label>
        <input type="text" id="alt-guardian-state" name="alt-guardian-state"><br/>
        <label for="alt-guardian-country">Country</label>
        <input type="text" id="alt-guardian-country" name="alt-guardian-country"><br/>
    </div>
</div>

<div id="wasiyya-bequest" hidden>
    <label for="designate">
        Would you like to designate a part of your estate as a Wasiyya Bequest to certain beneficiaries?
    </label>
    <label><input type="radio" id="designate" name="designate" value="yes"> Yes</label>
    <label><input type="radio" id="designate" name="designate" value="no"> No</label>

    <div id="bequest-percentage" hidden>
        <div class="error" id="bequest-percent-error" hidden>
            <p>Can not be greater than 33%</p>
        </div>
        <label for="bequest-percent">What percentage would you like to designate (Up to 33%)?</label>
        <input type="number" id="bequest-percent" name="bequest-percent" min="1" max="33">
    </div>
</div>

<div id="bequest-info" hidden>
    <div id="total-percent-error" class="error" hidden>
        The total percent must be 100%
    </div>
    <label for="beneficiary-name">Name of person or organization</label>
    <input type="text" id="beneficiary-name" name="beneficiary-name"><br>
    <label for="beneficiary-city">City</label>
    <input type="text" id="beneficiary-city" name="beneficiary-city"><br>
    <label for="beneficiary-state">State</label>
    <input type="text" id="beneficiary-state" name="beneficiary-state"><br/>
    <label for="beneficiary-country">Country</label>
    <input type="text" id="beneficiary-country" name="beneficiary-country"><br/>
    <div id="percent-error" class="error" hidden>
        The total percentage cannot be over 100%
    </div>
    <label for="beneficiary-percent">Percent of Wasiyya Bequest</label>
    <input type="number" id="beneficiary-percent" name="beneficiary-percent" min="1" max="100"><br/>
    <div id="added-beneficiaries">
    </div>
    <br/>
    <button id="add-beneficiary">Add Beneficiary</button>
</div>

<div id="five" hidden>
    <div id="personalRepresentative-info">
        <label for="personal-rep-fName">Personal Representative First Name</label>
        <input type="text" id="personal-rep-fName"><br>

        <label for="personal-rep-LName">Personal Representative Last Name</label>
        <input type="text" id="personal-rep-LName"><br>

        <label for="personal-rep-phoneNum">Phone Number</label>
        <input type="text" id="personal-rep-phoneNum" placeholder="eg 5557774444"><br>

        <label for="personal-rep-email">Email Address</label>
        <input type="email" id="personal-rep-email" name="personal-rep-email"><br><br>
    </div>

    <div id="alt-personalRepresentative-info" hidden>
        <label for="alt-personal-rep-fName">Alternate Personal Representative First Name</label>
        <input type="text" id="alt-personal-rep-fName"><br>

        <label for="alt-personal-rep-LName">Alternate Personal Representative Last Name</label>
        <input type="text" id="alt-personal-rep-LName"><br>

        <label for="alt-personal-rep-phoneNum">Phone Number</label>
        <input type="text" id="alt-personal-rep-phoneNum" placeholder="eg 5557774444"><br>

        <label for="alt-personal-rep-email">Email Address</label>
        <input type="email" id="alt-personal-rep-email" name="personal-rep-email"><br><br>
    </div>
</div>

