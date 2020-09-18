<?php
declare(strict_types=1);

namespace Croogo\Taxonomy\Model\Table;

use Croogo\Core\Model\Table\CroogoTable;

/**
 * ModelTaxonomies
 *
 * @category Taxonomy.Model
 * @package  Croogo.Taxonomy.Model
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ModelTaxonomiesTable extends CroogoTable
{

    public function initialize(array $config): void
    {
        $this->setTable('model_taxonomies');
    }
}
