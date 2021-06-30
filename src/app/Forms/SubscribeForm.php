<?php

namespace Prophe1\WPProjectsCore\Forms;

use Prophe1\WPProjectsCore\Feature;
use Prophe1\WPProjectsCore\Services\Sendgrid;

class SubscribeForm extends Feature
{
    /**
     * @var int
     */
    private $formToSkip;

    /**
     * @param $contact_form
     * @param $abort
     * @param $submission
     */
    public function subscribeToNewsletter($contact_form, $abort, $submission)
    {
        $postedData = $submission->get_posted_data();

        if (! array_key_exists('subscribe-newsletter', $postedData)) {
            return $abort;
        }

        // Skip this form from sending mail
        $this->setFormToSkip(
            $contact_form->id()
        );

        try {
            $service = new Sendgrid();

            $service->addContacts(
                [
                    $postedData['subscribe-newsletter']
                ],
                [
                    [
                        'first_name' => $postedData['first_name'],
                        'last_name' => $postedData['last_name'],
                        'email' => $postedData['email'],
                        'full_name' => $postedData['full_name'],
                        'company_name' => $postedData['company_name'],
                    ]
                ]
            );
        } catch (\Exception $e) {
            error_log($e->getMessage());

            return true;
        }

        return $abort;
    }

    /**
     * @param $skip
     * @param $contact_form
     * @return bool
     */
    public function skipMail($skip, $contact_form)
    {
        if ($contact_form->id() === $this->getFormToSkip()) {
            return true;
        }

        return false;
    }

    /**
     * @param int $value
     */
    public function setFormToSkip(int $value) : void
    {
        $this->formToSkip = $value;
    }

    /**
     * @return int
     */
    public function getFormToSkip()
    {
        return $this->formToSkip;
    }

    /**
     * Register Functionality
     */
    public function register()
    {
        add_action('wpcf7_before_send_mail', [$this, 'subscribeToNewsletter'], 10, 3);
        add_filter('wpcf7_skip_mail', [$this, 'skipMail'], 10, 2);
    }
}
