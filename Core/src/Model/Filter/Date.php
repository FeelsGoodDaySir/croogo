<?php
declare(strict_types=1);

namespace Croogo\Core\Model\Filter;

use DateInterval;
use DateTime;
use Search\Model\Filter\Base;

class Date extends Base
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'mode' => 'AND'
    ];

    /**
     * Filter by date value.  Date is assumes to be in UTC
     *
     * @return bool
     */
    public function process(): bool
    {
        $start = $this->value();
        if (!is_scalar($start)) {
            return false;
        }

        $field = current($this->fields());
        $end = new DateTime($start);
        $end = $end->add(new DateInterval('P1D'));
        $conditions = [
            $field . ' >' => $start,
            $field . ' <=' => $end->format('Y-m-d H:i:s'),
        ];

        $this->getQuery()->andWhere([$this->getConfig('mode') => $conditions]);

        return true;
    }
}
