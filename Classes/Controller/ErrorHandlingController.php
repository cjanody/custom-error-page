<?php
declare(strict_types=1);

namespace Bitmotion\CustomErrorPage\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 Cyril Janody <cyril.janody@fsg.ulaval.ca>, FSG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;


/**
 * Class ErrorHandlingController
 *
 * @package Bitmotion\CustomErrorPage\Controller
 */
class ErrorHandlingController extends ActionController
{
    /**
     * action show
     *
     * @return string
     */
    public function showAction(): string
    {
        switch (GeneralUtility::_GET('reason')) {
            case 'Page is not available in default language.':
            case 'Page is not available in the requested language.':
            case 'Page is not available in the requested language (strict).':
            case 'Page is not available in the requested language (fallbacks did not apply).':
                $contentElements = $this->settings['pageNotTranslated'];
                break;
            default:
                $contentElements = $this->settings['pageNotFound'];
        }

        $this->view->assign('contentElements', $contentElements);

        return $this->view->render();
    }
}
