<?php
require_once 'swiftMailerLib/lib/swift_required.php';

/**
 * Created by PhpStorm.
 * User: Hillary
 * Date: 4/24/2017
 * Time: 12:19 PM
 */


function sendEmails($body, $name, $userEmail)
{
    // Create the Transport
    $transport = Swift_SmtpTransport::newInstance('mail.attorney-at-law.greenrivertech.net', 25)
        ->setUsername('rhcj-email@attorney-at-law.greenrivertech.net')
        ->setPassword('capstone01');

    // Create the Mailer using your created Transport
    $mailer = Swift_Mailer::newInstance($transport);

    // Create the message to Arthur
    $messageToArthur = Swift_Message::newInstance()
        // Give the message a subject
        ->setSubject('A new purchase has been made')
        // Set the From address with an associative array
        ->setFrom(array('Delongwebsite@gmail.com' => 'Arthur DeLong Website'))
        // Set the To addresses with an associative array
        ->setTo(array('hwagoner@mail.greenriver.edu' => 'Hillary Wagoner'))
        // Give it a body
        ->setBody($body, 'text/html');

    //add attachments
    if (file_exists($name . 'POAHealth.docx')) {
        $messageToArthur->attach(Swift_Attachment::fromPath($name . 'POAHealth.docx'));
    }
    if (file_exists($name . 'POA.docx')) {
        $messageToArthur->attach(Swift_Attachment::fromPath($name . 'POA.docx'));
    }
    if (file_exists($name . 'WillTest.docx')) {
        $messageToArthur->attach(Swift_Attachment::fromPath($name . 'Will.docx'));
    }


    // Create the message to the client who purchased documents
    $messageToUser = Swift_Message::newInstance()
        // Give the message a subject
        ->setSubject('Purchased Estate Planning Documents')
        // Set the From address with an associative array
        ->setSender(array('delongwebsite@gmail.com' => 'Arthur DeLong'))
        // Set the To addresses with an associative array
        ->setTo(array($userEmail => $name))
        // Give it a body
        ->setBody('Thank you for your purchase! Your documents will be sent to you shortly.');

    // Send the message
    $mailer->send($messageToArthur);
    $mailer->send($messageToUser);
}

function sendReferralEmail($body)
{
    // Create the Transport
    $transport = Swift_SmtpTransport::newInstance('mail.attorney-at-law.greenrivertech.net', 25)
        ->setUsername('rhcj-email@attorney-at-law.greenrivertech.net')
        ->setPassword('capstone01');

    // Create the Mailer using your created Transport
    $mailer = Swift_Mailer::newInstance($transport);

    // Create the message to Arthur
    $messageToArthur = Swift_Message::newInstance()
        // Give the message a subject
        ->setSubject('A new referral has been submitted')
        // Set the From address with an associative array
        ->setFrom(array('arthur@delong.com' => 'Arthur DeLong Website'))
        // Set the To addresses with an associative array
        ->setTo(array('cbarbour@mail.greenriver.edu' => 'Hillary Wagoner'))
        // Give it a body
        ->setBody($body, 'text/html');

    // Send the message
    $mailer->send($messageToArthur);
}

function sendNewPassword($email, $name, $tempPW)
{
    // Create the Transport
    $transport = Swift_SmtpTransport::newInstance('mail.attorney-at-law.greenrivertech.net', 25)
        ->setUsername('rhcj-email@attorney-at-law.greenrivertech.net')
        ->setPassword('capstone01');

    // Create the Mailer using your created Transport
    $mailer = Swift_Mailer::newInstance($transport);

    // Create the message to Arthur
    $messageToUser = Swift_Message::newInstance()
        // Give the message a subject
        ->setSubject('Temporary Password')
        // Set the From address with an associative array
        ->setFrom(array('arthur@delong.com' => 'Arthur DeLong Website'))
        // Set the To addresses with an associative array
        ->setTo(array($email => $name))
        // Give it a body
        ->setBody('Your temporary password is: ' . $tempPW, 'text/html');

    // Send the message
    $mailer->send($messageToUser);
}

function testAttachment($name)
{
    // Create the Transport
    $transport = Swift_SmtpTransport::newInstance('mail.attorney-at-law.greenrivertech.net', 25)
        ->setUsername('rhcj-email@attorney-at-law.greenrivertech.net')
        ->setPassword('capstone01');

    // Create the Mailer using your created Transport
    $mailer = Swift_Mailer::newInstance($transport);

    // Create the message to Arthur
    $message = Swift_Message::newInstance()
        // Give the message a subject
        ->setSubject('A new purchase has been made')
        // Set the From address with an associative array
        ->setFrom(array('arthur@delong.com' => 'Arthur DeLong Website'))
        // Set the To addresses with an associative array
        ->setTo(array('hwagoner@mail.greenriver.edu' => 'Hillary Wagoner'))
        // Give it a body
        ->setBody("Attachment!", 'text/html')
        //add attachment
        ->attach(Swift_Attachment::fromPath($name . 'POAHealth.docx'));

    // Send the message
    $mailer->send($message);
}

?>