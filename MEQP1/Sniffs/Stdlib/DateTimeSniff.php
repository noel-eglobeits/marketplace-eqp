<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MEQP1\Sniffs\Stdlib;

use PHP_CodeSniffer_Sniff;
use PHP_CodeSniffer_File;

/**
 * Class DateTimeSniff
 * Detects overcomplicated Date/Time handling.
 */
class DateTimeSniff implements PHP_CodeSniffer_Sniff
{

    /**
     * String representation of warning.
     */
    protected $warningMessage = "Overcomplicated Date/Time handling. Use Mage::getSingleton('core/date') instead.";

    /**
     * Warning violation code.
     */
    protected $warningCode = 'Overcomplicated';

    /**
     * Class name to find.
     */
    protected $dateTimeClasses = [
        'Zend_Date',
        'Zend_Locale',
        'Varien_Date',
    ];

    /**
     * Function name to find.
     */
    protected $dateTimeFunctions = [
        'strftime',
        'time',
        'date',
        'gmdate',
        'localtime',
        'date_create',
        'date_format',
    ];

    /**
     * @inheritdoc
     */
    public function register()
    {
        return [T_STRING];
    }

    /**
     * @inheritdoc
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        if (in_array($tokens[$stackPtr]['content'], $this->dateTimeClasses)
            || in_array($tokens[$stackPtr]['content'], $this->dateTimeFunctions)
        ) {
            $phpcsFile->addWarning($this->warningMessage, $stackPtr, $this->warningCode, $stackPtr);
        }
    }
}
