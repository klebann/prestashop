{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
{block name='header_banner'}
    <div class="header-banner">
        {hook h='displayBanner'}
    </div>
{/block}

{block name='header_nav'}
    <nav class="header-nav">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-12 links-nav hidden-sm-down">
                    <a href="#">Centrum pomocy</a>
                    <span class="separator">/</span>
                    <a href="#">Strefa wiedzy</a>
                    <span class="separator">/</span>
                    <a href="#">Kontakt</a>
                </div>
                <div class="col-md-3 right-nav hidden-sm-down">
                    <a href="#">Lorem ipsum</a>
                </div>
                <div class="hidden-md-up text-sm-center mobile">
                    <div class="float-xs-left" id="menu-icon">
                        <i class="material-icons d-inline">&#xE5D2;</i>
                    </div>
                    <div class="float-xs-right" id="_mobile_cart"></div>
                    <div class="float-xs-right" id="_mobile_user_info"></div>
                    <div class="top-logo" id="_mobile_logo"></div>
                </div>
            </div>
        </div>
    </nav>
{/block}

{block name='header_top'}
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-3 hidden-sm-down" id="_desktop_logo">
                  <h1 class="logo">
                    <a href="{$urls.base_url}">LOGO</a>
                  </h1>
                </div>

                <div class="col-md-6 col-sm-12">
                    {hook h='displaySearch'}
                </div>

                <div class="col-md-3 hidden-sm-down">
                    <div class="header-actions">

                        <a href="#" class="header-action">
                            <i class="material-icons">favorite_border</i>
                            <span>Ulubione</span>
                        </a>

                        <a href="#" class="header-action">
                            <i class="material-icons">person</i>
                            <span>Panel</span>
                        </a>

                        <a href="#" class="header-action">
                            <i class="material-icons">shopping_bag</i>
                            <span>Koszyk</span>
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>
    {hook h='displayNavFullWidth'}
{/block}
