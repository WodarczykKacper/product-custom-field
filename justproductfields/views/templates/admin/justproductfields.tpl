{*
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
 *
 *
 * @author    Justidea <dev@justidea.agency>
 * @copyright  Copyright 2022 Justidea Agency
 * @license    For personal use
 *
*}

<div class="m-b-1 m-t-1">
    <h2>{l s='Justidea Product Fields' mod='justproductfields'}</h2>
    <fieldset class="form-group">
        {* <div class="col-lg-12 col-xl-4">
            <label class="form-control-label">{l s='Admin field' mod='justproductfields'}</label>
            <input class="form-control" name="custom_field" type="text">
            <br />
            <label class="form-control-label">{l s='Multilingual field' mod='justproductfields'}</label>
            <div class="translations tabbable">
                <div class="translationsFields tab-content">
                    {foreach from=$languages item=language }
                    <div class="tab-pane translation-label-{$language.iso_code} {if $default_language == $language.id_lang}active{/if}">
                        <input class="form-control" name="custom_field_lang_{$language.id_lang}" type="text">
                    </div>{/foreach}
                </div>
            </div>
            <br />
        </div> *}
        <div class="col-lg-12 col-xl-12">
            <label class="form-control-label">{l s='Custom field' mod='justproductfields'}</label>
            <div class="translations tabbable">
                <div class="translationsFields tab-content bordered">
                    {foreach from=$languages item=language }
                    <div class="tab-pane translation-label-{$language.iso_code} {if $default_language == $language.id_lang}active{/if}">
                        <textarea class="autoload_rte" name="custom_field_lang_wysiwyg_{$language.id_lang}">{if isset({$custom_field_lang_wysiwyg[$language.id_lang]}) && {$custom_field_lang_wysiwyg[$language.id_lang]} != ''}{$custom_field_lang_wysiwyg[$language.id_lang]}{/if}</textarea>
                    </div>{/foreach}
                </div>
            </div>
        </div>
    </fieldset>
    <div class="clearfix"></div>
</div>