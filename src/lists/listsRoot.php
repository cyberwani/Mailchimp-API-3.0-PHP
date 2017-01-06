<?php

class Lists extends Mailchimp
{

    public $subclass_resource;

    //SUBCLASS INSTANTIATIONS
    public $webhooks;
    public $signup_forms;
    public $merge_fields;
    public $growth_history;
    public $clients;
    public $activity;
    public $abuse;
    public $segments;
    public $members;
    public $interest_categories;


    function __construct($apikey, $class_input)
    {
        parent::__construct($apikey);

        if (isset($class_input)) {
            $this->url .= '/lists/' . $class_input;;
        } else {
            $this->url .= '/lists/';
        }
        $this->subclass_resource = $class_input;

    }

    public function GET( $query_params = null )
    {
        $query_string = '';

        if (is_array($query_params)) {
            $query_string = $this->constructQueryParams($query_params);
        }

        $url = $this->url . $query_string;
        $response = $this->curlGet($url);

        return $response;
    }

    public function BATCH_SUB($members = array(), $update_existing)
    {

        $params = array(
            'members' => $members,
            'update_existing' => $update_existing
        );
        $payload = json_encode($params);

        $url = $this->url;

        $response = $this->curlPost($url, $payload);

        return $response;

    }

    public function POST(
        $name,
        $reminder,
        $emailtype,
        $company,
        $address_street,
        $address_street2,
        $address_city,
        $address_state,
        $address_zip,
        $country,
        $from_name,
        $from_email,
        $subject,
        $language,
        $optional_parameters = array()
    ) {

        $params = array('name' => $name,
                        'permission_reminder' => $reminder,
                        'email_type_option' => $emailtype,
                        'contact' => array('company' => $company,
                                           'address1' => $address_street,
                                           'city' => $address_city,
                                           'state' => $address_state,
                                           'zip' => $address_zip,
                                           'country' => $country),
                        'campaign_defaults' => array('from_name' => $from_name,
                                                     'from_email' => $from_email,
                                                     'subject' => $subject,
                                                     'language' => $language)
                        );

        if (!is_null($address_street2)) {
            $params['address2'] = $address_street2;
        }

        if (!is_null($optional_parameters['phone'])) {
            $params['contact']['phone'] = $optional_parameters['phone'];
        }

        $payload = json_encode($params);
        $url = $this->url;

        $response = $this->curlPost($url, $payload);

        return $response;

    }

    public function PATCH($patch_params = null)
    {

        $payload = json_encode($patch_params);
        $url = $this->url;

        $response = $this->curlPatch($url, $payload);

        return $response;
    }

    public function DELETE()
    {
        $url = $this->url;
        $response = $this->curlDelete($url);

        return $response;
    }

    //SUBCLASS FUNCTIONS ------------------------------------------------------------

    public function webhooks( $class_input = null )
    {
        $this->webhooks = new Lists_Webhooks(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->webhooks;
    }

    public function signupForms( $class_input = null )
    {
        $this->signup_forms = new Lists_Signup_Forms(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->signup_forms;
    }

    public function mergeFields( $class_input = null )
    {
        $this->merge_fields = new Lists_Merge_Fields(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->merge_fields;
    }

    public function growthHistory( $class_input = null )
    {
        $this->growth_history = new Lists_Growth_History(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->growth_history;
    }

    public function clients( $class_input = null )
    {
        $this->clients = new Lists_Clients(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->clients;
    }

    public function activity( $class_input = null )
    {
        $this->activity = new Lists_Activity(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->activity;
    }

    public function abuseReports( $class_input = null )
    {
        $this->abuse = new Lists_Abuse_Reports(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->abuse;
    }

    public function segments( $class_input = null )
    {
        $this->segments =  new Lists_Segments(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->segments;
    }

    public function members( $class_input = null )
    {
        $this->members = new Lists_Members(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->members;
    }

    public function interestCategories( $class_input = null )
    {
        $this->interest_categories = new Lists_Interest_Categories(
            $this->apikey,
            $this->subclass_resource,
            $class_input
        );
        return $this->interest_categories;
    }

}