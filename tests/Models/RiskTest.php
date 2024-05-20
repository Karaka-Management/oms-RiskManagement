<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\RiskManagement\Models\Risk;

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
        self::assertEquals(0, $this->risk->unit);
        self::assertNull($this->risk->department);
        self::assertNull($this->risk->category);
        self::assertNull($this->risk->process);
        self::assertNull($this->risk->project);
        self::assertNull($this->risk->responsible);
        self::assertNull($this->risk->deputy);
        self::assertEquals([], $this->risk->histScore);
        self::assertEquals([], $this->risk->causes);
        self::assertEquals([], $this->risk->solutions);
        self::assertEquals([], $this->risk->riskObjects);
        self::assertEquals([], $this->risk->files);
    }
}
