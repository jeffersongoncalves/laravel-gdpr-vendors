<?php

return [

    'table' => 'gdpr_vendors',

    /*
     * What a processor contract must cover (GDPR Art. 28(3)). Keys are stored on each vendor's
     * dpa_checklist; a processor (or joint controller) with an unchecked item is flagged.
     */
    'dpa_checklist' => [
        'instructions' => 'Processes personal data only on documented instructions from the controller (Art. 28(3)(a))',
        'confidentiality' => 'People authorised to process the data are bound to confidentiality (Art. 28(3)(b))',
        'security_measures' => 'Takes the security measures required by Art. 32 (Art. 28(3)(c))',
        'sub_processors' => 'Engages sub-processors only with authorisation and the same obligations (Art. 28(2) and (4))',
        'data_subject_rights' => 'Assists the controller in answering data subject requests (Art. 28(3)(e))',
        'compliance_assistance' => 'Assists with security, breach notification, DPIAs and prior consultation (Art. 28(3)(f))',
        'international_transfers' => 'Transfers outside the EEA only under a Chapter V mechanism',
        'deletion_on_termination' => 'Deletes or returns all personal data at the end of the services (Art. 28(3)(g))',
        'audits' => 'Makes information available and allows audits and inspections (Art. 28(3)(h))',
    ],

    /*
     * How often each risk tier must be reviewed, counted from the last review
     * (or from registration). CarbonInterval strings.
     */
    'review_every' => [
        'low' => '3 years',
        'medium' => '2 years',
        'high' => '1 year',
    ],

    /*
     * Countries where no transfer mechanism is needed: the European Economic Area
     * (EU member states plus Iceland, Liechtenstein and Norway). ISO 3166-1 alpha-2.
     */
    'eea' => [
        'AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT',
        'LV', 'LT', 'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE', 'IS', 'LI', 'NO',
    ],

    /*
     * Default country for new vendors.
     */
    'home_country' => 'IE',

];
