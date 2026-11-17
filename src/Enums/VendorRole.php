<?php

namespace JeffersonGoncalves\GdprVendors\Enums;

enum VendorRole: string
{
    /** Processes on your behalf (Art. 4(8)). Needs an Art. 28 contract. */
    case Processor = 'processor';

    /** Independent controller: decides its own purposes and means (Art. 4(7)). */
    case Controller = 'controller';

    /** Joint controller: decides purposes and means with you. Needs an Art. 26 arrangement. */
    case JointController = 'joint_controller';

    public function needsAgreement(): bool
    {
        return $this !== self::Controller;
    }
}
