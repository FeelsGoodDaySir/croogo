<?php
declare(strict_types=1);

namespace Croogo\Meta\Model\Table;

use Croogo\Core\Model\Table\CroogoTable;
use Croogo\Meta\Model\Entity\Meta;

/**
 * Meta
 *
 * @category Meta.Model
 * @package  Croogo.Meta
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class MetaTable extends CroogoTable
{
    protected $_quoted;

    protected $_displayFields = [
        'key',
        'value',
    ];

    protected $_editFields = [
        'key',
        'value',
    ];

    public function initialize(array $config): void
    {
        $this->setTable('meta');
        $this->setEntityClass(Meta::class);
        $this->addBehavior('Timestamp');
        $this->addBehavior('Croogo/Core.Trackable');
        $this->addBehavior('Croogo/Core.Cached', [
            'groups' => [
                'settings',
            ],
        ]);
        $this->addBehavior('Search.Search');
    }

    /**
     * @return void
     */
    public function beforeSave()
    {
        $this->_quoted = $this->getConnection()
            ->getDriver()
            ->enableAutoQuoting();
        $this->getConnection()
            ->getDriver()
            ->enableAutoQuoting();
    }

    /**
     * @return void
     */
    public function afterSave()
    {
        $this->getConnection()
            ->getDriver()
            ->enableAutoQuoting($this->_quoted);
    }
}
