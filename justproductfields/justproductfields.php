<?php
/*
 * 2007-2022 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2022 PrestaShop SA
 *  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
/**
 * @author    Justidea <dev@justidea.agency>
 * @copyright  Copyright 2022 Justidea Agency
 * @license    For personal use
 */

class JustProductFields extends Module {

	public function __construct() {
		$this->name = 'justproductfields';
        $this->tab = 'administration';
        $this->author = 'Justidea';
        $this->version = '1.0';
        $this->need_instance = 0;
        $this->bootstrap = true;
 
        parent::__construct();
 
        $this->displayName = $this->l('Justidea Product Fields');
        $this->description = $this->l('Custom field on product page');
        $this->ps_versions_compliancy = array('min' => '1.7.1', 'max' => _PS_VERSION_);
    }
 
    public function install() {
        if (!parent::install() || !$this->_installSql()
                || ! $this->registerHook('displayAdminProductsExtra')
                || ! $this->registerHook('displayProductAdditionalInfo')
                || ! $this->registerHook('displayAdminProductsMainStepLeftColumnMiddle')       
        ) {
            return false;
        }
 
        return true;
    }
 
    public function uninstall() {
        return parent::uninstall() && $this->_unInstallSql();
    }
 
    /**
    
     * @return boolean
     */
    public function _installSql() {
        $sqlInstall = "ALTER TABLE " . _DB_PREFIX_ . "product "
                . "ADD custom_field VARCHAR(255) NULL";
        $sqlInstallLang = "ALTER TABLE " . _DB_PREFIX_ . "product_lang "
                . "ADD custom_field_lang VARCHAR(255) NULL,"
                . "ADD custom_field_lang_wysiwyg TEXT NULL";
 
        $returnSql = Db::getInstance()->execute($sqlInstall);
        $returnSqlLang = Db::getInstance()->execute($sqlInstallLang);
 
        return $returnSql && $returnSqlLang;
    }
 
    /**
     * Suppression des modification sql du module
     * @return boolean
     */
    public function _unInstallSql() {
       $sqlInstall = "ALTER TABLE " . _DB_PREFIX_ . "product "
                . "DROP custom_field";
        $sqlInstallLang = "ALTER TABLE " . _DB_PREFIX_ . "product_lang "
                . "DROP custom_field_lang,DROP custom_field_lang_wysiwyg";
 
        $returnSql = Db::getInstance()->execute($sqlInstall);
        $returnSqlLang = Db::getInstance()->execute($sqlInstallLang);
 
        return $returnSql && $returnSqlLang;
    }
 
    public function hookDisplayAdminProductsExtra($params)
    {
    
    }
 
    /**
     * Affichage des informations supplémentaires sur la fiche produit
     * @param type $params
     * @return type
     */
    public function hookDisplayAdminProductsMainStepLeftColumnMiddle($params) {
        $product = new Product($params['id_product']);
        $languages = Language::getLanguages(false);
        $this->context->smarty->assign(array(
            'custom_field' => $product->custom_field,
            'custom_field_lang' => $product->custom_field_lang,
            'custom_field_lang_wysiwyg' => $product->custom_field_lang_wysiwyg,
            'languages' => $languages,
            'default_language' => $this->context->employee->id_lang,
            )
           );
        return $this->display(__FILE__, 'views/templates/hook/justproductfields.tpl');
    }
    public function hookDisplayProductAdditionalInfo($params){
        
        $product = new Product($params['id_product']);

        $params['product']->custom_field_lang_wysiwyg;
        if ($params['product']->custom_field_lang_wysiwyg){
			return '<span class="my-variable">'. $params['product']->custom_field_lang_wysiwyg.'</span>';
		} else {
			return '';
		}
    

    }
    // public function hookDisplayFooterProduct($params){
        
    //     $product = new Product($params['id_product']);

    //     $params['product']->custom_field_lang_wysiwyg;
    //     if ($params['product']->custom_field_lang_wysiwyg){
	// 		return '<span class="my-variable">'. $params['product']->custom_field_lang_wysiwyg.'</span>';
	// 	} else {
	// 		return '';
	// 	}
    

    // }
    
}
