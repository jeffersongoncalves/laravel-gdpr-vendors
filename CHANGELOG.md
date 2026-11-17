# Changelog

All notable changes to this project will be documented in this file.

## 1.0.0 - 2026-11-17

First release: GDPR vendor register for Laravel, part of the laravel-gdpr suite.

- Processors, independent controllers and joint controllers, each with a risk tier, the services they provide and the data shared with them.
- The processor contract: signed and expiry dates, plus a checklist of what Art. 28(3) says it must cover. You can change the checklist in the config.
- Vendors outside the EEA (EU, Iceland, Liechtenstein, Norway) need a Chapter V mechanism: adequacy, standard contractual clauses, BCRs, codes or certification, ad hoc clauses, administrative arrangements or an Art. 49 derogation.
- Reviews by risk tier, termination and confirmation that the data was deleted or returned (Art. 28(3)(g)).
- `issues()` lists what each vendor still owes, and `gdpr:vendors [--issues] [--json]` reports it.

## [Unreleased]
