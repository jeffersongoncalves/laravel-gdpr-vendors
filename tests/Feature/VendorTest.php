<?php

use Illuminate\Support\Facades\Artisan;
use JeffersonGoncalves\GdprVendors\Enums\TransferMechanism;
use JeffersonGoncalves\GdprVendors\Enums\VendorIssue;
use JeffersonGoncalves\GdprVendors\Enums\VendorRisk;
use JeffersonGoncalves\GdprVendors\Enums\VendorRole;
use JeffersonGoncalves\GdprVendors\Models\Vendor;

function fullChecklist(): array
{
    return array_fill_keys(array_keys(config('gdpr-vendors.dpa_checklist')), true);
}

it('flags a processor without an agreement and abroad without a mechanism', function () {
    $vendor = Vendor::create(['name' => 'Stripe', 'role' => VendorRole::Processor, 'country' => 'us']);

    expect($vendor->issues())->toBe([VendorIssue::AgreementMissing, VendorIssue::TransferMechanismMissing]);

    $vendor->update([
        'dpa_signed_at' => now(),
        'dpa_checklist' => fullChecklist(),
        'transfer_mechanism' => TransferMechanism::StandardClauses,
    ]);

    expect($vendor->issues())->toBe([]);
});

it('flags an incomplete or expired agreement', function () {
    $vendor = Vendor::create([
        'name' => 'Mailer',
        'role' => VendorRole::Processor,
        'dpa_signed_at' => now(),
        'dpa_expires_at' => now()->addMonth(),
        'dpa_checklist' => ['instructions' => true, 'audits' => false],
    ]);

    expect($vendor->issues())->toBe([VendorIssue::AgreementIncomplete])
        ->and($vendor->missingChecklistItems())->toContain('audits', 'security_measures')->not->toContain('instructions');

    $vendor->update(['dpa_checklist' => fullChecklist()]);
    $this->travel(2)->months();

    expect($vendor->issues())->toBe([VendorIssue::AgreementExpired]);
});

it('needs no agreement from an independent controller', function () {
    expect(Vendor::create(['name' => 'Revenue Commissioners', 'role' => VendorRole::Controller])->issues())->toBe([]);
});

it('asks for a review by risk tier', function () {
    $high = Vendor::create(['name' => 'Payroll', 'role' => VendorRole::Controller, 'risk' => VendorRisk::High]);
    $low = Vendor::create(['name' => 'Florist', 'role' => VendorRole::Controller, 'risk' => VendorRisk::Low]);

    $this->travel(13)->months();

    expect($high->issues())->toBe([VendorIssue::ReviewDue])
        ->and($low->issues())->toBe([])
        ->and($high->markReviewed()->issues())->toBe([]);
});

it('owes the data deletion or return after termination', function () {
    $vendor = Vendor::create(['name' => 'Old CRM', 'role' => VendorRole::Processor])->terminate();

    expect($vendor->issues())->toBe([VendorIssue::DataReturnPending])
        ->and(Vendor::query()->scopes('active')->count())->toBe(0)
        ->and($vendor->confirmDataReturned()->issues())->toBe([]);
});

it('lists vendors and their issues', function () {
    Vendor::create(['name' => 'Stripe', 'role' => VendorRole::Processor, 'country' => 'US']);
    Vendor::create(['name' => 'Revenue Commissioners', 'role' => VendorRole::Controller]);

    Artisan::call('gdpr:vendors');
    expect(Artisan::output())->toContain('Stripe')->toContain('No signed data processing agreement')->toContain('1 vendor(s) with issues.');

    Artisan::call('gdpr:vendors', ['--json' => true, '--issues' => true]);
    expect(json_decode(Artisan::output(), true))->toHaveCount(1)
        ->{0}->issues->toBe(['agreement_missing', 'transfer_mechanism_missing']);
});

it('treats any EEA country as home', function () {
    expect(Vendor::create(['name' => 'Hosting', 'role' => VendorRole::Controller, 'country' => 'de'])->isAbroad())->toBeFalse()
        ->and(Vendor::create(['name' => 'Support', 'role' => VendorRole::Controller, 'country' => 'NO'])->isAbroad())->toBeFalse()
        ->and(Vendor::create(['name' => 'Analytics', 'role' => VendorRole::Controller, 'country' => 'GB'])->isAbroad())->toBeTrue();
});
