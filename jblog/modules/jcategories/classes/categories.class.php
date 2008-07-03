<?php
/**
    * @package      jBlog
    * @subpackage   jCategories
    * @author       Thibault PIRONT < nuKs >
    * @copyright    2008 Thibault PIRONT
    * @link         http://forge.jelix.org/projects/sharecode/
	* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
    */

class categories {
    protected $dao_categories = "jcategories~categories";
    
    
    function getCategoryNameById($id) {
        $factory_categories = jDao::get($this->dao_categories);
        $daocategory = $factory_categories->get($id);
        $category = $daocategory->cat_name;
        return $category;
    }
    
    function getAllCategories() {
        $factory_categories = jDao::get($this->dao_categories);
        $categories = $factory_categories->findAll();
        $categoryList = array();
        foreach($categories as $c) {
            $categoryList[$c->cat_id] = $c->cat_name;
        }
        return $categoryList;
    }
        
    function createCategory($cat_name) {
        $factory_categories = jDao::get($this->dao_categories);
        $newCategory = jDao::createRecord($this->dao_categories);
        $newCategory->cat_name = $cat_name;
        $factory_categories->insert($newCategory);
        return $newCategory->getPk();
    }
}
?>