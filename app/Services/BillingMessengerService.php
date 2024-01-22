<?php

namespace App\Services;

use App\Models\Billing;
use App\Models\BillingNoticeHistories;
use App\Models\Customers;
use App\Models\Subscription;
use App\Services\SendMessages;
use App\Traits\TextReplacementTrait;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BillingMessengerService
{
    use TextReplacementTrait;

    public function index()
    {
        $dayName = strtolower(Carbon::now()->dayName);
        $column_name = "{$dayName}_billing";

        $thresholdDate =  Carbon::now();

        $billing = DB::table('billings')
            ->whereDate('last_shipment', '!=', $thresholdDate)
            ->where('automatic_sending', 1)
            ->where('daily_billing', 1)
            ->orWhere($column_name, 1)
            ->get();

        foreach ($billing as $bill) {
            $this->processCustomerNotification($bill);
        }
    }

    public function indexSingle($bill)
    {
        $this->processCustomerNotification($bill);
    }

    protected function processCustomerNotification($bill)
    {
        switch ($bill->customer_subscription_status) {
            case 'active':
                $this->handleActiveCustomers($bill);
                break;
            case 'all_client':
                $this->handleAllCustomers($bill);
                break;
            case 'in_active':
                $this->handleInactiveCustomers($bill);
                break;
            case 'already_due':
                $this->handleAlreadyDueCustomers($bill);
                break;
            case 'due_today':
                $this->handleDueTodayCustomers($bill);
                break;
        }
    }

    // TESTED
    protected function handleActiveCustomers($bill)
    {
        $customers = Customers::when($bill->server, function ($query) use ($bill) {
            $query->orWhere('server', $bill->server);
        })
            ->when($bill->application_id, function ($query) use ($bill) {
                $query->orWhere('application_id', $bill->application_id);
            })
            ->when($bill->device_id, function ($query) use ($bill) {
                $query->orWhere('device_id', $bill->device_id);
            })->get();

        $subscription = [];
        $customerIds = [];

        foreach ($customers as $customer) {
            $rawSub = Subscription::where('customer_id', $customer->id)
                ->where('customer_id', '!=', null)
                ->where('active_status', 1);

            $thresholdDate = $bill->days_to_expire == 0 ?
                Carbon::now() :
                Carbon::now()->subDays($bill->days_to_expire);

            $rawSub = $bill->days_to_expire == 0 ?
                $rawSub->whereDate('next_due_date', '>=', $thresholdDate) :
                $rawSub->whereDate('next_due_date', $thresholdDate);

            $rawSub = $rawSub->orderBy('id', 'desc')->first();

            if ($rawSub) {
                $subscription[] = $rawSub;
                $customerIds[] = $customer;
                // YOU CAN SEND THE MESSAGE HERE
            }
        }

        $this->initMessage("ALL ACTIVE CUSTOMERS", count($subscription), $bill->default_message, $customerIds, $bill->id, $bill->created_by);
    }



    // TESTED
    protected function handleAllCustomers($bill)
    {

        $customer_list = Customers::when($bill->server, function ($query) use ($bill) {
            $query->orWhere('server', $bill->server);
        })
            ->when($bill->application_id, function ($query) use ($bill) {
                $query->orWhere('application_id', $bill->application_id);
            })
            ->when($bill->device_id, function ($query) use ($bill) {
                $query->orWhere('device_id', $bill->device_id);
            });



        if ($bill->days_to_expire > 0) {
            $thresholdDate = Carbon::now()->subDays($bill->days_to_expire);
            $customer_list->whereDate('created_at', $thresholdDate);
        }

        $customers = $customer_list->get();
        $number_of_customers = $customers->count();

        $customerIds = $customers;

        $this->initMessage("ALL CUSTOMERS", $number_of_customers, $bill->default_message, $customerIds, $bill->id, $bill->created_by);
    }



    // TESTED
    protected function handleInactiveCustomers($bill)
    {

        $customers = Customers::when($bill->server, function ($query) use ($bill) {
            $query->orWhere('server', $bill->server);
        })
            ->when($bill->application_id, function ($query) use ($bill) {
                $query->orWhere('application_id', $bill->application_id);
            })
            ->when($bill->device_id, function ($query) use ($bill) {
                $query->orWhere('device_id', $bill->device_id);
            })->get();

        $subscription = [];
        $customerIds = [];

        foreach ($customers as $customer) {
            $rawSub = Subscription::where('customer_id', $customer->id)
                ->where('customer_id', '!=', null)
                ->orderBy('id', 'desc')
                ->first();

            if ($rawSub && $rawSub->active_status == 0) {
                $subscription[] = $rawSub;
                $customerIds[] = $customer;
                // YOU CAN SEND THE MESSAGE HERE
            }
        }

        $this->initMessage("ALL INACTIVE CUSTOMERS", count($subscription), $bill->default_message, $customerIds, $bill->id, $bill->created_by);
    }


    //TESTED
    protected function handleAlreadyDueCustomers($bill)
    {

        $customers = Customers::when($bill->server, function ($query) use ($bill) {
            $query->orWhere('server', $bill->server);
        })
            ->when($bill->application_id, function ($query) use ($bill) {
                $query->orWhere('application_id', $bill->application_id);
            })
            ->when($bill->device_id, function ($query) use ($bill) {
                $query->orWhere('device_id', $bill->device_id);
            })->get();

        $subscription = [];
        $customerIds = [];

        foreach ($customers as $customer) {
            $rawSub = Subscription::where('customer_id', $customer->id)
                ->where('customer_id', '!=', null)
                ->where('active_status', 1);

            $thresholdDate = $bill->days_to_expire == 0 ?
                Carbon::now() :
                Carbon::now()->subDays($bill->days_to_expire);

            $rawSub = $bill->days_to_expire == 0 ?
                $rawSub->whereDate('next_due_date', '<', $thresholdDate) :
                $rawSub->whereDate('next_due_date', $thresholdDate);

            $rawSub = $rawSub->orderBy('id', 'desc')->first();

            if ($rawSub) {
                $subscription[] = $rawSub;
                $customerIds[] = $customer;
                // YOU CAN SEND THE MESSAGE HERE
            }
        }


        $this->initMessage("ALL ALREADY DUE CUSTOMERS", count($subscription), $bill->default_message, $customerIds, $bill->id, $bill->created_by);
    }

    //TESTED
    protected function handleDueTodayCustomers($bill)
    {
        $customers = Customers::when($bill->server, function ($query) use ($bill) {
            $query->orWhere('server', $bill->server);
        })
            ->when($bill->application_id, function ($query) use ($bill) {
                $query->orWhere('application_id', $bill->application_id);
            })
            ->when($bill->device_id, function ($query) use ($bill) {
                $query->orWhere('device_id', $bill->device_id);
            })->get();


        $subscription = [];
        $customerIds = [];

        foreach ($customers as $customer) {
            $rawSub = Subscription::where('customer_id', $customer->id)
                ->where('customer_id', '!=', null)
                ->where('active_status', 1)
                ->whereDate('next_due_date', Carbon::now())
                ->orderBy('id', 'desc')
                ->first();

            if ($rawSub) {
                $subscription[] = $rawSub;
                $customerIds[] = $customer;
                // YOU CAN SEND THE MESSAGE HERE
            }
        }

        $this->initMessage("ALL DUE TODAY CUSTOMERS", count($subscription), $bill->default_message, $customerIds, $bill->id, $bill->created_by);
    }


    protected function initMessage($title, $count, $message, $customers, $billId, $sender_id)
    {
        echo "_______________________________________<br>" . PHP_EOL;
        echo "$title<br>" . PHP_EOL;
        echo "Customer count: " . $count . PHP_EOL;
        echo "Customer IDs: " . print_r($customers, true)  . PHP_EOL;
        echo "Message: " . $message . PHP_EOL;
        echo "Bill ID: " . $billId . PHP_EOL;


        if (count($customers) > 0) {
            $customer_received_count = 0;
            $billingHistories = [];

            foreach ($customers as $customer) {
                $processedText = $this->replacePlaceholdersBulk($customer,  $message);

                $sendMsg = new SendMessages();
                $sendMsg->send($customer->whatsapp, $processedText,  $sender_id);

                // Create billing history records for bulk insert
                $billingHistories[] = [
                    'customer_id' => $customer->id,
                    'billing_id' => $billId,
                    'notice_delivery_status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                Log::info("MESSAGE: {$processedText}");
                $customer_received_count += 1;
            }

            // Bulk insert billing histories
            try {
                BillingNoticeHistories::insert($billingHistories);
            } catch (\Exception $e) {
                Log::warning($e->getMessage());
            }

            // Update last shipment date and counts in a single query
            try {
                $currentDate = now();

                Billing::where('id', $billId)->update([
                    'last_shipment' => $currentDate,
                    'customer_count' => $count,
                    'customer_received_count' => $customer_received_count,
                ]);
            } catch (\Exception $e) {
                Log::warning($e->getMessage());
            }

            Log::info("TITLE: {$title}, CUSTOMER COUNT: {$count}, MESSAGE: {$message}, CUSTOMER IDs: " . json_encode($customers) . ", BILL ID: {$billId}");
        }
    }
}
