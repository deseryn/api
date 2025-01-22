<?php

namespace Unit;

use App\Persistence\MedicationLoader;
use App\Persistence\MedicationWriter;
use App\UserMedicationService;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * This class would be ideal for integration tests where you can test with an actual database with docker
 */
#[CoversClass(UserMedicationService::class)]
class UserMedicationServiceTest extends TestCase
{
    public function testCanRetrieveUserMedication(): void
    {
        $loader = $this->createMock(MedicationLoader::class);
        $loader->expects($this->once())->method('loadUserMedication')
            ->willReturn(['medication' => 'medication']); // return some data
        $writer = $this->createMock(MedicationWriter::class);
        $service = new UserMedicationService($loader, $writer);

        $this->assertSame(['medication' => 'medication'], $service->getUserMedicationsByUserId(1));
    }

    public function testRetrieveThrowsException()
    {
        $loader = $this->createMock(MedicationLoader::class);
        $loader->expects($this->once())->method('loadUserMedication')
            ->willThrowException(new \PDOException());
        $writer = $this->createMock(MedicationWriter::class);
        $service = new UserMedicationService($loader, $writer);

        $this->expectException(\PDOException::class);
        // $this->expectExceptionMessage();

        $service->getUserMedicationsByUserId(1);
    }
}