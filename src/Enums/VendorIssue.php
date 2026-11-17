<?php

namespace JeffersonGoncalves\GdprVendors\Enums;

enum VendorIssue: string
{
    case AgreementMissing = 'agreement_missing';
    case AgreementExpired = 'agreement_expired';
    case AgreementIncomplete = 'agreement_incomplete';
    case TransferMechanismMissing = 'transfer_mechanism_missing';
    case ReviewDue = 'review_due';
    case DataReturnPending = 'data_return_pending';

    public function description(): string
    {
        return match ($this) {
            self::AgreementMissing => 'No signed data processing agreement',
            self::AgreementExpired => 'The data processing agreement has expired',
            self::AgreementIncomplete => 'The data processing agreement misses checklist items',
            self::TransferMechanismMissing => 'Outside the EEA without a Chapter V transfer mechanism',
            self::ReviewDue => 'Periodic review is due',
            self::DataReturnPending => 'Relationship ended, data deletion or return not confirmed (Art. 28(3)(g))',
        };
    }
}
