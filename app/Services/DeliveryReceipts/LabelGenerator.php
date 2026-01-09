<?php

namespace App\Services\DeliveryReceipts;

use App\Models\DeliveryReceipt;
use Endroid\QrCode\Builder\Builder as QrCodeBuilder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\PngEncoder;
use Intervention\Image\ImageManager;

class LabelGenerator
{
    public function __construct(
        public DeliveryReceipt $deliveryReceipt
    ) {
    }

    protected function qrCode(): string
    {
        $route = route('delivery-receipts.show', $this->deliveryReceipt);

        $builder = new QrCodeBuilder(
            writer: new PngWriter(),
            writerOptions: [],
            validateResult: false,
            data: $route,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 95,
            margin: 0,
            roundBlockSizeMode: RoundBlockSizeMode::None
        );

        return $builder->build()->getDataUri();
    }

    public function label()
    {
        $width = 284;
        $height = 188;

        // Create a new manager instance with desired driver
        $manager = new ImageManager(Driver::class);

        // Create a new image
        $image = $manager->create($width, $height)
            ->fill('fff');

        // Add app string
        $image->text('Front Desk App', 10, 90, function ($font) {
            $font->file(storage_path('fonts/DejaVuSansCondensed.ttf'));
            $font->size(13);
        });

        // Add reference string
        $referenceString = $this->deliveryReceipt->reference;

        $image->text($referenceString, 10, 130, function ($font) {
            $font->file(storage_path('fonts/DejaVuSansCondensed-Bold.ttf'));
            $font->size(15);
        });

        // Add location
        $volumesString = trans_choice('app.locations', 1).': '.$this->deliveryReceipt->location->name;

        $image->text($volumesString, 10, 152, function ($font) {
            $font->file(storage_path('fonts/DejaVuSansCondensed.ttf'));
            $font->size(13);
        });

        // Add volumes string
        $volumesString = trans_choice('app.volumes', 0).': '.$this->deliveryReceipt->volumes;

        $image->text($volumesString, 10, 172, function ($font) {
            $font->file(storage_path('fonts/DejaVuSansCondensed.ttf'));
            $font->size(13);
        });

        // Add Spot logo
        $logo = $manager->read(public_path('images/osd-logo.webp'));
        $logo->resize(100, 49);
        $image->place($logo, 'top-left', 10, 8);

        // Add QR code
        $image->place($this->qrCode(), 'top-right', 10, 8);

        return $image->encode(new PngEncoder());
    }

    public function store()
    {
        $image = $this->label();

        return $this->deliveryReceipt
            ->addMediaFromString((string) $image)
            ->usingFileName("delivery-receipt-{$this->deliveryReceipt->id}.png")
            ->usingName("Delivery Receipt {$this->deliveryReceipt->id} Label")
            ->toMediaCollection('label');
    }
}
