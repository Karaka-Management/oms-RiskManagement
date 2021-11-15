<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\Solution;

/**
 * @internal
 */
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

    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->risk->getId());
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
        self::assertEquals([], $this->risk->getMedia());
    }

    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testCauseInputOutput() : void
    {
        $this->risk->addCause(new Cause());
        self::assertCount(1, $this->risk->getCauses());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Cause', $this->risk->getCauses()[0]);
    }

    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testSolutionInputOutput() : void
    {
        $this->risk->addSolution(new Solution());
        self::assertCount(1, $this->risk->getSolutions());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Solution', $this->risk->getSolutions()[0]);
    }

    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testRiskObjectInputOutput() : void
    {
        $this->risk->addRiskObject(2);
        self::assertCount(1, $this->risk->getRiskObjects());
    }

    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testHistoryInputOutput() : void
    {
        $this->risk->addHistory(2);
        self::assertCount(1, $this->risk->getHistory());
    }

    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testMediaInputOutput() : void
    {
        $this->risk->addMedia(2);
        self::assertCount(1, $this->risk->getMedia());
    }
}
