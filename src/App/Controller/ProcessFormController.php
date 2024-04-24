<?php
namespace App\Controller;

use DateTime;
use DateTimeZone;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcessFormController
{
    /**
     * @Route("/process-form", name="process_form", methods={"POST"})
     */
    public function index(Request $request): Response
    {
        // Retrieve form data
        $date = $request->request->get('date') ?? '';
        $timezone = $request->request->get('timezone') ?? '';

        // Validate input
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return new Response('<h3 style="color: rgb(220, 53, 69)">Invalid date format! Please use YYYY-MM-DD.<h3>');
        }

        // Determine timezone offset in minutes
        if($timezone == '') {
            return new Response('<h3 style="color: rgb(220, 53, 69)">Please input timezone.<h3>');
        }

        $timezones = DateTimeZone::listIdentifiers();
        if (in_array($timezone, $timezones)) {
        $formatted_timezone = new DateTimeZone($timezone);
        } else {
        return new Response('<h3 style="color: rgb(220, 53, 69)">Timezone value is wrong.<h3>');
        }

        $dt = new DateTime($date.' 12:00:00', new DateTimeZone($timezone));
        $offset = $dt->getOffset() / 60;

        // Determine number of days in February in the year of the given date
        if (date('L', strtotime($date))) {
            $feb_days = 29;
        } else {
            $feb_days = 28;
        }

        // Determine number of days in the specified month
        $month = date('F', strtotime($date));
        $days_in_month = intval(date('t', strtotime($date)));

        // Generate output
        $output = "The timezone $timezone has ".($offset >= 0 ? '+' : '')."$offset minutes offset to UTC on given day at midnight.<br />";
        $output .= "February in this year has $feb_days days.<br />";
        $output .= "Specified month ($month) has $days_in_month days.";

        // Render the output as HTML in a template
        return new Response('<h3>'.$output.'</h3>');
    }
}