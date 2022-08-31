<?php

/*
 * This file is part of the Osynapsy package.
 *
 * (c) Pietro Celeste <p.celeste@osynapsy.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Osynapsy\Ocl;

use Osynapsy\Html\Tag;
use Osynapsy\Html\Component;
use Osynapsy\Ocl\HiddenBox;
use Osynapsy\DataStructure\Tree;

/**
 * Description of TreeBox
 *
 * @author Pietro Celeste <p.celeste@osynapsy.net>
 */
class TreeBox2 extends Component
{
    private $nodeOpenIds = [];
    private $dataTree;

    const CLASS_SELECTED_LABEL = 'osy-treebox-label-selected';
    const ICON_NODE_CONNECTOR_EMPTY = '<span class="tree tree-null">&nbsp;</span>';
    const ICON_NODE_CONNECTOR_LINE = '<span class="tree tree-con-4">&nbsp;</span>';
    const ROOT_ID = 0;

    public function __construct($id)
    {
        parent::__construct('div', $id);
        $this->add(new HiddenBox("{$id}_sel"))->setClass('selectedNode');
        $this->add(new HiddenBox("{$id}_opn"))->setClass('openNodes');
        $this->setClass('osy-treebox');
        $this->requireJs('Ocl/TreeBox/script.js');
        $this->requireCss('Ocl/TreeBox/style2.css');
    }

    protected function __build_extra__(): void
    {
        foreach ($this->dataTree->get() as $node) {
            $this->add($this->node($node));
        }
    }

    protected function branch($item, $icons) : Tag
    {
        $branch = new Tag('div', null, 'osy-treebox-branch');
        $head   = $branch->add(new Tag('div', null, 'osy-treebox-node-head'));
        $head->add($this->icon($item, $icons));
        $head->add(new Tag('span', '', 'osy-treebox-node-label'))
             ->add($item[1]);
        $branchBody = $branch->add(
            new Tag('div', null, 'osy-treebox-branch-body')
        );
        if (!in_array($item[0], $this->nodeOpenIds) && ($item[3] != '1')) {
            $branchBody->addClass('d-none');
        }
        foreach ($item['_childrens'] as $node) {
            $branchBody->add($this->node($node, $icons));
        }
        return $branch;
    }

    protected function leaf($item, $icons) : Tag
    {
       $leaf = new Tag('div', null, 'osy-treebox-leaf');
       $leaf->add($this->icon($item, $icons));
       $leaf->add(new Tag('span', null, 'osy-treebox-node-label'))->add($item[1]);
       return $leaf;
    }

    protected function node($item, $icons = []) : Tag
    {
        if ($item['_level'] > -1){
            $icons[$item['_level']] = $item['_position'] === Tree::POSITION_END ? self::ICON_NODE_CONNECTOR_EMPTY: self::ICON_NODE_CONNECTOR_LINE;
        }
        return empty($item['_childrens']) ? $this->leaf($item, $icons) : $this->branch($item, $icons);
    }

    private function icon($node, $icons = [])
    {
        $class = "osy-treebox-branch-command tree-plus-".(!empty($node['_level']) && $node['_position'] === Tree::POSITION_BEGIN ? Tree::POSITION_BETWEEN : $node['_position']);
        if (empty($node['_childrens'])){
            $class = "tree-con-{$node['_position']}";
        } elseif (in_array($node[0], $this->nodeOpenIds) || !empty($node[3])) { //If node is open load minus icon
            $class .= ' minus';
        }
        //Sovrascrivo l'ultima icona con il l'icona/segmento corrispondente al comando / posizione
        $icons[$node['_level']] = sprintf('<span class="tree %s">&nbsp;</span>', $class);
        return implode('',$icons);
    }

    public function setData($data, $keyId = 0, $keyParentId = 2, $keyIsOpen = 3)
    {
        parent::setData($data);
        if (empty($this->data)){
            return $this;
        }
        $this->dataTree = new Tree($keyId, $keyParentId, $keyIsOpen, $this->getData());
        return $this;
    }
}
