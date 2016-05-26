<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MEQP1\Sniffs\PHP;

use PHP_CodeSniffer_Sniff;
use PHP_CodeSniffer_File;

/**
 * Class PrivateClassMemberSniff
 * Detects possible usage of 'private' scope modifiers.
 */
class PrivateClassMemberSniff implements PHP_CodeSniffer_Sniff
{
    /**
     * String representation of warning.
     */
    protected $warningMessage = 'Use of private class members is discouraged.';

    /**
     * Warning violation code.
     */
    protected $warningCode = 'FoundPrivate';

    /**
     * @inheritdoc
     */
    public function register()
    {
        return [T_PRIVATE];
    }

    /**
     * @inheritdoc
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $phpcsFile->addWarning($this->warningMessage, $stackPtr, $this->warningCode);
    }
}
