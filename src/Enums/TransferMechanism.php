<?php

namespace JeffersonGoncalves\GdprVendors\Enums;

/**
 * Grounds for a transfer outside the EEA (GDPR Chapter V).
 */
enum TransferMechanism: string
{
    case Adequacy = 'adequacy';                                  // Art. 45 (e.g. the EU-US Data Privacy Framework)
    case StandardClauses = 'standard_clauses';                   // Art. 46(2)(c)
    case BindingCorporateRules = 'binding_corporate_rules';      // Art. 47
    case CodesCertification = 'codes_certification';             // Art. 46(2)(e) and (f)
    case AdHocClauses = 'ad_hoc_clauses';                        // Art. 46(3)(a), authorised by the supervisory authority
    case AdministrativeArrangements = 'administrative_arrangements'; // Art. 46(3)(b), public authorities
    case Derogation = 'derogation';                              // Art. 49
}
