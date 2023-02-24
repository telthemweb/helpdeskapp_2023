<?php

namespace Ti\Helpdesk\App\http\controllers;

interface Report
{
    public function companies($date);
    public function todayinvoices($date);
    public function receipts($date);
    public function payments($date);
    public function systemlogs($date);
    public function customersystemlogs($date);
}