<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\Solution;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\Risk::class)]
final class RiskTest extends \PHPUnit\Framework\TestCase
{
    private Risk $risk;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->risk = new Risk();
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->risk->id);
        self::assertEquals('', $this->risk->name);
        self::assertEquals('', $this->risk->description);
        self::assertEquals('', $this->risk->descriptionRaw);
        self::assertNull($this->risk->unit);
        self::assertNull($this->risk->department);
        self::assertNull($this->risk->category);
        self::assertNull($this->risk->process);
        self::assertNull($this->risk->project);
        self::assertNull($this->risk->responsible);
        self::assertNull($this->risk->deputy);
        self::assertEquals([], $this->risk->getHistory());
        self::assertEquals([], $this->risk->getCauses());
        self::assertEquals([], $this->risk->getSolutions());
        self::assertEquals([], $this->risk->getRiskObjects());
        self::assertEquals([], $this->risk->files);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCauseInputOutput() : void
    {
        $this->risk->addCause(new Cause());
        self::assertCount(1, $this->risk->getCauses());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Cause', $this->risk->getCauses()[0]);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSolutionInputOutput() : void
    {
        $this->risk->addSolution(new Solution());
        self::assertCount(1, $this->risk->getSolutions());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Solution', $this->risk->getSolutions()[0]);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testRiskObjectInputOutput() : void
    {
        $this->risk->addRiskObject(2);
        self::assertCount(1, $this->risk->getRiskObjects());
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testHistoryInputOutput() : void
    {
        $this->risk->addHistory(2);
        self::assertCount(1, $this->risk->getHistory());
    }
}
